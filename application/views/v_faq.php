<?php
$bahasa = $this->session->userdata('bahasa');
?>
<style>
  .accordion_container {
    width: 100%;
}
.accordion_head {
    background-color:#0097B1;
    color: white;
    cursor: pointer;
    font-family: arial;
    font-size: 15px;
    margin: 0 0 4px 0;
    padding: 7px 11px;
    font-weight: bold;
    border-radius: 7px;
}
.accordion_body {
    background: #F2F0F0;
}
.accordion_body p {
    padding: 18px 10px;
    margin: 0px;
    
}
.plusminus {
    float:right;
    font-size: 18px !important;
}
.accordion_body * {
    color: black;
}
</style>
<div class="beranda-area">
			<div class="container">
				<div class="beranda-top">
					<ul>
					<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
					<li class="text-secondary">FAQ</li>
					</ul>
				</div>
				<div class="beranda-main bm-mobile">
					<div class="beranda-main-item">
						<h3>FAQ</h3>
						<div class="Jumlah-border">
							<div class="Jumlah-border-left Jumlah-border-left3"></div>
							<div class="Jumlah-border-right Jumlah-border-right3"></div>
						</div>
					</div>	
					<!-- <div class="beranda-item beranda-item1 mt-4 pt-4"> -->
						<div class="widgetcontent fst-italic fw-normal mt-3" style="color:white">
                <div class="accordion_container">
                  <?php  foreach ($list_faq as $key => $value) {                  ?>
                    <div class="accordion_head"><?php echo $value['pertanyaan'.$bahasa];?><span class="plusminus">+</span>

                    </div>
                    <div class="accordion_body" style="display: none;">
                        <p class="text-dark"><?php echo $value['jawaban'.$bahasa];?></p>
                    </div>
                    <?php } ?>
                  </div>
						</div>
					<!-- </div>	 -->
				</div>												
			</div>
		</div>
 