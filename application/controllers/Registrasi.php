<?php
//filepath :  application\controllers\Registrasi.php
defined("BASEPATH") or exit("No direct script access allowed");

class Registrasi extends CI_Controller
{
    var $folder = "";

    function __construct()
    {
        parent::__construct();
        // $this->template->set_template('frontend');
        $this->template->set_template("frontend_ptsp");
        $this->load->model("global_model");
        $module = $this->folder . "/" . $this->router->fetch_class();
        $this->load->model("frontend/registrasi_model", "app_model");
        $this->module = $module;
    }

    public function index()
    {
        $data["title"] = "Registrasi";
        $data["bahasa"] = $this->session->userdata("bahasa");

        $this->template->write("title", $data["title"]);
        $this->template->write_view("content", "v_registrasi", $data, true);
        $this->template->render();
    }

    public function registrasi_perorangan()
    {
        $data["title"] = translate(43);
        $bahasa = $this->session->userdata("bahasa");
        $data["bahasa"] = $bahasa;
        $errMsg = [];

        /*$vals = array(
            'word'          => random_word(5, false, true,true),
            'img_path'      => './captcha/',
            'img_url'       => base_url().'captcha/',
            'font_path'     => './system/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 33,
            'expiration'    => 7200,
            'word_length'   => 5,
            'font_size'     => 16,
            'colors'        => array(
                                'background' => array(200, 200, 200),
                                'border' => array(0, 0, 0),
                                'text' => array(0, 0, 0),
                                'grid' => array(255, 255, 20)
                               )
        );
        $cap = create_captcha($vals);
        $data['captcha_image'] = $cap['image'];*/

        $vals = [
            "word" => random_word(5, false, true, true),
            "img_path" => "./captcha/",
            "img_url" => base_url() . "captcha/",
            "font_path" => "./system/fonts/texb.ttf",
            "img_width" => "150",
            "img_height" => 33,
            "expiration" => 7200,
            "word_length" => 5,
            "font_size" => 16,
            "colors" => [
                "background" => [200, 200, 200],
                "border" => [0, 0, 0],
                "text" => [0, 0, 0],
                "grid" => [255, 255, 20],
            ],
        ];

        $recaptcha_v2 = false;
        if (isset($_SESSION["recaptcha_v2"])) {
            $recaptcha_v2 = $_SESSION["recaptcha_v2"];
        }
        $cap = create_captcha($vals);
        $err = $this->session->flashdata("login_message");

        // $data['captcha_image'] = $cap['image'];
        $data["err"] = $err;
        $data["recaptcha_v2"] = $recaptcha_v2;

        if ($_POST) {
            $data_post = $this->input->post();
            $data["detail"] = $data_post;
            $simpan = true;

            if (empty($data["detail"]["username"])) {
                $simpan = false;
                $errMsg["username"] = "Username tidak boleh kosong";
            }
            if (empty($data["detail"]["nama"])) {
                $simpan = false;
                $errMsg["nama"] = "Nama tidak boleh kosong";
            }
            if (empty($data["detail"]["password"])) {
                $simpan = false;
                $errMsg["password"] = "Password tidak boleh kosong";
            }
            if (empty($data["detail"]["password2"])) {
                $simpan = false;
                $errMsg["password"] = "Ulangi Password tidak boleh kosong";
            }
            if (empty($data["detail"]["email"])) {
                $simpan = false;
                $errMsg["email"] = "Email tidak boleh kosong";
            }
            if (empty($data["detail"]["no_ktp"])) {
                $simpan = false;
                $errMsg["no_ktp"] = "KTP tidak boleh kosong";
            }
            if (!empty($data["detail"]["npwp"])) {
                // get number only from npwp
                $temp_npwp = $data["detail"]["npwp"];
                $temp_npwp = preg_replace("/[^0-9]/", "", $temp_npwp);

                if (strlen($temp_npwp) > 20) {
                    $simpan = false;
                    $errMsg["npwp"] = "Maksimal 20 angka";
                } elseif (strlen($temp_npwp) < 15) {
                    $simpan = false;
                    $errMsg["npwp"] = "NPWP tidak valid";
                }
            }
            if (empty($data["detail"]["alamat"])) {
                $simpan = false;
                $errMsg["alamat"] = "Alamat tidak boleh kosong";
            }
            if (empty($data["detail"]["no_hp"])) {
                $simpan = false;
                $errMsg["no_hp"] = "No HP/ Telepon tidak boleh kosong";
            }
            if (empty($data["detail"]["pekerjaan"])) {
                $simpan = false;
                $errMsg["pekerjaan"] = "Pekerjaan tidak boleh kosong";
            }
            // Awal script yang ditambahkan Rahmat, 10 Agustus 2020
            if (empty($data["detail"]["id_pendidikan"])) {
                $simpan = false;
                $errMsg["id_pendidikan"] = "Pendidikan tidak boleh kosong";
            }
            // Akhir script yang ditambahkan rahmat, 10 Agustus 2020
            if (empty($data["detail"]["id_provinsi"])) {
                $simpan = false;
                $errMsg["id_provinsi"] = "Provinsi tidak boleh kosong";
            }
            if (empty($data["detail"]["id_kabkot"])) {
                $simpan = false;
                $errMsg["id_kabkot"] = "Kabupaten/Kota tidak boleh kosong";
            }
            $email = strip_tags($this->input->post("email"));
            // menonaktifkan fungsi FILTER_VALIDATE_EMAIL . Perubahan oleh Nurhayati Rahayu (24/08/2021)
            //if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //    $simpan = false;
            //    $errMsg['email'] = "Email tidak valid";
            //}
            // Baris terakhir perubahan oleh Nurhayati Rahayu (24/08/2021)

            $id_role = 7;
            $username = strip_tags($this->input->post("username"));
            $nama = strip_tags($this->input->post("nama"));
            $pwd = strip_tags($this->input->post("password"));
            $pwd2 = strip_tags($this->input->post("password2"));
            $password = strrev(md5($pwd));
            $email = $email;
            $npwp = strip_tags($this->input->post("npwp"));
            $no_ktp = strip_tags($this->input->post("no_ktp"));
            $tempat_lahir = strip_tags($this->input->post("tempat_lahir"));
            $tanggal_lahir = strip_tags($this->input->post("tanggal_lahir"));
            $bln = substr($tanggal_lahir, 0, 2);
            $tgl = substr($tanggal_lahir, 3, 2);
            $tahun = substr($tanggal_lahir, 6, 4);
            $tanggal_lahir = $tahun . "-" . $bln . "-" . $tgl;
            $jenis_kelamin = strip_tags($this->input->post("jenis_kelamin"));
            $pekerjaan = strip_tags($this->input->post("pekerjaan"));
            $id_pendidikan = strip_tags($this->input->post("id_pendidikan")); // Script yang ditambahkan Rahmat, 10 Agustus 2020
            $alamat = strip_tags($this->input->post("alamat"));
            $kelurahan = strip_tags($this->input->post("id_kelurahan"));
            $kecamatan = strip_tags($this->input->post("id_kecamatan"));
            $kabupaten = strip_tags($this->input->post("id_kabkot"));
            $provinsi = strip_tags($this->input->post("id_provinsi"));
            $kode_pos = strip_tags($this->input->post("kode_pos"));
            $no_telepon = strip_tags($this->input->post("no_telepon"));
            $no_hp = strip_tags($this->input->post("no_hp"));
            $foto = null;
            $id_perusahaan = null;
            $status = 0;
            $captcha = $this->input->post("captcha");

            // upload foto
            $this->load->library("upload");
            $this->load->library("image_lib");
            $tmp_name = $_FILES["foto"]["tmp_name"] ?? false;
            if (!empty($tmp_name)) {
                $extension_expl = explode(".", $_FILES["foto"]["name"]);
                $extension = $extension_expl[count($extension_expl) - 1];
                $file_name = date("YmdHis");

                $upload_conf = [
                    "upload_path" => "./upload/profil/",
                    "allowed_types" => "gif|jpg|jpeg|png|pdf",
                    "max_size" => "30000",
                    "file_name" => $file_name . "." . $extension,
                ];
                $this->upload->initialize($upload_conf);

                if (!$this->upload->do_upload("foto")) {
                    $simpan = false;
                    $errMsg = $this->upload->display_errors("<li>", "</li>");
                } else {
                    $upload_data = $this->upload->data();
                    $size = getimagesize($upload_data["full_path"]);
                    $maxWidth = 306;
                    $maxHeight = 306;
                    if ($size[0] > $maxWidth || $size[1] > $maxHeight) {
                        $resize_real = [
                            "source_image" => $upload_data["full_path"],
                            "width" => 306,
                        ];
                        $this->image_lib->initialize($resize_real);
                        if (!$this->image_lib->resize()) {
                            $errMsg = $this->image_lib->display_errors(
                                "<li>",
                                "</li>"
                            );
                        } else {
                            $errMsg = $upload_data;
                        }
                    }
                    $foto = $upload_conf["file_name"];
                }
            }

            // upload ktp
            $ktp_tmp_name = $_FILES["foto_ktp"]["tmp_name"];
            if (empty($ktp_tmp_name)) {
                $simpan = false;
                $errMsg["foto_ktp"] = "upload KTP tidak boleh kosong.";
            } else {
                $extension_expl = explode(".", $_FILES["foto_ktp"]["name"]);
                $extension = $extension_expl[count($extension_expl) - 1];
                $ktp_file_name = date("YmdHis") . "_ktp." . $extension;

                $upload_ktp_conf = [
                    "upload_path" => "./upload/profil/foto_identitas/",
                    "allowed_types" => "gif|jpg|jpeg|png|pdf",
                    "max_size" => "3000", // 3MB
                    "file_name" => $ktp_file_name,
                ];
                $this->upload->initialize($upload_ktp_conf);

                if (!$this->upload->do_upload("foto_ktp")) {
                    $simpan = false;
                    $errMsg["foto_ktp"] = $this->upload->display_errors(
                        "<li>",
                        "</li>"
                    );
                } else {
                    $ktp_file_name = $upload_ktp_conf["file_name"];
                }
            }

            $data_insert = [];

            // cek username
            $c_username = $this->cek_username($username);
            $c_username = count($c_username);
            if ($c_username > 0) {
                $simpan = false;
                $this->session->set_flashdata(
                    "errMsg",
                    "Username sudah digunakan! Gunakan Username yang lain"
                );
            }

            // cek password
            if ($pwd != $pwd2) {
                $simpan = false;
                $this->session->set_flashdata(
                    "errMsg",
                    "Konfirmasi password tidak sama!"
                );
            }

            // cek captcha
            /*$current_captcha = $this->session->userdata('mycaptcha');
            $val_capt = $this->validasi_captcha($current_captcha);
            if($val_capt == false) {
                $simpan = false;
                $this->session->set_flashdata('errMsg', 'Captcha tidak sesuai!');

                $vals = array(
                    'word'          => random_word(5, false, true,true),
                    'img_path'      => './captcha/',
                    'img_url'       => base_url().'captcha/',
                    'font_path'     => './system/fonts/texb.ttf',
                    'img_width'     => 150,
                    'img_height'    => 33,
                    'expiration'    => 7200,
                    'word_length'   => 5,
                    'font_size'     => 16,
                    'colors'        => array(
                                        'background' => array(200, 200, 200),
                                        'border' => array(0, 0, 0),
                                        'text' => array(0, 0, 0),
                                        'grid' => array(255, 255, 20)
                                       )
                );
                $cap = create_captcha($vals);
                $data['captcha_image'] = $cap['image'];
                $this->session->set_userdata('mycaptcha', $cap['word']);
            }*/

            // cek captcha
            $current_captcha = $this->session->userdata("mycaptcha");
            $val_capt = $this->validasi_captcha($current_captcha);
            // var_dump($val_capt);exit();
            if ($val_capt == false) {
                $simpan = false;
                $this->session->set_flashdata(
                    "errMsg",
                    "Captcha tidak sesuai!"
                );

                $vals = [
                    "word" => random_word(5, false, true, true),
                    "img_path" => "./captcha/",
                    "img_url" => base_url() . "captcha/",
                    "font_path" => "./system/fonts/texb.ttf",
                    "img_width" => "150",
                    "img_height" => 33,
                    "expiration" => 7200,
                    "word_length" => 5,
                    "font_size" => 16,
                    "colors" => [
                        "background" => [200, 200, 200],
                        "border" => [0, 0, 0],
                        "text" => [0, 0, 0],
                        "grid" => [255, 255, 20],
                    ],
                ];
                $cap = create_captcha($vals);
                $data["captcha_image"] = $cap["image"];
                $this->session->set_userdata("mycaptcha", $cap["word"]);
            }

            if ($simpan) {
                $data_insert = [
                    "id_role" => $id_role,
                    "username" => $username,
                    "nama" => $nama,
                    "password" => $password,
                    "email" => $email,
                    "npwp" => $npwp,
                    "no_ktp" => $no_ktp,
                    "foto_ktp" => $ktp_file_name,
                    "tempat_lahir" => $tempat_lahir,
                    "tanggal_lahir" => $tanggal_lahir,
                    "jenis_kelamin" => $jenis_kelamin,
                    "pekerjaan" => $pekerjaan,
                    "id_pendidikan" => $id_pendidikan, // Script yang ditambahkan Rahmat, 10 Agustus 2020
                    "alamat" => $alamat,
                    "id_kelurahan" => $kelurahan,
                    "id_kecamatan" => $kecamatan,
                    "id_kabupaten" => $kabupaten,
                    "id_provinsi" => $provinsi,
                    "kode_pos" => $kode_pos,
                    "no_telepon" => $no_telepon,
                    "no_hp" => $no_hp,
                    "foto" => $foto,
                    "id_perusahaan" => $id_perusahaan,
                    "status" => $status,
                ];
                $insert = $this->app_model->insert_data($data_insert);

                if ($insert) {
                    $this->session->set_flashdata(
                        "sucMsg",
                        "Pendaftaran Berhasil! Cek email untuk verify akun"
                    );
                } else {
                    $this->session->set_flashdata(
                        "errMsg",
                        "Pendaftaran Gagal!"
                    );
                }
                // Send Email Verifikasi
                $kata = "verify";
                $hash_pass = sha1($kata);
                // Mengganti nama subjek. Perubahan oleh Nurhayati Rahayu (22/09/2021)
                $subject = "[PTSP BMKG]-Verifikasi Pendaftaran Akun";
                // Baris terakhir perubahan. Perubahan oleh Nurhayati Rahayu (22/09/2021)
                $data["nama"] = $nama;
                $data["hash"] = $username . "/" . $hash_pass;
                $message = "";
                // Mengaktifkan email header. Perubahan oleh Nurhayati Rahayu (22/09/2021)
                $message = $this->load->view("email/_header", "", true);
                // Baris terakhir perubahan. Perubahan oleh Nurhayati Rahayu (22/09/2021)
                $message .= $this->load->view(
                    "email/verifikasi_akun",
                    $data,
                    true
                );
                $message .= $this->load->view("email/_footer", "", true);
                send_email($email, $subject, $message);
                redirect(base_url() . "registrasi/registrasi_perorangan");
            }
        } else {
            // $this->session->set_userdata('mycaptcha', $cap['word']);
        }

        $data["errMsg"] = $errMsg;
        $this->template->add_css(
            "resources/plugins/datepicker/datepicker3.css"
        );
        $this->template->add_js(
            "resources/plugins/datepicker/bootstrap-datepicker.js"
        );

        $this->template->add_css("resources/plugins/select2/select2.min.css");
        $this->template->add_css(
            "resources/plugins/select2/select2-bootstrap.min.css"
        );
        $this->template->add_js(
            "resources/plugins/select2/placeholders.jquery.min.js"
        );
        $this->template->add_js("resources/plugins/select2/select2.min.js");
        $this->template->write("title", $data["title"]);
        $this->template->write_view(
            "content",
            "v_registrasi_perorangan",
            $data,
            true
        );
        $this->template->render();
    }

