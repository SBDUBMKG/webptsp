<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$curr_lang = $this->session->userdata('language');
$this->lang->load('backend/complaint/respond', $curr_lang);
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
                    <h3 class="box-title"> <?= $this->lang->line('title.card.first') ?> </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <?php
                        if ( !empty($errMsg) ) {
                            ?>
                            <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12"> <?= $this->lang->line('form.complaint.name') ?> </label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" max_length="50" disabled>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12"><?= $this->lang->line('form.complaint.email') ?></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" max_length="50" disabled>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12"><?= $this->lang->line('form.complaint.complaint') ?> </label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <textarea class="textarea" name="pengaduan" id="text_pengaduan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" disabled><?php echo empty($detail['pengaduan']) ? NULL : $detail['pengaduan']; ?></textarea>
                           </div>
                        </div>

                        <h4 class="box-title"><?= $this->lang->line('title.card.second') ?>  </h4>
                        <hr>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12"> <?= $this->lang->line('form.respond.response') ?>  </label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <textarea class="textarea" name="response" id="text_response" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['response']) ? NULL : $detail['response']; ?></textarea>
                           </div>
                        </div>

<!--    Gak perlu di munculin kalo pengaduan send mail dan publish -->                        
<!--                      <?php if (($id_role == 1 || $id_role == 2 || $id_role == 3) && $detail['is_response'] == 0): ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Send Mail </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <label class="radio-inline"><input type="radio" value="1" name="is_response" <?php echo isset($detail['is_response']) && $detail['is_response'] == 1 ? 'checked' : NULL; ?>>
                                        Ya
                                    </label>
                                    <label class="radio-inline"><input type="radio" value="0" name="is_response" <?php echo isset($detail['is_response']) && $detail['is_response'] == 0 && is_numeric($detail['is_response']) ? 'checked' : NULL; ?>>
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">  <?= $this->lang->line('form.respond.publish') ?> </label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <label class="radio-inline"><input type="radio" value="1" name="is_publish" <?php echo isset($detail['is_publish']) && $detail['is_publish'] == 1 ? 'checked' : NULL; ?>>
                                   <?= $this->lang->line('form.respond.publish.true') ?>
                               </label>
                               <label class="radio-inline"><input type="radio" value="0" name="is_publish" <?php echo isset($detail['is_publish']) && $detail['is_publish'] == 0 && is_numeric($detail['is_publish']) ? 'checked' : NULL; ?>>
                                   <?= $this->lang->line('form.respond.publish.false') ?>
                               </label>
                           </div>
                        </div>
                    </div> -->
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">
                            <?= $this->lang->line('form.button.back') ?>
                        </button>
<?php                   if($detail['is_response']==0) {
?>                          <button type="submit" class="btn btn-success">
                                <?= $this->lang->line('form.button.save') ?>
                            </button>
<?php                   }                            
?>                  </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(function () {
        $("#text_pengaduan").summernote('disable');
<?php   if($detail['is_response']==0) {
?>          $("#text_response").summernote({height: 150});
<?php   } else {
?>          $("#text_response").summernote('disable');        
<?php     }
?>      $('.datepicker').datepicker({
            autoclose: true
        });
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
    });
</script>
