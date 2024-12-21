<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permohonan_layanan extends MY_Controller {
  public $page_title          = 'Permohonan Layanan Informasi/Jasa MKG';
  public $column_datatable    = ['id_permohonan', 'no_permohonan', 'tanggal_permohonan', 'pengantar', 'nama', 'status'];
  public $column_datatable2   = ['id_permohonan', 'no_permohonan', 'tanggal_permohonan', 'pengantar', 'nama', 'status'];
  public $folder              = 'backend/permohonan_layanan';
  public $module              = '';

  public function __construct()
  {
    parent::__construct();
    $module = $this->folder . '/' . $this->router->fetch_class();
    $this->load->helper(['status']);
    $this->load->model($this->folder.'/informasi_mkg_model', 'app_model');
    $this->app_model->initialize($module);
    $this->module = $module;
  }

  public function index()
  {
    if ($this->input->get('a', true) && $this->input->get('action', true)) {
      $id_dp = $this->input->get('a');
      $id_tp = $this->input->get('b');
      $ac_dp = $this->input->get('action');

      if ($ac_dp == 1) {
        $this->db->update('tbl_detail_permohonan', ['status' => 'Tersedia'], ['id_detail_permohonan' => $id_dp]);
      } else if ($ac_dp == 2) {
        $this->db->update('tbl_detail_permohonan', ['status' => 'Tidak Tersedia'], ['id_detail_permohonan' => $id_dp]);
      }
      $count = $this->db->select('status');
      $total = $count->get_where('tbl_detail_permohonan', ['id_detail_permohonan' => $id_dp])->num_rows();
      $ready = $count->get_where('tbl_detail_permohonan', ['id_detail_permohonan' => $id_dp, 'status' => 'Tersedia'])->num_rows();
      $tidak = $count->get_where('tbl_detail_permohonan', ['id_detail_permohonan' => $id_dp, 'status' => 'Tidak Tersedia'])->num_rows();
      $detek = $tidak + $ready;

      if ($detek == $total && $ready == $total) {
        $this->db->update('tbl_permohonan', ['status' => 3], ['id_permohonan' => $id_tp]);
      } else if ($detek == $total && $tidak >= 1) {
        $this->db->update('tbl_permohonan', ['status' => 2], ['id_permohonan' => $id_tp]);
      }

      redirect(current_url());
      die();
    }

    $module = $this->module;
    $id_role  = $this->session->userdata('id_role');

    if($id_role > 8) {
      $url_ajax = site_url($module.'/getDataTableBO');
    } else {
      $url_ajax = site_url($module.'/getDataTable');
    }

    $script = '
      var active_id = \'\';
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
          "order": [
              [ 0, "desc" ]
          ],
          dom: "Bfrtip",
          buttons: [ ' . ($this->is_write ? '
              {
                  text: "<span class=\'fa fa-plus-circle\'></span> Tambah Data",
                  className: "btn btn-sm btn-primary",
                  action: function ( e, dt, node, config ) {
                      go_add_data();
                  }
              },
              {
                  text: "<span class=\'fa fa-file-o\'></span> Detail Data", className: "btn btn-sm btn-success",
                  action: function ( e, dt, node, config ) {
                      go_detail();
                  }
              },
              { ' . ($id_role != 7 ? '
                  text: "<span class=\'fa fa-file-o\'></span> Hapus Data",
                  className: "btn btn-sm btn-danger",
                  action: function ( e, dt, node, config ) {
                      go_delete();
                  }' : null) . '
              }' : null) . '
          ],
          "processing": true,
          "serverSide": true,
          "ajax" : {
              "url": "' . $url_ajax . '",
              "type": "POST"
          }
        });
        oTable.on( "click", "tr", function () {
          var objcheck = $(this).children().find(".selectedrow");
          selectrowtable(objcheck);
        });
      });
      function selectrowtable(obj) {
          var parentrow = obj.parent().parent();
          if (  active_id != obj.val() ) {
              $("#datatable tbody tr").removeClass("selected");
              parentrow.addClass("selected");
              active_id = obj.val();
          } else {
              parentrow.removeClass("selected");
              active_id = "";
          }
      }
      function go_add_data() {
          document.location = "' . site_url($module) . '/add";
      }
      function go_edit_data() {
          if ( active_id.length < 1 ) {
              alert(\'Pilih baris data pada tabel yang ingin diubah!\');
          } else {
              document.location = "' . site_url($module) . '/edit/" + active_id;
          }
      }
      function go_detail() {
          if ( active_id.length < 1 ) {
              alert(\'Pilih baris data pada tabel yang ingin ditampilkan!\');
          } else {
              document.location = "' . site_url($module) . '/detail/" + active_id;
          }
      }
      function go_delete() {
          if ( active_id.length < 1 ) {
              alert(\'Pilih baris data pada tabel yang ingin dihapus!\');
          } else {
              if ( confirm(\'Apakah anda yakin ingin menghapus data ini?\') ) {
                  document.location = "' . site_url($module) . '/delete/" + active_id;
              }
          }
      }
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

    $this->template->add_js($script, 'embed');
    $this->template->write('title', $data['title']);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/datatable', $data, true);
    $this->template->render();
  }

  public function getDataTable()
  {
    $iDisplayStart  = $this->input->get_post('start', true);
    $iDisplayLength = $this->input->get_post('length', true);
    $order          = $this->input->get_post('order', true);
    $sSearch        = $this->input->get_post('search', true);

    $view = $this->app_model->show_datatable($this->column_datatable, $iDisplayStart, $iDisplayLength, $order, $sSearch);

    echo $view;
  }

  public function add()
  {
    $this->load->model('global_model');
    $module           = $this->module;
    $data['detail']   = array();
    $data['title']    = "Form Permohonan";
    $data['url_back'] = "window.location.href='" . base_url() . $module . "'";
    $errMsg           = null;

    if ($_POST) {
      $data_post      = $this->input->post();
      $data['detail'] = $data_post;
      $data_insert    = array();
      $simpan         = true;
      $this->valid_form(strtolower(__FUNCTION__));

      if ($this->form_validation->run() == false) {
        $simpan = false;
        $errMsg = '<ul>' . validation_errors('<li>', '</li>') . '</ul>';
      }

      if ($simpan) {
                // simpan permohonan
        $id_permohonan = '';
        $data_insert   = array(
          'id_pemohon'         => $this->session->userdata('id_admin'),
          'id_jenis_layanan'   => 1,
          'tanggal_permohonan' => date("Y-m-d H:i:s"),
          'no_permohonan'      => rand(),
          'status'             => 1,
        );
        $insert        = $this->app_model->insert_data($data_insert);
        $id_permohonan = $insert;

                // simpan detail permohonan
        $total_harga = 0;
        for ($i = 0; $i < count($data_post['arr_id_layanan']); $i++) {

                    // tanggal mulai
          $tahun         = substr($data_post['arr_tanggal_mulai'][$i], 6, 4);
          $bulan         = substr($data_post['arr_tanggal_mulai'][$i], 0, 2);
          $tanggal       = substr($data_post['arr_tanggal_mulai'][$i], 3, 2);
          $tanggal_mulai = $tahun . '-' . $bulan . '-' . $tanggal;

                    // tanggal selesai
          $tahun           = substr($data_post['arr_tanggal_selesai'][$i], 6, 4);
          $bulan           = substr($data_post['arr_tanggal_selesai'][$i], 0, 2);
          $tanggal         = substr($data_post['arr_tanggal_selesai'][$i], 3, 2);
          $tanggal_selesai = $tahun . '-' . $bulan . '-' . $tanggal;

          $data_insert = array(
            'id_layanan'         => strip_tags($data_post['arr_id_layanan'][$i]),
            'id_permohonan'      => $id_permohonan,
            'jumlah'             => strip_tags($data_post['arr_jumlah'][$i]),
            // 'jumlah_lokasi'      => strip_tags($data_post['arr_jumlah_lokasi'][$i]),
            // 'jumlah_route'       => strip_tags($data_post['arr_jumlah_route'][$i]),
            'jumlah_hari'        => strip_tags($data_post['arr_jumlah_hari'][$i]),
            'tanggal_mulai'      => $tanggal_mulai,
            'tanggal_selesai'    => $tanggal_selesai,
            'koordinat'          => strip_tags($data_post['arr_koordinat'][$i]),
            // 'jumlah_buku'        => strip_tags($data_post['arr_jumlah_buku'][$i]),
            'edisi'              => strip_tags($data_post['arr_edisi'][$i]),
            'tahun'              => strip_tags($data_post['arr_tahun'][$i]),
            'bulan'              => strip_tags($data_post['arr_bulan'][$i]),
            'provinsi'           => strip_tags($data_post['arr_provinsi'][$i]),
            'kabupaten'          => strip_tags($data_post['arr_kabupaten'][$i]),
            'kecamatan'          => strip_tags($data_post['arr_kecamatan'][$i]),
            'upt'                => strip_tags($data_post['arr_upt'][$i]),
            // 'jumlah_sampel'      => strip_tags($data_post['arr_jumlah_sampel'][$i]),
            'tambahan_perjam'    => strip_tags($data_post['arr_tambahan_perjam'][$i]),
            'merk'               => strip_tags($data_post['arr_merk'][$i]),
            'no_seri'            => strip_tags($data_post['arr_no_seri'][$i]),
            // 'jumlah_alat' => $this->input->post('jumlah_alat'),
            'jam_mulai'          => strip_tags($data_post['arr_jam_mulai'][$i]),
            'jam_selesai'        => strip_tags($data_post['arr_jam_selesai'][$i]),
            'zona_waktu'         => strip_tags($data_post['arr_zona_waktu'][$i]),
            'no_pendaftaran'     => strip_tags($data_post['arr_no_pendaftaran'][$i]),
            'npt'                => strip_tags($data_post['arr_npt'][$i]),
            'jurusan'            => strip_tags($data_post['arr_jurusan'][$i]),
            'semester'           => strip_tags($data_post['arr_semester'][$i]),
            'harga'              => strip_tags($data_post['arr_harga'][$i]),
            'status'             => NULL,
          );
          $insert = $this->global_model->insert_data('tbl_detail_permohonan', $data_insert);
          $total_harga += strip_tags($data_post['arr_harga'][$i]);
        }

                // update total harga permohonan
        $data_update = array(
          'total_harga' => $total_harga,
        );
        $update = $this->app_model->update_data($id_permohonan, $data_update);

        if ($insert) {
          redirect(site_url($module . '/upload_permohonan/' . $id_permohonan));
          die();
        } else {
          $errMsg = 'Data gagal disimpan';
        }
      }
    }

    $data['page_title'] = $this->page_title;
    $data['errMsg']     = $errMsg;

    $this->template->add_css('resources/plugins/datatables/dataTables.bootstrap.css');
    $this->template->add_css('resources/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css');
    $this->template->add_js('resources/plugins/datatables/jquery.dataTables.min.js');
    $this->template->add_js('resources/plugins/datatables/dataTables.bootstrap.min.js');
    $this->template->add_js('resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js');
    $this->template->add_js('resources/plugins/datatables/dataTables.buttons.min.js');
    $this->template->add_js('resources/plugins/datatables/buttons.flash.min.js');
    $this->template->add_js('resources/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js');

    $this->template->add_css('resources/plugins/select2/select2.min.css');
    $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
    $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
    $this->template->add_js('resources/plugins/select2/select2.min.js');

    $this->template->add_js('resources/js/apps/permohonan.js');

    $this->template->write('title', 'Tambah ' . $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/form', $data, true);
    $this->template->render();
  }

  public function proses($id = NULL)
  {
    $this->load->model('global_model');
    $module           = $this->module;
    $data['detail']   = array();
    $data['title']    = "Detail Permohonan";
    $data['url_back'] = "window.location.href='" . base_url($module) . "'";
    $errMsg           = null;

    $id_pemohon = $this->session->userdata('id_admin');
    // cek db tbl_permohonan jika id_pemohon sesuai dan status 1 (belum fix)
    $query = $this->db->get_where('tbl_permohonan', ['id_permohonan' => $id, 'id_pemohon' => $id_pemohon, 'status' => 1]);
    if ($query->row() !== null) {
      foreach ($query->result() as $k => $v) {
        $data['layanan'] = $this->db->get_where('tbl_detail_permohonan', ['id_permohonan' => $v->id_permohonan, 'status' => 'Belum Dilengkapi'])
        ->result_array();
      }
      if (empty($data['layanan'])) {
        $update_harga = $this->db->select("sum(harga) as harga")->get_where('tbl_detail_permohonan', ['id_permohonan' => $v->id_permohonan])
        ->row('harga');
        $this->db->where('id_permohonan', $id)->update('tbl_permohonan', ['total_harga' => $update_harga]);
        // echo $update_harga;
        redirect(site_url($module . '/upload_permohonan/' . $id));
        die();
      } else {
        $m_layanan = $this->db->get_where('m_layanan', ['id_layanan' => $data['layanan'][0]['id_layanan']])->row();
      }
    } else {
      redirect(site_url($module));
      die();
    }

    if ($_POST) {
      $simpan = true;
      $this->valid_form(strtolower(__FUNCTION__));

      if ($this->form_validation->run() == false) {
        $simpan = false;
        $errMsg = '<ul>' . validation_errors('<li>', '</li>') . '</ul>';
      }

      if ($simpan) {
                // tanggal mulai
        $tahun         = substr($this->input->post('tanggal_mulai'), 6, 4);
        $bulan         = substr($this->input->post('tanggal_mulai'), 0, 2);
        $tanggal       = substr($this->input->post('tanggal_mulai'), 3, 2);
        $tanggal_mulai = $tahun . '-' . $bulan . '-' . $tanggal;

                // tanggal selesai
        $tahun           = substr($this->input->post('tanggal_selesai'), 6, 4);
        $bulan           = substr($this->input->post('tanggal_selesai'), 0, 2);
        $tanggal         = substr($this->input->post('tanggal_selesai'), 3, 2);
        $tanggal_selesai = $tahun . '-' . $bulan . '-' . $tanggal;

        $data_update = array(
          'harga' => $this->input->post('jumlah') * $m_layanan->harga,
          'jumlah' => $this->input->post('jumlah'),
          // 'jumlah_lokasi' => $this->input->post('jumlah_lokasi'),
          // 'jumlah_route' => $this->input->post('jumlah_route'),
          'jumlah_hari' => $this->input->post('jumlah_hari'),
          'koordinat' => $this->input->post('koordinat'),
          // 'jumlah_buku' => $this->input->post('jumlah_buku'),
          'edisi' => $this->input->post('edisi'),
          'tahun' => $this->input->post('tahun'),
          'bulan' => $this->input->post('bulan'),
          'provinsi' => $this->input->post('provinsi'),
          'kabupaten' => $this->input->post('kabupaten'),
          'kecamatan' => $this->input->post('kecamatan'),
          'upt' => $this->input->post('upt'),
          // 'jumlah_sampel' => $this->input->post('jumlah_sampel'),
          'tambahan_perjam' => $this->input->post('tambahan_perjam'),
          'merk' => $this->input->post('merk'),
          'no_seri' => $this->input->post('no_seri'),
          // 'jumlah_alat' => $this->input->post('jumlah_alat'),
          'jam_mulai' => $this->input->post('jam_mulai'),
          'jam_selesai' => $this->input->post('jam_selesai'),
          'zona_waktu' => $this->input->post('zona_waktu'),
          'no_pendaftaran' => $this->input->post('no_pendaftaran'),
          'npt' => $this->input->post('npt'),
          'jurusan' => $this->input->post('jurusan'),
          'semester' => $this->input->post('semester'),
          'tanggal_mulai' => $tanggal_mulai,
          'tanggal_selesai'   => $tanggal_selesai,
          'status' => null,
        );
        $update = $this->global_model
        ->update_data('tbl_detail_permohonan', 'id_detail_permohonan', strip_tags($this->input->post('id_detail_permohonan')), $data_update);
        if ($update) {
          redirect(current_url());
        } else {
          $errMsg = 'Data gagal disimpan';
        }
      }
    }

    $data['page_title'] = $this->page_title;
    $data['errMsg']     = $errMsg;

    $this->template->add_css('resources/plugins/datatables/dataTables.bootstrap.css');
    $this->template->add_css('resources/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css');
    $this->template->add_js('resources/plugins/datatables/jquery.dataTables.min.js');
    $this->template->add_js('resources/plugins/datatables/dataTables.bootstrap.min.js');
    $this->template->add_js('resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js');
    $this->template->add_js('resources/plugins/datatables/dataTables.buttons.min.js');
    $this->template->add_js('resources/plugins/datatables/buttons.flash.min.js');
    $this->template->add_js('resources/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js');

    $this->template->add_css('resources/plugins/select2/select2.min.css');
    $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
    $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
    $this->template->add_js('resources/plugins/select2/select2.min.js');

    $this->template->add_js('resources/js/apps/permohonan.js');

    $this->template->write('title', 'Tambah ' . $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/form_proses', $data, true);
    $this->template->render();
  }

  private function valid_form($act = 'add')
  {
    $this->load->library('form_validation');
    $config = [
      [
        'field' => 'no_permohonan',
        'label' => 'No Permohonan',
        'rules' => 'max_length[100]',
      ],
    ];
    $this->form_validation->set_rules($config);
  }

  public function upload_permohonan($id = '')
  {
    $this->load->model('global_model');
    $module           = $this->module;
    $id_role          = $this->session->userdata('id_role');
    $data['title']    = "Upload Bukti Pembayaran";
    $data['url_back'] = "window.location.href='" . site_url($this->module) . "'";
    $errMsg           = null;
    $scsMsg           = null;

    $data['detail'] = $this->db->get_where('tbl_permohonan', ['id_permohonan' => $id])->row();

    if ($data['detail']->status != 1) {
      show_404();
      die();
    }

    if ($_POST) {
      $config['max_size']         = 100000;
      $config['upload_path']      = './upload/permohonan/';
      $config['encrypt_name']     = true;
      $config['allowed_types']    = 'gif|jpg|jpeg|png|pdf|doc|docx';
      $config['file_ext_tolower'] = true;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('permohonan')) {
        $errMsg = $this->upload->display_errors();
      } else {
        $to = $this->session->userdata('email');
        $subject = 'Pemesanan layanan dalam proses';
        $message = $this->load->view('email/_header', '', true);
        $message .= $this->load->view('email/pengajuan_layanan','', true);
        $message .= $this->load->view('email/_footer', '', true);
        send_email($to,$subject,$message);

        $this->db->update('tbl_permohonan', ['status' => 0, 'permohonan' => $this->upload->data('file_name')], ['id_permohonan' => $id]);
        $scsMsg = 'Dokumen Permohonan Berhasil DiUpload, silahkan tunggu konfirmasi ketersediaan dari Kami!';
        sleep(5);
        redirect(site_url($module));
        die();
      }
    }

    $data['page_title'] = $this->page_title;
    $data['errMsg']     = $errMsg;
    $data['scsMsg']     = $scsMsg;

    $this->template->write('title', $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/upload_permohonan', $data, true);
    $this->template->render();
  }

  public function detail($id = 0)
  {
    $this->load->model('global_model');
    $module                = $this->module;
    $data['detail']        = $this->app_model->get_by_id($id);
    $con                   = 'id_permohonan = ' . $id;
    $data['detail_produk'] = $this->global_model->get_list_array('tbl_detail_permohonan', $con);
    $id_admin              = $this->session->userdata('id_admin');
    $id_role               = $this->session->userdata('id_role');

    if ($id_role == 7) {
      if ($data['detail']['id_pemohon'] != $id_admin) {
        show_404();
        die();
      }
    }

    $data['title']    = "Detail Data Permohonan";
    $data['url_back'] = "window.location.href='" . site_url($this->module) . "'";
    $errMsg           = null;

    $data['page_title'] = $this->page_title;
    $data['id']         = $id;
    $data['errMsg']     = $errMsg;
    $this->template->write('title', $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/preview', $data, true);
    $this->template->render();
  }

  public function invoice($id = 0)
  {
    $this->load->model('global_model');
    $module = $this->module;

    $data['detail'] = $this->app_model->get_by_id($id);

    if (!$data['detail']) {
      show_404();
      return;
    }

    $data['list_detail_permohonan'] = $this->app_model->get_detail_permohonan_by_id($id);
    $data['data_pemohon'] = $this->app_model->get_data_pemohon_by_id($data['detail']['id_pemohon']);
    $data['data_perusahaan_pemohon'] = $this->app_model->get_data_perusahaan_by_id($data['data_pemohon']['id_perusahaan']);

    $data['title']    = "Cetak Invoice";
    $data['url_back'] = "window.location.href='" . base_url() . $this->module . "/invoice/" . $id . "'";

    $data['page_title'] = $this->page_title;

    $this->template->write('title', 'Cetak Invoice');
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/invoice', $data, true);
    $this->template->render();
  }

  public function konfirmasi($id = '')
  {
    $this->load->model('global_model');
    $module           = $this->module;
    $id_role          = $this->session->userdata('id_role');
    $data['title']    = "Detail Data Permohonan";
    $data['url_back'] = "window.location.href='" . site_url($this->module) . "'";
    $errMsg           = null;

    $data['detail']        = $this->db->get_where('tbl_permohonan', ['id_permohonan' => $id])->row();
    $data['detail_akun']   = $this->db->get_where('tbl_admin', ['id_admin' => $data['detail']->id_pemohon])->row();
    $data['detail_produk'] = $this->db->get_where('tbl_detail_permohonan', ['id_permohonan' => $id])->result_array();

    if ($id_role != 1 && $id_role != 2 && $id_role != 3) {
      show_404();
      die();
    }

    if ($this->input->get('a', true) && $this->input->get('action', true)) {
      // $this->load->library('email');
      // $_host = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 1);
      // $_user = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 2);
      // $_pass = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 3);
      // $_port = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 4);
      // $_type = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 5);
      // $config['smtp_host']   = $_host->value_task;
      // $config['smtp_user']   = $_user->value_task;
      // $config['smtp_pass']   = $_pass->value_task;
      // $config['smtp_port']   = $_port->value_task;
      // $config['smtp_crypto'] = $_type->value_task;
      // $this->email->initialize($config);

      $id_dp = $this->input->get('a');
      $ac_dp = $this->input->get('action');

      if ($ac_dp == 1) {
        $this->db->update('tbl_detail_permohonan', ['status' => 'Tersedia'], ['id_detail_permohonan' => $id_dp]);
      } else if ($ac_dp == 2) {
        $this->db->update('tbl_detail_permohonan', ['status' => 'Tidak Tersedia'], ['id_detail_permohonan' => $id_dp]);
      }

      $total = $this->db->select('status')->get_where('tbl_detail_permohonan', ['id_permohonan' => $id])->num_rows();
      $ready = $this->db->select('status')->get_where('tbl_detail_permohonan', ['id_permohonan' => $id, 'status' => 'Tersedia'])->num_rows();
      $tidak = $this->db->select('status')->get_where('tbl_detail_permohonan', ['id_permohonan' => $id, 'status' => 'Tidak Tersedia'])->num_rows();
      $detek = $tidak + $ready;

    // Jika Ready Semua
      if ($detek == $total && $ready == $total) {
        // jika semua produk tersedia
        $data['no_permohonan'] = $data['detail']->no_permohonan;
        $data['text_paragraph'] = "Informasi/Jasa yang dibutuhkan";
        $data['information'] = "TERSEDIA";
        $data['text_action'] = "PROSES SELANJUTNYA";
        $data['link_action'] = site_url($module.'/upload/'.$id);

        // $message = $this->load->view('email/_header', '', true);
        // $message .= $this->load->view('email/informasi_ketersediaan', $data, true);
        // $message .= $this->load->view('email/_footer', '', true);

        // $this->email->from($_user->value_task, 'NOTIFIKASI PTSP BMKG');
        // $this->email->reply_to($_user->value_task, 'NOTIFIKASI PTSP BMKG');
        // $this->email->to($data['detail_akun']->email);
        // $this->email->cc('setdjod@gmail.com');
        // $this->email->bcc('gunadiahmad949@gmail.com');
        // $this->email->subject('Layanan Tersedia');
        // $this->email->message($message);
        // $this->email->send();

        $to = $data['detail_akun']->email;
        $subject = 'Layanan Tersedia';
        $message = $this->load->view('email/_header', '', true);
        $message .= $this->load->view('email/informasi_ketersediaan',$data, true);
        $message .= $this->load->view('email/_footer', '', true);
        send_email($to,$subject,$message);

        $this->db->update('tbl_permohonan', ['status' => 3], ['id_permohonan' => $id]);
        redirect(site_url($module));
        die();
      } else if ($detek == $total && $tidak >= 1) {
        // jika ada salah satu yang tidak
        $data['no_permohonan'] = $data['detail']->no_permohonan;
        $data['text_paragraph'] = "Informasi/Jasa yang dibutuhkan";
        $data['information'] = "TIDAK TERSEDIA";
        $data['text_action'] = "LIHAT DETAIL LAYANAN";
        $data['link_action'] = site_url($module.'/detail/'.$id);

        // $message = $this->load->view('email/_header', '', true);
        // $message .= $this->load->view('email/informasi_ketersediaan', $data, true);
        // $message .= $this->load->view('email/_footer', '', true);

        // $this->email->from($_user->value_task, 'NOTIFIKASI PTSP BMKG');
        // $this->email->reply_to($_user->value_task, 'NOTIFIKASI PTSP BMKG');
        // $this->email->to($data['detail_akun']->email);
        // $this->email->cc('setdjod@gmail.com');
        // $this->email->bcc('gunadiahmad949@gmail.com');
        // $this->email->subject('Layanan Tidak Tersedia');
        // $this->email->message($message);
        // $this->email->send();

        $to = $data['detail_akun']->email;
        $subject = 'Layanan Tidak Tersedia';
        $message = $this->load->view('email/_header', '', true);
        $message .= $this->load->view('email/informasi_ketersediaan',$data, true);
        $message .= $this->load->view('email/_footer', '', true);
        send_email($to,$subject,$message);

        $this->db->update('tbl_permohonan', ['status' => 2], ['id_permohonan' => $id]);
        redirect(site_url($module));
        die();
      } else {
        redirect(current_url());
        die();
      }
    }

    $data['page_title'] = $this->page_title;
    $data['errMsg']     = $errMsg;
    $this->template->add_css('resources/plugins/select2/select2.min.css');
    $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
    $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
    $this->template->add_js('resources/plugins/select2/select2.min.js');
    $this->template->write('title', $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/konfirmasi', $data, true);
    $this->template->render();
  }

  public function upload($id = '')
  {
    $this->load->model('global_model');
    $module = $this->module;
    $id_role = $this->session->userdata('id_role');
    $id_admin = $this->session->userdata('id_admin');
    $data['title'] = "Upload Bukti Pembayaran";
    $data['url_back'] = "window.location.href='" . site_url($this->module) . "'";
    $errMsg = null;
    $scsMsg = null;

    $data['detail'] = $this->db->get_where('tbl_permohonan', ['id_permohonan' => $id])->row();
    $data['detail_akun']  = $this->db->get_where('tbl_admin', ['id_admin' => $data['detail']->id_pemohon])->row();

    if ($id_role == 7) {
      if ($data['detail']->id_pemohon != $id_admin) {
        show_404();
        die();
      }
    }

    if ($data['detail']->status == 3 || $data['detail']->status == 8) {

      if ($_POST) {
        $config['max_size']         = 100000;
        $config['upload_path']      = './upload/bukti/';
        $config['encrypt_name']     = true;
        $config['allowed_types']    = 'gif|jpg|jpeg|png|pdf|doc|docx';
        $config['file_ext_tolower'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti')) {
          $errMsg = $this->upload->display_errors();
        } else {
          if ($data['detail']->status == 3) {
            $this->db->update('tbl_permohonan', [
              'id_rekening' => $this->input->post('rekening'),
              'bukti'       => $this->upload->data('file_name'),
              'status'      => 4,
            ], [
              'id_permohonan' => $id,
            ]);
          } elseif ($data['detail']->status == 8) {
            $this->db->update('tbl_permohonan', [
              'id_rekening'     => $this->input->post('rekening'),
              'id_rekening_old' => $data['detail']->id_rekening,
              'bukti'           => $this->upload->data('file_name'),
              'bukti_old'       => $data['detail']->bukti,
              'status'          => 4,
            ], [
              'id_permohonan' => $id,
            ]);
          }
          $scsMsg = 'Bukti Pembayaran Berhasil DiUpload, silahkan tunggu verifikasi dari Kami!';

          // $this->load->library('email');
          // $_host = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 1);
          // $_user = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 2);
          // $_pass = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 3);
          // $_port = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 4);
          // $_type = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 5);
          // $config['smtp_host']   = $_host->value_task;
          // $config['smtp_user']   = $_user->value_task;
          // $config['smtp_pass']   = $_pass->value_task;
          // $config['smtp_port']   = $_port->value_task;
          // $config['smtp_crypto'] = $_type->value_task;
          // $this->email->initialize($config);

          $data['no_permohonan'] = $data['detail']->no_permohonan;
          $data['text_paragraph'] = "Telah mengunggah bukti pembayaran";
          $data['information'] = "PROSES VERIFIKASI PEMBAYARAN";
          $data['text_action'] = "BENDAHARA VERIFIKASI";
          $data['link_action'] = site_url($module.'/verifikasi_pembayaran/'.$id);

          // $message = $this->load->view('email/_header', '', true);
          // $message .= $this->load->view('email/konfirmasi_pembayaran', $data, true);
          // $message .= $this->load->view('email/_footer', '', true);

          // $this->email->from($_user->value_task, 'NOTIFIKASI PTSP BMKG');
          // $this->email->reply_to($_user->value_task, 'NOTIFIKASI PTSP BMKG');
          // $this->email->to($_user->value_task);
          // $this->email->subject('Verifikasi Pembayaran');
          // $this->email->message($message);
          // $this->email->send();

          $bendahara = $this->global_model->get_by_id('tbl_admin','id_role',4);
          $to = $bendahara->email;
          $subject = 'Verifikasi Pembayaran';
          $message = $this->load->view('email/_header', '', true);
          $message .= $this->load->view('email/informasi_ketersediaan',$data, true);
          $message .= $this->load->view('email/_footer', '', true);
          send_email($to,$subject,$message);

          redirect(site_url($module));
          die();
        }

      }
    } else {
      show_404();
      die();
    }

    $data['page_title'] = $this->page_title;
    $data['errMsg']     = $errMsg;
    $data['scsMsg']     = $scsMsg;

    $this->template->write('title', $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/upload', $data, true);
    $this->template->render();
  }

  public function verifikasi_pembayaran($id = '')
  {
    $this->load->model('global_model');
    $module              = $this->module;
    $id_role             = $this->session->userdata('id_role');
    $data['title']       = "Verifikasi Pembayaran";
    $data['url_back']    = "window.location.href='" . site_url($this->module) . "'";
    $errMsg              = null;
    $scsMsg              = null;

    $data['detail']      = $this->db->get_where('tbl_permohonan', ['id_permohonan' => $id])->row();
    $data['detail_akun'] = $this->db->get_where('tbl_admin', ['id_admin' => $data['detail']->id_pemohon])->row();

    if ($id_role != 1 && $id_role != 2 && $id_role != 3 && $id_role != 4) {
      show_404();
      die();
    }

    if ($this->input->post('action', true)) {
      $feedback = $this->input->post('catatan');
      if ($this->input->post('action') == 'cancel') {
        $this->session->set_userdata('message', '<strong>Sukses!</strong> Bukti Pembayaran Ditolak');
        $data['text_paragraph'] = "Pembayaran dengan Nomor Permohonan tersebut, Kami <strong>TOLAK</strong>";
        $data['text_paragraph'] .= "<br><br><br>".$feedback;
        $this->db->update('tbl_permohonan', ['status' => 5, 'feedback' => $feedback], ['id_permohonan' => $id]);
      } else if ($this->input->post('action') == 'pending') {
        $this->session->set_userdata('message', '<strong>Sukses!</strong> Bukti Pembayaran Ditangguhkan');
        $data['text_paragraph'] = "Pembayaran dengan Nomor Permohonan tersebut, Kami <strong>TANGGUHKAN</strong>.";
        $data['text_paragraph'] .= "<br><br><br>".$feedback;
        $this->db->update('tbl_permohonan', ['status' => 8, 'feedback' => $feedback], ['id_permohonan' => $id]);
      } else if ($this->input->post('action') == 'approve') {
        $this->session->set_userdata('message', '<strong>Sukses!</strong> Bukti Pembayaran Diterima');
        $data['text_paragraph'] = "Pembayaran dengan Nomor Permohonan tersebut, telah Kami <strong>TERIMA</strong>";
        $data['text_paragraph'] .= "<br><br><br>".$feedback;
        $this->db->update('tbl_permohonan', ['status' => 6, 'feedback' => $feedback], ['id_permohonan' => $id]);
      }

      // $this->load->library('email');
      // $_host = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 1);
      // $_user = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 2);
      // $_pass = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 3);
      // $_port = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 4);
      // $_type = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 5);
      // $config['smtp_host']   = $_host->value_task;
      // $config['smtp_user']   = $_user->value_task;
      // $config['smtp_pass']   = $_pass->value_task;
      // $config['smtp_port']   = $_port->value_task;
      // $config['smtp_crypto'] = $_type->value_task;
      // $this->email->initialize($config);

      $data['no_permohonan'] = $data['detail']->no_permohonan;
      $data['text_action'] = "DETAIL PERMOHONAN";
      $data['link_action'] = site_url($module.'/detail/'.$id);

      // $message = $this->load->view('email/_header', '', true);
      // $message .= $this->load->view('email/konfirmasi_pembayaran', $data, true);
      // $message .= $this->load->view('email/_footer', '', true);

      // $this->email->from($_user->value_task, 'NOTIFIKASI PTSP BMKG');
      // $this->email->reply_to($_user->value_task, 'NOTIFIKASI PTSP BMKG');
      // $this->email->to($data['detail_akun']->email);
      // $this->email->subject('Informasi Pembayaran');
      // $this->email->message($message);
      // $this->email->send();

      $to = $data['detail_akun']->email;
      $subject = 'Informasi Pembayaran';
      $message = $this->load->view('email/_header', '', true);
      $message .= $this->load->view('email/konfirmasi_pembayaran',$data, true);
      $message .= $this->load->view('email/_footer', '', true);
      send_email($to,$subject,$message);

      redirect(current_url());
      die();
    }
    $msg = $this->session->userdata('message');
    if (!empty($msg)) {
      $scsMsg = $this->session->userdata('message');
      $this->session->unset_userdata('message');
    }

    $data['page_title'] = $this->page_title;
    $data['errMsg']     = $errMsg;
    $data['scsMsg']     = $scsMsg;

    $this->template->write('title', $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/verifikasi_pembayaran', $data, true);
    $this->template->render();
  }

  public function verifikasi($id = '')
  {
    $this->load->model('global_model');
    $module              = $this->module;
    $id_role             = $this->session->userdata('id_role');
    $data['title']       = "Konfirmasi Output (Hasil)";
    $data['url_back']    = "window.location.href='" . site_url($this->module) . "'";
    $data['url_cancel']  = "window.location.href='" . site_url($this->module) . "/verifikasi/" . $id . "?action=cancel'";
    $data['url_approve'] = "window.location.href='" . site_url($this->module) . "/verifikasi/" . $id . "?action=approve'";
    $errMsg              = null;
    $scsMsg              = null;

    $data['detail']        = $this->db->get_where('tbl_permohonan', ['id_permohonan' => $id])->row();
    $data['detail_akun']   = $this->db->get_where('tbl_admin', ['id_admin' => $data['detail']->id_pemohon])->row();
    $data['detail_produk'] = $this->db->get_where('tbl_detail_permohonan', ['id_permohonan' => $id, 'status' => 'Tersedia'])->row();

    if ($id_role != 1 && $id_role != 2 && $id_role != 3) {
      show_404();
      die();
    }

    if (empty($data['detail_produk'])) {
      $this->session->set_userdata('message_1', 'Semua Permohonan Telah Selesai Diproses!');
      $this->db->update('tbl_permohonan', ['status' => 9], ['id_permohonan' => $id]);
    // sleep(10);
    }

    if ($_POST) {
      $catatan = $this->input->post('catatan', true);
      $ambil_di_ptsp = $this->input->post('ambil_di_ptsp', true);
      $catatan       = !empty($catatan) ? $catatan : 'Tidak ada catatan';
      $layanan       = $this->db->get_where('m_layanan', ['id_layanan' => $data['detail_produk']->id_layanan])->row();
      $ambil_di_ptsp = !empty($ambil_di_ptsp) ? $ambil_di_ptsp : null;
      $this->db->get_where('m_layanan', ['id_layanan' => $detail_produk->id_layanan])->row();

      $config_1['max_size']         = 100000;
      $config_1['upload_path']      = './upload/dokumen/';
      $config_1['encrypt_name']     = true;
      $config_1['allowed_types']    = 'doc|docx|pdf|xls|xlsx|ppt|pptx';
      $config_1['file_ext_tolower'] = true;
      $this->load->library('upload', $config_1);
      if (!$this->upload->do_upload('download')) {
        if ($layanan->download == 'Ya' && empty($layanan->download)) {
          $this->session->set_userdata('message_2', $this->upload->display_errors());
          $download = null;
        } elseif ($layanan->download == 'Ya' && !empty($layanan->download)) {
          $download = $layanan->file_download;
        }
        $this->session->set_userdata('message_1', '<strong>Sukses!</strong> Permohonan Telah Selesai Diprosses!');
      } else {
        $download = $this->upload->data('file_name');
        $this->session->set_userdata('message_1', '<strong>Sukses!</strong> Permohonan Telah Selesai Diprosses!');
      }

      $this->db->update(
        'tbl_detail_permohonan', [
          'status'        => 'Sukses',
          'catatan'       => $catatan,
          'download'      => $download,
          'ambil_di_ptsp' => $ambil_di_ptsp,
        ], [
          'id_detail_permohonan' => $data['detail_produk']->id_detail_permohonan,
        ]
      );

      redirect(current_url());
      die();
    }

    $message_1 = $this->session->userdata('message_1');
    $message_2 = $this->session->userdata('message_2');
    if (!empty($message_1)) {
      $scsMsg = $this->session->userdata('message_1');
      $this->session->unset_userdata('message_1');
    } else if (!empty($message_2)) {
      $errMsg = $this->session->userdata('message_2');
      $this->session->unset_userdata('message_2');
    }

    $data['page_title'] = $this->page_title;
    $data['errMsg']     = $errMsg;
    $data['scsMsg']     = $scsMsg;

    $this->template->write('title', $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/verifikasi', $data, true);
    $this->template->render();
  }

  public function verifikasi_akhir($id = '')
  {
    $this->load->model('global_model');
    $module           = $this->module;
    $id_role          = $this->session->userdata('id_role');
    $data['title']    = "Verifikasi Akhir";
    $data['url_back'] = "window.location.href='" . site_url($this->module) . "'";
    $errMsg           = null;
    $scsMsg           = null;

    $data['detail']        = $this->db->get_where('tbl_permohonan', ['id_permohonan' => $id])->row();
    $data['detail_akun']   = $this->db->get_where('tbl_admin', ['id_admin' => $data['detail']->id_pemohon])->row();
    $data['detail_produk'] = $this->db->get_where('tbl_detail_permohonan', ['id_permohonan' => $id, 'status' => 'Sukses'])->row();

    if ($id_role != 1 && $id_role != 2 && $id_role != 3) {
      show_404();
      die();
    }

    if (empty($data['detail_produk'])) {
      $this->session->set_userdata('message_1', '<strong>Sukses!</strong> Semua Permohonan Telah Selesai Diproses!');
      $this->db->update('tbl_permohonan', ['status' => 7], ['id_permohonan' => $id]);

      // $this->load->library('email');
      // $_host = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 1);
      // $_user = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 2);
      // $_pass = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 3);
      // $_port = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 4);
      // $_type = $this->global_model->get_by_id('tbl_setting_content', 'id_task', 5);
      // $config['smtp_host']   = $_host->value_task;
      // $config['smtp_user']   = $_user->value_task;
      // $config['smtp_pass']   = $_pass->value_task;
      // $config['smtp_port']   = $_port->value_task;
      // $config['smtp_crypto'] = $_type->value_task;
      // $this->email->initialize($config);

      $to = $data['detail_akun']->email;
      $subject = 'Transaksi Selesai';
      $data['no_permohonan']  = $data['detail']->no_permohonan;
      $data['text_action']    = "DOWNLOAD DOKUMEN PENGANTAR";
      $data['text_paragraph'] = "<storng>Teleh selesai diproses oleh Kami</storng>";
      $data['link_action']    = site_url('upload/dokumen/'.$data['detail']->pengantar);

      $message = $this->load->view('email/_header', '', true);
      $message .= $this->load->view('email/transaksi_sukses', $data, true);
      $message .= $this->load->view('email/_footer', '', true);

      // $this->email->from($_user->value_task, 'NOTIFIKASI PTSP BMKG');
      // $this->email->reply_to($_user->value_task, 'NOTIFIKASI PTSP BMKG');
      // $this->email->to($data['detail_akun']->email);
      // $this->email->subject('Transaksi Selesai');
      // $this->email->message($message);
      // $this->email->send();
      send_email($to,$subject,$message);

      redirect(site_url($module));
      die();
    }

    if ($_POST) {
      $catatan = $this->input->post('catatan', true);
      $ambil_di_ptsp = $this->input->post('ambil_di_ptsp', true);
      $catatan       = !empty($catatan) ? $catatan : 'Tidak ada catatan';
      $layanan       = $this->db->get_where('m_layanan', ['id_layanan' => $data['detail_produk']->id_layanan])->row();
      $ambil_di_ptsp = !empty($ambil_di_ptsp) ? $ambil_di_ptsp : null;
      $this->db->get_where('m_layanan', ['id_layanan' => $detail_produk->id_layanan])->row();

      $config['max_size']         = 100000;
      $config['upload_path']      = './upload/dokumen/';
      $config['encrypt_name']     = true;
      $config['allowed_types']    = 'doc|docx|pdf|xls|xlsx|ppt|pptx|zip|rar';
      $config['file_ext_tolower'] = true;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('download')) {
        if ( $layanan->download == 'Ya' && !empty($data['detail_produk']->download) ) {
          $this->session->set_userdata('message_1', '<strong>Sukses!</strong> Permohonan Telah Selesai Diprosses!');
          $download = $data['detail_produk']->download;
        } elseif ($layanan->download == 'Ya' && empty($layanan->download)) {
          $this->session->set_userdata('message_2', $this->upload->display_errors());
          $download = null;
        } elseif ($layanan->download == 'Ya' && !empty($layanan->download)) {
          $download = $layanan->file_download;
        }
        $this->session->set_userdata('message_1', '<strong>Sukses!</strong> Permohonan Telah Selesai Diprosses!');
      } else {
        $download = $this->upload->data('file_name');
        $this->session->set_userdata('message_1', '<strong>Sukses!</strong> Permohonan Telah Selesai Diprosses!');
      }
      $pengantar = $data['detail']->pengantar;
      if (empty($pengantar)) {
        if (!$this->upload->do_upload('pengantar')) {
          $pengantar = null;
          $this->session->set_userdata('message_2', $this->upload->display_errors());
        } else {
          $pengantar = $this->upload->data('file_name');
        }
      }

      $this->db->update(
        'tbl_detail_permohonan', [
          'status'        => 'Selesai',
          'catatan'       => $catatan,
          'download'      => $download,
          'ambil_di_ptsp' => $ambil_di_ptsp,
        ], [
          'id_detail_permohonan' => $data['detail_produk']->id_detail_permohonan,
        ]
      );
      $this->db->update(
        'tbl_permohonan', [
          'pengantar' => $pengantar,
        ], [
          'id_permohonan' => $id,
        ]
      );

      redirect(current_url());
      die();
    }

    $message_1 = $this->session->userdata('message_1');
    $message_2 = $this->session->userdata('message_2');
    if (!empty($message_1)) {
      $scsMsg = $this->session->userdata('message_1');
      $this->session->unset_userdata('message_1');
    } else if (!empty($message_2)) {
      $errMsg = $this->session->userdata('message_2');
      $this->session->unset_userdata('message_2');
    }

    $data['page_title'] = $this->page_title;
    $data['errMsg']     = $errMsg;
    $data['scsMsg']     = $scsMsg;

    $this->template->write('title', $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/verifikasi_akhir', $data, true);
    $this->template->render();
  }

  public function review($id = '')
  {
    $this->load->model('global_model');
    $module           = $this->module;
    $id_role          = $this->session->userdata('id_role');
    $data['title']    = "Review Layanan";
    $data['url_back'] = "window.location.href='" . site_url($this->module) . "'";
    $errMsg           = null;
    $scsMsg           = null;

    $data['detail']         = $this->db->get_where('tbl_permohonan', ['id_permohonan' => $id])->row();
    $data['detail_akun']    = $this->db->get_where('tbl_admin', ['id_admin' => $data['detail']->id_pemohon])->row();
    $data['detail_produk']  = $this->db->get_where('tbl_detail_permohonan', ['id_permohonan' => $id, 'is_survey' => 'Belum'])->row();
    $data['detail_layanan'] = $this->db->get_where('m_layanan', ['id_layanan' => $data['detail_produk']->id_layanan])->row();

    if (empty($data['detail_produk'])) {
      $this->db->update(
        'tbl_permohonan', [
          'status' => 10,
        ], [
          'id_permohonan' => $id,
        ]
      );
      redirect(site_url($module));
      die();
    }

    if ($this->input->post()) {
      $data_insert = [
        'id_layanan'           => $data['detail_produk']->id_layanan,
        'id_detail_permohonan' => $data['detail_produk']->id_detail_permohonan,
        'survey'               => json_encode($this->input->post()),
      ];
      $this->db->insert('tbl_survey', $data_insert);

      $this->db->update(
        'tbl_detail_permohonan', [
          'is_survey' => 'Sudah',
        ], [
          'id_detail_permohonan' => $data['detail_produk']->id_detail_permohonan,
        ]
      );
      redirect(current_url());
      die();
    }

    $data['pertanyaan'] = $this->db->get_where('m_pertanyaan_survey', ['is_active' => 1])->result_array();

    $data['page_title'] = $this->page_title;
    $data['errMsg']     = $errMsg;
    $data['scsMsg']     = $scsMsg;

    $this->template->add_css('resources/plugins/select2/select2.min.css');
    $this->template->add_css('resources/plugins/select2/select2-bootstrap.min.css');
    $this->template->add_js('resources/plugins/select2/placeholders.jquery.min.js');
    $this->template->add_js('resources/plugins/select2/select2.min.js');
    $this->template->write('title', $this->page_title);
    $this->template->write_view('content', $this->folder . '/permohonan_layanan/review', $data, true);
    $this->template->render();
  }

  public function delete($id = '')
  {
    $this->load->model('global_model');
    $this->global_model->delete_data('tbl_detail_permohonan', 'id_permohonan', $id);
    $this->app_model->delete_data($id);
    redirect(site_url($this->module));
  }

}
