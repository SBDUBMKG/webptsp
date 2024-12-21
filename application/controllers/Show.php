<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends CI_Controller {
	var $folder         = '';
    function __construct(){
        parent::__construct();
        $this->template->set_template('frontend_ptsp');
        $this->load->model('berita/minerba_model');
        $this->load->model('frontend/agenda_model');
        $this->load->model('galeri/galeri_foto_model');
        $this->load->model('global_model');
        $module = $this->folder.'/'.$this->router->fetch_class();
        $this->module = $module;
    }

    public function show_pdf()
    {
        $file_menu = $this->input->get('link_file');
        $data['file'] = $this->global_model->get_by_id_array('tbl_file_menu', 'id', $file_menu);

        $data['title']  = $data['file']['nama_file'];
        $data['title_en']  = $data['file']['nama_file_en'];
        $data['bahasa'] = $this->session->userdata('bahasa');

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_show_pdf', $data, true);
        $this->template->render();
    }

    public function show_halaman()
    {
        $halaman = $this->input->get('halaman');
        $data['halaman'] = $this->global_model->get_by_id_array('tbl_halaman_menu', 'id', $halaman);

        $data['title']  = $data['halaman']['nama_halaman'];
        $data['title_en']  = $data['halaman']['nama_halaman_en'];
        $data['bahasa'] = $this->session->userdata('bahasa');
        $script = '
       $(function () {
            $(".table").DataTable({
                "responsive": true,
                "paging": false,        // Enables pagination
                "searching": false,     // Enables search/filter functionality
                "ordering": false,      // Enables column sorting
                "info": false,          // Displays table information (e.g., "Showing 1 to 10 of 50 entries")
                "lengthChange": false,  // Allows changing the number of rows displayed per page
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
        $this->template->write_view('content', 'v_show_halaman', $data, true);
        $this->template->render();
    }
}