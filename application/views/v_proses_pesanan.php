<?php $total = 0 ?>

<div class="beranda-area pb-0">
    <div class="container">
      <div class="beranda-top">
        <ul>
          <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
          <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url().'katalog_pelayanan'; ?>"><?= translate(1);?></a></li>
          <li class="text-secondary"><?= $bahasa == "" ? "Keranjang" : "Cart" ?></li>
        </ul>
      </div>
      <div class="beranda-main mb-4">
        <div class="beranda-main-item">
          <h3><?= $bahasa == "" ? "Keranjang" : "Cart" ?></h3>
          <div class="Jumlah-border">
            <div class="Jumlah-border-left Jumlah-border-left3"></div>
            <div class="Jumlah-border-right Jumlah-border-right3"></div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col d-flex justify-content-end">
            <div class="d-flex" id="langChange" style="min-width:50px">
              <div class="d-flex align-items-center me-1">
                <input type="radio" name="l" id="toAr" checked />
                <a href="<?= base_url().'katalog_pelayanan/proses_pesanan/' ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                  <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                  </svg>
                </a>
              </div>
              <div class="d-flex align-items-center">
                <input type="radio" name="l" id="toEn" checked />
                <a style="padding:4px 8px; text-align:center;" href="<?= base_url().'katalog_pelayanan/proses_pesanan/' ?>"><?= $this->cart->total_items() ?></a>
              </div>
            </div>
          </div>
        </div>

        <?= $this->session->flashdata('not_1') ?>
        <?= $this->session->flashdata('not_2') ?>
        <h3><?= translate(84) ?></h3>

        <?php if(!empty($layanan)){ ?>
        <?php
        //var_dump($layanan);
          foreach ($layanan as $value) { ?>
        <form
            id="card-item-<?php echo $value['rowid'] ?>"
            method="post"
            action="<?= site_url() . 'katalog_pelayanan/update_pesanan/'.$value['id'] ?>"
            class="row mt-3 p-4 mb-4"
            style="background-color: #D9EBE1; border-radius: 30px;"
        >
            <table style="border:0">
              <tr>
                <div class="d-flex justify-content-between px-0 mobile-block">
                  <h5 style="max-width: 80%;"><?= $value['options']['layanan'.$bahasa] ?></h3>
                  <div class="" style="display: inline-block; transform: scale(1.2);transform-origin: bottom;">

                    <!-- Disabled button -->
                    <!-- <button id="btn-update" class="btn px-1 text-secondary" type="submit" disabled>
                          <i class="fa fa-fw fa-md fa-circle-check"></i>
                    </button>
                    <button id="btn-edit" class="btn px-1 text-success" type="button" onclick="editPesanan('<?php echo $value['rowid'] ?>')">
                          <i class="fa fa-fw fa-md fa-file-pen"></i>
                    </button> -->

                    <a href="<?= site_url('katalog_pelayanan/detail_layanan/'.$value['id'].'/'.$value['rowid']) ?>" class="text-success" data-bs-toggle="tooltip" title="<?= $bahasa == "" ? "Ubah" : "Edit"?>"><i class="fa fa-fw fa-md fa-file-pen"></i></a>
                    <a href="<?= site_url('katalog_pelayanan/hapus_pesanan/'.$value['rowid']) ?>" class="text-danger" onclick="if(!confirm('<?php echo translate(93);?>')) return false;" data-bs-toggle="tooltip" title="<?= $bahasa == "" ? "Hapus" : "Delete"?>"><i class="fa fa-fw fa-md fa-trash"></i></a>
                  </div>
                </div>
              </tr>
              <tr>
                <td class="new-line" width="20%" style="border:0"><ul><li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square me-2" viewBox="0 0 16 16">
                    <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z"/>
                    <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0"/>
                  </svg> <?= $bahasa == "" ? "Satuan" : "Unit"?></li></ul></td>
                <td class="new-line" style="border:0">
                  <input style="background-color: #D9D9D9" type="text" class="form-control mb-1" id="satuan" value="<?php echo empty($value['options']['satuan']) ? ' - ' : ucwords($value['options']['satuan'.$bahasa]); ?>" readonly>
                </td>
              </tr>
              <!-- <tr>
                <td class="new-line" width="20%" style="border:0"><ul><li>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3 me-2" viewBox="0 0 16 16">
                    <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6z"/>
                  </svg>
                  <?= $bahasa == "" ? "Berat" : "Weight"?></li></ul></td>
                <td class="new-line" style="border:0">
                  <input style="background-color: #D9D9D9" type="text" class="form-control mb-1" id="satuan" value=" <?php echo empty($value['options']['berat']) ? ' - ' : $value['options']['berat'].' '.$value['options']['satuan_berat']; ?>" readonly>
                </td>
              </tr> -->
                <?php
                  $harga = 'Rp. '.number_format($value['options']['harga'],0,',','.');
                  $subtotal = 'Rp. '.number_format($value['subtotal'],0,',','.');
                  $total += $value['subtotal'];
                ?>
              <tr>
                <td class="new-line" width="20%" style="border:0"><ul><li>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag me-2" viewBox="0 0 16 16">
                    <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0"/>
                    <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1m0 5.586 7 7L13.586 9l-7-7H2z"/>
                  </svg>
                  <?= $bahasa == "" ? "Harga Satuan" : "Unit Price"?></li></ul></td>
                <td class="new-line" style="border:0">
                  <input style="background-color: #D9D9D9" type="text" class="form-control mb-1" id="satuan" value=" <?php echo empty($value['options']['harga']) ? ' - ' : $harga; ?>" readonly>
                </td>
              </tr>
              <tr>
                <td class="new-line" width="20%" style="border:0"><ul><li>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace me-2" viewBox="0 0 16 16">
                    <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                    <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z"/>
                  </svg>
                Back Office</li></ul></td>
                <td class="new-line" style="border:0">
                  <input style="background-color: #D9D9D9" type="text" class="form-control mb-1" id="satuan" value="<?= $this->db->get_where('tbl_role', ['id_role' => $value['options']['penanggung_jawab']])->row('role') ?>" readonly>
                </td>
              </tr>
              <tr valign="top">
                <td class="new-line" style="border:0; margin-top: 0px;" class="py-2">
                    <ul>
                        <li style="margin-top: 10px">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-check me-2" viewBox="0 0 16 16">
                                <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
                            </svg>
                            <?= translate(91) ?>
                        </li>
                    </ul>
                </td>
                <td class="new-line" class="">
                    <div id="container-<?= $value['rowid'] ?>" style="background-color: #D9D9D9" class="p-3 rounded">
                        <input name='rowid' id="rowid" type="hidden" value="<?= $value['rowid'] ?>" />
                        <?php
                          $cols= json_decode(str_replace("'", '"', $value['options']['display_coloumn'.$bahasa]), true);
                          $data = json_decode($value['payload'], true);
                          foreach($data as $key => $val) {
                            echo '<div class="form-group row align-items-center py-1">';
                            echo '<label for="' . $key . '" class="control-label col-sm-3">' . $cols[$key] . '</label>';
                            echo '<div class="col-sm-9"><input id="' . $key . '" name="' . $key . '" value="'.$val.'" type="text" class="form-control bg-transparent border-0" readonly disabled /></div>';
                            echo '</div>';
                          }
                        ?>
                    </div>
                </td>
              </tr>
            </table>
            <hr class="my-4">
            <div class="row">
                <div class="col-sm-3">
                  <p><?= $bahasa == "" ? "Subtotal" : "Subtotal"?></p>
                  <h4 class="text-danger"><?= empty($subtotal) ? "-" : $subtotal; ?></h4>
                </div>
            </div>
        </form>

        <?php } ?>
        <?php } else { ?>
          <p><?= translate(87) ?></p>
        <?php } ?>
        <div class="row mt-3 p-4 mb-4 text-end" style="background-color: #D9EBE1; border-radius: 30px;">
            <h4 class="text-danger">Total: <?= 'Rp. '.number_format($total,0,',','.') ?></h4>
        </div>
        <div class="row mt-3 p-4 mb-4" style="background-color: #FFF; border-radius: 30px;">
          <!-- Tambah keterangan data yang perlu diupload. Perubahan dilakukan oleh : Nurhayati Rahayu (08/06/2022) -->
          <span><em><?= $bahasa == "" ? "Perhatian : " : "Attention : "?></em></span><br>
          <span><em><?= $bahasa == "" ? "Untuk proses selanjutnya, Anda HARUS untuk menyiapkan dokumen permohonan layanan dalam bentuk file PDF yang berisi : " : "For the next process, you MUST prepare a service request document in the form of a PDF file containing:"?></em></span><br>
          <!-- <span><em>* KTP </em></span><br> -->
          <?php
            $labels = ['english' => "ID Number", 'indonesia' => "KTP"];
            $id_role = $this->session->userdata('id_role');
            $identity = $this->session->userdata('foto_ktp');
            $curr_lang = $this->session->userdata('language');

            if ($id_role === 7 && $identity === null) {
                echo "<span><em>* " .$labels[$curr_lang] ."</em></span><br>";
            }
          ?>
          <span><em>* <?= $bahasa == "" ? "Surat permohononan permintaan data" : "Data request application letter"?></em></span><br>
          <span><em>* <?= $bahasa == "" ? "Surat tugas" : "Letter of assignment"?></em></span><br>
          <div class="col my-2">
            <a class="btn btn-sm btn-primary" href="<?= base_url().'upload/Format_surat_permohonan.zip';?>"><?= translate('proses_pemesanan_download_surat_permohonan', true) ?></a>
          </div>
          <span><em><?= $bahasa == "" ? " Bagi pelanggan yang melakukan permohonan PELAYANAN JASA KALIBRASI ALAT MKG, setelah mengunggah dokumen permohonan layanan, dalam kurun waktu maksimal 2 x 24 jam WAJIB datang ke kantor PTSP dengan membawa alat untuk dilakukan pengecekan." : "For customers who request MKG EQUIPMENT CALIBRATION SERVICES, after uploading the service request document, within a maximum period of 2 x 24 hours you MUST come to the PTSP office with the equipment to be checked."?> </em></span><br><br>
          <!-- baris terakhir perbaikan -->

          <div class="form-group mt-2">
            <button type="button" class="btn btn-flat btn-primary" onclick="location.href='<?= ($_SERVER['HTTP_REFERER'] != base_url() . "katalog_pelayanan/proses_pesanan/" && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : base_url().'katalog_pelayanan' ?>'">
              <?= translate(83) ?>
            </button>
            <?php if(!empty($layanan)){ ?>
              <a href="<?= site_url('katalog_pelayanan/validasi_pesanan') ?>" class="btn btn-flat btn-success"><?= translate(84) ?></a>
            <?php } ?>
          </div>
        </div>

    </div>
</div>


<script>
  function editPesanan(rowid) {
    // $('#card-item-'+rowid + ' #btn-update').removeAttr('disabled').removeClass('text-secondary').addClass('text-success')
    // $('#card-item-'+rowid + ' #btn-edit').attr('disabled', '').removeClass('text-success').addClass('text-secondary')
    $('#container-' + rowid + ' > div.form-group > div > input').removeClass('bg-transparent').removeClass('border-0').removeAttr('readonly').removeAttr('disabled');
  }

  function updatePesanan(rowid)
  {
      $('#form-'+rowid).submit()
  }

</script>
