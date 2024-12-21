<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

// Awal script yang ditambahkan Rahmat, 17 Juni 2020
$id_role = $this->session->userdata('id_role');
// Akhir script yang ditambahkan Rahmat, 17 Juni 2020

?>
<section class="content-header">
    <h1><?php echo $title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>No Permohonan</th>

                            <!-- Awal script yang ditambahkan Rahmat, 17 Juni 2020 -->
                            <th>Pemohon</th>
                            <th>Perusahaan</th>
                            <th>Layanan</th>
                            <!-- Akhir script yang ditambahkan Rahmat, 17 Juni 2020 -->

                            <th>Jumlah</th>
                            <th>Harga</th>

			    <!-- Awal script yang ditambahkan Nurhayati Rahayu, 24 Juni 2020 --> 	
			    <th>Bukti Transfer</th>
			    <!-- Akhir script yang ditambahkan Nurhayati Rahayu, 24 Juni 2020 --> 	

                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
