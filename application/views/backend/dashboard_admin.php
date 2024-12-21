<section class="content-header">
	<h1> 
		Dashboard
		<small></small>
	</h1>
	<ol class="breadcrumb">
	<li><i class="fa fa-dashboard"></i> Home</li>
	<li class="active">Dashboard</li>
	</ol>
</section>
<section class="content">
	<?php
	$total_harus_proses=total_harus_proses();
	if($this->session->userdata('id_role')>=9&&$total_harus_proses>0){
	// 
	?>
	<div class="alert alert-warning">Ada <?php echo $total_harus_proses ?> pesanan yang harus diproses <img style="height: 3rem" src="<?php echo base_url()."upload/profil/icon-new.gif" ?>"> <a href="<?php echo base_url()."backend/katalog_pelayanan/informasi_mkg" ?>">lihat</a></div>
	<?php }?>
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>
				<div class="info-box-content">
				<span class="info-box-text"><?= format_datetime(date('Y-m-d')) ?></span>
				<span id="clockbox" class="info-box-number"></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<form action="">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<select class="form-control" name="dari" id="filter_bulan">
								<option value="" disabled selected>Dari Bulan</option>
							<?php for($i=1;$i<=12;$i++): ?>
									<option value="<?= $i ?>" <?= ($filter && $filter['dari'] == $i) ? 'selected' : '' ?> <?= ($i > date('m') ? 'disabled' : '') ?>><?= bulan($i) ?></option>
								<?php endfor ?>
							</select>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<select class="form-control" name="sampai" id="filter_bulan">
								<option value="" disabled selected>Sampai Bulan</option>
							<?php for($i=1;$i<=12;$i++): ?>
									<option value="<?= $i ?>" <?= ($i == (($filter && $filter['sampai']) ? $filter['sampai'] : (($filter) ? 1 : date('m'))) && $i != 1) ? 'selected' : '' ?> <?= ($i > date('m') ? 'disabled' : '') ?>><?= bulan($i) ?></option>
								<?php endfor ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="row">
					<div class="col-xs-9">
						<div class="form-group">
							<select class="form-control" name="tahun" id="filter_bulan">
								<?php for($i=(date('Y') - 7);$i<=date('Y');$i++): ?>
									<option value="<?= $i ?>" <?= $i == ( ($filter && $filter['tahun']) ? $filter['tahun'] : date('Y')) ? 'selected' : '' ?>><?= $i ?></option>
								<?php endfor ?>
							</select>
						</div>
					</div>
					<div class="col-xs-3">
						<button class="btn btn-primary" id="btn_filter">Filter</button>
	
					</div>
					
				</div>
			</div>
		</form>
		
	</div>
	<div class="row">
		<div class="col-6">
			<?= $jumlah_pendaftar ?>
		</div>
		<div class="col-6">
			<?= $jumlah_layanan ?>
		</div>
		<div class="col-6">
			<?= $jumlah_pendapatan ?>
		<div class="col-6">
			<div id="containerLayanan"></div>
		</div>
		<div class="col-6">
			<?= $status_permohonan ?>
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

	$(document).ready(function(){
		var optionDari = $('select[name="dari"]').find('option');
		var optionSampai = $('select[name="sampai"]').find('option');
		var date = new Date();

		$('select[name="tahun"]').on('change',function(){
			if ($(this).val() == date.getFullYear()) {
				
				optionDari.each(function() {
					if ($(this).val() > date.getMonth() + 1) {
						$(this).attr('disabled', 'disabled');
					}
				});
				optionSampai.each(function() {
					if ($(this).val() > date.getMonth() + 1) {
						$(this).attr('disabled', 'disabled');
					}
				});

			}else{
				$('select[name="dari"]').find('option').removeAttr('disabled');
				$('select[name="sampai"]').find('option').removeAttr('disabled');
			}
		})

	})
	
  </script>