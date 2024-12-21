<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */

class Form_generator extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('generator_model','app');
    }
    public function index()
    {
        $list_table = $this->app->get_list_table();

        $data = array(
            'page_title'    => 'Form Generator',
            'list_table'    => $list_table
        );
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Form Generator');
        $this->template->write_view('content', 'generator/form_generator', $data, true);
        $this->template->render();
    }
    public function set_columns() {
        //print_r($this->app->get_by_column_name('tbl_line_code', 'harga'));
        $table_name     = $this->input->post('table_name');
        $list_table = $this->app->get_list_table();
        $list_column    = $this->app->get_list_column($table_name);
        $data = array(
            'page_title'    => 'Form Generator - Set Columns',
            'table'         => $table_name,
            'list_column'   => $list_column,
            'list_table'    => $list_table
        );

        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->write('title', 'Form Generator');
        $this->template->write_view('content', 'generator/set_column', $data, true);
        $this->template->render();
    }
    function proses() {
        $controller_name    = $this->input->post('controller_name');
        $table_name         = $this->input->post('table_name');
        $dir_views = './application/views/'.strtolower($controller_name);
        if ( !is_dir($dir_views) ) {
            mkdir($dir_views, 0555);
        }

        $this->generate_controller($table_name);
        $this->generate_model($table_name);
        $this->generate_datatable($table_name);
        $this->generate_form($table_name);

        redirect(base_url().$controller_name);
    }
    private function generate_controller($table_name) {
        $primary_key        = '';
        $controller_name    = $this->input->post('controller_name');
        $title              = $this->input->post('title');
        $is_primary_key         = $this->input->post('primary_key');
        $column_name        = $this->input->post('column_name');
        $show_in_form       = $this->input->post('show_in_form');
        $show_in_table      = $this->input->post('show_in_table');
        $is_readonly        = $this->input->post('is_readonly');
        $reference_table_name   = $this->input->post('reference_table_name');
        $reference_pk_name      = $this->input->post('reference_pk_name');
        $reference_value_name   = $this->input->post('reference_value_name');
        $reference_filtered_by  = $this->input->post('reference_filtered_by');

        $file_template = './template/controller.php';
        $file_destination = './application/controllers/'.ucfirst(strtolower($controller_name)).'.php';
        if ( file_exists($file_destination) ) {
            unlink($file_destination);
        }
        copy($file_template, $file_destination);

        $column_datatable   = array();
        $column_form        = array();
        $current_column   = array();
        for( $i=0; $i<count($column_name); $i++ ) {
            $datacolumn = $this->app->get_by_column_name($table_name, $column_name[$i]);
            if ( $datacolumn ) {
                if ( is_array($is_primary_key) && in_array($datacolumn->name, $is_primary_key) )
                    $primary_key = $datacolumn->name;


                if ( is_array($show_in_table) && in_array($datacolumn->name, $show_in_table) ) {
                    if ( !empty($reference_table_name[$i]) && !empty($reference_pk_name[$i]) && !empty($reference_value_name[$i]) ) {
                        $column_datatable[] = $reference_value_name[$i];
                    } else if ( !in_array($datacolumn->name, $current_column)) {
                        $column_datatable[] = $datacolumn->name;
                    }
                    $current_column[] = $datacolumn->name;
                }
                if ( is_array($show_in_form) && in_array($datacolumn->name, $show_in_form) ) {
                    $column_form[] = $datacolumn;
                }
            }
        }
        if ( empty($primary_key) ) {
            echo 'Primary Key Tidak Ditemukan!';
            exit();
        }
        $data = file_get_contents($file_destination);
        $newdata    = str_replace('class _ControllerName_', 'class '.ucfirst(strtolower($controller_name)), $data);
        $newdata    = str_replace('_page_title_',$title,$newdata);
        $string_column_datatable = "'".$primary_key."', '".implode("','",$column_datatable)."'";
        $newdata    = str_replace('_column_datatable_', $string_column_datatable, $newdata);
        $newdata    = str_replace('_ControllerName_', strtolower($controller_name), $newdata);
        $disable_sorting = count($column_datatable)+1;
        $newdata    = str_replace('_disable_sort_datatable_', $disable_sorting, $newdata);
        $string_conf_validation = '$config = array(';
        foreach ( $column_form as $f ) {
            $field_rules = '';
            if ( $f->is_null == 0 ) {
                $field_rules .= 'required|';
            }
            if ( !empty($f->max_length) && $f->max_length > 0 ) {
                $field_rules .= 'max_length['.$f->max_length.']|';
            }
            if ( $f->type == 'int' ) {
                $field_rules .= 'integer|';
            }
            if ( in_array($f->type, array('decimal','float')) ) {
                $field_rules .= 'numeric|';
            }
            if ( preg_match('/email/', $f->name) ) {
                $field_rules .= 'valid_email|';
            }
            $field_rules = empty($field_rules) ? NULL : substr($field_rules,0,strlen($field_rules)-1);

            if ( !empty($field_rules) && $f->primary_key == 0 ) {
                $string_conf_validation .= '
                    array(
                        \'field\' => \''.$f->name.'\',
                        \'label\' => \''.convert_field_to_string($f->name).'\',
                        \'rules\' => \''.$field_rules.'\'
                    ),
                ';
            }
        }
        $string_conf_validation .= ');';
        $newdata = str_replace('_config_form_validation_;',$string_conf_validation,$newdata);
        $string_data_insert = '$data_insert = array(
        ';
        foreach ( $column_form as $f ) {
            if ( in_array($f->type, array('varchar','char')) ) {
                $string_data_insert .= '    \''.$f->name.'\' => strip_tags($this->input->post(\''.$f->name.'\')),
            ';
            } else {
                $string_data_insert .= '    \''.$f->name.'\' => $this->input->post(\''.$f->name.'\'),
            ';
            }
        }
        $string_data_insert .= ');';
        $newdata = str_replace('_array_data_insert_;',$string_data_insert,$newdata);
        $string_data_update = '$data_update = array(';
        foreach ( $column_form as $f ) {
            if ( in_array($f->type, array('varchar','char')) ) {
                $string_data_update .= '    \''.$f->name.'\' => strip_tags($this->input->post(\''.$f->name.'\')),
            ';
            } else {
                $string_data_update .= '    \''.$f->name.'\' => $this->input->post(\''.$f->name.'\'),
            ';
            }
        }
        $string_data_update .= ');';
        $newdata = str_replace('_array_data_update_;',$string_data_update,$newdata);
        file_put_contents($file_destination, $newdata);
    }
    private function generate_model($table_name) {
        $controller_name    = $this->input->post('controller_name');
        $title              = $this->input->post('title');
        $primary_key        = '';
        $is_primary_key         = $this->input->post('primary_key');
        $id                 = $this->input->post('id');
        $column_name        = $this->input->post('column_name');
        $show_in_table      = $this->input->post('show_in_table');
        $reference_table_name   = $this->input->post('reference_table_name');
        $reference_pk_name      = $this->input->post('reference_pk_name');
        $reference_value_name   = $this->input->post('reference_value_name');
        $file_template = './template/model.php';
        $file_destination = './application/models/'.ucfirst(strtolower($controller_name)).'_model.php';
        if ( file_exists($file_destination) ) {
            unlink($file_destination);
        }
        copy($file_template, $file_destination);
        $list_column = array();
        $list_column_reference = array();
        $info_column    = array();
        $current_column = array();
        for( $i=0; $i<count($column_name); $i++ ) {
            $datacolumn = $this->app->get_by_column_name($table_name, $column_name[$i]);
            if ( $datacolumn ) {
                if ( is_array($is_primary_key) && in_array($datacolumn->name, $is_primary_key) )
                    $primary_key = $datacolumn->name;

                if ( is_array($show_in_table) && in_array($datacolumn->name, $show_in_table) && !in_array($datacolumn->name, $list_column) ) {
                    $list_column[] = $datacolumn->name;
                    $info_column[$datacolumn->name] = $datacolumn;
                }

                if ( !empty($reference_table_name[$i]) && !empty($reference_pk_name[$i]) && !empty($reference_value_name[$i]) ) {
                    $datareference = $this->app->get_by_column_name($reference_table_name[$i], $reference_value_name[$i]);
                    //echo $this->db->last_query();
                    $info_column[$datareference->name] = $datareference;
                    $list_column_reference[$datacolumn->name] = array(
                        'table'     => $reference_table_name[$i],
                        'pk'        => $reference_pk_name[$i],
                        'value'     => $reference_value_name[$i]
                    );
                }
            }
        }
        $string_query   = '$this->db->select(\'';
        if ( !in_array($is_primary_key, $list_column) ) {
            $string_query .= $primary_key.', ';
        }
        $string_join    = '';
        $string_search  = '$where .= "LOWER(".$aColumns[$i].") LIKE \'%".strtolower($this->db->escape_like_str($sSearch[\'value\']))."%\' OR ";';
        $string_search_dekrip = array();
        $current_join = array();
        $current_column = array();
        foreach ( $list_column as $cols ) {
            $cols_info = $info_column[$cols];
            if ( in_array($cols_info->type, array('text','varchar', 'char', 'nvarchar')) ) {
                $string_search_dekrip[$cols]  = '$where .= $aColumns[$i]." LIKE \'%".$this->db->escape_like_str($sSearch[\'value\'])."%\' OR ";';
            }
            if ( array_key_exists($cols, $list_column_reference) && !in_array($list_column_reference[$cols]['table'], $current_join) ) {
                $string_query .= $list_column_reference[$cols]['value'].', ';
                $string_join .= '$this->db->join(\''.$list_column_reference[$cols]['table'].'\', \''.$list_column_reference[$cols]['table'].'.'.$list_column_reference[$cols]['pk'].' = \'.$this->table.\'.'.$cols.'\', \'left\');
                ';
                $current_join[] = $list_column_reference[$cols]['table'];
            } else if ( !in_array($cols, $current_column)) {
                $string_query .= $cols.', ';
            }
            $current_column[] = $cols;
        }
        if ( count($string_search_dekrip) > 0 ) {
            $temp_string_search = $string_search;
            $string_search = '';
            $x=0;
            foreach ( $string_search_dekrip as $key=>$val ) {
                $string_search .= ($x==0 ? 'if' : 'else if').' ( $aColumns[$i] == \''.$key.'\' )
                        '.$val.'
                    ';
                $x++;
            }
            $string_search .= 'else
                    '.$temp_string_search;
        }

        $string_query = substr($string_query, 0, strlen($string_query)-2);
        $string_query .= '\');
        ';
        $string_query .= '$this->db->from($this->table);
        '.$string_join.'
        ';

        $string_row_data = '';
        foreach ( $list_column as $cols ) {
            $column = $cols;
            if ( array_key_exists($cols, $list_column_reference) ) {
                $column = $list_column_reference[$cols]['value'];

            }
            $cols_info = $info_column[$column];
            if ( $cols_info->type == 'date' ) {
                $string_row_data .= '$row[] = empty($aRow[\''.$column.'\']) || $aRow[\''.$column.'\'] == \'0000-00-00\' ? NULL : format_datetime($aRow[\''.$column.'\']) ;
                ';
            } else if ( in_array($cols_info->type, array('text','varchar', 'char', 'nvarchar')) ) {
                $string_row_data .= '$row[] = $aRow[\''.$column.'\'];
                ';
            } else {
                $string_row_data .= '$row[] = $aRow[\''.$column.'\'];
                ';
            }
        }

        $data = file_get_contents($file_destination);
        $newdata = str_replace('_ControllerName__model',ucfirst(strtolower($controller_name)).'_model',$data);
        $newdata    = str_replace('_table_name_',$table_name,$newdata);
        $newdata    = str_replace('_primary_key_',$primary_key,$newdata);
        $newdata = str_replace('_title_', $title, $newdata);
        $newdata = str_replace('_search_query_;',$string_search, $newdata);
        $newdata = str_replace('_datatable_query_;',$string_query, $newdata);
        $newdata = str_replace('_row_column_datatable_;',$string_row_data, $newdata);
        file_put_contents($file_destination, $newdata);
    }
    private function generate_datatable($table_name) {
        $controller_name    = $this->input->post('controller_name');
        $id                 = $this->input->post('id');
        $column_name        = $this->input->post('column_name');
        $show_in_table      = $this->input->post('show_in_table');
        $reference_table_name   = $this->input->post('reference_table_name');
        $reference_pk_name      = $this->input->post('reference_pk_name');
        $reference_value_name   = $this->input->post('reference_value_name');

        $file_template = './template/datatable.php';
        $file_destination = './application/views/'.strtolower($controller_name).'/datatable.php';
        if ( file_exists($file_destination) ) {
            unlink($file_destination);
        }
        copy($file_template, $file_destination);
        $list_header = array();
        $current_header = array();
        for( $i=0; $i<count($column_name); $i++ ) {
            $datacolumn = $this->app->get_by_column_name($table_name, $column_name[$i]);
            if ( $datacolumn ) {
                if ( is_array($show_in_table) && in_array($datacolumn->name, $show_in_table) ) {
                    if ( !empty($reference_table_name[$i]) && !empty($reference_pk_name[$i]) && !empty($reference_value_name[$i]) ) {
                        $datareference = $this->app->get_by_column_name($reference_table_name[$i], $reference_value_name[$i]);
                        if ( !in_array($datacolumn->name, $current_header) ) {
                            $list_header[] = convert_field_to_string($datareference->name);
                            $current_header[] = $datacolumn->name;
                        }
                    } else {
                        if ( !in_array($datacolumn->name, $current_header) ) {
                            $list_header[] = convert_field_to_string($datacolumn->name);
                            $current_header[] = $datacolumn->name;
                        }
                    }
                }
            }
        }
        $string_header = '';
        foreach ( $list_header as $header ) {
            $string_header .= '<th>'.$header.'</th>
            ';
        }

        $data = file_get_contents($file_destination);
        $newdata = str_replace('{_table_header_}',$string_header,$data);
        file_put_contents($file_destination, $newdata);
    }
    private function generate_form($table_name) {
        $controller_name    = $this->input->post('controller_name');
        $title              = $this->input->post('title');
        $id                 = $this->input->post('id');
        $primary_key        = '';
        $is_primary_key         = $this->input->post('primary_key');
        $column_name        = $this->input->post('column_name');
        $show_in_form       = $this->input->post('show_in_form');
        $show_in_table      = $this->input->post('show_in_table');
        $is_readonly        = $this->input->post('is_readonly');
        $reference_table_name   = $this->input->post('reference_table_name');
        $reference_pk_name      = $this->input->post('reference_pk_name');
        $reference_value_name   = $this->input->post('reference_value_name');
        $reference_filtered_by  = $this->input->post('reference_filtered_by');

        $file_template = './template/form.php';
        $file_destination = './application/views/'.strtolower($controller_name).'/form.php';
        if ( file_exists($file_destination) ) {
            unlink($file_destination);
        }
        copy($file_template, $file_destination);

        $column_form        = array();
        $index_form         = 0;

        $reference_table    = array();
        $current_column     = array();
        for( $i=0; $i<count($column_name); $i++ ) {
            $datacolumn = $this->app->get_by_column_name($table_name,$column_name[$i]);
            if ( $datacolumn ) {
                if ( is_array($is_primary_key) && in_array($datacolumn->name, $is_primary_key) )
                    $primary_key = $datacolumn->name;

                if ( is_array($show_in_form) && in_array($datacolumn->name, $show_in_form) && !in_array($datacolumn->name, $current_column) ) {
                    $current_column[] = $datacolumn->name;
                    $column_form[$index_form] = (array)$datacolumn;
                    $column_form[$index_form]['reference_table_name']   = $reference_table_name[$i];
                    $column_form[$index_form]['reference_pk_name']      = $reference_pk_name[$i];
                    $column_form[$index_form]['reference_value_name']   = $reference_value_name[$i];
                    $column_form[$index_form]['reference_filtered_by']  = $reference_filtered_by[$i];
                    if ( !empty($reference_table_name[$i]) && !empty($reference_pk_name[$i]) && !empty($reference_value_name[$i]) ) {
                        $val_reference = array(
                            'referenced_by'     => $datacolumn->name,
                            'reference_table'   => $reference_table_name[$i],
                            'reference_column'  => $reference_pk_name[$i]

                        );
                        if ( array_key_exists($reference_table_name[$i].'.'.$reference_pk_name[$i], $reference_table) && is_array($reference_table[$reference_table_name[$i].'.'.$reference_pk_name[$i]]) ) {
                            array_push($reference_table[$reference_table_name[$i].'.'.$reference_pk_name[$i]], $val_reference);
                        } else {
                            $reference_table[$reference_table_name[$i].'.'.$reference_pk_name[$i]] = array($val_reference);
                        }
                    }
                    $index_form++;
                }
            }
        }
        $data = file_get_contents($file_destination);
        $string_form = '';
        foreach ( $column_form as $f ) {
            $setlabelrequired = $f['is_null'] == 0 ? ' <span class="required">*</span>' : NULL;
            $setvalidationrequired  =  $f['is_null'] == 0 ? ' required' : NULL;
            if ( $f['primary_key'] == 1 ) {
                $string_form .= '<input type="hidden" name="'.$f['name'].'" value="<?php echo isset($detail[\''.$f['name'].'\']) ? $detail[\''.$f['name'].'\'] : NULL; ?>">
                ';
            } else if ( !empty($f['reference_table_name']) && !empty($f['reference_pk_name']) && !empty($f['reference_value_name']) ) {

                $data_reference = $this->app->get_by_column_name($f['reference_table_name'], $f['reference_value_name']);
                $string_form .= '<div class="form-group">
                ';
                $string_form .= '   <label class="control-label col-md-3 col-sm-3 col-xs-12">'.convert_field_to_string($data_reference->name).$setlabelrequired.'</label>
                ';
                $string_form .= '   <div class="col-md-9 col-sm-9 col-xs-12">
                ';
                $string_form .= '       <select class="form-control cmb_select2" id="'.$f['name'].'" name="'.$f['name'].'"'.$setvalidationrequired.' >
                ';
                $string_form .= '       <option value=""> - Pilih '.convert_field_to_string($data_reference->name).' - </option>
                ';
                $string_form .= '       <?php
                ';
                $set_con      = !empty($f['reference_filtered_by']) ? ', array(\''.$f['reference_filtered_by'].'\' => \'<?php echo empty($detail[\''.$f['reference_filtered_by'].'\']) ? 0 : $detail[\''.$f['reference_filtered_by'].'\']; ?>\')' : NULL;
                $string_form .= '       $list_'.$data_reference->name.' = $this->global_model->get_list(\''.$f['reference_table_name'].'\''.$set_con.');
                ';
                $string_form .= '       foreach ( $list_'.$data_reference->name.' as $'.$data_reference->name.' ) {
                ';
                $string_form .= '           $selected = $'.$data_reference->name.'->'.$f['reference_pk_name'].' == (empty($detail[\''.$f['name'].'\']) ? NULL : $detail[\''.$f['name'].'\']) ? \'selected\' : NULL;
                ';
                $string_form .= '           ?>
                ';
                $string_form .= '           <option value="<?php echo $'.$data_reference->name.'->'.$f['reference_pk_name'].'; ?>" <?php echo $selected; ?>><?php echo $'.$data_reference->name.'->'.$f['reference_value_name'].'; ?></option>
                ';
                $string_form .= '           <?php
                ';
                $string_form .= '       }
                                        ?>';
                $string_form .= '       </select>
                ';
                $string_form .= '   </div>
                ';
                $string_form .= '</div>';
            } else if ( $f['type'] == 'text' ) {
                $string_form .= '<div class="form-group">
                ';
                $string_form .= '   <label class="control-label col-md-3 col-sm-3 col-xs-12">'.convert_field_to_string($f['name']).$setlabelrequired.'</label>
                ';
                $string_form .= '   <div class="col-md-9 col-sm-9 col-xs-12">
                ';
                $string_form .= '       <textarea class="textarea" name="'.$f['name'].'"'.$setvalidationrequired.' style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail[\''.$f['name'].'\']) ? NULL : $detail[\''.$f['name'].'\']; ?></textarea>
                ';
                $string_form .= '   </div>
                ';
                $string_form .= '</div>';
            } else if ( $f['type'] == 'date' ) {
                $string_form .= '<div class="form-group">
                ';
                $string_form .= '   <label class="control-label col-md-3 col-sm-3 col-xs-12">'.convert_field_to_string($f['name']).$setlabelrequired.'</label>
                ';
                $string_form .= '   <div class="col-md-9 col-sm-9 col-xs-12">
                ';
                $string_form .= '       <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input class="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail[\''.$f['name'].'\']) || $detail[\''.$f['name'].'\'] == \'0000-00-00\' ? NULL : $detail[\''.$f['name'].'\']; ?>" name="'.$f['name'].'" readonly="readonly"'.$setvalidationrequired.'>
                    </div>
                ';
                $string_form .= '   </div>
                ';
                $string_form .= '</div>';
            } else if ( $f['type'] == 'tinyint' ) {
                $string_form .= '<div class="form-group">
                ';
                $string_form .= '   <label class="control-label col-md-3 col-sm-3 col-xs-12">'.convert_field_to_string($f['name']).$setlabelrequired.'</label>
                ';
                $string_form .= '   <div class="col-md-9 col-sm-9 col-xs-12">
                ';
                $string_form .= '       <label class="radio-inline"><input type="radio" value="1" name="'.$f['name'].'" <?php echo isset($detail[\''.$f['name'].'\']) && $detail[\''.$f['name'].'\'] == 1 ? \'checked\' : NULL; ?>> Ya</label>
 <label class="radio-inline"><input type="radio" value="0" name="'.$f['name'].'" <?php echo isset($detail[\''.$f['name'].'\']) && $detail[\''.$f['name'].'\'] == 0 && is_numeric($detail[\''.$f['name'].'\']) ? \'checked\' : NULL; ?>> Tidak</label>
                ';
                $string_form .= '   </div>
                ';
                $string_form .= '</div>';
            } else {
                $class_validation = '';
                if ( in_array($f['type'], array('int','bigint', 'smallint')) ) {
                    $class_validation .= ' is_integer';
                } else if ( in_array($f['type'], array('decimal','numeric', 'float')) ) {
                    $class_validation .= ' is_numeric';
                }
                $string_form .= '<div class="form-group">
                ';
                $string_form .= '   <label class="control-label col-md-3 col-sm-3 col-xs-12">'.convert_field_to_string($f['name']).$setlabelrequired.'</label>
                ';
                $string_form .= '   <div class="col-md-9 col-sm-9 col-xs-12">
                ';
                $string_form .= '       <input type="text" class="form-control'.$class_validation.'" name="'.$f['name'].'" value="<?php echo empty($detail[\''.$f['name'].'\']) ? NULL : '.(in_array($f['type'], array('text','varchar','char')) ? '$detail[\''.$f['name'].'\']' : '$detail[\''.$f['name'].'\']').'; ?>"'.($f['max_length'] > 0 ? ' max_length="'.$f['max_length'].'"' : NULL).$setvalidationrequired.'>
                ';
                $string_form .= '   </div>
                ';
                $string_form .= '</div>';
            }

        }
        $newdata = str_replace('{_form_content_}',$string_form,$data);
        file_put_contents($file_destination, $newdata);
    }
    function get_columns() {
        $table_name = $this->input->post('table_name');
        $list_column    = $this->app->get_list_column($table_name);
        echo json_encode(array('result' => (array)$list_column));
    }
}