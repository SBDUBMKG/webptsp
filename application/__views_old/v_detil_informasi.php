<div class="col-lg-8 col-md-8 col-sm-8" style="margin-bottom:20px;">
  <div class="single_page">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>">Home</a></li>
      <li class="active">Informasi</li>
    </ol>

    <h1><?php echo $detil_informasi['informasi'.$bahasa];?></h1>

    <div class="post_commentbox">
      <a href="#">
        <i class="fa fa-user"></i>Admin
      </a>
      <a href="#"><i class="fa fa-tags"></i>Informasi</a>
    </div>
    
    <div class="single_page_content">
      <p><?php echo $detil_informasi['isi'.$bahasa];?></p>

		<?php 
		if(!empty($detil_informasi['lampiran'])) {
		?>
		<table class="table table-striped">
		  <thead>
		    <th><?php echo $bahasa == '_en' ? 'Attachment' : 'Lampiran'; ?></th>
		    <th style="width:40px">Download</th>
		  </thead>
		  <tbody>
		    <tr>
		      <td><?php echo $detil_informasi['informasi'.$bahasa];?></td>
		      <td style="text-align:center">
		        <a href="<?php echo base_url().'upload/informasi/'.$detil_informasi['lampiran'];?>" target="_blank" title="download"><i class="fa fa-download"></i></a>
		      </td>
		    </tr>
		  </tbody>
		</table>
		<?php } ?>

    </div>
  </div>
</div>