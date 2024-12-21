<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_perizinan extends CI_Controller {
    var $folder             = 'perizinan';
    var $column_datatable   = array('id_pengumuman_perizinan', 'judul','tanggal','lampiran');
    var $page_title         = 'Pengumuman Perizinan';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $this->load->model('perizinan/pengumuman_perizinan_model','app_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

	public function index()
	{
        $data['title']  = "Pengumuman Perizinan";
        $data['bahasa']   = $this->session->userdata('bahasa');
        $module =$this->module;
        $script = '
            $(function () {
                var oTable_terima = $("#datatable_terima").DataTable({
                    responsive: {
                        details: {
                            type: "column",
                            target: -1
                        }
                    },
                     columnDefs: [ {
                        className: "control",
                        orderable: false,
                        targets:   -1
                    }],
                    "order": [[ 0, "desc" ]],
"processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : {
                        "url": "'.base_url().$module.'/getDataTable?status=1",
                        "type": "POST"
                    }
                });
                var oTable_tolak = $("#datatable_tolak").DataTable({
                    responsive: {
                        details: {
                            type: "column",
                            target: -1
                        }
                    },
                     columnDefs: [ {
                        className: "control",
                        orderable: false,
                        targets:   -1
                    }],
                    "order": [[ 0, "desc" ]],
"processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "ajax" : {
                        "url": "'.base_url().$module.'/getDataTable?status=0",
                        "type": "POST"
                    }
                });
            });
            ';

        $this->template->add_css('resources/plugins/datatables/dataTables.bootstrap.css');
        $this->template->add_css('resources/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css');
        $this->template->add_js('resources/plugins/datatables/jquery.dataTables.min.js');
        $this->template->add_js('resources/plugins/datatables/dataTables.bootstrap.min.js');
        $this->template->add_js('resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js');
        $this->template->add_js('resources/plugins/datatables/dataTables.buttons.min.js');
        $this->template->add_js('resources/plugins/datatables/buttons.flash.min.js');
        $this->template->add_js('resources/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js');

        $this->template->add_js($script,'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_pengumuman_perizinan', $data, true);
        $this->template->render();
	}

    function getDataTable()
    {
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $sSearch = $this->input->get_post('search', true);
        $status = $this->input->get('status');

        $view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch,$status);

        echo $view;
    }
}