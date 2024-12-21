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
                            <th>Tanggal</th>
                            <?php if($id_role > 8){ ?><th>Jenis Layanan</th><?php } ?>
                            <?php if($id_role < 4 || $id_role > 8){ ?><th>Pemohon</th><?php } ?>
                            <th>Status</th>   
                            <th>Aksi</th>
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
