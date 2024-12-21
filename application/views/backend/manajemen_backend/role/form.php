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
                    <h3 class="box-title"><?php echo $title; ?></h3>
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
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12" id="fg-role">
                       <input type="text" class="form-control" id="role" name="role" value="<?php echo empty($detail['role']) ? NULL : $detail['role']; ?>" max_length="30" required>
                        <span class="help-block" id="is_valid_role"></span>
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
    $(document).ready(function() {
        $('#role').on('keydown keyup change', function(){
            var role = $('#role').val();
            $.ajax({
              url : "<?php echo base_url() .$this->module.'/cek_role'?>",
              type: "POST",
              data      : {
                  role   : role
              },
              dataType: "JSON",
              success: function(data)
              {
                if (data) {
                    $('#is_valid_role').text('Role sudah ada, ganti lainnya!');
                    var element = document.getElementById("fg-role");
                    element.classList.add("has-error");
                    element.classList.remove("has-success");
                } else {
                    $('#is_valid_role').text('Role Tersedia');
                    var element = document.getElementById("fg-role");
                    element.classList.remove("has-error");
                    element.classList.add("has-success");
                };
              }
            });
        });
    });
</script>