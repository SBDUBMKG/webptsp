<div class="col-lg-8 col-md-8 col-sm-8">
	<div class="left_content">
	    <div class="single_post_content">
	    	<?php echo $bahasa == '_en' ? '<h2><span>Contact</span></h2>' : '<h2><span>Kontak</span></h2>'?>
	          <div class="col-lg-6 col-md-6 col-sm-6" style="margin-top:30px;">
	            <div class="footer_widget" style="min-height:120px;margin-top:-30px;">
	              <h2><?php echo strtoupper(translate(10));?></h2>
	                <?php               
	                echo strtoupper(translate(14));
	                ?>
	            </div>
	          </div>
			<?php
	          $map = $this->app_data->get_by_id_array('tbl_setting_content','id_setting',1);
	          $map_show = $map['is_show'];
	          if($map_show ==1 ){
	          ?>
	          <div class="col-lg-6 col-md-6 col-sm-6">
	            <div class="footer_widget">
	              <h2><?php echo strtoupper(translate(21));?></h2>
	              <div class="google-maps">
	                <?php               
	                echo $map['value'];
	                ?>
	              </div>
	            </div>
	          </div>
	          <?php } ?>
		</div>
	</div>
</div>
