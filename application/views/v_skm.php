<div class="beranda-area">
			<div class="container">
				<div class="beranda-top">
					<ul>
						<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
						<li class="text-secondary"><?= $bahasa == "" ? "Survei Kepuasan Masyarakat" : "Public Satisfaction Survey"?></li>
					</ul>
				</div>
				<div class="beranda-main">
					<div class="beranda-main-item">
						<h3><?= $bahasa == "" ? "Survei Kepuasan Masyarakat" : "Public Satisfaction Survey"?></h3>
						<div class="Jumlah-border">
							<div class="Jumlah-border-left Jumlah-border-left3"></div>
							<div class="Jumlah-border-right Jumlah-border-right3"></div>
						</div>
					</div>
					<div class="beranda-main2">
						<div class="row mt-3">
							<h6 class="text-center my-3"><?= $bahasa == "" ? "Laporan Survei Kepuasan Masyarakat PTSP BMKG" : "PTSP BMKG Public Satisfaction Survey Report"?> </h6>
							<table class="table table-striped">
							    <thead class="table-dark">
							    <tr>
							      <th scope="col" class="text-center">No</th>
							      <th scope="col" class="text-center"><?= $bahasa == "" ? "Tahun" : "Year"?></th>
							      <th scope="col" class="text-center"><?= $bahasa == "" ? " Lihat / Download" : " View / Download"?></th>
							    </tr>
							  </thead>
							  <tbody>
								<?php foreach ($entries as $no => $entry) : ?>
									<?php $file = urlencode(base64_encode(encrypt($entry->file))) ?>
									<tr>
									  <th class="text-center" scope="row"><?= $no + 1 ?></th>
									  <td class="text-center"><?= $entry->tahun ?></td>
									  <td class="text-center">
										  <a class="btn btn-sm btn-primary" target="_blank" href="<?= base_url() ?>skm/embed/<?= $file ?>" role="button">
											  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
												  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
												  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
												</svg>
											</a>
										  <a class="btn btn-sm btn-success" target="_blank" href="<?= base_url() ?>skm/download/<?= $file ?>" role="button">
											  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
											  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
											  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
											</svg>
										  </a>
									  </td>
									</tr>
								<?php endforeach ?>
							  </tbody>
							</table>
						</div>
					</div>			
				</div>												
			</div>
		</div>