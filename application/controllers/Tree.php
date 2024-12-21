<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tree extends CI_Controller {

    var $folder ='';

    function __construct(){
        parent::__construct();
        $this->load->model('global_model');
    }

    public function index() {
    	$jenis_layanan = $this->global_model->get_list_array('m_jenis_layanan');
    	$layanan       = $this->global_model->get_list_array('m_layanan');

  		$string = '<ol>';
    	foreach ($jenis_layanan as $key => $value) {
    		$string .= '<li>'.$value['jenis_layanan'].'</li>';
			$child = $this->get_child_jenis_layanan($value['id_jenis_layanan']);
    		if(count($child) > 0){
    			$string .= '<ul>';
    			foreach ($child as $key => $value) {
    				$produk = '';
    				if($value['is_produk'] == 1){
    					$produk = ' - <font color="red">(Produk)</font>';								    					
    				}
		    		$string .= '<li>'.$value['layanan'].$produk.'</li>';
					$child = $this->get_child_layanan($value['id_layanan']);
		    		if(count($child) > 0){
		    			foreach ($child as $key => $value) {
		    				$produk = '';
		    				if($value['is_produk'] == 1){
		    					$produk = ' - <font color="red">(Produk)</font>';								    					
		    				}
			    			$string .= '<ul>';
				    		$string .= '<li>'.$value['layanan'].$produk.'</li>';
							$child = $this->get_child_layanan($value['id_layanan']);
				    		if(count($child) > 0){
				    			foreach ($child as $key => $value) {
				    				$produk = '';
				    				if($value['is_produk'] == 1){
				    					$produk = ' - <font color="red">(Produk)</font>';								    					
				    				}
					    			$string .= '<ul>';
						    		$string .= '<li>'.$value['layanan'].$produk.'</li>';
									$child = $this->get_child_layanan($value['id_layanan']);
						    		if(count($child) > 0){
						    			foreach ($child as $key => $value) {
						    				$produk = '';
						    				if($value['is_produk'] == 1){
						    					$produk = ' - <font color="red">(Produk)</font>';								    					
						    				}
							    			$string .= '<ul>';
								    		$string .= '<li>'.$value['layanan'].$produk.'</li>';
											$child = $this->get_child_layanan($value['id_layanan']);
								    		if(count($child) > 0){
								    			foreach ($child as $key => $value) {
								    				$produk = '';
								    				if($value['is_produk'] == 1){
								    					$produk = ' - <font color="red">(Produk)</font>';								    					
								    				}
									    			$string .= '<ul>';
										    		$string .= '<li>'.$value['layanan'].$produk.'</li>';
									    			$string .= '</ul>';
												}
											}
							    			$string .= '</ul>';
										}
									}
					    			$string .= '</ul>';
								}
							}
			    			$string .= '</ul>';
						}
					}
    			}
    			$string .= '</ul>';
    		}
    	}
     	$string .= '</ol>';

     	echo $string;
    }

    function get_child_jenis_layanan($id_parent) {
    	$con = 'id_jenis_layanan = '.$id_parent.' AND id_parent = 0';
    	$child = $this->global_model->get_list_array('m_layanan', $con);
    	return $child;
    }

    function get_child_layanan($id_parent) {
    	$con = 'id_parent = '.$id_parent;
    	$child = $this->global_model->get_list_array('m_layanan', $con);
    	return $child;
    }
}