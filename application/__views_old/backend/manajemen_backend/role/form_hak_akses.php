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
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Role</td>
                                <td style="width: 15px;">:</td>
                                <td><?php echo $detail['role']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table">
                            <tbody>
                            <?php
                            foreach ( $list_kategori_menu as $kategori_menu ) {
                                ?>
                                <tr>
                                    <td colspan="2" style="font-weight:bold;" class="bg-info"><?php echo $kategori_menu->kategori_menu; ?></td>
                                </tr>
                                <?php
                                $list_menu = $this->app_model->get_list_menu($kategori_menu->id_kategori_menu);
                                foreach ( $list_menu as $menu ) {
                                    $checked_write = array_key_exists($menu->id_menu, $hak_akses) && $hak_akses[$menu->id_menu]['is_write'] == 1 ? 'checked' : NULL;
                                    $checked_read = array_key_exists($menu->id_menu, $hak_akses) && $hak_akses[$menu->id_menu]['is_read'] == 1 ? 'checked' : NULL;
                                    ?>
                                    <tr>
                                        <td style="padding-left: 25px;"><?php echo $menu->menu ?></td>
                                        <td>
                                            <input type="hidden" name="id_menu[]" value="<?php echo $menu->id_menu; ?>">
                                            <label class="checkbox-inline"><input type="checkbox" name="cmb_read[]" class="cmb_read" value="<?php echo $menu->id_menu; ?>" <?php echo $checked_read ?>>Read</label>
                                            <label class="checkbox-inline"><input type="checkbox" name="cmb_write[]" class="cmb_write" value="<?php echo $menu->id_menu; ?>" <?php echo $checked_write ?>>Write</label>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            $list_menu = $this->app_model->get_list_menu(0);
                            foreach ( $list_menu as $menu ) {
                                $checked_write = array_key_exists($menu->id_menu, $hak_akses) && $hak_akses[$menu->id_menu]['is_write'] == 1 ? 'checked' : NULL;
                                $checked_read = array_key_exists($menu->id_menu, $hak_akses) && $hak_akses[$menu->id_menu]['is_read'] == 1 ? 'checked' : NULL;
                                ?>
                                <tr>
                                    <td><?php echo $menu->menu ?></td>
                                    <td><input type="hidden" name="id_menu[]" value="<?php echo $menu->id_menu; ?>">
                                        <label class="checkbox-inline"><input type="checkbox" name="cmb_read[]" class="cmb_read" value="<?php echo $menu->id_menu; ?>" <?php echo $checked_read ?>>Read</label>
                                        <label class="checkbox-inline"><input type="checkbox" name="cmb_write[]" class="cmb_write" value="<?php echo $menu->id_menu; ?>" <?php echo $checked_write ?>>Write</label>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
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
        $('.cmb_write').click(function() {
           if ( this.checked == true ) {
               $(this).parent().parent().children().find('.cmb_read').attr('checked', 'checked');
           }
        });
        $('.cmb_read').click(function() {
            if ( this.checked == false ) {
                $(this).parent().parent().children().find('.cmb_write').removeAttr('checked');
            }
        });
    });
</script>