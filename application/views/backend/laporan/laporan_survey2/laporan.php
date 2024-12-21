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
        overflow: hidden;
        border: 1px solid #262626;
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

    .no-border {
        border: none;
    }

    .py-close {
        padding-top: 2px;
        padding-bottom: 2px;
    }

  </style>
</head>
<body>
<div style="">

    <!-- First Page -->

    <div style="margin-left: auto; margin-right: auto; text-align: center;">
        <span style="font-weight: bold; font-size: 11pt">
            Pengolahan Data Survey Kepuasan Masyarakat Per Responden dan Per Pelayanan
        </span>
    </div>

    <p  style="text-align: left; font-weight: semibold; font-size: 10pt; width: 100%">
        Unit Pelayanan <span style="margin-left: 97.5px;">: PTSP PUSAT Badan Meteorologi, Klimatologi, dan Geofisika</span><br>
        Jumlah Target Responden <span style="margin-left: 40px">: <?= count(
            $result
        ) ?></span><br>
        Tahun <span style="margin-left: 145px">: <?= $_GET["tahun"] ?></span>
    </p>

    <table id="table" style="" class="">
        <thead>
            <tr style="font-size: 8pt;">
                <th rowspan="2">No</th>
                <th rowspan="2">Jenis Kelamin</th>
                <th rowspan="2">Usia</th>
                <th rowspan="2">Pendidikan</th>
                <th rowspan="2">Pekerjaan</th>
                <th colspan="9">NILAI AKTUAL KEPUASAN MASYARAKT PER UNSUR-PELAYANAN</th>
                <th rowspan="2">Keluhan / Saran Perbaikan</th>
            </tr>
            <tr style="font-size: 10pt;">
                <th>U1</th>
                <th>U2</th>
                <th>U3</th>
                <th>U4</th>
                <th>U5</th>
                <th>U6</th>
                <th>U7</th>
                <th>U8</th>
                <th>U9</th>
            </tr>
        </thead>
        <tbody style="">
            <?php foreach ($result as $idx => $val): ?>
                <tr style="font-size: 9pt; text-align: left;">
                    <td style="text-align: center;"> <?= $idx + 1 ?> </td>
                    <?php foreach ($val as $key => $value): ?>
                        <td style="max-width: 150px; overflow-wrap: anywhere; <?= !in_array($key, ['age', 'gender', 'education', 'job']) ? 'text-align: center' : ''; ?>">
                            <div style="width:inherit">
                                <?= $value ?>
                            </div>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            <tr style="font-size: 10pt; text-align: center;">
                <td colspan="5">Nilai Rata-Rata</td>
                <?php foreach ($nrr_factors as $key => $value): ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?>
                <td></td>
            </tr>
            <tr style="font-size: 10pt; text-align: center;">
                <td colspan="5">Nilai Rata-Rata Tertimbang</td>
                <?php foreach ($weighted_nrr_factors as $key => $value): ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?>
                <td> <?= $avg_weighted_nrr_factor ?> </td>
            </tr>
            <tr style="font-size: 10pt; text-align: center; font-weight: bold;">
                <td colspan="7">SKM Unit Pelayanan</td>
                <td colspan="8"> <?= $skm_score ?> </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border: none; margin-top: 10px;">
        <tr>
            <td style="width: 45%; font-size: 10pt;" class="no-border">
                <table>
                    <tr>
                        <td class="no-border" style="font-weight: bold;" colspan="3">Keterangan :</td>
                    </tr>
                    <tr class="">
                        <td class="no-border py-close">U1 - U9</td>
                        <td class="no-border py-close"> = </td>
                        <td class="no-border py-close"> Unsur-Unsur pelayanan </td>
                    </tr>
                    <tr>
                        <td class="no-border py-close">NRR</td>
                        <td class="no-border py-close"> = </td>
                        <td class="no-border py-close"> Nilai rata-rata </td>
                    </tr>
                    <tr>
                        <td class="no-border py-close">IKM</td>
                        <td class="no-border py-close"> = </td>
                        <td class="no-border py-close"> Indeks Kepuasan Masyarakat </td>
                    </tr>
                    <tr>
                        <td class="no-border py-close"> -*) </td>
                        <td class="no-border py-close"> = </td>
                        <td class="no-border py-close"> Jumlah NRR IKM tertimbang </td>
                    </tr>
                    <tr>
                        <td class="no-border py-close"> -**) </td>
                        <td class="no-border py-close"> = </td>
                        <td class="no-border py-close"> Jumlah NRR IKM tertimbang x 25 </td>
                    </tr>
                    <tr>
                        <td class="no-border py-close"> NRR Per Unsur </td>
                        <td class="no-border py-close"> = </td>
                        <td class="no-border py-close"> Jumlah nilai per unsur dibagi Jumlah kuesioner yang terisi </td>
                    </tr>
                    <tr>
                        <td class="no-border py-close"> NRR Tertimbang </td>
                        <td class="no-border py-close"> = </td>
                        <td class="no-border py-close"> NRR per unsur x 0.111 per unsur </td>
                    </tr>
                </table>
                <div style="border-top: 2px solid black; padding: 7px 0; border-bottom: 2px solid black; font-size: 11pt; font-weight: bold;">
                    IKM UNIT PELAYANAN :
                </div>
                <table>
                    <tr>
                        <td class="no-border" style="font-weight: bold;" colspan="3">Mutu Pelayanan :</td>
                    </tr>
                    <tr>
                        <td class="no-border py-close" style="width: 30%;">A (Sangat Baik)</td>
                        <td class="no-border py-close" style="width: 1px"> : </td>
                        <td class="no-border py-close"> 88.31 - 100.00 </td>
                    </tr>
                    <tr>
                        <td class="no-border py-close">B (Baik)</td>
                        <td class="no-border py-close"> : </td>
                        <td class="no-border py-close"> 76.61 - 88.30</td>
                    </tr>
                    <tr>
                        <td class="no-border py-close">C (Kurang Baik)</td>
                        <td class="no-border py-close"> : </td>
                        <td class="no-border py-close"> 65.00 - 76.60</td>
                    </tr>
                    <tr>
                        <td class="no-border py-close">D (Tidak Baik)</td>
                        <td class="no-border py-close"> : </td>
                        <td class="no-border py-close"> 25.00 - 64.99</td>
                    </tr>
                </table>
            </td>
            <td style="" class="no-border">
                <table style="font-size: 10pt;" >
                    <tr>
                        <th class="py-close">No.</th>
                        <th class="py-close">UNSUR PELAYANAN</th>
                        <th class="py-close">NILAI RATA-RATA</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach ($nrr_factors as $key => $value): ?>
                    <tr>
                        <td class="py-close" style="text-align: center;">U<?= $i ?> </td>
                        <td class="py-close"> <?= $key ?> </td>
                        <td class="py-close"> <?= $value ?> </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
    </table>

    <!-- Second Page -->
    <div style="page-break-before: always"></div>

    <!-- <div style="margin-left: auto; margin-right: auto; text-align: center;"> -->
        <!-- <p style="font-weight: bold; font-size: 11pt; text-align: center; width: 100%">
                PTSP BMKG Pusat<br>Badan Meteorologi Klimatologi dan Geofisika<br>
                Tahun <?= $_GET["tahun"] ?>
        </p> -->
        <div style="text-align: center; font-weight: bold; font-size: 11pt; width: 100%">
            INDEKS KEPUASAN MASYARAKAT (IKM)
        </div>
        <div style="text-align: center; font-weight: bold; font-size: 11pt;">
            PTSP BMKG Pusat
        </div>
        <div style="text-align: center; font-weight: bold; font-size: 11pt; margin-left: -50px">
            Badan Meteorologi, Klimatologi, dan Geofisika
        </div>
        <div style="text-align: center; font-weight: bold; font-size: 11pt;">
            Tahun <?= $_GET['tahun'] ?>
        </div>
    <!-- </div> -->

    <table>
        <tr>
            <td class="no-border" style="width: 50%">
                <table style="padding: 0 50px">
                    <tr>
                        <td style="text-align: center; font-weight: bold; font-size: 14pt">
                            NILAI IKM
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-weight: bold; font-size: 82pt; padding: 32px 0;">
                            <?= $skm_score ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="no-border" style="width: 50%">
                <table style="padding: 0 50px">
                    <tr>
                        <td style="text-align: left; font-size: 12pt">
                            NAMA LAYANAN :
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table style="font-size: 11pt">
                                <tr>
                                    <td colspan="3" class="no-border" style="text-align: center;">RESPONDEN</td>
                                </tr>
                                <tr>
                                    <td class="no-border py-close" style="width: 30%;">JUMLAH</td>
                                    <td class="no-border py-close" style="width: 1px;">:</td>
                                    <td class="no-border py-close"> <?= count(
                                        $result
                                    ) ?> orang</td>
                                </tr>
                                <tr>
                                    <td class="no-border py-close" style="width: 30%;">JENIS KELAMIN</td>
                                    <td class="no-border py-close" style="width: 1px;">:</td>
                                    <td class="no-border py-close"> L = <?= count(
                                        filter_skm_result($result, "gender", [
                                            "Laki-laki",
                                        ])
                                    ) ?> orang / P = <?= count(
     filter_skm_result($result, "gender", ["Perempuan"])
 ) ?> orang </td>
                                </tr>
                                <tr>
                                    <td class="no-border py-close" style="width: 30%;">PENDIDIKAN</td>
                                    <td class="no-border py-close" style="width: 1px;">:</td>
                                    <td class="no-border py-close">
                                        SD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= <?= count(
                                            filter_skm_result(
                                                $result,
                                                "education",
                                                ["SD"]
                                            )
                                        ) ?> orang <br>
                                        SMP&nbsp;&nbsp;= <?= count(
                                            filter_skm_result(
                                                $result,
                                                "education",
                                                ["SMP", "MTS"]
                                            )
                                        ) ?> orang <br>
                                        SMA&nbsp;&nbsp;= <?= count(
                                            filter_skm_result(
                                                $result,
                                                "education",
                                                ["SMA", "SMU", "SMK", "SLTA"]
                                            )
                                        ) ?> orang <br>
                                        DIII  &nbsp;&nbsp;= <?= count(
                                            filter_skm_result(
                                                $result,
                                                "education",
                                                ["D3"]
                                            )
                                        ) ?> orang <br>
                                        S1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= <?= count(
                                            filter_skm_result(
                                                $result,
                                                "education",
                                                ["S1", "D4"]
                                            )
                                        ) ?> orang <br>
                                        S2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= <?= count(
                                            filter_skm_result(
                                                $result,
                                                "education",
                                                ["S2"]
                                            )
                                        ) ?> orang <br>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="border: none !important; vertical-align: top; padding: 20px; font-size: 11pt ">
        <tr style=" vertical-align: top">
            <td style="border: none !important; padding-left: 160px;  width: 400px">
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
                    <br>
                    <br>
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
