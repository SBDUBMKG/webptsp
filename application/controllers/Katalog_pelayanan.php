<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katalog_pelayanan extends CI_Controller
{
    public $folder = '';

    public function __construct()
    {
        parent::__construct();
        // $this->template->set_template('frontend');
        $this->template->set_template('frontend_ptsp');
        $this->load->model('global_model');
        $module       = $this->folder . '/' . $this->router->fetch_class();
        $this->module = $module;
        $this->load->library('cart');

        $libur = $this->global_model->get_count_data('tbl_libur','curdate() between tgl_mulai and tgl_akhir');
        if ($libur) redirect('v_404');
    }

    public function index()
    {
        $data = array();

        $data['title']         = "Katalog Pelayanan";
        $data['bahasa']        = $this->session->userdata('bahasa');
        $jenis_layanan         = $this->global_model->get_list_array('m_jenis_layanan');
        $data['jenis_layanan'] = $jenis_layanan;

        $script = '';

        // $data['url_back'] = "window.location.href='" . $_SERVER['HTTP_REFERER'] . "'";
        $this->template->add_js($script, 'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_katalog', $data, true);
        $this->template->render();
    }
    public function informasi()
    {
        $data['title']         = "Katalog Pelayanan Informasi";
        $data['bahasa']        = $this->session->userdata('bahasa');
        $layanan         = $this->global_model->get_list_array('m_layanan', 'id_jenis_layanan=1 AND id_parent=0');
        $data['layanan'] = $layanan;

        $script = '';

        // $data['url_back'] = "window.location.href='" . $_SERVER['HTTP_REFERER'] . "'";
        $this->template->add_js($script, 'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_katalog_informasi', $data, true);
        $this->template->render();
    }
    public function jasa()
    {
        $data['title']         = "Katalog Pelayanan Informasi";
        $data['bahasa']        = $this->session->userdata('bahasa');
        $layanan         = $this->global_model->get_list_array('m_layanan', 'id_jenis_layanan=2 AND id_parent=0');
        $data['layanan'] = $layanan;

        $script = '';

        // $data['url_back'] = "window.location.href='" . $_SERVER['HTTP_REFERER'] . "'";
        $this->template->add_js($script, 'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_katalog_jasa', $data, true);
        $this->template->render();
    }
    // public function katalog()
    // {
    //     $data['title']         = "Katalog Pelayanan";
    //     $data['bahasa']        = $this->session->userdata('bahasa');

    //     $script = '';

    //     $data['url_back'] = "window.location.href='" . $_SERVER['HTTP_REFERER'] . "'";
    //     $this->template->add_js($script, 'embed');
    //     $this->template->write('title', $data['title']);
    //     $this->template->write_view('content', 'v_katalog_pelayanan', $data, true);
    //     $this->template->render();
    // }

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
        $data['uri_segments'] = $this->uri->segment(3);
        if ($data['uri_segments'] == "1" || $data['uri_segments'] == "2" || $data['uri_segments'] == "3") {
            $data['uri_segments'] = 'informasi';
        } else {
            $data['uri_segments'] = 'jasa';
        }
        $script = '';

        // $data['url_back'] = "window.location.href='" . (isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'') . "'";
        $this->template->add_js($script, 'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_katalog_layanan', $data, true);
        $this->template->render();
    }

    public function detail_layanan($id_layanan = 0, $id_cart=null)
    {
        $data['title']          = "Detail Layanan";
        $data['bahasa']         = $this->session->userdata('bahasa');
        $data['detail_layanan'] = $this->global_model->get_by_id_array('m_layanan', 'id_layanan', $id_layanan);
        $data['jenis_layanan']  = $data['detail_layanan']['id_jenis_layanan'] == 1 ? "informasi" : "jasa";
        $data['layanan']        = !$id_cart?$this->cart->contents():$this->cart->get_item($id_cart);
        $data['id_layanan']     = $id_layanan;
        $data['id_cart']        = $id_cart;

        $json_detail_layanan    = str_replace('"', '"', $data['detail_layanan']['display_coloumn'.$data['bahasa']]);
        $array_detail_layanan   = json_decode($json_detail_layanan, true);

        $script = "
        function formatRupiah(angka, prefix){
            var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
            split       = number_string.split(','),
            sisa        = split[0].length % 3,
            rupiah        = split[0].substr(0, sisa),
            ribuan        = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
              separator = sisa ? '.' : '';
              rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
        }

        $(document).ready(function() {
            const detailLayanan = " . $json_detail_layanan .";
            const payload = ".(isset($data['layanan']['payload'])?$data['layanan']['payload']:"null").";
            const formInput = $('#form-input');

            const total = formatRupiah(" . $data['detail_layanan']['harga'] . ");
            $('#total-price').text('Rp. ' + total);

            $.each(detailLayanan, function(key, value) {
                const inputType = key.includes('jumlah') ? 'number' : key.includes('tanggal') ? 'date' : 'text';

                const wrapper = $('<div></div>').addClass('form-group').addClass('row').addClass('p-2').addClass('align-items-center');
                const label = $('<label></label>').attr('for', key).addClass('control-label').addClass('col-sm-3').append(value);
                const field = $('<input></input>').attr('name', key).attr('id', key).attr('type', inputType)".(isset($data['layanan']['payload'])?".attr('value',payload[key])":"").".addClass('form-control').addClass('field');

                if (key.includes('jumlah') && !payload) {
                    field.attr('min', 1).val(1);
                }

                if (key.includes('tanggal')) {
                    const today = new Date().toISOString().split('T')[0]
                    field.val(today);
                    field.attr('min', today);
                }

                const fieldWrapper = $('<div></div>').addClass('col-sm-9').append(field);

                wrapper.append(label, fieldWrapper);
                formInput.append(wrapper);
            });

            $('#btn-submit').on('click', function() {
                $('#form-input').submit();
            });

            const BASE_PRICE = " . $data['detail_layanan']['harga'] . ";

            function calculate(amount, amount_docs) {
                return (amount * BASE_PRICE) * amount_docs;
            }

            $('input[name=\"jumlah\"]').on('change', function() {
                const amount = $(this).val();
                const amount_docs = $('input[name=\"jumlah_dokumen\"]').val() ?? 1; // some service did not have jumlah_dokumen field

                const start_date = $('input[name=\"tanggal_mulai\"]').val();
                const end_date = $('input[name=\"tanggal_selesai\"]').val();
                if (start_date && end_date) {
                    const start = new Date(start_date);
                    const end =  start.setDate(start.getDate() + parseInt(amount) - 1 );

                    $('input[name=\"tanggal_selesai\"]').val(new Date(end).toISOString().split('T')[0]);
                }

                const total = formatRupiah(calculate(amount, amount_docs));
                $('#total-price').text('Rp. ' + total);
            });

            // specific only for tanggal_mulai and tanggal_selesai field if it exists in the form
            // and useful to calculate the amount of days between the two dates
            function calculateDays() {
                const start_date = $('input[name=\"tanggal_mulai\"]').val();
                const end_date = $('input[name=\"tanggal_selesai\"]').val();
                const difference = new Date(end_date) - new Date(start_date);

                const amount = Math.ceil(difference / (1000 * 3600 * 24)) + 1;

                $('input[name=\"jumlah\"]').val(amount).trigger('change');
            }

            $('input[name=\"tanggal_mulai\"]').on('change', calculateDays);
            $('input[name=\"tanggal_selesai\"]').on('change', calculateDays);

            // specific only for jumlah_dokumen field if it exists in the form
            $('input[name=\"jumlah_dokumen\"]').on('change', function() {
                const amount_docs = $(this).val();
                const amount = $('input[name=\"jumlah\"]').val();

                const total = formatRupiah(calculate(amount, amount_docs));
                $('#total-price').text('Rp. ' + total);
            });


        });

        ";

        $this->template->add_js($script, 'embed');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_detail_layanan', $data, true);
        $this->template->render();
    }

    public function tambah_layanan($id_layanan = 0, $id_cart = null)
    {
        if($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Forbidden', '403');
        }

        $this->load->library('form_validation');

        $data['bahasa']         = $this->session->userdata('bahasa');
        $data['detail_layanan'] = $this->global_model->get_by_id_array('m_layanan', 'id_layanan', $id_layanan);
        $json_detail_layanan = str_replace('"', '"', $data['detail_layanan']['display_coloumn'.$data['bahasa']]);
        $array_detail_layanan = json_decode($json_detail_layanan, true);

        foreach ($array_detail_layanan as $key => $value) {
            if ($key == 'jumlah') {
                $this->form_validation->set_rules($key, $value, 'required|numeric|greater_than[0]');
            }else {
                $this->form_validation->set_rules($key, $value, 'required');

            }
            if (empty($data['bahasa'])) {
                $this->form_validation->set_message('required', '{field} harus diisi');
                $this->form_validation->set_message('numeric', '{field} harus berupa angka');
                $this->form_validation->set_message('greater_than', '{field} harus lebih dari 0');
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->session->set_flashdata('not_1', '<div class="alert alert-danger" role="alert">'.$errors.'</div>');
            redirect($_SERVER['HTTP_REFERER']);
            return;
        }

        $payload            = $this->input->post();
        $detail_layanan     = $this->db->get_where('m_layanan', ['id_layanan' => $id_layanan])->row_array();

        $subtotal = (int) $detail_layanan['harga'] * $payload['jumlah'];
        if (isset($payload['jumlah_dokumen'])) {
            $subtotal = $subtotal * (int) $payload['jumlah_dokumen'];
        }

        $data_layanan = [
            'id'      => $detail_layanan['id_layanan'],
            'qty'     => 1,
            'price'   => $subtotal,
            'name'    => strip_tags($detail_layanan['layanan']),
            'options' => $detail_layanan,
            'payload' => json_encode($payload),
        ];
        if($id_cart) {
            $data_layanan['rowid']=$id_cart;
            $this->cart->update($data_layanan);
            redirect('katalog_pelayanan/proses_pesanan');
        } else  $this->cart->insert($data_layanan);
        $this->session->set_flashdata('not_1', '<div class="alert alert-success" role="alert">'.translate(85).'</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function proses_pesanan()
    {
        $data['title']   = "Proses Pesanan";
        $data['bahasa']  = $this->session->userdata('bahasa');
        $data['layanan'] = $this->cart->contents();

        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'v_proses_pesanan', $data, true);
        $this->template->render();
    }

    public function hapus_pesanan($rowid)
    {
      if (!empty($rowid)) {
        $this->session->set_flashdata('not_1', '<div class="alert alert-success" role="alert">'.translate(88).'</div>');
        $this->cart->remove($rowid);
        redirect($_SERVER['HTTP_REFERER']);
      }

      $cart_contents = $this->cart->contents();
      if (!empty($cart_contents)) {
        $this->session->set_flashdata('not_1', '<div class="alert alert-success" role="alert">'.translate(89).'</div>');
        $this->cart->destroy();
      } else {
        $this->session->set_flashdata('not_2', '<div class="alert alert-danger" role="alert">'.translate(90).'</div>');
      }

      redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_pesanan($id_layanan) {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Forbidden', 403);
        }

        if (empty($id_layanan)) {
            $this->session->set_flashdata('not_2', '<div class="alert alert-danger" role="alert">'.translate(90).'</div>');
        }

        $payload            = $this->input->post();
        $detail_layanan     = $this->db->get_where('m_layanan', ['id_layanan' => $id_layanan])->row_array();

        $input_fields       = [];
        foreach($payload  as $key => $val) {
            if ($key === 'rowid') {
                continue;
            }

            $input_fields[$key] = $val;
        }

        $subtotal = (int) $detail_layanan['harga'] * $payload['jumlah'];
        if (isset($payload['jumlah_dokumen'])) {
            $subtotal = $subtotal * (int) $payload['jumlah_dokumen'];
        }

        $data_layanan = [
            'rowid'   => $payload['rowid'],
            'id'      => $detail_layanan['id_layanan'],
            'qty'     => 1,
            'price'   => $subtotal,
            'name'    => strip_tags($detail_layanan['layanan']),
            'options' => $detail_layanan,
            'payload' => json_encode($input_fields),
        ];

        $this->cart->update($data_layanan);
        $this->session->set_flashdata('not_1', '<div class="alert alert-success" role="alert">'.translate(85).'</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function validasi_pesanan()
    {
        $this->load->model('backend/katalog_pelayanan/' . 'informasi_mkg_model', 'app_model');
        $this->load->model('global_model');

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
                $no_urut = $this->global_model->get_max_data('tbl_permohonan', 'id_permohonan','YEAR(tanggal_permohonan)='.date('Y'));
                $bulan=numberToRoman(date('m'));
                $data_insert = [
                    'id_pemohon'         => $this->session->userdata('id_admin'),
                    'id_jenis_layanan'   => 1,
                    'tanggal_permohonan' => date("Y-m-d H:i:s"),
                    'no_permohonan'      => date('Y').date('m').str_pad($no_urut, 4, '0', STR_PAD_LEFT),
                    'status'             => 1,
                    'nama_bendahara'     => $nama_bendahara->value_task,
                    'nip_bendahara'      => $nip_bendahara->value_task,
                    'total_harga'        => $this->session->userdata('cart_contents')['cart_total'],
                    'idadmin_petugaskonfirmasi'  => 6,
                    'idadmin_petugasverifikasi'  => 6,
                ];

                $insert_data = $this->global_model->insert_data('tbl_permohonan', $data_insert);
                if ($insert_data) {
                    foreach ($data as $value) {
                        for ($i=0; $i < $value['qty'] ; $i++) {
                            $data_insert = [
                                'id_layanan'    => strip_tags($value['id']),
                                'id_permohonan' => $insert_data,
                                'harga_satuan'  => strip_tags($value['options']['harga']),
                                'harga'         => strip_tags($value['price']),
                            ];


                            // this would turn to false whenever a payload is empty
                            $is_payload_valid = true;

                            $payload = json_decode($value['payload']);
                            foreach($payload as $key => $val) {
                                $data_insert[$key] = $val;
                                $is_payload_valid = strlen($val) !== 0;
                            }

                            $data_insert['status'] = $is_payload_valid ? null : 'Belum Dilengkapi';
                            $insert = $this->global_model->insert_data('tbl_detail_permohonan', $data_insert);
                        }
                    }
                }

                // if (!empty($informasi)) {

                //     $no_urut = $this->global_model->get_max_data('tbl_permohonan', 'id_permohonan','YEAR(tanggal_permohonan)='.date('Y'));
                //     $bulan=numberToRoman(date('m'));
                //     $data_insert = [
                //         'id_pemohon'         => $this->session->userdata('id_admin'),
                //         'id_jenis_layanan'   => 1,
                //         'tanggal_permohonan' => date("Y-m-d H:i:s"),
                //         'no_permohonan'      => date('Y').date('m').str_pad($no_urut, 4, '0', STR_PAD_LEFT),
                //         'status'             => 1,
                //         'nama_bendahara'     => $nama_bendahara->value_task,
                //         'nip_bendahara'      => $nip_bendahara->value_task,
                //         'total_harga'        => $this->session->userdata('cart_contents')['cart_total'],
                //         'idadmin_petugaskonfirmasi'  => 6,
                //         'idadmin_petugasverifikasi'  => 6,
                //     ];

                //     $insert_infromasi = $this->global_model->insert_data('tbl_permohonan', $data_insert);
                //     if ($insert_infromasi) {
                //         foreach ($data as $value) {
                //             for ($i=0; $i < $value['qty'] ; $i++) {
                //                 if ($value['options']['id_jenis_layanan']==1) {
                //                     $data_insert = [
                //                         'id_layanan'    => strip_tags($value['id']),
                //                         'id_permohonan' => $insert_infromasi,
                //                         'harga_satuan'  => strip_tags($value['options']['harga']),
                //                         'harga'         => strip_tags($value['price']),
                //                     ];


                //                     // this would turn to false whenever a payload is empty
                //                     $is_payload_valid = true;

                //                     $payload = json_decode($value['payload']);
                //                     foreach($payload as $key => $val) {
                //                         $data_insert[$key] = $val;
                //                         $is_payload_valid = strlen($val) !== 0;
                //                     }

                //                     $data_insert['status'] = $is_payload_valid ? null : 'Belum Dilengkapi';
                //                     $insert = $this->global_model->insert_data('tbl_detail_permohonan', $data_insert);
                //                 }
                //             }
                //         }
                //     }
                // }

                // if (!empty($jasa)) {
                //     $no_urut = $this->global_model->get_max_data('tbl_permohonan', 'id_permohonan','YEAR(tanggal_permohonan)='.date('Y'));
                //     $bulan=numberToRoman(date('m'));
                //     $data_insert = [
                //         'id_pemohon'         => $this->session->userdata('id_admin'),
                //         'id_jenis_layanan'   => 2,
                //         'tanggal_permohonan' => date("Y-m-d H:i:s"),
                //         'no_permohonan'      => date('Y').date('m').str_pad($no_urut, 4, '0', STR_PAD_LEFT),
                //         'status'             => 1,
                //         'nama_bendahara'     => $nama_bendahara->value_task,
                //         'nip_bendahara'      => $nip_bendahara->value_task,
                //         'total_harga'        => $this->session->userdata('cart_contents')['cart_total'],
                //         'idadmin_petugaskonfirmasi'  => 6,
                //         'idadmin_petugasverifikasi'  => 6,
                //     ];
                //     $insert_jasa        = $this->global_model->insert_data('tbl_permohonan', $data_insert);
                //     if ($insert_jasa) {
                //         foreach ($data as $value) {
                //             for ($i=0; $i < $value['qty'] ; $i++) {
                //                 if ($value['options']['id_jenis_layanan']==2) {
                //                     $data_insert = [
                //                         'id_layanan'    => strip_tags($value['id']),
                //                         'id_permohonan' => $insert_jasa,
                //                         'harga_satuan'  => strip_tags($value['options']['harga']),
                //                         'harga'         => strip_tags($value['price']),
                //                     ];


                //                     // this would turn to false whenever a payload is empty
                //                     $is_payload_valid = true;

                //                     $payload = json_decode($value['payload']);
                //                     foreach($payload as $key => $val) {
                //                         $data_insert[$key] = $val;
                //                         $is_payload_valid = strlen($val) !== 0;
                //                     }

                //                     $data_insert['status'] = $is_payload_valid ? null : 'Belum Dilengkapi';
                //                     $insert = $this->global_model->insert_data('tbl_detail_permohonan', $data_insert);
                //                 }
                //             }
                //         }
                //     }
                // }

                $this->cart->destroy();
                redirect(site_url('backend/permohonan_layanan/permohonan_layanan'));
            } else {
                // jika cart kosong
                redirect(site_url('katalog_pelayanan'));
            }
        } else {
            // jika belum login
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url('login'));
        }
    }

    public function get_child_layanan($id_parent)
    {
        $con   = 'id_parent = ' . $id_parent;
        $child = $this->global_model->get_list_array('m_layanan', $con);
        return $child;
    }
}