    public function registrasi_perusahaan()
    {
        $data["title"] = translate(44);
        $data["bahasa"] = $this->session->userdata("bahasa");
        $data["provinsi"] = $this->app_model->get_list_provinsi();
        $errMsg = [];

        $script = "";

        /*$vals = [
            'word'          => random_word(5, false, true, true),
            'img_path'      => './captcha/',
            'img_url'       => site_url('captcha'),
            'font_path'     => './system/fonts/texb.ttf',
            'img_width'     => 200,
            'img_height'    => 40,
            'expiration'    => 600,
            'word_length'   => 5,
            'font_size'     => 16,
            'colors'        => [
                'background'    => array(200, 200, 200),
                'border'        => array(0, 0, 0),
                'text'          => array(0, 0, 0),
                'grid'          => array(255, 255, 20)
            ]
        ];
        $cap = create_captcha($vals);
        $data['captcha_image'] = $cap['image'];*/

        $vals = [
            "word" => random_word(5, false, true, true),
            "img_path" => "./captcha/",
            "img_url" => base_url() . "captcha/",
            "font_path" => "./system/fonts/texb.ttf",
            "img_width" => "150",
            "img_height" => 33,
            "expiration" => 7200,
            "word_length" => 5,
            "font_size" => 16,
            "colors" => [
                "background" => [200, 200, 200],
                "border" => [0, 0, 0],
                "text" => [0, 0, 0],
                "grid" => [255, 255, 20],
            ],
        ];

        $recaptcha_v2 = false;
        if (isset($_SESSION["recaptcha_v2"])) {
            $recaptcha_v2 = $_SESSION["recaptcha_v2"];
        }
        $cap = create_captcha($vals);
        $err = $this->session->flashdata("login_message");

        // $data['captcha_image'] = $cap['image'];
        $data["err"] = $err;
        $data["recaptcha_v2"] = $recaptcha_v2;

        if ($_POST) {
            $data_post = $this->input->post();
            $data["detail"] = $data_post;
            $simpan = true;

            if (empty($data["detail"]["username"])) {
                $simpan = false;
                $errMsg["username"] = "Username tidak boleh kosong";
            }
            if (empty($data["detail"]["nama"])) {
                $simpan = false;
                $errMsg["nama"] = "Nama tidak boleh kosong";
            }
            if (empty($data["detail"]["password"])) {
                $simpan = false;
                $errMsg["password"] = "Password tidak boleh kosong";
            }
            if (empty($data["detail"]["password2"])) {
                $simpan = false;
                $errMsg["password"] = "Ulangi Password tidak boleh kosong";
            }
            if (empty($data["detail"]["email"])) {
                $simpan = false;
                $errMsg["email"] = "Email tidak boleh kosong";
            }
            if (empty($data["detail"]["no_ktp"])) {
                $simpan = false;
                $errMsg["no_ktp"] = "KTP tidak boleh kosong";
            }
            if (empty($data["detail"]["alamat"])) {
                $simpan = false;
                $errMsg["alamat"] = "Alamat tidak boleh kosong";
            }
            if (empty($data["detail"]["no_hp"])) {
                $simpan = false;
                $errMsg["no_hp"] = "No HP/ Telepon tidak boleh kosong";
            }
            if (empty($data["detail"]["pekerjaan"])) {
                $simpan = false;
                $errMsg["pekerjaan"] = "Pekerjaan tidak boleh kosong";
            }
            // Awal script yang ditambahkan Rahmat, 10 Agustus 2020
            if (empty($data["detail"]["id_pendidikan"])) {
                $simpan = false;
                $errMsg["id_pendidikan"] = "Pendidikan tidak boleh kosong";
            }
            // Akhir script yang ditambahkan rahmat, 10 Agustus 2020
            if (empty($data["detail"]["id_provinsi"])) {
                $simpan = false;
                $errMsg["id_provinsi"] = "Provinsi tidak boleh kosong";
            }
            if (empty($data["detail"]["id_kabkot"])) {
                $simpan = false;
                $errMsg["id_kabkot"] = "Kabupaten/Kota tidak boleh kosong";
            }
            $email = strip_tags($this->input->post("email"));
            // menonaktifkan fungsi FILTER_VALIDATE_EMAIL . Perubahan oleh Nurhayati Rahayu (24/08/2021)
            //if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //    $simpan = false;
            //    $errMsg['email'] = "Email tidak valid";
            //}
            //Baris terakhir perubahan oleh Nurhayati Rahayu (24/08/2021)

            // validasi perusahaan

            // Awal script yang diedit Rahmat, 9 Juni 2020
            // asalnya ($data['detail']['nama_perusahaan']) diganti ($data['detail']['perusahaan'])
            if (empty($data["detail"]["perusahaan"])) {
                $simpan = false;
                $errMsg["perusahaan"] = "Nama perusahaan tidak boleh kosong";
            }
            // Akhir script yang diedit Rahmat, 9 Juni 2020

            if (empty($data["detail"]["email_perusahaan"])) {
                $simpan = false;
                $errMsg["email_perusahaan"] =
                    "Email perusahaan tidak boleh kosong";
            }
            if (empty($data["detail"]["alamat_perusahaan"])) {
                $simpan = false;
                $errMsg["alamat_perusahaan"] =
                    "Alamat perusahaan tidak boleh kosong";
            }
            if (empty($data["detail"]["provinsi_perusahaan"])) {
                $simpan = false;
                $errMsg["provinsi_perusahaan"] = "Provinsi tidak boleh kosong";
            }
            if (empty($data["detail"]["kabupaten_perusahaan"])) {
                $simpan = false;
                $errMsg["kabupaten_perusahaan"] =
                    "Kabupaten/Kota tidak boleh kosong";
            }
            $email_perusahaan = strip_tags(
                $this->input->post("email_perusahaan")
            );
            // menonaktifkan fungsi FILTER_VALIDATE_EMAIL . Perubahan oleh Nurhayati Rahayu (24/08/2021)
            //if (!filter_var($email_perusahaan, FILTER_VALIDATE_EMAIL)) {
            //    $simpan = false;
            //    $errMsg['email_perusahaan'] = "Email tidak valid";
            //}
            // Baris terakhir perubahan oleh Nurhayati Rahayu (24/08/2021)

            // NPWP
            $npwp = strip_tags($this->input->post("npwp"));

            // tbl_admin
            $id_role = 7;
            $username = strip_tags($this->input->post("username"));
            $nama = strip_tags($this->input->post("nama"));
            $pwd = strip_tags($this->input->post("password"));
            $pwd2 = strip_tags($this->input->post("password2"));
            $password = strrev(md5($pwd));
            $email = $email;
            $no_ktp = strip_tags($this->input->post("no_ktp"));
            $tempat_lahir = strip_tags($this->input->post("tempat_lahir"));
            $tanggal_lahir = strip_tags($this->input->post("tanggal_lahir"));
            $bln = substr($tanggal_lahir, 0, 2);
            $tgl = substr($tanggal_lahir, 3, 2);
            $tahun = substr($tanggal_lahir, 6, 4);
            $tanggal_lahir = $tahun . "-" . $bln . "-" . $tgl;
            $jenis_kelamin = strip_tags($this->input->post("jenis_kelamin"));
            $pekerjaan = strip_tags($this->input->post("pekerjaan"));
            $id_pendidikan = strip_tags($this->input->post("id_pendidikan")); // Script yang ditambahkan Rahmat, 10 Agustus 2020
            $alamat = strip_tags($this->input->post("alamat"));
            $kelurahan = strip_tags($this->input->post("id_kelurahan"));
            $kecamatan = strip_tags($this->input->post("id_kecamatan"));
            $kabupaten = strip_tags($this->input->post("id_kabkot"));
            $provinsi = strip_tags($this->input->post("id_provinsi"));
            $kode_pos = strip_tags($this->input->post("kode_pos"));
            $no_telepon = strip_tags($this->input->post("no_telepon"));
            $no_hp = strip_tags($this->input->post("no_hp"));
            $status = 0;

            // tbl_perusahaan
            // Awal script yang diedit Rahmat, 9 Juni 2020
            // asalnya $nama_perusahaan diganti $perusahaan
            // asalnya post('nama_perusahaan) diganti post(perusahaan)
            $perusahaan = strip_tags($this->input->post("perusahaan"));
            $alamat_perusahaan = strip_tags(
                $this->input->post("alamat_perusahaan")
            );
            $kelurahan_perusahaan = strip_tags(
                $this->input->post("kelurahan_perusahaan")
            );
            $kecamatan_perusahaan = strip_tags(
                $this->input->post("kecamatan_perusahaan")
            );
            $kabupaten_perusahaan = strip_tags(
                $this->input->post("kabupaten_perusahaan")
            );
            $provinsi_perusahaan = strip_tags(
                $this->input->post("provinsi_perusahaan")
            );
            $kode_pos_perusahaan = strip_tags(
                $this->input->post("kode_pos_perusahaan")
            );
            $no_telepon_perusahaan = strip_tags(
                $this->input->post("no_telepon_perusahaan")
            );
            $fax = strip_tags($this->input->post("fax"));
            $email_perusahaan = $email_perusahaan;
            // Akhir script yang diedit Rahmat, 9 Juni 2020

            // upload foto
            $this->load->library("upload");
            $this->load->library("image_lib");
            $tmp_name = $_FILES["foto"]["tmp_name"];
            if (!empty($tmp_name)) {
                $extension_expl = explode(".", $_FILES["foto"]["name"]);
                $extension = $extension_expl[count($extension_expl) - 1];
                $file_name = date("YmdHis");

                $upload_conf = [
                    "upload_path" => "./upload/profil/",
                    "allowed_types" => "gif|jpg|jpeg|png|pdf",
                    "max_size" => "30000",
                    "file_name" => $file_name . "." . $extension,
                ];
                $this->upload->initialize($upload_conf);

                if (!$this->upload->do_upload("foto")) {
                    $simpan = false;
                    $errMsg = $this->upload->display_errors("<li>", "</li>");
                } else {
                    $upload_data = $this->upload->data();
                    $size = getimagesize($upload_data["full_path"]);
                    $maxWidth = 306;
                    $maxHeight = 306;
                    if ($size[0] > $maxWidth || $size[1] > $maxHeight) {
                        $resize_real = [
                            "source_image" => $upload_data["full_path"],
                            "width" => 306,
                        ];
                        $this->image_lib->initialize($resize_real);
                        if (!$this->image_lib->resize()) {
                            $errMsg = $this->image_lib->display_errors(
                                "<li>",
                                "</li>"
                            );
                        } else {
                            $errMsg = $upload_data;
                        }
                    }
                    $foto = $upload_conf["file_name"];
                }
            }

            // upload ktp
            $ktp_tmp_name = $_FILES["foto_ktp"]["tmp_name"];
            if (empty($ktp_tmp_name)) {
                $simpan = false;
                $errMsg["foto_ktp"] = "upload KTP tidak boleh kosong.";
            } else {
                $extension_expl = explode(".", $_FILES["foto_ktp"]["name"]);
                $extension = $extension_expl[count($extension_expl) - 1];
                $ktp_file_name = date("YmdHis") . "_ktp." . $extension;

                $upload_ktp_conf = [
                    "upload_path" => "./upload/profil/foto_identitas/",
                    "allowed_types" => "gif|jpg|jpeg|png|pdf",
                    "max_size" => "3000", // 3MB
                    "file_name" => $ktp_file_name,
                ];
                $this->upload->initialize($upload_ktp_conf);

                if (!$this->upload->do_upload("foto_ktp")) {
                    $simpan = false;
                    $errMsg["foto_ktp"] = $this->upload->display_errors(
                        "<li>",
                        "</li>"
                    );
                } else {
                    $ktp_file_name = $upload_ktp_conf["file_name"];
                }
            }

            $data_insert = [];

            // cek username
            $c_username = $this->cek_username($username);
            $c_username = count($c_username);
            if ($c_username > 0) {
                $simpan = false;
                $this->session->set_flashdata(
                    "errMsg",
                    "Username sudah digunakan! Gunakan Username yang lain"
                );
            }

            // cek password
            if ($pwd != $pwd2) {
                $simpan = false;
                $this->session->set_flashdata(
                    "errMsg",
                    "Konfirmasi password tidak sama!"
                );
            }

            // cek captcha
            /*$current_captcha = $this->session->userdata('mycaptcha');
            $val_capt = $this->validasi_captcha($current_captcha);
            if($val_capt == false) {
                $simpan = false;
                $this->session->set_flashdata('errMsg', 'Captcha tidak sesuai!');

                $vals = array(
                    'word'          => random_word(5, false, true,true),
                    'img_path'      => './captcha/',
                    'img_url'       => base_url().'captcha/',
                    'font_path'     => './system/fonts/texb.ttf',
                    'img_width'     => '150',
                    'img_height'    => 33,
                    'expiration'    => 7200,
                    'word_length'   => 5,
                    'font_size'     => 16,
                    'colors'        => array(
                                        'background' => array(200, 200, 200),
                                        'border' => array(0, 0, 0),
                                        'text' => array(0, 0, 0),
                                        'grid' => array(255, 255, 20)
                                       )
                );
                $cap = create_captcha($vals);
                $data['captcha_image'] = $cap['image'];
                $this->session->set_userdata('mycaptcha', $cap['word']);
            }*/

            // cek captcha
            $current_captcha = $this->session->userdata("mycaptcha");
            $val_capt = $this->validasi_captcha($current_captcha);
            // var_dump($val_capt);exit();
            if ($val_capt == false) {
                $simpan = false;
                $this->session->set_flashdata(
                    "errMsg",
                    "Captcha tidak sesuai!"
                );

                $vals = [
                    "word" => random_word(5, false, true, true),
                    "img_path" => "./captcha/",
                    "img_url" => base_url() . "captcha/",
                    "font_path" => "./system/fonts/texb.ttf",
                    "img_width" => "150",
                    "img_height" => 33,
                    "expiration" => 7200,
                    "word_length" => 5,
                    "font_size" => 16,
                    "colors" => [
                        "background" => [200, 200, 200],
                        "border" => [0, 0, 0],
                        "text" => [0, 0, 0],
                        "grid" => [255, 255, 20],
                    ],
                ];
                $cap = create_captcha($vals);
                $data["captcha_image"] = $cap["image"];
                $this->session->set_userdata("mycaptcha", $cap["word"]);
            }

            if ($simpan) {
                // insert tbl_perusahaan
                // Awal script yang diedit Rahmat, 9 Juni 2020
                // asalnya 'nama' diganti 'perusahaan'
                // asalnya '$nama_perusahaan' diganti '$perusahaan'
                $data_insert = [
                    "perusahaan" => $perusahaan,
                    "alamat" => $alamat_perusahaan,
                    "id_kelurahan" => $kelurahan_perusahaan,
                    "id_kecamatan" => $kecamatan_perusahaan,
                    "id_kabupaten" => $kabupaten_perusahaan,
                    "id_provinsi" => $provinsi_perusahaan,
                    "kode_pos" => $kode_pos_perusahaan,
                    "no_telepon" => $no_telepon_perusahaan,
                    "fax" => $fax,
                    "email" => $email_perusahaan,
                ];
                // Akhir script yang diedit Rahmat, 9 Juni 2020

                $insert_perusahaan = $this->app_model->insert_data_perusahaan(
                    $data_insert
                );

                $id_perusahaan = $insert_perusahaan;

                // insert tbl_admin
                $data_insert = [
                    "id_role" => $id_role,
                    "username" => $username,
                    "nama" => $nama,
                    "password" => $password,
                    "email" => $email,
                    "npwp" => $npwp,
                    "no_ktp" => $no_ktp,
                    "foto_ktp" => $ktp_file_name,
                    "tempat_lahir" => $tempat_lahir,
                    "tanggal_lahir" => $tanggal_lahir,
                    "jenis_kelamin" => $jenis_kelamin,
                    "pekerjaan" => $pekerjaan,
                    "id_pendidikan" => $id_pendidikan, // Script yang ditambahkan Rahmat, 10 Agustus 2020
                    "alamat" => $alamat,
                    "id_kelurahan" => $kelurahan,
                    "id_kecamatan" => $kecamatan,
                    "id_kabupaten" => $kabupaten,
                    "id_provinsi" => $provinsi,
                    "kode_pos" => $kode_pos,
                    "no_telepon" => $no_telepon,
                    "no_hp" => $no_hp,
                    "foto" => $foto,
                    "id_perusahaan" => $id_perusahaan,
                    "status" => $status,
                ];
                $insert_admin = $this->app_model->insert_data($data_insert);

                if ($insert_admin && $insert_perusahaan) {
                    $this->session->set_flashdata(
                        "sucMsg",
                        "Pendaftaran Berhasil! Cek email untuk verify akun"
                    );
                } else {
                    $this->session->set_flashdata(
                        "errMsg",
                        "Pendaftaran Gagal!"
                    );
                }
                $kata = "verify";
                $hash_pass = sha1($kata);
                // Mengganti nama subjek. Perubahan oleh Nurhayati Rahayu (22/09/2021)
                $subject = "[PTSP BMKG]-Verifikasi Pendaftaran Akun";
                // Baris terakhir perubahan. Perubahan oleh Nurhayati Rahayu (22/09/2021)
                $data["nama"] = $nama;
                $data["hash"] = $username . "/" . $hash_pass;
                $message = "";
                // Mengaktifkan email header. Perubahan oleh Nurhayati Rahayu (22/09/2021)
                $message = $this->load->view("email/_header", "", true);
                // Baris terakhir perubahan. Perubahan oleh Nurhayati Rahayu (22/09/2021)
                $message .= $this->load->view(
                    "email/verifikasi_akun",
                    $data,
                    true
                );
                $message .= $this->load->view("email/_footer", "", true);
                send_email($email, $subject, $message);
                redirect(base_url() . "registrasi/registrasi_perusahaan");
            }
        } else {
            // $this->session->set_userdata('mycaptcha', $cap['word']);
        }

        $data["errMsg"] = $errMsg;
        $this->template->add_css(
            "resources/plugins/datepicker/datepicker3.css"
        );
        $this->template->add_css("resources/plugins/select2/select2.min.css");
        $this->template->add_css(
            "resources/plugins/select2/select2-bootstrap.min.css"
        );

        $this->template->add_js(
            "resources/plugins/datepicker/bootstrap-datepicker.js"
        );
        $this->template->add_js("resources/plugins/select2/select2.min.js");
        $this->template->add_js(
            "resources/plugins/select2/placeholders.jquery.min.js"
        );
        $this->template->add_js($script, "embed");

        $this->template->write("title", $data["title"]);
        $this->template->write_view(
            "content",
            "v_registrasi_perusahaan",
            $data,
            true
        );
        $this->template->render();
    }

