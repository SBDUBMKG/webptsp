<?php
class Login_model extends CI_Model{
	var $table_admin = 'tbl_admin';
    var $table_role = 'tbl_role';
	public function __construct(){
		$this->load->database();
	}

	public function validation($username, $password){
        $this->db->select('A.*, B.role, B.is_super_admin')
                 ->from($this->table_admin.' A')
                 ->join($this->table_role.' B', 'A.id_role = B.id_role')
                 ->where('username', $username);
		$query = $this->db->get();
		if ( is_object($query)) {
			$row = $query->row();
			if ( is_object($row) ) {
				if ( strrev(md5($password)) == $row->password ) {
					return $query->row();			
				}
			}
		}
		return false;
	}
    function check_password($id_user, $password) {
        $return = false;
        $this->db->select('password')->from($this->table_admin)->where('id_admin', $id_user);
        $execute    = $this->db->get();
        if ( is_object($execute) ) {
            $data = $execute->row();
            if ( $data->password == strrev(md5($password)) ) {
                $return = true;
            }
        }
        return $return;
    }
    function update_user($id_user, $data_update) {
        $this->db->where('id_admin', $id_user);
        $update = $this->db->update($this->table_admin, $data_update);
        return $update;
    }
}