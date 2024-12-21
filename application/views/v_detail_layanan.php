<div class="beranda-area">
	<div class="container">
		<div class="beranda-top">
			<ul>
				<li class="me-3">
					<a class="text-dark fw-bold" href="<?= base_url() ?>">
						<?= translate(37) ?>
					</a>
				</li>
				<li class="me-3"><a class="text-dark fw-bold text-nowrap" href="<?= base_url() .
					"katalog_pelayanan" ?>"><?= translate(1) ?></a></li>
				<li class="me-3"><a class="text-dark fw-bold text-nowrap" href="<?= base_url() .
					"katalog_pelayanan/" .
					$jenis_layanan ?>">
						<?= $detail_layanan["id_jenis_layanan"] == 1
							? translate(113)
							: translate(114) ?></a></li>
				<li class="text-secondary mobile-none"><?= $detail_layanan["layanan" . $bahasa] ?></li>
			</ul>
		</div>
		<div class="beranda-main">
			<div class="beranda-main-item">
				<h3><?php echo translate(1); ?></h3>
				<div class="Jumlah-border">
					<div class="Jumlah-border-left Jumlah-border-left3"></div>
					<div class="Jumlah-border-right Jumlah-border-right3"></div>
				</div>
			</div>

			<div class="row mt-3">
				<?= $this->session->flashdata('not_1') ?>
				<div class="col d-flex mb-mobile">
					<div class="me-2 <?= $jenis_layanan === 'informasi' ? 'btn-katalog-green' : 'btn-katalog-blue' ?>">
						<a href="<?= base_url() . "katalog_pelayanan/informasi" ?>" class="text-white">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
								class="bi bi-info-circle me-1" viewBox="0 0 16 16">
								<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
								<path
									d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
							</svg><?php echo translate(113); ?>
						</a>
					</div>
					<div class="<?= $jenis_layanan === 'jasa' ? 'btn-katalog-green' : 'btn-katalog-blue' ?>">
						<a href="<?= base_url() . "katalog_pelayanan/jasa" ?>" class="text-white">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
								class="bi bi-person-raised-hand me-1" viewBox="0 0 16 16">
								<path
									d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a1 1 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207" />
								<path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
							</svg><?php echo translate(114); ?>
						</a>
					</div>
				</div>
				<div class="col d-flex justify-content-end">
					<div class="hd-searchbar">
						<form class="search" method="get" action="<?php echo base_url() .
							"search_katalog/index"; ?>">
							<button class="cari-katalog" type="submit"><i
									class="fa-solid fa-magnifying-glass"></i></button>
							<input id="search_katalog" name="search_katalog" style="background: white; padding-left: 40px;" maxlength="100"
								type="search" placeholder="<?= $bahasa ==
									""
									? "  Cari layanan informasi/jasa"
									: "  Search for information/services" ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="">
						</form>
					</div>
					<div class="d-flex" id="langChange">
						<div class="d-flex align-items-center me-1">
							<input type="radio" name="l" id="toAr" checked />
							<a href="<?= base_url() . "katalog_pelayanan/proses_pesanan/" ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-cart4" viewBox="0 0 16 16">
									<path
										d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
								</svg>
							</a>
						</div>
						<div class="d-flex align-items-center">
							<input type="radio" name="l" id="toEn" checked />
							<a style="padding:4px 8px; text-align:center;" href="<?= base_url() .
								"katalog_pelayanan/proses_pesanan/" ?>"><?= $this->cart->total_items() ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-3 p-4" style="background-color: #D9EBE1; border-radius: 30px;">
				<h5><?= $detail_layanan["layanan" . $bahasa] ?></h5>
				<div class="col-md-8">
					<div class="row mb-3">
						<div class="col-sm-3 d-flex align-items-center">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
								class="bi bi-check2-square me-2" viewBox="0 0 16 16">
								<path
									d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z" />
								<path
									d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0" />
							</svg>
							<label for="satuan" class="col-form-label"><?= $bahasa == ""
								? "Satuan"
								: "Unit" ?></label>
						</div>

						<div class="col-sm-9">
							<input style="background-color: #D9D9D9" type="text" class="form-control" id="satuan" value="<?= empty(
								$detail_layanan["satuan"]
							)
								? " - "
								: ucwords($detail_layanan["satuan" . $bahasa]) ?>" readonly>
						</div>
					</div>
					<!-- <div class="row mb-3">
						<div class="col-sm-3 d-flex align-items-center">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
								class="bi bi-basket3 me-2" viewBox="0 0 16 16">
								<path
									d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6z" />
							</svg>
							<label for="berat" class="col-form-label"><?= $bahasa == ""
								? "Berat"
								: "Weight" ?></label>
						</div>

						<div class="col-sm-9">
							<input style="background-color: #D9D9D9" type="text" class="form-control" id="berat" value="<?= empty(
								$detail_layanan["berat"]
							)
								? " - "
								: $detail_layanan["berat"] .
								" " .
								$detail_layanan["satuan_berat"] ?>" readonly>
						</div>
					</div> -->
                    <div class="row mb-3">
                        <div class="col-sm-3 d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag me-2" viewBox="0 0 16 16">
                                <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0"/>
                                <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1m0 5.586 7 7L13.586 9l-7-7H2z"/>
                            </svg>
                            <?= $bahasa == "" ? "Harga Satuan" : "Unit Price"?></li></ul>
                        </div>
						<div class="col-sm-9">
                            <input style="background-color: #D9D9D9" type="text" class="form-control mb-1" id="satuan" value=" <?= 'Rp. '.number_format($detail_layanan['harga'],0,',','.') ?>" readonly>
						</div>
                    </div>
					<div class="row mb-3">
						<div class="col-sm-3 d-flex align-items-center">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
								class="bi bi-person-workspace me-2" viewBox="0 0 16 16">
								<path
									d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
								<path
									d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.4 5.4 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2z" />
							</svg>
							<label for="back_office" class="col-form-label">Back Office</label>
						</div>

						<div class="col-sm-9">
							<input style="background-color: #D9D9D9" type="text" class="form-control" id="back_office"
								value="<?= $this->db
									->get_where("tbl_role", [
										"id_role" => $detail_layanan["penanggung_jawab"],
									])
									->row("role") ?>" readonly>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-sm-3 d-flex align-items-start">
							<div class="py-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-file-earmark-check me-2" viewBox="0 0 16 16">
									<path
										d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
									<path
										d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
								</svg>
							</div>
							<label for="data_diperlukan" class="col-form-label"><?= translate(
								91
							) ?></label>
						</div>

						<div class="col">
							<form id="form-input"
								action="<?= site_url() . '/katalog_pelayanan/tambah_layanan/' . $id_layanan.(isset($id_cart)?"/$id_cart":"") ?>"
								method="post" class="bg-white p-2 rounded-2"></form>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<?php if ($detail_layanan['contoh']): ?>
						<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
							<img class="w-100" src="<?= base_url() . 'upload/dokumen/' .  $detail_layanan['contoh'] ?>">
						</a>
					<?php else: ?>
							<img class="w-100" src="<?= base_url() . 'resources/images/noimage.png' ?>">
					<?php endif ?>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-3">
						<p>Total</p>
						<h4 class="text-danger">
						    <span id="total-price"></span>
						</h4>
					</div>
					<div class="col-sm-6 d-flex align-items-center">
						<!-- <form id="form-submit"> -->
						<button id='btn-submit' type="button" class="btn btn-info text-white">
							<?= $bahasa == "" ? (empty($id_cart)?"Masukkan Keranjang":"Update Keranjang") : (empty($id_cart)?"Add Cart":"Update Cart") ?>
						</button>
						<!-- </form> -->
						<?php if (!empty($layanan)) { ?>
							<p class="mx-2 m-0"><?= $bahasa == "" ?"atau":"or"?></p>
							<a href="<?= site_url(
								"katalog_pelayanan/validasi_pesanan"
							) ?>" class="btn btn-flat btn-success"><?= translate(
							 	84
							 ) ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contoh surat permohonan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  	<?php if ($detail_layanan['contoh']): ?>
			<img class="w-100" src="<?= base_url() . 'upload/dokumen/' .  $detail_layanan['contoh'] ?>">
		<?php else: ?>
			<img class="w-100" src="<?= base_url() . 'resources/images/noimage.png' ?>">
		<?php endif ?>
      </div>
      <div class="modal-footer justify-content-start">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- // <script>
// $(document).on('ready', function() {
//     $('#totalPrice').text('<?= $detail_layanan['harga'] ?>').mask('000.000.000', {reverse: true});
// });
// </script> -->
