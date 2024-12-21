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
			<?php $profil = $this->global_model->get_by_id_array('tbl_struktur_organisasi','id_struktur_organisasi','1');?>
			<h1><span><?php echo strtoupper(translate(22));?></span></h1>
			<img src="<?php echo base_url().'resources/frontend/images/'.$profil['struktur_organisasi'.$bahasa]?>" width="100%">
		</div>
	</main>
</div>
