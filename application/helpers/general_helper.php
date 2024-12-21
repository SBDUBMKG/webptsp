<?php


function get_data_web($name = '') {
    $output = '';
    $CI = &get_instance();
    $CI->db->select('value')
           ->from('setting_web')
           ->where('LOWER(variable_name)', strtolower($name));
    $query = $CI->db->get();
    if ( is_object($query) ) {
        $data = $query->row();
        if ( is_object($data) )
            $output = $data->value;
    }
    return $output;
}

function translate($key = '',$nama_translate = false) {
    $output = '';
    $CI = &get_instance();
    $lang = $CI->session->userdata('bahasa');
    switch($lang) {
        default:
            $bahasa = 'translate';
            break;
        case '_en':
            $bahasa = 'translate_en';
            break;
    }

    $CI->db->select($bahasa)
        ->from('tbl_translate');
    if($nama_translate){
        $CI->db->where('nama', $key);
    } else {
        $CI->db->where('id', strtolower($key));
    }
    $query = $CI->db->get();
    if ( is_object($query) ) {
        $data = $query->row();
        if ( is_object($data) )
            $output = $data->$bahasa;
    }
    return $output;
}
function word_shorter($text = '', $length = 100) {
    $new_string = '';
    if ( !empty($text) ) {
        $new_string = substr(strip_tags($text), 0, $length);
        if ( strlen($text) > $length ) {
            $new_string .= ' ...';
        }
    }
    return $new_string;
}

function url_menu($uri = '') {

    // jika, url ada https return https jika tidak return menggunakan base_url
    if ( substr($uri, 0, 8) == 'https://' || substr($uri, 0, 7) == 'http://' ) {
        $uri = $uri;
    }else{
        $uri = base_url() . $uri;
    }
    return $uri;
}

function set_target_http($uri = '') {
    $result = "";
    if ( substr($uri, 0, 8) == 'https://' || substr($uri, 0, 7) == 'http://' ) {
        $result = "target='_blank'";
    }
    return $result;
}

