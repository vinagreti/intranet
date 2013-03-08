<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{page_title}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
  <!-- Le styles -->
  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
  }
  .sidebar-nav {
    padding: 9px 0;
  }
  @media (max-width: 980px) {
    /* Enable use of floated navbar text */
    .navbar-text.pull-right {
      float: none;
      padding-left: 5px;
      padding-right: 5px;
    }
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

  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

  <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/font-awesome.min.css">

  <!--[if IE 7]>
  <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/css/font-awesome-ie7.min.css">
  <![endif]-->

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
  <script src="<?=base_url()?>assets/bootstrap/js/html5shiv.js"></script>
  <![endif]-->
  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/bootstrap/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/bootstrap/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/bootstrap/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/bootstrap/ico/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="<?=base_url()?>assets/bootstrap/ico/favicon.png">
</head>
<body>
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="brand" href="<?=base_url()?>">Intranet</a>
        <div class="nav-collapse collapse">
          <ul class="nav pull-right">  
            <li class="dropdown pull-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-large icon-white"></i> <?=$this->session->userdata('userName')?></b></a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1"  href="#profile">Perfil</a></li>
                <li><a tabindex="-1"  href="#configuracoes">Configurações</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1"  href="<?=base_url()?>logout">Logout</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav">

            <li <?php if($this->router->class == 'git'){ echo 'class="active"';}?> >
              <a href="<?=base_url()?>git" rel="tooltip" title="Git"><i class="icon-github icon-large icon-white"></i></a>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Dashboard"><i class="icon-signal icon-large icon-white"></i></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?=base_url()?>dashboard" rel="tooltip" title="Estatísticas">Estatísticas</a></li>
                <li><a href="<?=base_url()?>dashboard/serverInfo" rel="tooltip" title="Dados do apache">Servidor</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Boas práticas"><i class="icon-lightbulb icon-large icon-white"></i></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?=base_url()?>gp" rel="tooltip" title="Boas práticas com git"><i class="icon-file"></i> Git</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Ferramentas"><i class="icon-wrench icon-large icon-white"></i></b></a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#" class="calcButton">Calculadora</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Tarefas"><i class="icon-time icon-large icon-white"></i></a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#" class="newTaskButton">Nova Tarefa</a></li>
                <li><a tabindex="-1" href="#" class="newProjectButton">Novo Projeto</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="<?=base_url()?>task">Listar Tarefas</a></li>
                <li><a href="<?=base_url()?>task/userActivities">Histórico de atividades</a></li>
              </ul>
            </li>
          </div><!--/.nav-collapse -->
        </div><!-- container-fluid -->
      </div><!-- navbar-inner -->
    </div><!-- navbar -->
    <div class="container">
      {content}
      <hr>
      <footer>
        <p>{footer}</p>
      </footer>
    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url()?>assets/js/global.js"></script>
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
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-daterangepicker.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-daterangepicker-date.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap-clockface.js"></script>
</body>
</html>
