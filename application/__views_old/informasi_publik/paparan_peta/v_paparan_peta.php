<style>
.jssocials-share-link { border-radius: 50%; }
</style>

<div class="wrapper row3">
  	<main class="hoc container clear"> 
    	<div class="content"> 
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url();?>">Home</a></li>
				<li class="active"><?php echo $title ?></li>
			</ol>
	    	<h1><span><?php echo isset($bahasa) ? 'map exposure' : 'Paparan Peta'?></span></h1>
	    	<hr>
	    	<p>Silahkan klik link dibawah ini :</p>
			<?php
				$str_paparan = '<ol>';
				$list_jenis_paparan = $this->global_model->get_list_array('m_jenis_paparan');
				foreach ($list_jenis_paparan as $jenis_paparan) {
					$str_paparan .= '<li>'.$jenis_paparan['jenis_paparan'].'</li>';

					$where = 'id_jenis_paparan = '.$jenis_paparan['id_jenis_paparan'];
					$list_paparan = $this->global_model->get_list_array('tbl_paparan', $where);
					if($list_paparan){
						foreach ($list_paparan as $paparan) {
							$str_paparan .= '<ul><li><a href="'.base_url().'upload/paparan_peta/'.$paparan['lampiran'].'" target="blank">'.$paparan['judul'].'</a></li></ul><br>';
						}
					}else{
							$str_paparan .= ' - ';						
					}
				}
				$str_paparan .= '</ol>';
			?>
			<div class="single_page_content">
		      <p><?php echo $str_paparan;?></p>
		    </div>
		</div>
	</main>
</div>