function set_seo($text = "") {
    $text = str_replace('-', ' ', $text);
    $text = preg_replace("/[[:blank:]]+/"," ",$text);
    $result = str_replace('--','-',str_replace(' ','-', preg_replace('/[^a-zA-Z0-9\s]/', '-', strtolower(trim($text)))));
    if ( $result[strlen($result)-1] == '-' ) {
        $result = substr($result, 0, strlen($result)-1);
    }
    return $result;
}
function describe_seo($text = "") {
    $output = str_replace('-',' ',str_replace('_',' ',$text));
    return $output;
}
function convert_field_to_string($field = '') {
    $label = $field;
    if ( !empty($field) ) {
        $label = str_replace('_',' ',$label);
        $label = ucwords($label);
    }
    return $label;
}
function clear_text($text = '') {
    $val = strip_tags($text, '<blockquote><a><table><span><ul><ol><b><i><h1><h2><h3><h4><h5><div><hr>');
    return $val;
}
function get_field_data($table_name = '', $where = '') {
    $CI = &get_instance();
    $sql = "SELECT COLUMN_NAME AS name,
            DATA_TYPE AS type,
            CHARACTER_MAXIMUM_LENGTH AS max_length,
            CASE WHEN UPPER(IS_NULLABLE) = 'NO' THEN 0 ELSE 1 END is_null,
            CASE WHEN UPPER(COLUMN_KEY) = 'PRI' THEN 1 ELSE 0 END primary_key,
            COLUMN_COMMENT AS label
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = '".$CI->db->database."'
            AND TABLE_NAME= '".$table_name."'".$where;
    $query = $CI->db->query($sql);
    if ( is_object($query) ) {
        $data = $query->result();
        return $data;
    }
    return false;
}
function format_datetime($datetime = '') {
    $result = '';
    if ( !empty($datetime) ) {
        $expl_space     = explode(' ', $datetime);
        $tanggal        = $expl_space[0];
        $expl_tanggal   = explode('-', $tanggal);
        if ( count($expl_tanggal) > 2 ) {
            $result = $expl_tanggal[2] . ' ' . get_nama_bulan($expl_tanggal[1]) . ' ' . $expl_tanggal[0];
        }
    }

    return $result;
}
function short_datetime($datetime = '') {
    $result = '';
    if ( !empty($datetime) ) {
        $expl_space     = explode(' ', $datetime);
        $tanggal        = $expl_space[0];
        $expl_tanggal   = explode('-', $tanggal);
        if ( count($expl_tanggal) > 2 ) {
            $result = $expl_tanggal[2] . ' ' . get_nm_bulan($expl_tanggal[1]) . ' ' . $expl_tanggal[0];
        }
    }

    return $result;
}
function get_nm_bulan($kode_bulan = '') {
    $kode_bulan = (int)$kode_bulan;
    $result     = '';

    switch($kode_bulan) {
        default: $result = 'Jan'; break;case 2: $result = 'Feb'; break;
        case 3: $result = 'Mar'; break;case 4: $result = 'Apr'; break;
        case 5: $result = 'Mei'; break;case 6: $result = 'Jun'; break;
        case 7: $result = 'Jul'; break;case 8: $result = 'Ags'; break;
        case 9: $result = 'Sep'; break;case 10: $result = 'Okt'; break;
        case 11: $result = 'Nov'; break;case 12: $result = 'Des'; break;
    }
    return $result;
}
function get_nama_bulan($kode_bulan = '') {
    $kode_bulan = (int)$kode_bulan;
    $result     = '';

    switch($kode_bulan) {
        default: $result = 'Januari'; break;case 2: $result = 'Februari'; break;
        case 3: $result = 'Maret'; break;case 4: $result = 'April'; break;
        case 5: $result = 'Mei'; break;case 6: $result = 'Juni'; break;
        case 7: $result = 'Juli'; break;case 8: $result = 'Agustus'; break;
        case 9: $result = 'September'; break;case 10: $result = 'Oktober'; break;
        case 11: $result = 'November'; break;case 12: $result = 'Desember'; break;
    }
    return $result;
}
function GetBetween($var1="",$var2="",$pool){
    if ( !empty($var1) )
        $temp1 = strpos($pool,$var1)+strlen($var1);
    else
        $temp1 = 0;
    $result = substr($pool,$temp1,strlen($pool));

    $dd = 0;
    if ( !empty($var2) )
        $dd=strpos($result,$var2);
    if($dd == 0){
        $dd = strlen($result);
    }

    return substr($result,0,$dd);
}
function random_word($length = 5, $is_upper = false, $is_lower = true, $is_number=false) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if($is_number){
     $chars = "0123456789";
    } else {

    if ( $is_upper )
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if ( $is_lower )
        $chars = "abcdefghijklmnopqrstuvwxyz";
    }
    $i = 0;
    $string = "";
    while ($i < $length) {
        $string .= $chars[mt_rand(0,strlen($chars)-1)];
        $i++;
    }
    return $string;
}
function get_list_kategori_menu($is_backend) {
    $CI = &get_instance();
    $CI->db->from('tbl_kategori_menu')->where('is_backend', $is_backend);
    $query = $CI->db->get();
    if ( is_object($query) ) {
        return $query->result();
    }
    return array();
}

