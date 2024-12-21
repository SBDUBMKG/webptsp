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
                <label>Layanan</label>
                <select class="select2 form-control" id="id_jenis_layanan" name="id_jenis_layanan" required>
                  <option value="">Pilih Jenis Layanan</option>
                  <?php
                  $list_bulan = $this->global_model->get_list('m_jenis_layanan');
                  foreach ( $list_bulan as $dt ) {
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
              <div class="form-group">
                <label>Tahun</label>
                <select class="select2 form-control" id="tahun" name="tahun" required>
                  <option value="">Pilih Tahun</option>
                  <option>2018</option><option>2019</option><option>2020</option>
		  <option>2021</option><option>2022</option><option>2023</option>
		  <option>2024</option><option>2025</option><option>2026</option>
                </select>
              </div>
              <div class="form-group">
                <label>Bulan</label>
                <select class="select2 form-control" id="bulan" name="bulan" required>
                  <option value=""> - Pilih Bulan - </option>
                  <?php
                  $list_bulan = $this->global_model->get_list('m_bulan');
                  foreach ( $list_bulan as $dt ) {
                    $selected = '';
                    if( isset( $_POST['bulan'] ) ) {
                      if ($dt->id_bulan == $_POST['bulan']) {
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
                      <th>Biaya</th>
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
                      <td class="text-right">Rp. <?= number_format($layanan->harga, 2, ',', '.') ?></td>
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
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
          extend: 'pdf',
          text: '<div class="btn btn-sm btn-danger">PDF</div>'
      },
      {
          extend: 'print',
          text: '<div class="btn btn-sm btn-warning">Print</div>'
      }
      ]
    } );

  });
  
  
</script>

<!--line 50-52 : menambahkan tahun. Perubahan dilakukan oleh : Nurhayati Rahayu (17/10/2019) -->