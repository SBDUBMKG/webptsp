<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- /.row -->
<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url().$this->module; ?>"><?php echo $page_title; ?></a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Pengaduan</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <?php if(empty($detail['response'])){ ?>
                        <div class="alert alert-danger" role="alert">Maaf, pengaduan anda belum direspon</div>
                        <?php } else { ?>
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td>Pengaduan</td>
                                <td width="5px">:</td>
                                <td><?php echo $detail['pengaduan']?></td>
                            </tr>
                            <tr>
                                <td>Oleh</td>
                                <td width="5px">:</td>
                                <td><?php echo $detail['nama'].' <em>('.$detail['email'].')</em>' ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td width="5px">:</td>
                                <td><?php echo format_datetime($detail['waktu_pengaduan'])?></td>
                            </tr>
                            <tr>
                                <td>Respon PTSP</td>
                                <td width="5px">:</td>
                                <td><?php echo $detail['response'] ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