function get_list_menu($id_kategori_menu = 0,$is_backend) {
    $CI = &get_instance();
    $id_role = $CI->session->userdata('id_role');
    $is_super_admin = $CI->session->userdata('is_super_admin');
    $where = "1=1 AND is_backend = ".$is_backend;
    if ( empty($id_kategori_menu) )
        $where .= " AND id_kategori_menu IS NULL";
    else
        $where .= " AND id_kategori_menu = ".$id_kategori_menu;
    if ( $is_super_admin == 1 ) {
        $CI->db->select('A.*')
            ->from('tbl_menu A')
            ->where($where)
            ->order_by('urutan');
    } else {

        $where .= " AND B.is_read = 1";
        $CI->db->select('A.*')
            ->from('tbl_menu A')
            ->join('tbl_hak_akses B', 'A.id_menu = B.id_menu AND B.id_role = '.$id_role)
            ->where($where)
            ->order_by('urutan');
    }
    $query = $CI->db->get();
    if ( is_object($query) ) {
        return $query->result();
    }
    return array();
}
function show_hide_banner($session){
    $CI = &get_instance();
    $sql="SELECT * FROM  tbl_user_online WHERE session_id ='$session'";
    //echo $sql;
    $query = $CI->db->query($sql);
    $count = $query->num_rows();
    return $count;
}
function setting_content($val = ''){
    $CI = &get_instance();
    $CI->db->select('value')
        ->from('tbl_setting_content')
        ->where('id_setting', $val);
    $query = $CI->db->get();
    if ( is_object($query) ) {
        $data = $query->row();
        if ( is_object($data) )
            $output = $data->value;
    }
    return $output;
}
function check_counter(){
    $CI = &get_instance();
    $sql = "SELECT value_task as jml FROM tbl_user_online WHERE variable_task = 'counter_website' LIMIT 1";
    $query = $CI->db->query($sql);
    if(is_object($query)){
        if(is_object($query->row())){
            return $query->row()->jml;
        }
    }
    return false;
}
function update_counter(){
    $CI = &get_instance();
    $sql = "UPDATE tbl_user_online SET value_task = value_task+1 WHERE variable_task = 'counter_website'";
    $query = $CI->db->query($sql);
    if(is_object($query)){
        if(is_object($query->row()))
        return $query->row_array();
    }
    return false;
}
function get_list_menu_frontend($id_kategori_menu = NULL) {
    $CI = &get_instance();
    $CI->load->model('global_model');

    $where = "1=1";
    if ( empty($id_kategori_menu) )
        $where .= " AND id_kategori_menu IS NULL";
    else
        $where .= " AND id_kategori_menu = ".$id_kategori_menu;

    $CI->db->select('A.*')
        ->from('tbl_menu_frontend A')
        ->where($where)
        ->where('tampilkan_menu', 1)
        ->order_by('urutan');
    $query = $CI->db->get();
    if ( is_object($query) ) {
        $result = $query->result();
        return $result;
    }
    return array();
}
function generate_kategori_menu($id_parent = 0, $level = 1) {
    $CI = &get_instance();
    // $controller = $CI->router->fetch_class();
    $controller = $_SERVER['REQUEST_URI'];
    // var_dump($controller);
    $suffix = '';
    $active_bahasa = $CI->session->userdata('bahasa');
    if ( $active_bahasa == '_en' )
        $suffix = $active_bahasa;
    $column_category = 'kategori_menu'.$suffix;
    $column_menu = 'menu'.$suffix;
    if ( $level <= 2 ) {
        if ( empty($id_parent) ){
            $CI->db->where('id_parent IS NULL and is_show=1');
        } else {
            $CI->db->where('id_parent', $id_parent);
        }

        $CI->db->order_by('urutan');
        $query = $CI->db->get('tbl_kategori_menu_frontend');
        if ( is_object($query) ) {
            $result = $query->result();
            $string_menu = NULL;
            foreach ($result as $res) {
                $cat_active = '';
                $list_menu = get_list_menu_frontend($res->id_kategori_menu);
                $sub_kategori_menu = generate_kategori_menu($res->id_kategori_menu, ($level+1));
                $cat_icon = '<i class="fa fa-arrow"></i>';
                if ( count($list_menu) > 0 || !empty($res->uri)) {

                    $temp_string_menu = NULL;
                    $temp_string_menu .= '<ul style="text-align:left" class="sub">';

                    $have_active = false;
                    foreach ($list_menu as $menu) {
                        $class_active = NULL;
                        if ( '/'.$menu->uri == $controller ) {
                            $class_active = ' class="active"';
                            $have_active = true;
                        }
                        $icon = '<i class="fa fa-th-list"></i>';
                        if($menu->link_file != 0){
                            $temp_string_menu .= '<li'.$class_active.'><a style="color:#FFFFFF" href="'.base_url().'show/show_pdf?link_file='.$menu->link_file.'">'.$menu->$column_menu.'</a></li>';
                        }
                        elseif($menu->rte != 0){
                            $temp_string_menu .= '<li'.$class_active.'><a style="color:#FFFFFF" href="'.base_url().'show/show_halaman?halaman='.$menu->rte.'">'.$menu->$column_menu.'</a></li>';
                        }
                        else{
                            $temp_string_menu .= '<li'.$class_active.'><a style="color:#FFFFFF" href="'.base_url().$menu->uri.'">'.$menu->$column_menu.'</a></li>';
                        }
                    }
                    $class_active_cat = $have_active || preg_match('/class\=\"active\"/', $sub_kategori_menu) ? ' class="active"' : NULL;
                    $string_menu .= '<li'.$class_active_cat.'>';
                    if(!empty($res->uri)){
                        $string_menu .= '<a href="'.base_url().$res->uri.'">'.$cat_icon.' '.strtoupper($res->$column_category).'</span></a>';
                    }else{
                        $string_menu .= '<a href="#">'.$cat_icon.' '.strtoupper($res->$column_category).' <span class="fa fa-arrow"></span></a>';
                    }
                    $string_menu .= $temp_string_menu;
                    $string_menu .= $sub_kategori_menu;
                    $string_menu .= '</ul>';
                    $string_menu .= '</li>';
                }
                else if ( !empty($sub_kategori_menu) ) {
                    $temp_string_menu = NULL;
                    $temp_string_menu .= '<ul class="clear" style="color: #fff000">';
                    $temp_string_menu .= $sub_kategori_menu;
                    $class_active_cat = preg_match('/class\=\"active\"/', $sub_kategori_menu) ? ' class="active"' : NULL;
                    $string_menu .= '<li'.$class_active_cat.'>';
                    $string_menu .= '<a href="#">'.$cat_icon.' '.strtoupper($res->$column_category).' <span class="fa fa-arrow"></span></a>';
                    $string_menu .= $temp_string_menu;
                    $string_menu .= '</ul>';
                    $string_menu .= '</li>';
                }
            }
            return $string_menu;
        }
    }
    return NULL;
}
// adnan
function generate_menu() {
    $CI = &get_instance();
    $suffix = '';
    $active_bahasa = $CI->session->userdata('bahasa');
    if ( $active_bahasa == '_en' )
        $suffix = $active_bahasa;
    $column_menu = 'menu'.$suffix;
    $list_menu = get_list_menu_frontend();
    $controller = $CI->router->fetch_class();
    $string_menu = '<ul class="clear" style="color: black">';

    $home_active = $controller == 'home' ? 'class="active"' : NULL;
    $text_home = $active_bahasa == '_en' ? 'HOME' : 'BERANDA';
    $string_menu .= '<li '.$home_active.' style="padding:0.5%">
                    <a href="'.base_url().'">'.$text_home.'</a>
                </li>';

    foreach ($list_menu as $menu) {
        $class_active = $controller == $menu->cname ? ' class="active"' : NULL;
        $icon = '<i class="fa fa-th-list"></i>';
        $string_menu .= '<li'.$class_active.' style="padding:0.5%">';
        $string_menu .= '<a href="'.base_url().$menu->uri.'">'.$menu->$column_menu.'</a>';
        $string_menu .= '</li>';
    }
    $string_menu .=  generate_kategori_menu();
    $id_role = $CI->session->userdata('id_role');
    if(!empty($id_role)){
        if($id_role == 7){
            if($active_bahasa == '_en'){
                $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'login/logout"> | <i class="fa fa-sign-in"></i> LOGOUT</span></a></li>';
                $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'backend"><i class="fa fa-user"></i> Welcome '.$CI->session->userdata('nama').'</span></a></li>';
            }
            else{
                $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'login/logout"> | <i class="fa fa-sign-out"></i> LOGOUT</span></a></li>';
                $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'backend"><i class="fa fa-user"></i> Selamat datang '.$CI->session->userdata('nama').'</span></a></li>';
            }
        }else{
            if($active_bahasa == '_en'){
                $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'backend/login/logout"> | <i class="fa fa-sign-in"></i> LOGOUT</span></a></li>';
                $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'backend"><i class="fa fa-user"></i> Welcome '.$CI->session->userdata('nama').' <em>'.$CI->session->userdata('role').'</em></span></a></li>';
            }
            else{
                $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'backend/login/logout"> | <i class="fa fa-sign-out"></i> LOGOUT</span></a></li>';
                $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'backend"><i class="fa fa-user"></i> Selamat datang '.$CI->session->userdata('nama').' <em>'.$CI->session->userdata('role').'</em></span></a></li>';
            }
        }
    }
    else{
        if($active_bahasa == '_en'){
            $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'login"> | <i class="fa fa-sign-in"></i> LOGIN</span></a></li>';
            $string_menu .= '<li style="padding:0.5%;float:right;"><a href="">Welcome Customer</span></a></li>';
        }
        else{
            $string_menu .= '<li style="padding:0.5%;float:right;"><a href="'.base_url().'login"> | <i class="fa fa-sign-in"></i> LOGIN</span></a></li>';
            $string_menu .= '<li style="padding:0.5%;float:right;"><a href="">Selamat datang Pelanggan</span></a></li>';
        }
    }
    $string_menu .= '</ul>';
    return $string_menu;
}
function insert_log($proses = NULL, $link = NULL) {	$CI = &get_instance();	if ( !empty($proses) ) {		$dt_insert = array(			'proses'	=> $proses,			'link'		=> $link,			'username'	=> $CI->session->userdata('username'),			'created'	=> date('Y-m-d H:i:s')		);		$CI->db->insert('tbl_log', $dt_insert);	}}


