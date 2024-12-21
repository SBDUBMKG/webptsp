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
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_role" name="id_role" required >
                                    <option value=""> - Pilih Role - </option>
                                    <?php
                                    $list_role = $this->global_model->get_list('tbl_role');
                                    foreach ( $list_role as $role ) {
                                        $selected = $role->id_role == (empty($detail['id_role']) ? NULL : $detail['id_role']) ? 'selected' : NULL;
                                        ?>
                                        <option value="<?php echo $role->id_role; ?>" <?php echo $selected; ?>><?php echo $role->role; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="form_group_username">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo empty($detail['username']) ? NULL : $detail['username']; ?>" max_length="60" required>
                                <span class="help-block" id="username_massage" style="display: none;">Help block with error</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <?php echo isset($id) ? NULL : '<span class="required">*</span>'; ?></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" name="password" value="" max_length="255" <?php echo isset($id) ? NULL : 'required'; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ulangi Password <?php echo isset($id) ? NULL : '<span class="required">*</span>'; ?></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" name="r_password" value="" max_length="255" <?php echo isset($id) ? NULL : 'required'; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" max_length="100">
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
        $('#username').change(function() {
            var username = $('#username').val();
            $.ajax({
                type: "GET",
                url: base_url + "user/check_username",
                data: "iuser=<?php echo isset($id) ? $id : NULL; ?>&uname=" + username,
                success: function(msg) {
                    if ( parseInt(msg) > 0 ) {
                        $('#form_group_username').addClass('has-error');
                        $('#username_massage').html('Username ' + $('#username').val() + ' tidak tersedia');
                        $('#username_massage').show();
                        $('#username').val('');
                        $('#username').focus();
                    } else {
                        $('#form_group_username').removeClass('has-error');
                        $('#username_massage').hide();
                    }
                },
                error: function(xhr, msg, e) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>