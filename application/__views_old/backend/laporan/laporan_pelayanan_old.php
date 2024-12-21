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
              <div class="form-group">
                <label>Jenis Laporan</label>
                <select class="form-control">
                  <option>Laporan keuangan pelayanan PTSP</option>
                  <option>Laporan kondisi jaringan komunikasi dari Sistem Interface PTSP</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jenis Layanan</label>
                <select class="form-control">
                  <option>Layanan MKG</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jenis Permintaan</label>
                <select class="form-control">
                  <option>Informasi khusus Meteorologi, Klimatologi dan Geofisika</option>
                </select>
              </div>
              <div class="form-group">
                <label>Tahun</label>
                <select class="form-control">
                  <option>2018</option>
                  <option>2019</option>
                  <option>2020</option>
                  <option>2021</option>
                  <option>2022</option>
                </select>
              </div>
              <div class="form-group">
                <label>Bulan</label>
                <select class="form-control">
                  <option>Januari</option>
                  <option>Februari</option>
                  <option>Maret</option>
                  <option>April</option>
                  <option>Mei</option>
                  <option>Juni</option>
                  <option>Juli</option>
                  <option>Agustus</option>
                  <option>September</option>
                  <option>Otober</option>
                  <option>November</option>
                  <option>Desember</option>
                </select>
              </div>
              <div class="form-group">
                <button class="btn btn-warning">Proses</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="box box-default">
        <div class="box-header with-border">
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Jumlah Permintaan Pelayanan Informasi MKG Bulan Januari Tahun 2017</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th rowspan="2" style="text-align: center;">No</th>
                  <th rowspan="2" style="text-align: center;">Unsur Layanan</th>
                  <th colspan="31" style="text-align: center;">Jumlah Transaksi Per Tanggal</th>
                </tr>
                <tr>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<th>".$i."</th>";
                  }
                  ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>Informasi Cuaca Khusus Untuk Pelayaran</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Informasi Cuaca Untuk Pengeboran Lepas Pantai</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td rowspan="7">3</td>
                  <td>Informasi Iklim Untuk Agro Industri</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td></td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td>A. Analisis dan Prakiraan Hujan Bulanan</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td>B. Prakiraan Musim Kemarau</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td>C. Prakiraan Musim Hujan</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td>D. Atlas Normal Curah Hujan</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td>E. Atlas Kesesuaian Agroklimat</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td>F. Analisis Iklim</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td rowspan="3">4</td>
                  <td>Informasi Iklim Untuk Diversikam Energi</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td></td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td>A. Atlas Normal Suhu Udara</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <td>B. Atlas Normal Arah Dan Kecepatan Angin</td>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<td>".$i."</td>";
                  }
                  ?>
                </tr>
                <tr>
                  <th colspan="2">Total</th>
                  <?php
                  for ($i=1; $i <= 31; $i++) { 
                    echo "<th>".$i."</th>";
                  }
                  ?>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
          </div>
        </div>
      </div>
    </section>