function format_chart($dt_kategori,$dt_list_nilai){
    //setting format chart
    $dt_chart = array();
    $dt_chart['sumbu_x'] = array('categories'=>$dt_kategori);
    $dt_chart['values'] = $dt_list_nilai;
    foreach($dt_list_nilai as $arr_nilai){
        $dt_nilai = $arr_nilai['data'];
    }

    // khusus pie chart
    $arr_combine = array_combine($dt_kategori,$dt_nilai);
    $arr_pie = array();

    $i = 0;
    foreach($arr_combine as $key => $val){
        $arr_pie['data'][$i] = array($key,$val);
        $i++;
    }
    $dt_chart['pie'] = $arr_pie;
    // end set up data pie
    return $dt_chart;
}

function send_email($to = '', $subject = '',$message=''){
    $CI = &get_instance();
    $CI->load->library('email');
    $_host = $CI->global_model->get_by_id('tbl_setting_content', 'variable_task', 'smtp_host');
    $_user = $CI->global_model->get_by_id('tbl_setting_content', 'variable_task', 'smtp_user');
    $_pass = $CI->global_model->get_by_id('tbl_setting_content', 'variable_task', 'smtp_pass');
    $_port = $CI->global_model->get_by_id('tbl_setting_content', 'variable_task', 'smtp_port');
    $_type = $CI->global_model->get_by_id('tbl_setting_content', 'variable_task', 'smtp_crypto');
    $config['protocol'] = 'smtp';
    $config['smtp_host']   = $_host->value_task;
    $config['smtp_user']   = $_user->value_task;
    $config['smtp_pass']   = $_pass->value_task;
    $config['smtp_port']   = $_port->value_task;
    $config['smtp_crypto'] = $_type->value_task;
    $config['mailtype'] = 'html';
    $CI->email->initialize($config);

    $CI->email->from($_user->value_task, 'NOTIFIKASI PTSP BMKG');
    $CI->email->reply_to($_user->value_task, 'NOTIFIKASI PTSP BMKG');
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($message);
    if ($CI->email->send()) {
            return true;
    } else {

        //echo $CI->email->print_debugger();

        return false;
    }

}

