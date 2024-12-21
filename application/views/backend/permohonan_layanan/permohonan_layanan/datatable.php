<?php
defined("BASEPATH") or exit("No direct script access allowed");
$id_role = $this->session->userdata("id_role");
$curr_lang = $this->session->userdata('language');
$this->lang->load('backend/service_request/datatable', $curr_lang);
?>
<section class="content-header">
    <h1><?php echo $title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                  <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th style="width: 20px;text-align: center;">No</th>
                            <th style="text-align: center;"> <?= $this->lang->line('datatable.header.number') ?> </th>
                            <th style="text-align: center;"> <?= $this->lang->line('datatable.header.date') ?> </th>
                            <th style="text-align: center;"> <?= $this->lang->line('datatable.header.verify') ?> </th>
                            <th style="text-align: center;"> <?= $this->lang->line('datatable.header.company') ?> </th>
                            <th style="text-align: center;"> <?= $this->lang->line('datatable.header.name') ?> </th>
                            <!-- <th style="text-align: center;"> <?= $this->lang->line('datatable.header.coverletter') ?> </th> -->
                            <th style="text-align: center;"> <?= $this->lang->line('datatable.header.mobile') ?> </th>
                            <th style="text-align: center;">Status</th>
                            <?php echo $this->is_write
                                ? ('<th style="width: 120px;text-align: center;">' . $this->lang->line('datatable.header.navigation') . '</th>' )
                                : null ?>
                            <th></th>
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
