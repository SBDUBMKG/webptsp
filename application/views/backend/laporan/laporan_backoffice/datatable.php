
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Jenis Layanan</label>
                            <select class="form-control" name="id_jenis_layanan">
                                <option value="">- Pilih -</option>
                                <?php foreach ($jenis_layanan as $key => $value) { ?>
                                <option value="<?php echo $value['id_jenis_layanan'] ?>" <?php echo $jenis_layanan_selected == $value['id_jenis_layanan'] ? "selected" : NULL; ?>><?php echo $value['jenis_layanan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Back Office</label>
                            <select class="form-control" name="id_role">
                                <option value="">- Pilih -</option>
                                <?php foreach ($backoffice as $key => $value) { ?>
                                <option value="<?php echo $value['id_role'] ?>" <?php echo $backoffice_selected == $value['id_role'] ? "selected" : ""; ?>><?php echo $value['role'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Tahun</label>
                            <select class="form-control" name="tahun">
                                <option><?php echo date('Y')?></option>
                                <?php for ($i=date("Y");$i>2000;$i--) { ?>
                                <option value="<?php echo $i ?>"<?php echo $tahun == $i ? "selected" : "" ; ?>><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Proses</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-xs-12"> -->
        <div class="col-xs-12">
            <?= $jumlah_layanan ?>
        </div>
    </div>
</section>
  <script type="application/javascript">
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