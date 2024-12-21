<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katalog_pelayanan extends CI_Controller
{

    public $folder = '';

    public function __construct()
    {
        parent::__construct();
        $this->template->set_template('frontend');
        $this->load->model('global_model');
        $module       = $this->folder . '/' . $this->router->fetch_class();
        $this->module = $module;
        $this->load->library('cart');
    }

    public function index()
    {
        $data['title']         = "Katalog Pelayanan";
        $data['bahasa']        = $this->session->userdata('bahasa');
        $jenis_layanan         = $this->global_model->get_list_array('m_jenis_layanan');
        $data['jenis_layanan'] = $jenis_layanan;

        $script = '';

        $data['url_back'] = "window.location.href='" . $_SERVER['HTTP_REFERER'] . "'";
        $this->template->add_js($script, 'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_katalog_pelayanan', $data, true);
        $this->template->render();
    }

    public function layanan($id_layanan = 0)
    {
        $data['title']          = "Katalog Pelayanan";
        $data['bahasa']         = $this->session->userdata('bahasa');
        $detail_layanan         = $this->global_model->get_by_id_array('m_layanan', 'id_layanan', $id_layanan);
        $data['detail_layanan'] = $detail_layanan;
        $child                  = $this->get_child_layanan($id_layanan);
        $childs                 = [];
        foreach ($child as $key => $value) {$childs[$key] = $value['is_produk'];}
        array_multisort($childs, SORT_DESC, $child);
        $data['child'] = $child;

        $script = '';

        $data['url_back'] = "window.location.href='" . $_SERVER['HTTP_REFERER'] . "'";
        $this->template->add_js($script, 'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_katalog_layanan', $data, true);
        $this->template->render();
    }

    public function detail_layanan($id_layanan = 0)
    {
        $data['title']          = "Detail Layanan";
        $data['bahasa']         = $this->session->userdata('bahasa');
        $data['detail_layanan'] = $this->global_model->get_by_id_array('m_layanan', 'id_layanan', $id_layanan);

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_detail_layanan', $data, true);
        $this->template->render();
    }

    public function tambah_layanan($id_layanan = 0)
    {
        // $this->cart->product_name_rules = '[:print:]';
        // $this->cart->product_name_rules = "\.\:\-_\"\' a-z0-9";
        $old_cart                       = $this->cart->contents();
        $detail_layanan                 = $this->db->get_where('m_layanan', ['id_layanan' => $id_layanan])->row_array();
        if($_POST){
            $kuantitas_pesanan = $this->input->post('kuantitas_pesanan');
        }
        $data_layanan                   = [
            'id'      => $detail_layanan['id_layanan'],
            'qty'     => $kuantitas_pesanan,
            'price'   => (int) $detail_layanan['harga'],
            'name'    => strip_tags($detail_layanan['layanan']),
            'options' => $detail_layanan,
        ];
        $insert_new = TRUE;
        foreach ($old_cart as $item) {
            if ( $item['id'] == $id_layanan ) {
                $this->session->set_flashdata('not_2', '<div class="alert alert-danger" role="alert">'.translate(86).'</div>');
                // $data = array('rowid'=>$item['rowid'],'qty'=>++$item['qty']);
                // $this->cart->update($data_layanan);
                $insert_new = FALSE;
            }
        }
        if ($insert_new) {
            $this->session->set_flashdata('not_1', '<div class="alert alert-success" role="alert">'.translate(85).'</div>');
            $this->cart->insert($data_layanan);
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            redirect($_SERVER['HTTP_REFERER']);
            die();
            // $this->cart->destroy();
            // $this->output
            // ->set_status_header(200)
            // ->set_content_type('application/json','utf-8')
            // ->set_output(json_encode($old_cart, JSON_PRETTY_PRINT));
        } else {
            show_404();
            die();
        }
    }

    public function proses_pesanan()
    {
        $data['title']   = "Proses Pesanan";
        $data['bahasa']  = $this->session->userdata('bahasa');
        $data['layanan'] = $this->cart->contents();

        // $this->template->add_js($script, 'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_proses_pesanan', $data, true);
        $this->template->render();
    }

    public function hapus_pesanan($rowid)
    {
        if(empty($rowid)){
            $cart_contents = $this->cart->contents();
            if (!empty($cart_contents)) {
                $this->session->set_flashdata('not_1', '<div class="alert alert-success" role="alert">'.translate(89).'</div>');
                $this->cart->destroy();
            } else {
                $this->session->set_flashdata('not_2', '<div class="alert alert-danger" role="alert">'.translate(90).'</div>');
            }
        } else {
            $this->session->set_flashdata('not_1', '<div class="alert alert-success" role="alert">'.translate(88).'</div>');
            $this->cart->remove($rowid);
        }
        redirect($_SERVER['HTTP_REFERER']);
        die();
    }

    public function validasi_pesanan()
    {
        $this->load->model('backend/katalog_pelayanan/' . 'informasi_mkg_model', 'app_model');
        $this->load->model('global_model');
        // $this->app_model->initialize($module);
        // $this->module = $module;
        // jika sudah login
        $id_role = $this->session->userdata('id_role');
        $username = $this->session->userdata('username');

        if (!empty($id_role) && !empty($username)) {
            $data = $this->cart->contents();
            $nama_bendahara = $this->global_model->get_by_id('tbl_setting_content','id_task',6);
            $nip_bendahara = $this->global_model->get_by_id('tbl_setting_content','id_task',7);
            // jika cart ada
            $id_admin = $this->session->userdata('id_admin');
            if (!empty($data) && !empty($id_admin)) {
                $jasa = $informasi = NULL;
                foreach ($data as $value) {               
                    if($value['options']['id_jenis_layanan']==1) {
                        $informasi = true;
                    }
                    if($value['options']['id_jenis_layanan']==2) {
                        $jasa = true;
                    }
                }
                if (!empty($informasi)) {
		    // Merubah bulan menjadi tahun. Perbaikan oleh Nurhayati Rahayu dan Rahmat (04/01/2021)
		    //$no_urut = $this->global_model->get_max_data('tbl_permohonan', 'id_permohonan','MONTH(tanggal_permohonan)='.date('m'));
		    $no_urut = $this->global_model->get_max_data('tbl_permohonan', 'id_permohonan','YEAR(tanggal_permohonan)='.date('Y'));
		    // Baris terakhir perubahan 
                    $bulan=numberToRoman(date('m'));
                    $data_insert = [
                        'id_pemohon'         => $this->session->userdata('id_admin'),
                        'id_jenis_layanan'   => 1,
                        'tanggal_permohonan' => date("Y-m-d H:i:s"),
                        'no_permohonan'      => 'UM.501/'.$no_urut.'/PTSP/'.$bulan.'/'.date('Y'),
                        'status'             => 1,
                        'nama_bendahara'     => $nama_bendahara->value_task,
                        'nip_bendahara'      => $nip_bendahara->value_task,
                        'total_harga'        => $this->session->userdata('cart_contents')['cart_total'],
                        //Baris awal menambah kolom idadmin_petugaskonfirmasi dan idadmin_petugasverifikasi (Nurhayati Rahayu 07/03/2023)
                        'idadmin_petugaskonfirmasi'  => 6,
                        'idadmin_petugasverifikasi'  => 6,
                        //Baris akhir menambah kolom idadmin_petugaskonfirmasi dan idadmin_petugasverifikasi (Nurhayati Rahayu 07/03/2023)
                    ];
                    $insert_infromasi        = $this->global_model->insert_data('tbl_permohonan', $data_insert);
                    if ($insert_infromasi) {
                        foreach ($data as $value) {
                            for ($i=0; $i < $value['qty'] ; $i++) {
                                if ($value['options']['id_jenis_layanan']==1) {
                                    $data_insert = [
                                        'id_layanan'    => strip_tags($value['id']),
                                        'id_permohonan' => $insert_infromasi,
                                        'jumlah'        => 1,
                                        'harga_satuan'  => strip_tags($value['price']),
                                        'harga'         => strip_tags($value['price']),
                                        'status'        => 'Belum Dilengkapi',
                                    ];
                                    $insert = $this->global_model->insert_data('tbl_detail_permohonan', $data_insert);
                                }
                            }
                        }
                    }
                }

                if (!empty($jasa)) {
		    // Merubah bulan menjadi tahun. Perbaikan oleh Nurhayati Rahayu dan Rahmat (04/01/2021)
                    //$no_urut = $this->global_model->get_max_data('tbl_permohonan', 'id_permohonan','MONTH(tanggal_permohonan)='.date('m'));
                    $no_urut = $this->global_model->get_max_data('tbl_permohonan', 'id_permohonan','YEAR(tanggal_permohonan)='.date('Y'));
		    // Baris terakhir perubahan
                    $bulan=numberToRoman(date('m'));
                    $data_insert = [
                        'id_pemohon'         => $this->session->userdata('id_admin'),
                        'id_jenis_layanan'   => 2,
                        'tanggal_permohonan' => date("Y-m-d H:i:s"),
                        'no_permohonan'      => 'UM.501/'.$no_urut.'/PTSP/'.$bulan.'/'.date('Y'),
                        'status'             => 1,
                        'nama_bendahara'     => $nama_bendahara->value_task,
                        'nip_bendahara'      => $nip_bendahara->value_task,
                        'total_harga'        => $this->session->userdata('cart_contents')['cart_total'],
                        //Baris awal menambah kolom idadmin_petugaskonfirmasi dan idadmin_petugasverifikasi (Nurhayati Rahayu 07/03/2023)
                        'idadmin_petugaskonfirmasi'  => 6,
                        'idadmin_petugasverifikasi'  => 6,
                        //Baris akhir menambah kolom idadmin_petugaskonfirmasi dan idadmin_petugasverifikasi (Nurhayati Rahayu 07/03/2023)
                    ];
                    $insert_jasa        = $this->global_model->insert_data('tbl_permohonan', $data_insert);
                    if ($insert_jasa) {
                        foreach ($data as $value) {
                            for ($i=0; $i < $value['qty'] ; $i++) {
                                if ($value['options']['id_jenis_layanan']==2) {
                                    $data_insert = [
                                        'id_layanan'    => strip_tags($value['id']),
                                        'id_permohonan' => $insert_jasa,
                                        'jumlah'        => 1,
                                        'harga'         => strip_tags($value['price']),
                                        'harga_satuan'  => strip_tags($value['price']),
                                        'status'        => 'Belum Dilengkapi',
                                    ];
                                    $insert = $this->global_model->insert_data('tbl_detail_permohonan', $data_insert);
                                }
                            }
                        }
                    }
                }
                
                $this->cart->destroy();
                redirect(site_url('backend/permohonan_layanan/permohonan_layanan'));
                die();
            } else {
                // jika cart kosong
                redirect(site_url('katalog_pelayanan'));
                die();
            }
        } else {
            // jika belum login
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'));
            die();
        }
    }

    public function get_child_layanan($id_parent)
    {
        $con   = 'id_parent = ' . $id_parent;
        $child = $this->global_model->get_list_array('m_layanan', $con);
        return $child;
    }
}
