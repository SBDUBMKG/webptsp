<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $page_title; ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo base_url().'form_generator/proses' ?>">
                    <input type="hidden" name="table_name" value="<?php echo $table; ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Controller Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="controller_name" id="controller_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Page Title</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <th>Column</th>
                                <th>Is PK</th>
                                <th>Show In Form</th>
                                <th>Show In Table</th>
                                <th>Is Readonly</th>
                                <th>Reference Table</th>
                                <th>Reference Key</th>
                                <th>Reference Value</th>
                                <th>Reference Filtered By</th>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            foreach ( $list_column as $cols ) {
                                ?>
                                <tr>
                                    <td><input type="hidden" name="column_name[]" value="<?php echo $cols->name ?>">
                                        <?php echo convert_field_to_string($cols->name); ?><br/><small><?php echo $cols->name ?></small></td>
                                    <td>
                                        <input type="checkbox" name="primary_key[]" value="<?php echo $cols->name; ?>" <?php echo $cols->primary_key == 1 ? 'checked' : NULL; ?>>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="show_in_form[]" value="<?php echo $cols->name; ?>">
                                    </td>
                                    <td><input type="checkbox" name="show_in_table[]" value="<?php echo $cols->name; ?>" ></td>
                                    <td><input type="checkbox" name="is_readonly[]" value="<?php echo $cols->name; ?>" ></td>
                                    <td>
                                        <select class="form-control cmb_select2 table_reference" id="reference_table_name_<?php echo $i; ?>" name="reference_table_name[]">
                                            <option value=""> - Pilih Tabel - </option>
                                            <?php
                                            foreach ( $list_table as $table ) {;
                                                ?>
                                                <option value="<?php echo $table->table_name ?>"><?php echo $table->table_name ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control cmb_select2 column_reference" id="reference_pk_name_<?php echo $i; ?>" name="reference_pk_name[]">
                                            <option value=""> - Pilih Column - </option>
                                            <?php
                                            if ( !empty($cols->reference_table_name) ) {
                                                $list_parent_cols = $this->app->get_list_column($cols->reference_table_name);
                                                foreach ( $list_parent_cols as $cols_parent ) {
                                                    ?>
                                                    <option value="<?php echo $cols_parent->name ?>"><?php echo $cols_parent->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control cmb_select2 column_reference" id="reference_value_name_<?php echo $i; ?>" name="reference_value_name[]">
                                            <option value=""> - Pilih Column - </option>
                                            <?php
                                            if ( !empty($cols->reference_table_name) ) {
                                                $list_parent_cols = $this->app->get_list_column($cols->reference_table_name);
                                                foreach ( $list_parent_cols as $cols_parent ) {
                                                    ?>
                                                    <option value="<?php echo $cols_parent->name ?>"><?php echo $cols_parent->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control cmb_select2 column_reference" id="reference_filtered_by_<?php echo $i; ?>" name="reference_filtered_by[]">
                                            <option value=""> - Pilih Column - </option>
                                            <?php
                                            if ( !empty($cols->reference_table_name) ) {
                                                $list_parent_cols = $this->app->get_list_column($cols->reference_table_name);
                                                foreach ( $list_parent_cols as $cols_parent ) {
                                                    ?>
                                                    <option value="<?php echo $cols_parent->name ?>"><?php echo $cols_parent->name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <button type="button" class="btn btn-danger" onclick="document.location='<?php echo base_url().'form_generator' ?>'">KEMBALI</button>
                        <button type="submit" class="btn btn-success">CREATE PAGE</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
        $('.table_reference').change(function(e) {
            var thisid = $(this).attr('id');
            var explid = thisid.split('_');
            var number = explid[3];
            var obj_pk_column = 'reference_pk_name_'+number;
            var obj_value_column = 'reference_value_name_'+number;
            var obj_filter_column = 'reference_filtered_by_'+number;
            set_loader_select2(obj_pk_column);
            set_loader_select2(obj_value_column);
            set_loader_select2(obj_filter_column);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>form_generator/get_columns",
                data: "table_name="+$(this).val(),
                success: function(msg) {
                    var data = JSON.parse(msg);
                    var columns = data.result;
                    set_option_select2(obj_pk_column, columns, ' - Pilih Column - ', 'name', 'name');
                    set_option_select2(obj_value_column, columns, ' - Pilih Column - ', 'name', 'name');
                    set_option_select2(obj_filter_column, columns, ' - Pilih Column - ', 'name', 'name');
                },
                error: function(xhr, msg, e) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>