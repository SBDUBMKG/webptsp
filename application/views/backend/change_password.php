<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                &nbsp;
            </div>
            <div class="panel-body">
                <?php
                if ( !empty($msg_change_password) ) {
                    ?>
                    <!-- baris awal perbaikan background warna berdasarkan hasil perubahan password. Perbaikan oleh Nurhayati Rahayu (26042024)
                    <div class="alert alert-success">
                    <?php echo $msg_change_password; ?> -->
                    <div class="alert <?php echo ($msg_change_password === 'Password berhasil diubah') ? 'alert-success' : 'alert-danger'; ?>">
                        <?php echo $msg_change_password; ?>    
                    <!-- baris awal perbaikan background warna berdasarkan hasil perubahan password. Perbaikan oleh Nurhayati Rahayu (26042024) -->
                    </div>
                    <?php
                }
                ?>
                <div class="row">

                    <div class="col-lg-6">
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $this->session->userdata('id_admin'); ?>">
                            <div class="form-group">
                                <label>Password Lama</label>
                                <input class="form-control" name="password_lama" type="password">
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input class="form-control" name="password_baru" type="password">
                            </div>
                            <div class="form-group">
                                <label>Ulangi Password</label>
                                <input class="form-control" name="ulangi_password" type="password">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="btn_simpan" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
