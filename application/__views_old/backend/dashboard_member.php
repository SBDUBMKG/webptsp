<section class="content-header">
	<h1> 
		Dashboard
		<small>BMKG</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
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