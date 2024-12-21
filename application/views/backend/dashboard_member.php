<?php
    // $locale = 'id_ID';
    // $formatter = new IntlDateFormatter($locale, IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'MMMM');
    $curr_lang = $this->session->userdata('language');
    $this->lang->load('backend/dashboard/member', $curr_lang);

    $lang_key = $curr_lang === 'indonesia' ? 'id' : 'en';
    $months = [
        'en' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        'id' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
    ];
?>

<section class="content-header">
	<h1>
		Dashboard
		<small>BMKG</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
	<li class="active">Dashboard</li>
	</ol>
</section>
<section class="content">
	    <form class="form-inline" method="get">
			<div></div>

			<div class="form-group" style="">
				<select class="form-control" name="from_month" id="filterBulan" required>
				    <option value="0">
				        <?= $this->lang->line('form.filter.month.from') ?>
					</option>
					<?php foreach($months[$lang_key] as $key => $value): ?>
					<option value="<?= $key+1 ?>"
					   <?php echo isset($_GET['from_month']) && ($key + 1) === (int) $_GET['from_month'] ? "selected" : ""; ?>
					>
						<?= $value ?>
					</option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group" style="margin-left:10px;">
				<select class="form-control" name="to_month" id="filterBulan" required>
				    <option value="0">
				        <?= $this->lang->line('form.filter.month.to') ?>
					</option>
					<?php foreach($months[$lang_key] as $key => $value): ?>
					<option value="<?= $key+1 ?>"
					   <?php echo isset($_GET['to_month']) && ($key + 1) === (int) $_GET['to_month'] ? "selected" : ""; ?>
					>
						<?= $value ?>
					</option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="form-group" style="margin-left:10px;">
				<select class="form-control " name="year" id="filterTahun" required>
					<?php for ($i = 0; $i < 6; $i++) { ?>
					<option
							value="<?= date("Y") - $i ?>"
							<?php
							    if (isset($_GET['year'])) {
							        echo date('Y') - $i === (int) $_GET['year'] ? "selected" : "";
							    } else {
							        echo date('Y') - $i === (int) date('Y') ? "selected" : "";
							    }
							?>>
							    <?= date("Y") - $i ?>
					</option>
					<?php } ?>
				</select>
			</div>

			<button type="submit" class="btn btn-primary" style="margin-left:13px">Filter</button>
		</form>

		<div class="row" style="margin-top: 2em;">
		  <div id="riwayatPermohonanChart" class="col-sm-12" style=""></div>
		</div>

		<div class="row" style="margin-top: 20px">
		    <div class="col-md-7 col-sm-12" style="">
				<div id="jenisLayananChart"></div>
			</div>
            <div class="col-md-5 col-sm-12" style="">
                <div id="pembayaranChart"></div>
            </div>
		</div>
		<div id="dataPermohonanTable" class="table-responsive" style="margin-top: 20px; background-color: #fff; padding: 2em 1em">
		    <h4 id="tableTitle" class="text-center" style="margin-bottom:2em"> <?php ?> </h4>
		    <table class="table table-border">
				<thead>
				    <tr>
						<th> <?= $this->lang->line('table.header.1') ?> </th>
						<th> <?= $this->lang->line('table.header.2') ?> </th>
						<th> <?= $this->lang->line('table.header.3') ?> </th>
						<th> <?= $this->lang->line('table.header.4') ?> </th>
						<th> Status </th>
						<th> <?= $this->lang->line('table.header.5') ?> </th>
				    </tr>
				</thead>
				<tbody>
				    <tr>
						<td colspan="5">
						    <h4 class="text-center">
								<?= $this->lang->line('table.empty') ?>
							</h4>
						</td>
					</tr>
				</tbody>
			</table>
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
