
<section class="content">

    <div class="row">
        <div class="col-xs-12" style="margin: 0 5px">
            <form method="GET" class="form-inline">
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <?php
                        $tahun_now = date("Y");
                        $tahun = isset($_GET["tahun"])
                            ? $_GET["tahun"]
                            : $tahun_now;
                        for ($i = 2019; $i <= $tahun_now; $i++) {
                            $selected = $i == $tahun ? "selected" : "";
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
            </form>
        </div>
        <div class="col-xs-12 row" style="margin: 10px 0px">
            <button id="download-excel" type="button" class="btn btn-sm btn-primary">Excel</button>
            <button id="download-pdf" type="button" class="btn btn-sm btn-danger">PDF</button>
            <button id="download-jpeg" type="button" class="btn btn-sm btn-warning">JPEG</button>
            <button id="download-png" type="button" class="btn btn-sm btn-info">PNG</button>
        </div>
        <div class="col-xs-12">
            <div id="chart_survey"></div>
        </div>
    </div>
</section>
  <script type="application/javascript">

    $('#download-excel').click(function () {
        chart.exportChart({
            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            filename: 'Laporan Survey <?= $tahun ?>'
        });
    });

    $('#download-pdf').click(function () {
        chart.exportChart({
            type: 'application/pdf',
            filename: 'Laporan Survey <?= $tahun ?>'
        });
    });

    $('#download-jpeg').click(function () {
        chart.exportChart({
            type: 'image/jpeg',
            filename: 'Laporan Survey <?= $tahun ?>'
        });
    });

    $('#download-png').click(function () {
        chart.exportChart({
            type: 'image/png',
            filename: 'Laporan Survey <?= $tahun ?>'
        });
    });

    function GetClock(){
            var d=new Date();
            var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

            if(nhour==0){ap=" AM";nhour=12;}
            else if(nhour<12){ap=" AM";}
            else if(nhour==12){ap=" PM";}
            else if(nhour>12){ap=" PM";nhour-=12;}

            if(nmin<=9) nmin="0"+nmin;
            if(nsec<=9) nsec="0"+nsec;

            document.getElementById('clockbox').innerHTML=""+nhour+":"+nmin+":"+nsec+ap+"";
        }
        window.onload=function(){
            GetClock();
            setInterval(GetClock,1000);
        }
  </script>
