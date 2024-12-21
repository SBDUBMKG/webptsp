<div class="wrapper row3" style="min-height:800px">
  <main class="hoc container clear"> 
  	<section class="content-header">
  	  <ol class="breadcrumb">
  	    <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
        <li><a href="<?= base_url();?>"><i class="fa fa-dashboard"></i> <?= translate(37);?></a></li> 
        Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->

        <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
        <li><a href="<?= base_url();?>"><?= translate(37);?></a></li>
        <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->

  	    <li><a href="<?= base_url().'katalog_pelayanan';?>"><?= translate(1);?></a></li>
  	    <li class="active"><?= translate(77);?></li>
  	  </ol>
  	</section>

    <div class="content">
      <h1><?= $detail_layanan['layanan'];?></h1>
      <?= $this->session->flashdata('not_1') ?>
      <?= $this->session->flashdata('not_2') ?>
      <button type="button" class="btn btn-sm btn-flat btn-primary" onclick="history.go(-1);return false;">
        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
      </button>
      <a class="btn btn-sm btn-flat btn-success" href="<?= site_url('katalog_pelayanan/proses_pesanan') ?>">
        <i class="fa fa-fw fa-lg fa-shopping-basket"></i> <?= translate(80) ?> <span class="badge"><?= $this->cart->total_items() ?></span>
      </a>
      <a class="btn btn-sm btn-flat btn-danger" href="<?= site_url('katalog_pelayanan/hapus_pesanan') ?>">
        <i class="fa fa-fw fa-lg fa-trash-o"></i>
      </a>
      <hr>
      <table style="border:0">
        <tr>
          <td width="20%" style="border:0"><ul><li>Satuan</li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?= empty($detail_layanan['satuan']) ? ' - ' : $detail_layanan['satuan']; ?></td>
        </tr>
        <tr>
          <td width="20%" style="border:0"><ul><li>Berat</li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?= empty($detail_layanan['berat']) ? ' - ' : $detail_layanan['berat'].' '.$detail_layanan['satuan_berat']; ?></td>
        </tr>
        <tr>
          <td width="20%" style="border:0"><ul><li>Harga</li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?= empty($detail_layanan['harga']) ? ' - ' : 'Rp. '.number_format($detail_layanan['harga'], 2, ',', '.'); ?></td>
        </tr>
        <tr>
          <td width="20%" style="border:0"><ul><li>Back Office</li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?= $this->db->get_where('tbl_role', ['id_role' => $detail_layanan['penanggung_jawab']])->row('role') ?></td>
        </tr>
        <tr>
          <td width="20%" style="border:0"><ul><li><?= translate(91) ?></li></ul></td>
          <td width="5%" style="border:0">:</td>
          <td style="border:0"><?php
          $display_coloumn = json_decode(str_replace("'", '"', $detail_layanan['display_coloumn']), true);
          foreach($display_coloumn as $key => $value) {
            echo '<li>'.$value.'</li>';
          }
          ?>
        </tr>
      </table>
      <hr>
      <a href="#" class="btn btn-flat btn-primary" onclick="history.go(-1);return false;">
        <small><span class="fa fa-fw fa fa-fw fa-lg fa-arrow-left" aria-hidden="true"></span> <?= translate(83) ?></small>
      </a>
      <a class="btn btn-flat btn-success" href="<?= site_url('katalog_pelayanan/tambah_layanan/'.$detail_layanan['id_layanan']) ?>">
        <small><span class="fa fa-fw fa-shopping-cart" aria-hidden="true"></span> <?= translate(82) ?></small>
      </a>
    </div>
    <div class="clear"></div>
  </main>
</div>