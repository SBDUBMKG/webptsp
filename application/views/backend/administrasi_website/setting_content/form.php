<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined("BASEPATH") or exit("No direct script access allowed"); ?>
<!-- /.row -->
<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url() .
            $this->module; ?>"><?php echo $page_title; ?></a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $title; ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <?php if (!empty($errMsg)) { ?>
                            <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                            <?php } ?>
                        <div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Variable Task</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control" name="variable_task" value="<?php echo empty(
                           $detail["variable_task"]
                       )
                           ? null
                           : $detail[
                               "variable_task"
                           ]; ?>" max_length="100">
                   </div>
                </div>
                <?php $tipe = isset($id) && $id == 3 ? "password" : "text"; ?>
                <div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Value Task</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                    <?php if (isset($id) && $id == 3): ?>
                       <input type="password" class="form-control" name="value_task" value="" max_length="255" required>
                    <?php elseif (isset($id) && $id == 5): ?>
                       <select class="form-control cmb_select2" id="value_task" name="value_task">
                          <option>- SMTP Secure -</option>
                          <option value="None" <?php echo (empty(
                              $detail["value_task"]
                          )
                              ? null
                              : $detail["value_task"]) == "None"
                              ? "selected"
                              : null; ?> >None</option>
                          <option value="TLS" <?php echo (empty(
                              $detail["value_task"]
                          )
                              ? null
                              : $detail["value_task"]) == "TLS"
                              ? "selected"
                              : null; ?> >TLS</option>
                          <option value="SSL" <?php echo (empty($detail["SSL"])
                              ? null
                              : $detail["SSL"]) == "SSL"
                              ? "selected"
                              : null; ?> >SSL</option>
                      </select>
                    <?php else: ?>
                        <input type="text" class="form-control" name="value_task" value="<?php echo empty(
                            $detail["value_task"]
                        )
                            ? null
                            : $detail[
                                "value_task"
                            ]; ?>" max_length="255" required>
                    <?php endif; ?>
                   </div>
                </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        $(".textarea").wysihtml5();
        $('.datepicker').datepicker({
            autoclose: true
        });
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
    });
</script>