    public function validasi_captcha($current_captcha)
    {
        // $captcha  = $this->input->post('captcha');

        // if($captcha != $current_captcha) {
        //     return false;
        // }
        // else{
        //     return true;
        // }
        if (!$this->cek_recaptcha()) {
            $msg = "Verifikasi Recaptcha gagal";
            $_SESSION["recaptcha_v2"] = true;
            $this->session->set_flashdata("login_message", $msg);
            return false;
            redirect(base_url() . "saran");
            die();
        } else {
            return true;
        }
    }

    public function cek_username($username)
    {
        $this->db->from("tbl_admin");
        $this->db->where("username", $username);
        $query = $this->db->get();
        if (is_object($query)) {
            $result = $query->result_array();
            return $result;
        }
        return [];
    }

    public function cek_recaptcha()
    {
        if (isset($_SESSION["recaptcha_v2"])) {
            $recaptcha_v2 = $_SESSION["recaptcha_v2"];
            if ($recaptcha_v2) {
                return $this->cek_recapthca_v2();
            }
        }

        $token = $this->input->post("g-recaptcha-response");

        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            "secret" => "6Ldg38IpAAAAAAG6dQrc1j8IdW19a_y_yz5zDCHN",
            "response" => $token,
        ];

        $options = [
            "http" => [
                "method" => "POST",
                "header" =>
                    "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " .
                    strlen(http_build_query($data)) .
                    "\r\n" .
                    "User-Agent:MyAgent/1.0\r\n",
                "content" => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $result = json_decode($response);

        // dd($result);
        // die();

        // if($result) log_message('error', $result->score);

        if (!$result->success || $result->score < 0.9) {
            return false;
        }

        return true;
    }
    public function cek_recapthca_v2()
    {
        $captcha_response = $this->input->post("g-recaptcha-response");
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            "secret" => "6Lc2RcopAAAAAHjC5Cau6t3MABZa8oR_iDqlD1Fx",
            "response" => $captcha_response,
        ];

        $options = [
            "http" => [
                "header" =>
                    "Content-Type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $result = json_decode($response);

        if (!$result->success) {
            echo "reCAPTCHA verification failed";
            return false;
        } else {
            return true;
        }
    }
}
