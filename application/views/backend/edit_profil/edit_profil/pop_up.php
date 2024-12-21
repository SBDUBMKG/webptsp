<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Tampilan Pengingat</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/plugins/iCheck/square/blue.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="modal fade" id="myModal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h1>HIMBAUAN</h1>
							</div>
							<div class="modal-body">
								<h1>Mohon Isi Lengkap Profil Anda</h1>
							</div>
							<div class="modal-footer">
								<input class="btn btn-primary" data-dismiss="modal" value="Close">
							</div>
							<script src="<?php echo base_url() ?>resources/plugins/jQuery/jquery-2.2.3.min.js"></script>
							<!-- Bootstrap 3.3.6 -->
							<script src="<?php echo base_url() ?>resources/js/bootstrap.min.js"></script>
							<!-- iCheck -->
							<script src="<?php echo base_url() ?>resources/plugins/iCheck/icheck.min.js"></script>
							<script type="text/javascript">
								$(document).ready(function(){
									setTimeout(function(){
										$("#myModal").modal('show');
											setTimeout(function(){
												$("myModal").modal('hide');
										}, 3000);
									}, 2000);
								});
							</script>

</body>
</html>