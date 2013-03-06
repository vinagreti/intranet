<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tzadi</title>
		<!-- Enable responsive features-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap CSS-->
		<link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<!-- Bootstrap CSS responsive-->
		<link href="<?=base_url()?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		<!-- Bootstrap clockface CSS-->
		<link href="<?=base_url()?>assets/bootstrap/css/bootstrap-clockface.css" rel="stylesheet" media="screen">
		<!-- Bootstrap daterangepicker CSS-->
		<link href="<?=base_url()?>assets/bootstrap/css/bootstrap-daterangepicker.css" rel="stylesheet" media="screen">
		<!-- Bootstrap datepicker CSS-->
		<link href="<?=base_url()?>assets/bootstrap/css/bootstrap-datepicker.css" rel="stylesheet" media="screen">
		<!-- start: Favicon -->
		<link rel="shortcut icon" href="<?= base_url()?>assets/img/favicon.ico">
		<!-- Putting the container under the navbar -->
		<style type="text/css">
		body {
			padding-top: 60px;
			padding-bottom: 40px;
		}
		.sidebar-nav {
			padding: 9px 0;
		}
		.loading
		{
			display:none;
			position: fixed;
			z-index: 1000;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background: rgba( 255, 255, 255, .8 ) 
				url("<?=base_url()?>assets/img/loading.gif")
				50% 50% 
				no-repeat;
		}
		</style>
		<!-- Loading the JQuery -->
		<script src="<?=base_url()?>assets/JQuery/jquery.js"></script>

		<script type="text/javascript">
    		var base_url = "<?=base_url()?>" ;
		</script>
	</head>

	<body>
