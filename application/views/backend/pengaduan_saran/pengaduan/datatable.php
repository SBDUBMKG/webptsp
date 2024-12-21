<?php

defined("BASEPATH") or exit("No direct script access allowed");

$id_role = $this->session->userdata("id_role");
$curr_lang = $this->session->userdata("language");
$is_user_role = (int) $id_role === 7;

if ($is_user_role) {
    $this->lang->load("backend/complaint/datatable", $curr_lang);
}

?>
<section class="content-header">
    <h1>
        <?= $is_user_role ? $this->lang->line("title.page") : $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
            <?= $is_user_role ? $this->lang->line("title.card") : $title ?>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
<?php           if ( $this->is_write ) {
                    ?>
                    <div class="box-header">
                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <button class="btn btn-primary" onClick="document.location = '<?php echo base_url().$this->module.'/add' ?>'">Tambah Data</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
?>              <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="width: 20px;text-align: center;">No</th>
                                <th style="text-align: center;">
                                    <?= $is_user_role
                                        ? $this->lang->line("datatable.time")
                                        : "Waktu Pengaduan" ?>
                                </th>
                                <th style="text-align: center;">
                                    <?= $is_user_role
                                        ? $this->lang->line("datatable.name")
                                        : "Nama" ?>
                                </th>
                                <th style="text-align: center;">
                                    <?= $is_user_role
                                        ? $this->lang->line("datatable.email")
                                        : "Email" ?>
                                </th>
                                <th style="text-align: center;">
                                    <?= $is_user_role
                                        ? $this->lang->line(
                                            "datatable.complaint"
                                        )
                                        : "Pengaduan" ?>
                                </th>
                                <th style="text-align: center;">
                                    Respon
                                </th>
                                <?= ($this->is_write && !$is_user_role)
                                    ? ('<th style="width: 120px;text-align: center;">' .
                                    ($is_user_role
                                        ? $this->lang->line(
                                            "datatable.navigation"
                                        )
                                        : "Navigasi") . "</th>")
                                    : null ?>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
