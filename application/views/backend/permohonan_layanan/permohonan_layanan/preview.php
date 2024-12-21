<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$curr_lang = $this->session->userdata('language');
$this->lang->load('backend/service_request/detail', $curr_lang);
?>

<section class="content-header">
  <h1><?= $page_title ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url() ?>">Home</a></li>
    <li><a href="<?= site_url($this->module) ?>"><?= $page_title ?></a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<form method="post" enctype="multipart/form-data" action="">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">
                <strong>
                    <?= strtoupper($this->lang->line('data.request.title')) ?>
                </strong>
            </h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td style="width: 400px;"> <?= $this->lang->line('data.request.number') ?> </td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail['no_permohonan']) ? '-' : $detail['no_permohonan']; ?></td>
                </tr>
                <tr>
                  <td> <?= $this->lang->line('data.request.date') ?> </td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail['tanggal_permohonan']) ? '-' : $detail['tanggal_permohonan']; ?></td>
                </tr>


                <tr>
                  <td> <?= $this->lang->line('data.request.verify') ?> </td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail['tanggal_verifikasibendahara']) ? '-' : $detail['tanggal_verifikasibendahara']; ?></td>
                </tr>

                <tr>
                  <td> <?= $this->lang->line('data.request.letter.number') ?> </td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail['no_surat_keluar']) ? '-' : $detail['no_surat_keluar']; ?></td>
                </tr>

                <tr>
                  <td> <?= $this->lang->line('data.request.letter.date') ?> </td>
                  <td style="width: 10px">:</td>
                  <td><?= $detail['tanggal_surat_keluar'] === '0000-00-00' ? '-' : $detail['tanggal_surat_keluar']; ?></td>
                </tr>

                <tr>
                  <td> <?= $this->lang->line('data.request.doc') ?> </td>
                  <td style="width: 10px">:</td>
                  <td>
                      <div class="row" style="margin-left: -1px">
                            <?php if(!empty($detail['permohonan'])): ?>
                            <a class="col" href="<?= site_url('upload/permohonan/'.$detail['permohonan']) ?>" target="_blank"> <?= $this->lang->line('data.request.doc.link') ?> </a>
                            <?php else: ?>
                            -
                            <?php endif ?>
                            <?php if((int) $detail['status'] === 0 && (int) $role_user === 7): ?>
                                <a class="col btn btn-sm btn-primary" style="margin-left: 10px" href="<?= site_url('/backend/permohonan_layanan/permohonan_layanan/upload_permohonan/' . $detail['id_permohonan'] . '?reupload=true') ?>">
                                    <?= $this->lang->line('data.request.doc.btn') ?>
                                </a>
                            <?php endif ?>
                      </div>
                  </td>
                </tr>
                <?php if((int) $role_user === 7): ?>
                <tr>
                  <td> <?= $this->lang->line('data.request.proof'); ?> </td>
                  <td style="width: 10px">:</td>
                  <td>
                      <?php if(!empty($detail['bukti'])): ?>
                      <a href="<?= site_url('upload/bukti/'.$detail['bukti']) ?>" target="_blank">
                       <?= $this->lang->line('data.request.proof.link'); ?>
                      </a>
                      <?php else: ?>
                      -
                      <?php endif ?>
                  </td>
                </tr>
                <?php endif ?>
                <tr>
                  <td>Status</td>
                  <td style="width: 10px">:</td>
                  <td>
                    <?php if((($role_user == 1) || ($role_user == 2) || ($role_user == 3))): ?>
                      <select name="status" class="form-control">
                        <?php foreach ($statuses as $status) : ?>
                          <option value="<?= $status['id_status'] ?>" <?= $detail['status'] == $status['id_status'] ? 'selected' : '' ?>>
                              <?= status($status['id_status'], $role_user) ?>
                          </option>
                        <?php endforeach ?>
                      </select>
                    <?php else : ?>
                        <?=
                        strcmp($curr_lang, 'english') === 0
                        ? $this->lang->line('data.request.status.'.$detail['status'])
                        : status($detail['status'], $role_user)
                        ?>
                    <?php endif ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!--data produk-->
    <div class="row">
      <div class="col-xs-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">
                <strong>
                    <?= strtoupper($this->lang->line('data.product.table.title')) ?>
                </strong>
            </h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <div class="box-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <th><?= $this->lang->line('data.product.table.header.service') ?></th>
                  <th><?= $this->lang->line('data.product.table.header.details') ?></th>
                  <th><?= $this->lang->line('data.product.table.header.amount') ?></th>
                  <th><?= $this->lang->line('data.product.table.header.price') ?></th>
                  <?php if((int) $detail['status'] === 6): ?>
                  <th><?= $this->lang->line('data.product.table.header.stages') ?></th>
                  <?php endif ?>
                  <?php if($detail['status'] == 7 || $detail['status'] == 10) { ?>
                  <th>Download Data</th>
                  <?php } ?>
                </tr>
                <?php foreach ($detail_produk as $produk) { ?>
                <tr>
                  <td>
                    <?php
                        $suffix = $curr_lang === 'english' ? '_en' : '';
                        $con = "id_layanan = ".$produk['id_layanan'];
                        $this->db->from('m_layanan')->where($con);
                        $query = $this->db->get();
                        $layanan = $query->row('layanan'.$suffix);
                        echo empty($layanan) ? '-' : $layanan;
                    ?>
                  </td>
                  <td style="width: 350px;">
                    <?php
                      if(!empty($produk['jumlah_hari'])){
                        echo '<li>' . $this->lang->line('data.product.detail.jumlah_hari') . ' : '.$produk['jumlah_hari'].'</li>';
                      }
                      if($produk['tanggal_mulai'] && $produk['tanggal_mulai'] != '0000-00-00 00:00:00'){
                        echo '<li>'. $this->lang->line('data.product.detail.tanggal_mulai') .' : '.format_datetime($produk['tanggal_mulai']).'</li>';
                      }
                      if($produk['tanggal_selesai'] && $produk['tanggal_selesai'] != '0000-00-00 00:00:00'){
                        echo '<li>' . $this->lang->line('data.product.detail.tanggal_selesai') . ' : '.format_datetime($produk['tanggal_selesai']).'</li>';
                      }
                      if( !empty($produk['tahun']) ){
                        echo '<li>' . $this->lang->line('data.product.detail.tahun') . ' : '.$produk['tahun'].'</li>';
                      }
                      if( !empty($produk['bulan']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.bulan') . ' : '.get_nama_bulan($produk['bulan']).'</li>';
                      }
                      if( !empty($produk['provinsi']) ) {
                        $provinsi = $this->global_model->get_by_id('m_provinsi', 'id_provinsi', $produk['provinsi']);
                        echo '<li>' . $this->lang->line('data.product.detail.provinsi') . ' : '.$provinsi->provinsi.'</li>';
                      }
                      if( !empty($produk['kabupaten']) ) {
                        $kabkot = $this->global_model->get_by_id('m_kabkot', 'id_kabkot', $produk['kabupaten']);
                        echo '<li>' . $this->lang->line('data.product.detail.kabupaten') . ' : '.$kabkot->kabkot.'</li>';
                      }
                      if( !empty($produk['kecamatan']) ) {
                        $kecamatan = $this->global_model->get_by_id('m_kecamatan', 'id_kecamatan', $produk['kecamatan']);
                        echo '<li>' . $this->lang->line('data.product.detail.kecamatan') . ' : '.$kecamatan->kecamatan.'</li>';
                      }
                      if( !empty($produk['upt']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.upt') . ' : '.$produk['upt'].'</li>';
                      }
                      if( !empty($produk['tambahan_perjam']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.tambahan_perjam') . ' : '.$produk['tambahan_perjam'].'</li>';
                      }
                      if( !empty($produk['merk']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.merk') . ' : '.$produk['merk'].'</li>';
                      }
                      if( !empty($produk['no_seri']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.no_seri') . ' : '.$produk['no_seri'].'</li>';
                      }
                      if( !empty($produk['jam_mulai']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.jam_mulai') . ' : '.$produk['jam_mulai'].'</li>';
                      }
                      if( !empty($produk['edisi']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.edisi') . ' : '.$produk['edisi'].'</li>';
                      }
                      if( !empty($produk['koordinat']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.koordinat') . ' : '.$produk['koordinat'].'</li>';
                      }
                      if( !empty($produk['zona_waktu']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.zona_waktu') . ' : '.$produk['zona_waktu'].'</li>';
                      }
                      if( !empty($produk['npt']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.npt') . ' : '.$produk['npt'].'</li>';
                      }
                      if( !empty($produk['no_pendaftaran']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.no_pendaftaran') . ' : '.$produk['no_pendaftaran'].'</li>';
                      }
                      if( !empty($produk['jam_selesai']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.jam_selesai') . ' : '.$produk['jam_selesai'].'</li>';
                      }
                      if( !empty($produk['jurusan']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.jurusan') . ' : '.$produk['jurusan'].'</li>';
                      }
                      if( !empty($produk['menyerahkan_sampel']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.menyerahkan_sampel') . ' : '.$produk['menyerahkan_sampel'].'</li>';
                      }
                      if( !empty($produk['semester']) ) {
                        echo '<li>' . $this->lang->line('data.product.detail.semester') . ' : '.$produk['semester'].'</li>';
                      }
                      if( $produk['ambil_di_ptsp'] == "Ya" ) {
                        echo '<li>' . $this->lang->line('data.product.detail.ambil_di_ptsp') . ' : '.$produk['ambil_di_ptsp'].'</li>';
                      }
                      if(!empty($produk['catatan'])) {
                        echo '<li>' . $this->lang->line('data.product.table.footer.note.title') .$produk['catatan'].'</li>';
                      }
                    ?>
                  </td>
                  <td ><?= empty($produk['jumlah']) ? '0' : $produk['jumlah']; ?></td>
                  <td style="width: 150px;">Rp. <?= empty($produk['harga']) ? '0' : number_format($produk['harga'], 0 , '' , '.' ) ?></td>
                  <?php if((int) $detail['status'] === 6): ?>
                  <td class="text-success">
                      <?php
                        $process = get_process_array($detail['id_jenis_layanan']);
                        $current_process = $produk['tahapan_proses'] ?? 1;
                        $process_name = $process[$current_process - 1];
                    ?>
                      Tahap <?= $current_process ?>/4:<br><?= $process_name ?><br>
                      <div style="display: flex;">
                        <?php foreach($process as $i => $p): ?>
                        <span style="padding:4px 10px;margin-right:3px;margin-top: 4px;border:1px solid;background-color: <?= ($current_process - 1) >= $i ? '#198754' : '' ?>;"></span>
                        <?php endforeach; ?>
                      </div>
                  </td>
                  <?php endif; ?>
                  <?php if($detail['status'] == 7 || $detail['status'] == 10) { ?>
                  <td>
                    <?php
                    if( !empty($produk['download']) ) {
                      echo '<a target="_blank" class="btn btn-sm btn-primary" href="'.site_url('upload/dokumen/'.$produk['download']).'">' . $this->lang->line('data.product.download.btn') . '</a> ';
                    } else {
                      echo $this->lang->line('data.product.download.no_data');
                    }
                    ?>
                  </td>
                  <?php } ?>
                </tr>
                <?php } ?>
                  <td colspan="3">
                      <strong>
                          <?= $this->lang->line('data.product.table.footer.total') ?>
                      </strong>
                  </td>
                  <td><strong>Rp. <?= empty($detail['total_harga']) ? '0' : number_format($detail['total_harga'], 0 , '' , '.' ) ?></strong></td>
                </tr>
              </tbody>
              <tr>
                <td>
                    <strong>
                        <?= $this->lang->line('data.product.table.footer.note.title') ?>
                    </strong>
                </td>
              </tr>
              <tr>
                  <td>
                    <strong>
                        <?= $this->lang->line('data.product.table.footer.note.content.1') ?>
                    </strong>
                  <br>
                    <strong>
                        <?= $this->lang->line('data.product.table.footer.note.content.2') ?>
                    </strong>
                 </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-footer" style="text-align: center;">
            <button type="button" class="btn btn-primary" onclick="<?= $url_back ?>">
                <?= $this->lang->line('button.back') ?>
            </button>
            <a class="btn btn-success" href="<?= site_url('backend/permohonan_layanan/permohonan_layanan/invoice/'.$detail['id_permohonan']) ?>" target="_blank">
                <?= $this->lang->line('button.invoice') ?>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>

<?php if((($role_user == 1) || ($role_user == 2) || ($role_user == 3))): ?>
<script>
  $(document).ready(function() {
    const _status = '<?= $detail['status'] ?>';
    $('select[name="status"]').on('change', function() {
      var status = $(this).val();
      var id_tp = '<?= $detail['id_permohonan'] ?>';

      return confirm('Apakah anda yakin ingin mengubah status permohonan ini?') ? changeStatus(status, id_tp) : defaultStatus(); ;
    });

    function changeStatus(status, id_tp) {
      $.ajax({
        url: '<?= site_url('backend/permohonan_layanan/permohonan_layanan/update_status') ?>',
        type: 'POST',
        dataType: 'JSON',
        data: {
          id_tp: id_tp,
          status: status
        },
        success: function(result) {
          alert(result.message);
          location.reload();
        },
        error: function(result) {
          alert(result.responseJSON.message);
          defaultStatus();
        }
      });
    }

    function defaultStatus() {
      $('select[name="status"]').val(_status);
    }
  });
</script>
<?php endif; ?>
