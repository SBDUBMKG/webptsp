<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="left_content">
      <div class="single_post_content">
        <?php 
          echo $bahasa == '_en' ? '<h2><span>FAQ</span></h2>' : '<h2><span>FAQ</span></h2>';
        ?>
        <?php $i=0; foreach($list_tanya_jawab as $key => $value){ $i++; ?>
        <table class="table table-striped">
          <thead>
            <th>Jawab : <?php echo $value['jawaban'];?> </th>
          </thead>
          <tbody>
            <tr>Tanya : <?php echo $value['pesan'];?> </tr>
          </tbody>
        </table>
        <?php } ?>
    </div>
  </div>

  <div class="center">
      <div class="pagination"><?php echo $links;?></div>
  </div>
</div>