<div class="col-lg-8 col-md-8 col-sm-8">
	<div class="left_content">
	    <div class="single_post_content">
	    	<?php 
	    		echo $bahasa == '_en' ? '<h2><span>Rules</span></h2>' : '<h2><span>Peraturan</span></h2>';
	    		$list_kategori = $this->global_model->get_list_array('tbl_peraturan');
	    	?>
	    	<table class="table table-striped">
	    		<thead>
	    			<th>Peraturan</th>
	    			<th style="width:40px">Download</th>
	    		</thead>
	    		<tbody>
	    			<?php foreach($list_kategori as $key => $value){ ?>
	    			<tr>
	    				<td><?php echo $value['judul_peraturan'.$bahasa];?></td>
	    				<td style="text-align:center"><a href="<?php echo base_url().'upload/peraturan/'.$value['lampiran'];?>" target="blank" title="download"><i class="fa fa-download"></i></a></td>
	    			</tr>
	    			<?php } ?>
	    		</tbody>
	    	</table>
		</div>
	</div>
</div>
