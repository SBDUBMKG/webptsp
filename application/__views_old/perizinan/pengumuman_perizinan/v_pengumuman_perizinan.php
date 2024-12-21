<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.jssocials-share-link { border-radius: 50%; }
</style>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#terima" aria-controls="terima" role="tab" data-toggle="tab"><?php echo isset($bahasa) ? 'Approve' : 'Terima'?></a></li>
        <li role="presentation"><a href="#tolak" aria-controls="tolak" role="tab" data-toggle="tab"><?php echo isset($bahasa) ? 'Reject' : 'Tolak'?></a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="terima">
          <div class="article" style="padding-top:5px">
            <table class="table table-bordered" id="datatable_terima">
              <thead>
              <tr>
                  <th style="width: 20px;">No</th>
                  <th>Pengumuman Perizinan</th>
                  <th>Tanggal</th>
                  <th>Lampiran</th>
                  <th></th>
              </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="tolak">
          <div class="article" style="padding-top:5px">
            <table class="table table-bordered" id="datatable_tolak">
              <thead>
              <tr>
                  <th style="width: 20px;">No</th>
                  <th>Pengumuman Perizinan</th>
                  <th>Tanggal</th>
                  <th>Lampiran</th>
                  <th></th>
              </tr>
              </thead>
              <tbody></tbody>
            </table>
        </div>
      </div>
    </div>
  </main>
</div>
