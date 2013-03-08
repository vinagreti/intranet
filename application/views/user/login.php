<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sign in &middot; Tzadi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Le styles -->
  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <style type="text/css">
  body {
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
  }

  .title {
    max-width: 360px;
    padding: 19px 29px 29px;
    margin: 0 auto 20px;
  }

  .form-signin {
    max-width: 300px;
    padding: 19px 29px 29px;
    margin: 0 auto 20px;
    background-color: #fff;
    border: 1px solid #e5e5e5;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
    -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
    box-shadow: 0 1px 2px rgba(0,0,0,.05);
  }
  .form-signin .form-signin-heading,
  .form-signin .checkbox {
    margin-bottom: 10px;
  }
  .form-signin input[type="text"],
  .form-signin input[type="password"] {
    font-size: 16px;
    height: auto;
    margin-bottom: 15px;
    padding: 7px 9px;
  }

  </style>
  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/img/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/img/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/img/favicon.ico">
  <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/img/favicon.ico">
  <link rel="shortcut icon" href="<?=base_url()?>assets/img/favicon.ico">
</head>

<body>

  <div class="container">

	<h3 class="title">Bem vindo à Intranet da Tzadi</h3>

	<form method="post" action="<?=base_url()?>user/submitLogin" class="form-horizontal form-signin">

		<h4 class="form-signin-heading">Forneça seu email e senha</h4>

		<input type="text" class="input-block-level" placeholder="Email" id="email" name="email">
		<input type="password" class="input-block-level" placeholder="Senha" id="password" name="password">
		<button class="btn btn-large btn-primary" type="submit">Entrar</button>

	</form>

  </div> <!-- /container -->

  <!-- Le javascript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?=base_url()?>assets/JQuery/jquery.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-transition.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-alert.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-modal.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-dropdown.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-scrollspy.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-tab.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-tooltip.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-popover.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-button.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-collapse.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-carousel.js"></script>
  <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-typeahead.js"></script>

  </body>
  </html>
