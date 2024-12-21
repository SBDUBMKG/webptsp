    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cetak Laporan Pelayanan
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- filter -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Filter</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <form id="form" name="form" method="post">
              <div class="form-group">
                <label>Jenis Layanan</label>
                <select class="select2 form-control" id="id_jenis_layanan" name="id_jenis_layanan" required>
                  <option value=""> - Pilih Jenis Layanan - </option>
                  <?php
                  $list_jenis_layanan = $this->global_model->get_list('m_jenis_layanan');
                  foreach ( $list_jenis_layanan as $dt ) {
                    $selected = '';
                    if( isset( $_POST['id_jenis_layanan'] ) ) {
                      if ($dt->id_jenis_layanan == $_POST['id_jenis_layanan']) {
                        $selected = 'selected';
                      }
                    }
                  ?>
                  <option value="<?= $dt->id_jenis_layanan ?>" <?= $selected ?> ><?= $dt->jenis_layanan ?></option>
                  <?php } ?>
                </select>
              </div>

              <!-- Awal script yang ditambahkan Rahmat, 30 Juli 2020 -->
              <div class="form-group">
                <label>Tahun</label>
                <select class="select2 form-control" id="tahun" name="tahun" required>
                  <option value=""> - Pilih Tahun - </option>
                  <?php 
                  for ($i=date('Y'); $i < date('Y')+4 ; $i++) { 
                    $selected = $i==$_POST['tahun'] ? 'selected' : NULL;
                    ?>
                      <option value="<?php echo $i ?>" <?php echo $selected?>><?php echo $i?></option>
                  <?php } ?>
                </select>
              </div>
              <!-- Akhir script yang ditambahkan Rahmat, 30 Juli 2020 -->

              <div class="form-group">
                <label>Bulan</label>
                <select class="select2 form-control" id="bulan" name="bulan" required>
                  <option value=""> - Pilih Bulan - </option>
                  <?php
                  $list_bulan = $this->global_model->get_list('m_bulan');
                  foreach ( $list_bulan as $dt ) {
                    $selected = '';
                    if( isset( $_POST['id_bulan'] ) ) {
                      if ($dt->id_bulan == $_POST['id_bulan']) {
                        $selected = 'selected';
                      }
                    }
                  ?>
                  <option value="<?= $dt->id_bulan ?>" <?= $selected ?> ><?= $dt->nama ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" id="submit" name="submit" class="btn btn-warning">Proses</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Data Laporan</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id="table_id" class="table table-bordered table-hover display">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Pemohon</th>
                      <th>Layanan</th>
                      <th>Biaya (Rp)</th>
                    </tr>
                  </thead>
                  <?php if(!empty($data_permohonan)) { ?> 
                  <tbody>
                    <?php
                    foreach ($data_permohonan as $key => $val) {
                      $akun = $this->db->get_where('tbl_admin', ['id_admin' => $val['id_pemohon'] ] )->row();
                      $layanan = $this->db->get_where('tbl_detail_permohonan', ['id_permohonan' => $val['id_permohonan'] ] )->row();
                      $details = $this->db->get_where('m_layanan', ['id_layanan' => $layanan->id_layanan ] )->row();
                    ?>
                    <tr>
                      <td><?= date('d-m-Y', strtotime($val['tanggal_permohonan'])) ?></td>
                      <td><?= $akun->nama ?></td>
                      <td><?= $details->layanan ?></td>
                      <td class="text-right"><?= number_format($layanan->harga, 2, ',', '.') ?></td>
                    </tr>
                    <?php } ?> 
                  </tbody>
                  <?php } ?> 
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<script type="text/javascript">
  $(document).ready(function () {

    $('.select2').select2({
      theme: 'bootstrap'
    });

    $('#table_id').DataTable( {
      // paging: false,
      "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "All"]],
      dom: 'Blfrtip',
      buttons: [
      // 'copy', 'csv', 'excel', 'pdf', 'print'
      {
          extend: 'copy',
          text: '<div class="btn btn-sm btn-success">Copy</div>'
      },
      {
          extend: 'excel',
          text: '<div class="btn btn-sm btn-primary">Excel</div>'
      },
      {
          extend: 'print',
          text: '<div class="btn btn-sm btn-warning">Print</div>'
      },
      {
            extend: 'pdfHtml5',
            text: '<div class="btn btn-sm btn-danger">PDF</div>',
            pageSize: 'A4',
            exportOptions: {
                columns: [0, 1, 2, 3]
            },
            //-------------------------- 
            customize : function(doc) {
                doc.pageMargins = [10, 10, 10, 10 ];
            }
        }
      ]
    } );

  });
  
  
</script>