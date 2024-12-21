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
		    <h1><span><?php echo $title ?></span></h1>
			<div class="widgetcontent">
				<object width="100%" height="950px" data="<?php echo base_url().'upload/file_menu/'.$file['lampiran']; ?>" type="application/pdf" width="300" height="300">
				alt : <a href="<?php echo base_url().'upload/file_menu/'.$file['lampiran']; ?>"><?php echo $file['lampiran'] ?></a>
				</object>
			</div>
		</div>
	</main>
</div>