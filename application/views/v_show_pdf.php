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
					<?php
						$array = explode('.', $file['lampiran']);
						$extension = end($array);
						if($extension != 'pdf'){
						?>
						<div class="card p-3 mb-3">
							<h2 class="text-center"><span><?php echo $bahasa == "" ? $title : $title_en ?></span></h2>
							<div class="widgetcontent">
								<img width="100%" src="<?= base_url().'upload/file_menu/'.$file['lampiran']; ?>" />
							</div>
						</div>
						<?php } else { ?>
						<div class="card p-3 mb-3">
							<h2><span><?php echo $bahasa == "" ? $title : $title_en ?></span></h2>
							<div class="widgetcontent">
								<object width="100%" height="720px" data="<?= base_url().'upload/file_menu/'.$file['lampiran']; ?>" type="application/pdf">
								alt : <a href="<?= base_url().'upload/file_menu/'.$file['lampiran']; ?>"><?php echo $file['lampiran'] ?></a>
								</object>
							</div>
						</div>
						<?php } ?>
					</div>	
				</div>												
			</div>
		</div>