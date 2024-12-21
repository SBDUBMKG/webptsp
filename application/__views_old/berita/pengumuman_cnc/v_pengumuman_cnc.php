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

#datatable thead th {
  background-color: #70ad47 !important;
}

#datatable thead th.sorting:after,
#datatable thead th.sorting_asc:after,
#datatable thead th.sorting_desc:after {
    color: gold;
    opacity: 1 !important;
}

#datatable tbody a {
  color: #337ab7;
}

#datatable thead tr th {
  padding: 5px 30px 5px 5px !important;
}

#datatable tbody tr td {
  padding: 5px !important;
}

#datatable tbody tr.odd td {
  background-color: #e2efd9 !important;
}
</style>



<div class="wrapper row3">

  <main class="hoc container clear"> 

    <div class="content"> 

      <ol class="breadcrumb">

        <li><a href="<?php echo base_url();?>">Home</a></li>

        <li class="active"><?php echo $title ?></li>

      </ol>
      <div class="table-responsive">
      <table class="table table-bordered" id="datatable">

          <thead>

          <tr>

              <th style="width: 20px;">No</th>

              <th>Judul</th>

              <th>Tanggal</th>

              <th>Lampiran</th>



              <th></th>

          </tr>

          </thead>

          <tbody></tbody>

      </table>
      </div>

    </div>

  </main>

</div>

