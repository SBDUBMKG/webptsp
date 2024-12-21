<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
class Penerangan_jalan_umum extends MY_Controller {
    var $page_title = 'Penerangan Jalan Umum';
    var $column_datatable = array('id_pju', 'kecamatan', 'kelurahan', 'alamat');
    var $folder         = '';
    var $module         = '';

    function __construct(){
        parent::__construct();
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->load->model('Pju_model', 'app_model');
        $this->app_model->initialize($module);
        $this->module = $module;
    }
    public function index()
    {
        $this->load->model('backend/global_model');
        $module =$this->module;
        $id_kecamatan = $this->input->get('kec');
        $id_kelurahan = $this->input->get('kel');
        $id_pju = $this->input->get('id_pju');
        $level = 'kabupaten';
        if ( !empty($id_kecamatan) ) {
            $level = 'kecamatan';
        }
        if ( !empty($id_kelurahan) ) {
            $level = 'kelurahan';
        }
        if ( !empty($id_pju) ) {
            $level = 'peta';
        }
        $data['level'] = $level;
        $data['id_pju']       = $id_pju;
        $data['id_kecamatan'] = $id_kecamatan;
        $data['id_kelurahan'] = $id_kelurahan;
        if ( $level == 'peta' ) {
            $detail = $this->app_model->get_by_id($id_pju);
            if ( !$detail ) {
                show_404();
                return;
            }

            $data['id_kecamatan'] = $detail['id_kecamatan'];
            $data['id_kelurahan'] = $detail['id_kelurahan'];
            $list_point_pju = $this->app_model->list_point_pju($id_pju);
            $data['detail']       = $detail;
            $data['title'] = $this->page_title;
            $this->template->add_js('https://maps.googleapis.com/maps/api/js?key=AIzaSyB4fIuF6TCVR_jR7xZJ105lM6AefK2WxAA&libraries=places','import',false, true);
            $this->template->add_js('var icon_marker = \'small-pju-icon.png\'', 'embed');
            $this->template->add_js('var list_point = \''.json_encode((array)$list_point_pju).'\'', 'embed');
            $this->template->add_js('resources/js/apps/peta.js');
            $this->template->write('title', 'Peta '.$this->page_title);
            $this->template->write_view('content', 'pju/peta', $data, true);
            $this->template->render();
        } else {
            $script = '
                var active_id = \'\';
                $(function () {
                    var oTable = $("#datatable").DataTable({
                        responsive: true,
                        "order": [[ 0, "desc" ]],
                        "processing": true,
                        "serverSide": true,
                        "ajax" : {
                            "url": "'.base_url().$module.'/getDataTable?kec='.$id_kecamatan.'&kel='.$id_kelurahan.'&id_pju='.$id_pju.'&level='.$level.'",
                            "type": "POST"
                        }
                    });
                    $(".cmb_select2").select2({theme: "bootstrap", width: "100%"});
                });
                ';
            $data['title'] = $this->page_title;
            $this->template->add_css('resources/plugins/datatables/dataTables.bootstrap.css');
            $this->template->add_css('resources/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css');
            $this->template->add_js('resources/plugins/datatables/jquery.dataTables.min.js');
            $this->template->add_js('resources/plugins/datatables/dataTables.bootstrap.min.js');
            $this->template->add_js('resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js');
            $this->template->add_css('resources/plugins/select2/select2.min.css');
            $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
            $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
            $this->template->add_js('resources/plugins/select2/select2.min.js');
            
            $this->template->add_js($script,'embed');
            $this->template->write('title', $data['title']);
            $this->template->write_view('content', 'pju/datatable', $data, true);
            $this->template->render();
        }
    }
    function getDataTable()
    {
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $sSearch = $this->input->get_post('search', true);
        $id_kecamatan = $this->input->get('kec');
        $id_kelurahan = $this->input->get('kel');
        $level = $this->input->get('level');
        $con = array(
            'm_kelurahan.id_kecamatan'  => $id_kecamatan,
            $this->app_model->table.'.id_kelurahan'  => $id_kelurahan
        );

        $view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch,$con, $level);
        echo $view;
    }
    function preview($id = 0) {
        $this->load->model('backend/global_model');
        $module = $this->module;
        $data['detail'] = $this->app_model->get_by_id($id);
        if ( !$data['detail'] ) {
            show_404();
            return;
        }
        $data['title'] = "Detil Data";
        $data['url_back'] = "window.location.href='".base_url().$this->module."'";

        $data['page_title'] = $this->page_title;
        $data['id'] = $id;
        $this->template->add_css('resources/plugins/select2/select2.min.css');
        $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
        $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
        $this->template->add_js('resources/plugins/select2/select2.min.js');
        $this->template->add_js('https://maps.googleapis.com/maps/api/js?key=AIzaSyB4fIuF6TCVR_jR7xZJ105lM6AefK2WxAA&libraries=places','import',false, true);
        $this->template->add_js('var icon_marker = \'small-perumahan-icon.png\'', 'embed');
        $this->template->add_js('resources/js/apps/form_manajemen_peta.js');
        $this->template->write('title', 'Detil '.$this->page_title);
        $this->template->write_view('content', 'pju/preview', $data, true);
        $this->template->render();
    }
}
