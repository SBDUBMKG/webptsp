<?php
//filepath:  application\views\v_proses_pesanan.php
?>
<div class="wrapper row3" style="min-height:800px">
  <main class="hoc container clear"> 
  	<section class="content-header">
  	  <ol class="breadcrumb">
  	    <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
        <li><a href="<?= site_url() ?>"><i class="fa fa-dashboard"></i> <?= translate(37) ?></a></li> 
        Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->


        <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
        <li><a href="<?= base_url();?>"></i> <?= translate(37);?></a></li>
        <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->
        
  	    <li><a href="<?= site_url('katalog_pelayanan') ?>"><?= translate(1) ?></a></li>
  	    <li class="active"><?= translate(79);?></li>
  	  </ol>
  	</section>
    <div class="content"> 
      <h1><?= translate(84) ?></h1>
      <?= $this->session->flashdata('not_1') ?>
      <?= $this->session->flashdata('not_2') ?>
      <button type="button" class="btn btn-sm btn-flat btn-primary" onclick="history.go(-1);return false;">
        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
      </button>
      <a class="btn btn-sm btn-flat btn-success" href="<?= site_url('katalog_pelayanan/proses_pesanan') ?>">
        <i class="fa fa-fw fa-lg fa-shopping-basket"></i> <?= translate(80) ?> <span class="badge"><?= $this->cart->total_items() ?></span>
      </a>
      <a class="btn btn-sm btn-flat btn-danger" href="<?= site_url('katalog_pelayanan/hapus_pesanan') ?>"  onclick="if(!confirm('<?php echo translate(93);?>')) return false;">
        <i class="fa fa-fw fa-lg fa-trash-o"></i>
      </a>
      <hr>
      <?php if(!empty($layanan)){ ?>
      <?php foreach ($layanan as $value) { ?>
      <table style="border:0">
        <h3><?= $value['name'] ?><a href="<?= site_url('katalog_pelayanan/hapus_pesanan/'.$value['rowid']) ?>" class="text-danger"   onclick="if(!confirm('<?php echo translate(93);?>')) return false;"><i class="fa fa-fw fa-lg fa-trash-o"></i></a></h3>
        <tr>
          <td width="20%" style="border:0"><ul><li>Kuantitas</li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?php echo empty($value['qty']) ? ' - ' : $value['qty']; ?></td>
        </tr>
        <tr>
          <td width="20%" style="border:0"><ul><li>Satuan</li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?php echo empty($value['options']['satuan']) ? ' - ' : $value['options']['satuan']; ?></td>
        </tr>
        <tr>
          <td width="20%" style="border:0"><ul><li>Berat</li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?php echo empty($value['options']['berat']) ? ' - ' : $value['options']['berat'].' '.$value['options']['satuan_berat']; ?></td>
        </tr>
        <tr>
          <td width="20%" style="border:0"><ul><li>Harga</li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?= empty($value['options']['harga']) ? ' - ' : 'Rp. '.$value['options']['harga']; ?></td>
        </tr>
        <tr>
          <td width="20%" style="border:0"><ul><li>Back Office</li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?= $this->db->get_where('tbl_role', ['id_role' => $value['options']['penanggung_jawab']])->row('role') ?></td>
        </tr>
        <tr>
          <td width="20%" style="border:0"><ul><li><?= translate(91) ?></li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0">
            <?php
            $display_coloumn = json_decode(str_replace("'", '"', $value['options']['display_coloumn']), true);
            foreach($display_coloumn as $key => $value) {
              echo '<li>'.$value.'</li>';
            }
            ?>
          </td>
        </tr>
      </table>
      <?php } ?>
      <?php } else { ?>
        <p><?= translate(87) ?></p>
      <?php } ?>
      <hr>
    </div>
		<div class="form-group">
      <button type="button" class="btn btn-flat btn-primary" onclick="location.href='<?= $_SERVER['HTTP_REFERER'] ?>'">
        <?= translate(83) ?>
      </button>
      <?php if(!empty($layanan)){ ?>
        <a href="<?= site_url('katalog_pelayanan/validasi_pesanan') ?>" class="btn btn-flat btn-success"><?= translate(84) ?></a>
      <?php } ?>
		</div>
  <div class="clear"></div>
  </main>
</div>