<?php

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
                <div class="">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th class="">No Permohonan</th>
                            <th class="">Pemohon</th>
                            <th class="">Perusahaan</th>
                            <th class="">Layanan</th>
                            <th class="">Jumlah</th>
                            <th class="">Harga</th>
                            <th class="">Bukti Transfer</th>
                            <th class="">Status</th>
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
