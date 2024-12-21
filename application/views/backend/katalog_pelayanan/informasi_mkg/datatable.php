<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$id_role = $this->session->userdata('id_role');
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
                            <!-- Awal script yang diedit Nurhayati Rahayu 15 Juni 2022 -->
                            <th>Tanggal Permohonan</th>
                            <th>Tanggal Verifikasi Pembayaran</th>
                            <!--<th>Tanggal</th>-->
                            <!-- Akhir script yang diedit Nurhayati Rahayu 15 Juni 2022 -->
                            <?php if($id_role > 8){ ?><th>Jenis Layanan</th><?php } ?>
                            <?php if($id_role < 4 || $id_role > 8){ ?><th style="width: 200px;text-align: center;">Perusahaan</th><?php } ?>
                            <?php if($id_role < 4 || $id_role > 8){ ?><th style="width: 200px;text-align: center;">Nama Pemohon</th><?php } ?>
                            <!--Baris awal menambahkan kolom alamat. Perbaikan oleh Nurhayati Rahayu (15/03/2024) -->
                            <?php if($id_role < 4 || $id_role > 8){ ?><th>Alamat</th><?php } ?>
                            <!--Baris akhir menambahkan kolom alamat. Perbaikan oleh Nurhayati Rahayu (15/03/2024) -->
                            <th>No. HP</th>
                            <?php if($id_role > 8){ ?><th>Due Date</th><?php } ?>
                            <!-- Awal script yang diedit Rahmat 6 Mei 2020 -->
                            <!-- <th>Status</th> dan <th>Aksi</th> diberi tambahan script dimana hanya BO yang menampilkan kolom tsb -->
                            <?php if($id_role > 8){ ?><th>Status</th><?php } ?>   
                            <!-- <?php if($id_role > 8){ ?><th>Aksi</th><?php } ?> -->
                            <!-- Akhir script yang diedit Rahmat 6 Mei 2020 -->
                            <?php echo $this->is_write ? '<th style="width: 100px;text-align: center;">Navigasi</th>' : NULL; ?>
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
