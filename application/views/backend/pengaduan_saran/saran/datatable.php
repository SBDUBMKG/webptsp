<?php
//file: application\views\backend\pengaduan_saran\saran\datatable.php
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
                                <th style="width: 20px;text-align: center;">No</th>
                                <th style="text-align: center;">Waktu Saran</th>            
                                <th style="text-align: center;">Nama</th>            
                                <th style="text-align: center;">Email</th>            
                                <th style="text-align: center;">Publish</th>            
                                <?php echo $this->is_write ? '<th style="width: 120px;text-align: center;">Navigasi</th>' : NULL; ?>
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