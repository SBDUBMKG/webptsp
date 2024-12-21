<?php
//file: application\controllers\backend\Login.php
defined("BASEPATH") or exit("No direct script access allowed");

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(["login_model", "global_model"]);
        $this->load->helper(["form", "url", "captcha"]);
        $this->load->library(["session", "form_validation"]);
    }

    public function index()
    {
        $username = $this->session->userdata("username");
        $id_role = $this->session->userdata("id_role");
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

        $data = [
            // "captcha_image" => $cap["image"],
            "err" => $err,
        ];
        $data["recaptcha_v2"] = $recaptcha_v2;

        if (!empty($username) && !empty($id_role)) {
            redirect(site_url("backend/home"));
            die();
        }

        if ($_POST) {
            // $current_captcha = $this->session->userdata("mycaptcha");
            $this->validation();
        } else {
            // $this->session->set_userdata("mycaptcha", $cap["word"]);
            $this->load->view("login_view", $data);
        }
    }

    private function validation()
    {
        $username = $this->input->post("txt_username");
        $password = $this->input->post("txt_password");
        // $captcha = $this->input->post("txt_captcha");

        $this->form_validation->set_rules(
            "txt_username",
            "username",
            "required"
        );
        $this->form_validation->set_rules(
            "txt_password",
            "password",
            "required"
        );

        $result = $this->login_model->validation($username, $password);
        if ($result === false) {
            $msg = "Username atau Password tidak valid";
            $this->session->set_flashdata("login_message", $msg);
            redirect(base_url() . "login");
            die();
        } elseif (!$this->cek_recaptcha()) {
            $msg = "Verifikasi Recaptcha gagal";
            $_SESSION["recaptcha_v2"] = true;
            $this->session->set_flashdata("login_message", $msg);
            redirect(base_url() . "login");
            die();
        } elseif ($result->status == 0) {
            $msg = "Akun anda tidak aktif";
            $this->session->set_flashdata("login_message", $msg);
            redirect(base_url() . "login");
            die();
        } else {
            if ($result) {
                $this->session->set_userdata("id_admin", $result->id_admin);
                $this->session->set_userdata("username", $result->username);
                $this->session->set_userdata("nama", $result->nama);
                $this->session->set_userdata("id_role", $result->id_role);
                $this->session->set_userdata("role", $result->role);
                $this->session->set_userdata("no_ktp", $result->no_ktp);
                $this->session->set_userdata("foto_ktp", $result->foto_ktp);
                $this->session->set_userdata("language", "indonesia");
                $this->session->set_userdata(
                    "id_perusahaan",
                    $result->id_perusahaan
                );
                $this->session->set_userdata(
                    "is_super_admin",
                    $result->is_super_admin
                );
                $this->session->set_userdata("email", $result->email);
                $last_page = $this->session->userdata("last_page");

                if (!empty($last_page)) {
                    $this->session->unset_userdata("last_page");
                    redirect($last_page);
                    die();
                }
                redirect(site_url("backend/home"));
                die();
            } else {
                $msg = "Username atau Password tidak valid";
                $this->session->set_flashdata("login_message", $msg);
                redirect(site_url("login"));
                die();
            }
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
        die();
    }
    public function cek_recaptcha()
    {
        if (isset($_SESSION["recaptcha_v2"])) {
            $recaptcha_v2 = $_SESSION["recaptcha_v2"];
            if ($recaptcha_v2) {
                return $this->cek_recapthca_v2();
            }
        }

        // Retrieve the reCAPTCHA token from the form data
        $token = $this->input->post("g-recaptcha-response");

        // Send a POST request to Google's reCAPTCHA verification endpoint
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            "secret" => "6Ldg38IpAAAAAAG6dQrc1j8IdW19a_y_yz5zDCHN",
            "response" => $token,
        ];

        $options = [
            "http" => [
                "header" =>
                    "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "User-Agent:MyAgent/1.0\r\n",
                "method" => "POST",
                "content" => http_build_query($data),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $result = json_decode($response);

        if (isset($result->score)) {
            log_message("error", $result->score);
        }
        //var_dump($result);
        //die();

        if (!$result->success || $result->score < 0.9) {
            // reCAPTCHA verification failed
            // Display an error message or handle the failure as needed
            //echo "reCAPTCHA verification failed";
            return false;
        } else {
            return true;
        }

        // reCAPTCHA verification successful, proceed with form submission
        // Your further processing logic
    }
    public function cek_recapthca_v2()
    {
        // Your form processing logic

        // Validate reCAPTCHA
        //log_message('error', $captcha_response);

        $captcha_response = $this->input->post("g-recaptcha-response");
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            "secret" => "6Lc2RcopAAAAAHjC5Cau6t3MABZa8oR_iDqlD1Fx",
            "response" => $captcha_response,
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

        if (!$result->success) {
            // reCAPTCHA verification failed
            // Display an error message or handle the failure as needed
            echo "reCAPTCHA verification failed";
            return false;
        } else {
            return true;
        }

        // reCAPTCHA verification successful, proceed with form submission
        // Your further processing logic
    }
}
