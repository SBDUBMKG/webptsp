<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $page_title; ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo base_url().$this->router->fetch_class().'/set_columns' ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tabel</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control cmb_select2" name="table_name" required>
                                    <option value=""> - Pilih Tabel - </option>
                                    <?php
                                    foreach ( $list_table as $table ) {
                                        ?>
                                        <option value="<?php echo $table->table_name ?>"><?php echo $table->table_name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-success">NEXT</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
    });
</script>