<style>
	td {
		text-align: left;
	}
</style>
<div class="beranda-area">
			<div class="container">
				<div class="beranda-top">
					<ul>
					<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
					<li class="text-secondary"><?php echo $bahasa == "" ? $title : $title_en ?></li>
					</ul>
				</div>
				<div class="beranda-main bm-mobile">
					<div class="beranda-main-item">
						<h3><?php echo $bahasa == "" ? $title : $title_en ?></h3>
						<div class="Jumlah-border">
							<div class="Jumlah-border-left Jumlah-border-left3"></div>
							<div class="Jumlah-border-right Jumlah-border-right3"></div>
						</div>
					</div>	
					<div class="beranda-item beranda-item1 mt-4 pt-4 mobile-bi">
						<h2 style="color:white"><span><?php echo $bahasa == "" ? $title : $title_en ?></span></h2>
						<div class="widgetcontent fst-italic fw-normal" style="color:white">
							<?php echo $bahasa == '' ? $halaman['text_rte'] : $halaman['text_rte_en'];?>
						</div>
					</div>	
				</div>												
			</div>
		</div>