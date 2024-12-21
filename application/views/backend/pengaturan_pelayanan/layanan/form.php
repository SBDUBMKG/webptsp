<?php
//file: application\views\backend\pengaturan_pelayanan\layanan\form.php
defined("BASEPATH") or exit("No direct script access allowed");

$current_informasi = "";
?>

<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url() .
          $this->module; ?>"><?php echo $page_title; ?></a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>

<form class="form-horizontal" method="post" enctype="multipart/form-data">
<section class="content" style="padding:15px 15px 0px 15px;">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $title; ?></h3>
                </div>

                <div class="box-body">
                    <?php if (!empty($errMsg)) { ?>
                        <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                        <?php } ?>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Layanan * </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="layanan" value="<?php echo empty(
                              $detail["layanan"]
                            )
                              ? null
                              : $detail[
                                "layanan"
                              ]; ?>" max_length="200" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Layanan En * </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="layanan_en" value="<?php echo empty(
                              $detail["layanan_en"]
                            )
                              ? null
                              : $detail[
                                "layanan_en"
                              ]; ?>" max_length="200" required>
                        </div>
                    </div>
		    <!-- Menghilangkan kolom level dikarenakan kolom ini tidak diperlukan. Perubahan oleh  Nurhayati Rahayu (02/04/2020)
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">level </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" class="form-control" name="level" value="<?php echo empty(
                              $detail["level"]
                            )
                              ? null
                              : $detail["level"]; ?>" max_length="50">
                        </div>
                    </div>
                    baris terakhir perubahan -->
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Layanan * </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control cmb_select2" id="id_jenis_layanan" name="id_jenis_layanan" required>
                                <option value=""> - Pilih Kategori Layanan - </option>
                                <?php
                                $list_kategori_layanan = $this->global_model->get_list(
                                  "m_jenis_layanan"
                                );
                                foreach ($list_kategori_layanan as $dt) {
                                  $selected =
                                    $dt->id_jenis_layanan ==
                                    (empty($detail["id_jenis_layanan"])
                                      ? null
                                      : $detail["id_jenis_layanan"])
                                      ? "selected"
                                      : null; ?>
                                    <option value="<?php echo $dt->id_jenis_layanan; ?>" <?php echo $selected; ?>><?php echo $dt->jenis_layanan; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Layanan * </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control cmb_select2" id="id_parent" name="id_parent" >
                                <option value="0"> - Pilih Jenis Layanan - </option>
                                <?php
                                $con =
                                  "id_parent = 0 and id_jenis_layanan = " .
                                  $detail["id_jenis_layanan"];
                                $list_parent = $this->global_model->get_list(
                                  "m_layanan",
                                  $con
                                );
                                foreach ($list_parent as $dt) {
                                  $selected =
                                    $dt->id_layanan ==
                                    (empty($detail["id_parent"])
                                      ? null
                                      : $detail["id_parent"])
                                      ? "selected"
                                      : null; ?>
                                    <option value="<?php echo $dt->id_layanan; ?>" <?php echo $selected; ?>><?php echo $dt->layanan; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sebuah Produk</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="radio-inline"><input type="radio" value="1" name="is_produk" <?php echo isset(
                              $detail["is_produk"]
                            ) && $detail["is_produk"] == 1
                              ? "checked"
                              : null; ?>> Ya</label>
                            <label class="radio-inline"><input type="radio" value="0" name="is_produk" <?php echo (isset(
                              $detail["is_produk"]
                            ) &&
                              $detail["is_produk"] == 0) ||
                            empty($detail["is_produk"])
                              ? "checked"
                              : null; ?>> Tidak</label>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Icon</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="file" class="form-control" name="icon" value="<?php echo empty(
                              $detail["icon"]
                            )
                              ? null
                              : $detail["icon"]; ?>">
			    <!-- Tambah keterangan gambar -->
			    <span><small class="label bg-red"><em>* WARNING</em></small></span><br>
			    <span><small class="label bg-blue"><em>* jenis file yang dapat diupload : ekstensi pdf | doc | png | jpg | gif</em></small></span><br>
			    <span><small class="label bg-blue"><em>* Dimensi Gambar Maksimal : 428 x 430 piksel</em></small></span><br>
			    <span><small class="label bg-blue"><em>* Ukuran File Gambar Maksimal : 30 Mb</em></small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content" style="padding:0px 15px 0px 15px;">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-footer" style="text-align: center;">
                    <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</section>
</form>

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

    const LAYANAN = <?= json_encode(
      $this->global_model->get_list("m_layanan", "id_parent = 0")
    ) ?>;

    $('document').ready(function() {
      $('#id_jenis_layanan').on('change', function(e){
        const idLayanan = e.target.value;
        const filteredLayanan = LAYANAN.filter((item) => item.id_jenis_layanan === idLayanan).map((item) => ({key: item.layanan, val: item.id_layanan}));

        const layananContainer = $('#id_parent');
        layananContainer.empty()
        layananContainer.append($("<option></option>").text('- Pilih Jenis Layanan -'))
        $.each(filteredLayanan, function(key, value) {
          layananContainer.append($("<option></option>").attr("value", value.val).text(value.key))
        });
      });
    });
</script>

<!-- line 51 :
     mengubah : <select class="form-control cmb_select2" id="id_jenis_layanan" name="id_jenis_layanan">
	 menjadi  : <select class="form-control cmb_select2" id="id_jenis_layanan" name="id_jenis_layanan" required>
	 Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019)
-->
<!-- line 68 :
     mengubah : <select class="form-control cmb_select2" id="id_parent" name="id_parent">
	 menjadi  : <select class="form-control cmb_select2" id="id_parent" name="id_parent" required>
	 Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019)
-->
<!-- line 93-97 : Penambahan keterangan gambar. Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019) -->
