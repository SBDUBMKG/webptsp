<?php
$this->load->model('global_model');
$lang = $this->session->userdata('bahasa');

$locale_format = strlen($lang) === 0 ? 'id_ID.UTF-8' : 'en_US.UTF-8';
setlocale(LC_TIME, $locale_format);

function format_date($date, $add = '') {
    $ts = strtotime($date . $add);
    return strftime('%d %B %Y', $ts);
}

$current_libur = $this->global_model->get_list('tbl_libur','curdate() between tgl_mulai and tgl_akhir')[0];
?>

<div class="m-5 py-5">
  <main class="hoc container center clear text-center">
    <div class="content">
      <div class="error_page">
      <?php if ($this->session->userdata("bahasa") === "_en"): ?>
        <br>
        <h3>We Are Sorry</h3>
        <figure>
            <img src="<?php echo base_url() .
                "resources/frontend/images/404.png"; ?>" style="max-width:250px">
        </figure>
        <p>
            Due to the
            <?= $current_libur->keterangan ?>
            on
            <?= format_date($current_libur->tgl_mulai) ?>
            -
            <?= format_date($current_libur->tgl_akhir) ?>.
            PTSP services is temporary unavailable. PTSP services can be accessed again
            on
            <?= format_date($current_libur->tgl_akhir, ' + 1 days') ?>.
            Thank you</p>
        <span></span>
        <a href="<?php echo base_url(); ?>" class="btn btn-sm btn-warning">Go to home page</a>
        <br>
        <br>
      <?php else: ?>
        <br>
        <h3>Kami Mohon Maaf</h3>
        <figure>
          <img src="<?php echo base_url() .
              "resources/frontend/images/404.png"; ?>" style="max-width:250px">
        </figure>
        <p>
            Sehubungan dengan
            <?= $current_libur->keterangan ?>
            mulai
            <?= format_date($current_libur->tgl_mulai) ?>
            sampai dengan
            <?= format_date($current_libur->tgl_akhir) ?>.
            Pelayanan Terpadu Satu Pintu (PTSP) BMKG Pusat Tidak Memberikan Layanan/Libur.
            Layanan akan kembali dibuka pada tanggal
            <?= format_date($current_libur->tgl_akhir, ' + 1 days') ?>.
        </p>
        <span></span>
        <a href="<?php echo base_url(); ?>" class="btn btn-sm btn-warning">Kembali ke halaman beranda</a>
        <br>
        <br>
      <?php endif; ?>
      </div>
    </div>
  </main>
</div>
