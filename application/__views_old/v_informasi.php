<div class="col-lg-8 col-md-8 col-sm-8">
	<div class="left_content">
	    <div class="single_post_content">
	    	<?php 
	    		$con = "id_bidang = ". $id_bidang;
	    		$bidang = $this->global_model->get_list_array('tbl_bidang', $con);
				foreach($bidang as $key => $value){
	    		echo $bahasa == '_en' ? '<h2><span>'.$value['bidang'].' Information</span></h2>' : '<h2><span>Informasi '.$value['bidang'].'</span></h2>';
	    		}
	    	?>

	    	<?php
    		$layanan = $this->global_model->get_list_array('tbl_informasi', $con);
	    	if(empty($layanan)) {
	    	?>
    		<div class="error_page">
            	<h3>Mohon Maaf</h3>
            	<p>Halaman belum tersedia</p>
            	<span></span> 
            	<a href="<?php echo base_url();?>" class="wow fadeInLeftBig animated" style="visibility: visible; animation-name: fadeInLeftBig;">Kembali</a>
            </div>
    		<?php
    		}else{
    		?>
	    	<table class="table table-striped">
	    		<thead>
	    			<th><?php echo $bahasa == '_en' ? 'Information' : 'Informasi'; ?></th>
	    			<th style="width:40px">Pilihan</th>
	    		</thead>
	    		<tbody>
	    			<?php 
		    		$con = "id_bidang = ". $id_bidang;
		    		$layanan = $this->global_model->get_list_array('tbl_informasi', $con);

	    			foreach($layanan as $key => $value){ 
	    			?>
	    			<tr>
	    				<?php
	    				if(empty($value['lampiran'])){
	    				?>
	    				<td><a href="<?php echo base_url().'informasi/informasi/detil_informasi/'.$value['id_informasi'];?>" target="_blank" title="<?php echo $value['informasi'.$bahasa];?>"><?php echo $value['informasi'.$bahasa];?></a></td>
						<?php } else { ?>
	    				<td><?php echo $value['informasi'.$bahasa];?></td>
	    				<?php }?>
	    				<td style="text-align:center">
		    				<?php
		    				if(!empty($value['isi'.$bahasa])){
		    				?>	    				
	    					<a href="<?php echo base_url().'informasi/informasi/detil_informasi/'.$value['id_informasi'];?>" target="_blank" title="detil"><i class="fa fa-eye"></i></a>
	    					<?php } else { ?>
	    					<a href="<?php echo base_url().'upload/informasi/'.$value['lampiran'];?>" target="_blank" title="download"><i class="fa fa-download"></i></a>
	    					<?php } ?>
	    				</td>
	    			</tr>
	    			<?php } ?>
	    		</tbody>
	    	</table>
	    	<?php } ?>
		</div>
	</div>
</div>
