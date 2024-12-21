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
		<div class="col-6">
			<?= $jumlah_pendaftar ?>
		</div>
		<div class="col-6">
			<?= $jumlah_layanan ?>
		</div>
		<div class="col-6">
			<?= $jumlah_pendapatan ?>
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
  </script>