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
	    	<h1><span><?php echo isset($bahasa) ? 'Work Program' : 'Program Kerja'?></span></h1>
			<?php $tupoksi = $this->global_model->get_by_id_array('tbl_program_kerja','id',1);?>
			<div class="single_page_content">
		      <p><?php echo $tupoksi['program_kerja'.$bahasa];?></p>
		    </div>
		</div>
	</main>
</div>
