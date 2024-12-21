<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_cnc extends CI_Controller {
    var $folder         = 'berita';
    var $column_datatable = array('id_pengumuman_cnc', 'judul','tanggal','lampiran');
    var $page_title = 'Pengumuman CNC';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $this->load->model('berita/pengumuman_cnc_model','app_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

	public function index()
	{
        $data['bahasa']   = $this->session->userdata('bahasa');
        $module =$this->module;
        $script = '
            $(function () {
                var oTable = $("#datatable").DataTable({
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
                        "url": "'.base_url().$module.'/getDataTable",
                        "type": "POST"
                    }
                });
            });
            ';
        $data['title'] = $this->page_title;
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
        $this->template->write_view('content', $this->module.'/v_pengumuman_cnc', $data, true);
        $this->template->render();
	}

    function getDataTable()
    {
        $iDisplayStart = $this->input->get_post('start', true);
        $iDisplayLength = $this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $sSearch = $this->input->get_post('search', true);

        $view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart,$iDisplayLength,$order,$sSearch);

        echo $view;
    }
    function detail($id_pengumuman_cnc)
    {
        $script = "";
        $data['title'] = $this->page_title;
        $data['detail'] = $this->app_model->get_by_id($id_pengumuman_cnc);
        // $this->template->add_css('resources/plugins/datatables/dataTables.bootstrap.css');
        // $this->template->add_css('resources/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css');
        // $this->template->add_js('resources/plugins/datatables/jquery.dataTables.min.js');
        // $this->template->add_js('resources/plugins/datatables/dataTables.bootstrap.min.js');
        // $this->template->add_js('resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js');
        // $this->template->add_js('resources/plugins/datatables/dataTables.buttons.min.js');
        // $this->template->add_js('resources/plugins/datatables/buttons.flash.min.js');
        // $this->template->add_js('resources/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js');

        $this->template->add_js($script,'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', $this->module.'/v_pengumuman_cnc_detail', $data, true);
        $this->template->render();
    }
}