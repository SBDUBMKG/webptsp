<style>
.jssocials-share-link { border-radius: 50%; }
</style>

<div class="wrapper row3">
	<main class="hoc container clear"> 
		<div class="content"> 
			<ol class="breadcrumb">
				<!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
				<li><a href="<?php echo base_url();?>">Home</a></li> 
				Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->

                <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                <li><a href="<?php echo base_url();?>"><?php echo translate(37);?></a></li>
                <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->

				<li class="active"><?php echo $title ?></li>
			</ol>
		    <h1><span><?php echo $title ?></span></h1>
			<div class="widgetcontent">
				<img width="100%" src="<?= base_url().'upload/file_menu/'.$file['lampiran']; ?>" />
			</div>
			<!-- <div class="widgetcontent">
				<object width="100%" data="<?= base_url().'upload/file_menu/'.$file['lampiran']; ?>" type="application/pdf">
				alt : <a href="<?= base_url().'upload/file_menu/'.$file['lampiran']; ?>"><?php echo $file['lampiran'] ?></a>
				</object>
			</div> -->
		</div>
	</main>
</div>