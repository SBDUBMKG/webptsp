<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    /* table, th, td {
      border: 1px solid black;
      box-sizing: border-box;
      border-collapse: collapse;
    } */
/*
    thead:before, thead:after { display: none; }
    tbody:before, tbody:after { display: none; } */

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 7px;
        /* width: auto; */
        overflow: hidden;
        border: 1px solid #262626;
        /* word-wrap: break-word; /* Ensure text wraps within cells */ */
        /* word-break: break-word; /* Break long words */ */
        vertical-align: top; /* Ensure text is aligned at the top of cells */
        overflow-wrap: anywhere; /* Ensure text wraps within cells */
    }

    /* Style table headers */
    th {
        background-color: #f2f2f2;
        border: 1px solid #262626;
        text-align: center;
        padding: 7px;
    }

  </style>
</head>
<body>
<div style="">
    <div style="margin-left: auto; max-width: 40%">
    <span style="text-align: left; font-weight: bold; font-size: 11pt">
        LAMPIRAN II<br>
        PERATURAN BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA REPUBLIK INDONESIA<br>
        NOMOR 1 TAHUN 2019<br>
        TENTANG<br>
        PELAYANAN TERPADU SATU PINTU DI LINGKUNGAN BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA
    </span>
    </div>
        <p  style="text-align: center; font-weight: bold; font-size: 10pt; width: 100%">
            LAPORAN PELAKSANAAN PELAYANAN PTSP<br>
            UNIT PTSP BMKG JAKARTA <br>
            <?= isset($_GET['bulan']) && (int) $_GET['bulan'] !== 0 ?
            'BULAN ' . strtoupper(get_nama_bulan($_GET["bulan"])) : ''
            ?>
            TAHUN <?= $_GET["tahun"] ?>
        </p>

    <table id="table" style="" class="">
        <thead>
            <tr style="font-size: 8pt;">
                <th>No</th>
                <th>Nomor & Tanggal<br>Surat Permintaan<br>dari Wajib Bayar</th>
                <th>Tanggal Surat Masuk<br>di Unit PTSP</th>
                <th>Nama Wajib<br>Bayar</th>
                <th>Uraian Permintaan<br>Berdasarkan Jenis PNBP</th>
                <th>Jumlah PNBP yang<br>Harus Dibayar</th>
                <th>Nomor & Tanggal Surat<br>Keluar dari Unit PTSP</th>
                <th>Tanggal Pengambilan Dokumen <br>Layanan oleh Wajib Bayar</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody style="">
            <?php foreach ($result as $idx => $val): ?>
                <tr style="font-size: 9pt; text-align: left;">
                    <td style="text-align: center;"> <?= $idx + 1 ?> </td>
                    <?php foreach ($val as $key => $value): ?>
                        <td style="max-width: 150px; overflow-wrap: anywhere;">
                        <div style="width:inherit">
                            <?= $value ?>
                        </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table style="border: none !important; vertical-align: top; padding: 20px; font-size: 11pt ">
        <tr style=" vertical-align: top">
            <td style="border: none !important; padding-left: 160px; width: 400px">
                <span style="text-align: left;" width="50">
                    Mengetahui
                    <br>
                    Kepala Unit PTSP
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <?= $nama_kepala_ptsp ?>
                    <br>
                    NIP. <?= $nip_kepala_ptsp ?>
                    <br>
                </span>
            </td>
            <td style="border: none !imporant; padding-left: 300px">
                <span style="">
                    Jakarta, ............................
                    <br>
                    Pembuat Laporan
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <?= $nama_pembuat_laporan ?>
                    <br>
                    NIP. <?= $nip_pembuat_laporan ?>
                    <br>
                    <span style="margin-top: 10px; display: block"></span>
                    KEPALA BADAN METEOROLOGI,<br>KLIMATOLOGI, DAN GEOFISIKA
                    <br><br>
                    Ttd.
                    <br><br>
                    <?= $nama_kepala_bmkg ?>
                </span>
            </td>
        </tr>
    </table>

    <table style="border: none !important; margin-top: -60px">
        <tr style="border: none !important">
            <td style="border: none !important">
               <span style="text-align: left;">
                   Salinan sesuai dengan aslinya,<br>
                       Kepala Biro Hukum dan Organisasi
                   <br><br><br><br><br>
                       <?= $nama_kepala_biro ?>
               </span>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