if(!function_exists('total_harus_proses')){
    function total_harus_proses(){
        $CI = &get_instance();
        $id_role = $CI->session->userdata('id_role');


        // Data set length after filtering
        $where = "1=1 ";
        $CI->db->where($where);
        $CI->db->where('B.status',6);
        if($id_role >= 9){
            //ROLE BO
            $CI->db->where('D.penanggung_jawab',$id_role);
        }
        $CI->db->select('*');
        $CI->db->join('tbl_permohonan B', 'A.id_permohonan = B.id_permohonan');
        $CI->db->join('m_layanan D', 'D.id_layanan = A.id_layanan');
        $CI->db->from("tbl_detail_permohonan A");

        $iFilteredTotal = $CI->db->count_all_results();
        return $iFilteredTotal;

    }
}

if(!function_exists('list_notif1')){
    function list_notif1(){
        $CI = &get_instance();
        $id_role = $CI->session->userdata('id_role');
        $id_admin = $CI->session->userdata('id_admin');

        $query = null;

        switch($id_role) {
            case 3: // Admin PTSP
                $query = $CI->db
                    ->where('status = 0 OR status = 7 OR status = 9')
                    ->get('tbl_permohonan');
                break;
            case 4: // Bendahara
                $query = $CI->db
                    ->where('status = 4')
                    ->get('tbl_permohonan');
                break;
            case 7: // Pelanggan
                $query = $CI->db
                    ->where('status < 10 AND status != 2 AND status != 5')
                    ->where('id_pemohon', $id_admin)
                    ->get('tbl_permohonan');
                break;
            case 1:
            case 2:
            case 5:
            case 6:
            case 8:
                $query = $CI->db->where('status is null')->get('tbl_permohonan');
                break;
            default: // BO
                $query = $CI->db
                    ->where('B.status = 6')
                    ->where('C.penanggung_jawab', $id_role)
                    ->join('tbl_permohonan B', 'A.id_permohonan = B.id_permohonan')
                    ->join('m_layanan C', 'C.id_layanan = A.id_layanan')
                    ->from('tbl_detail_permohonan A')
                    ->group_by("B.no_permohonan")
                    ->get();
                break;
        }

        return $query->result();
    }
}

