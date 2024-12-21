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
                <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>Judul</th>
                            <th>Judul En</th>
                            <th>Penyelenggara</th>
                            <th>Penyelenggara En</th>
                            <th>Lokasi</th>
                            <th>Lokasi En</th>
                            <th>Jam</th>
                            <th>Disposisi</th>
                            <th>Dihadiri</th>
                            <th>Keterangan</th>
                            <th>Keterangan En</th>
                            <th>Foto</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Selesai</th>
            
                            <th></th>
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
