<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
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
		<!-- Baris awal penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (08 Mei 2024) -->
                <?php
                if ( $this->is_write ) {
                    ?>
                    <div class="box-header">
                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <button class="btn btn-primary" onClick="document.location = '<?php echo base_url().$this->module.'/add' ?>'">Tambah Data</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!-- Baris akhir penggantian tombol navigasi. Perbaikan oleh Nurhayati Rahayu (08 Mei 2024) -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                            <tr>
                                <th style="width: 20px;text-align: center;">No</th>
                                <th style="text-align: center;">Kategori Menu</th>
                                <th style="text-align: center;">Menu</th>
                                <th style="text-align: center;">Controller</th>
                                <th style="text-align: center;">Uri</th>
                                <th style="text-align: center;">Urutan Menu</th>
                                <?php echo $this->is_write ? '<th style="width: 100px;text-align: center;">Navigasi</th>' : NULL; ?>
                                <!-- <th></th> -->
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