function get_nama_perusahaan($id_admin = '') {
    $output = '';
    $CI = &get_instance();
    $CI->load->model('global_model');
    $pengguna = $CI->global_model->get_by_id('tbl_admin','id_admin',$id_admin);
    if (!empty($pengguna)) {
        $perusahaan = $CI->global_model->get_by_id('tbl_perusahaan','id_perusahaan',$pengguna->id_perusahaan);
        return ($perusahaan->nama ?? 'PERSEORANGAN');
    }
    return NULL;

}

//Baris awal penambahan kolom alamat. Perubahan oleh Nurhayati Rahayu(18/03/2024)
function get_alamat_perusahaan($id_admin = '') {
    $output = '';
    $CI = &get_instance();
    $CI->load->model('global_model');
    $pengguna = $CI->global_model->get_by_id('tbl_admin','id_admin',$id_admin);
    if (!empty($pengguna)) {
        $perusahaan = $CI->global_model->get_by_id('tbl_perusahaan','id_perusahaan',$pengguna->id_perusahaan);
        return ($perusahaan->alamat ?? '');
    }
    return NULL;
}
//Baris akhir penambahan kolom alamat. Perubahan oleh Nurhayati Rahayu(18/03/2024)


function numberToRoman($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}

if(!function_exists("get_duedate"))
{
    function get_duedate($tanggal, $days) {
        $CI = &get_instance();

        $workingDays = array(1, 2, 3, 4, 5);
        // $holidayDays = array(); # variable and fixed holidays
        // foreach ($list_hari_libur as $key => $value) {
        //     $holidayDays[] = $value->hari_libur;
        // }

        $from = new DateTime($tanggal);
        $dates = array();
        $dates[] = $from->format('Y-m-d');

        while ($days) {
            $from->modify('+1 day');
            if (!in_array($from->format('N'), $workingDays)) continue;
            $dates[] = $from->format('Y-m-d');
            $days--;
        }

        $dates_total = count($dates);
        $latest_date = $dates[$dates_total-1];
        return $latest_date;
    }
}

function snake_case(string $str): string
{
    $lower = strtolower($str);
    $split = explode(" ", $lower);
    return implode("_", $split);
}

function encrypt($string) {
    $method = 'AES-256-CBC';
    $key = 'katakunci2';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
    $encrypted_data = openssl_encrypt($string, $method, $key, 0, $iv);
    $encrypted_data_with_iv = base64_encode($encrypted_data . '::' . $iv);
    return $encrypted_data_with_iv;
}

function decrypt($string) {
    $method = 'AES-256-CBC';
    $key = 'katakunci2';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
    $encrypted_data = openssl_encrypt($string, $method, $key, 0, $iv);
    list($encrypted_data, $iv) = explode('::', base64_decode($string), 2);
    $decrypted_data = openssl_decrypt($encrypted_data, $method, $key, 0, $iv);
    return $decrypted_data;
}

if (!function_exists('get_process_array')) {
    /**
     * Get the process array based on the type of service.
     *
     * @param int|string $id_jenis_layanan The ID of the service type.
     * @return array The array of processes for the given service type.
     */
    function get_process_array($id_jenis_layanan) {
        $process = array();

        switch((int) $id_jenis_layanan) {
            case 1:
                array_push($process, 'Pengumpulan Data', 'Pengolahan Data');
                break;
            case 2:
                array_push($process, 'Pemeriksaan Alat', 'Kalibrasi Alat');
                break;
        }


        array_push($process, 'Quality Control', 'Pengesahan Dokumen');
        return $process;
    }
}

?>
