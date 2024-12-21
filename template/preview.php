<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
    <?php echo $breadcrumb; ?>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $title; ?></h3>
                </div>
                <div class="box-body form-horizontal">
                    {_form_content_}
                </div>
                <div class="box-footer" style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</section>