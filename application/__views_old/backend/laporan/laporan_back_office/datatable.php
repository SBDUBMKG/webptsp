
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-body">
                    <form>
                        <div class="form-group">
                            <label>Jenis</label>
                            <select class="form-control" name="id_layanan">
                                <option value="">Pilih </option>
                                <?php foreach ($layanan as $key => $value) { ?>
                                <option value="<?php echo $value->id_layanan ?>" <?php echo $this->input->get("id_layanan")==$value->id_layanan?"selected":""; ?>><?php echo $value->layanan ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control" name="tahun">
                                <option>2019</option>
                                <?php for ($i=date("Y");$i>2000;$i--) { ?>
                                <option value="<?php echo $i ?>"<?php echo $this->input->get("tahun")==$i?"selected":""; ?>><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Proses</button>
                        </div>
                    </form>
                </di>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
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

<!-- line 27 
 mengubah : <button type="submit" class="btn btn-success">Kirim</button>
 menjadi  : <button type="submit" class="btn btn-warning">Proses</button>
-->