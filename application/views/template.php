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
  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <!-- Le styles -->
  <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
  <style type="text/css">
    body {
      padding-top: 20px;
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
      z-index: 9999;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background: rgba( 255, 255, 255, .8 ) 
        url("<?=base_url()?>assets/img/loading.gif")
        50% 50% 
        no-repeat;
    }
    th.header { 
        cursor: pointer; 
    }

    /* Arrumando o datetimepiker para aparecer sobre os modais. */
    .bootstrap-datetimepicker-widget { z-index: 9998;}

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
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/img/144x144.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/img/114x114.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/img/72x72.png">
  <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/img/32x32.png">
  <link rel="shortcut icon" href="<?=base_url()?>assets/img/32x32.png">
</head>
<body>
  <div class="navbar <?php if (ENVIRONMENT == "production") echo "navbar-inverse"; ?> navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container-fluid">
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <?php if($this->session->userdata('userID')) { ?>
          <span class="brand dropdown">
            Projeto:
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Selecione outro projeto">
              <?php
                if($this->session->userdata('userProject') > 0) {
                  echo $this->session->userdata('userProjectName');
                } else {
                  echo "Todos";
                }
              ?>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#" id='0' class="projectSelect">Todos</a></li>
              <?php foreach($this->session->userdata('userProjects') as $project) { ?>
                <li><a href="#" id='<?=$project->projectID?>' class="projectSelect"><?=$project->projectTitle?></a></li>
              <?php } ?>
            </ul>
          </span>
        <?php } else { ?>
          <style type="text/css">
            /* arrumando o local do logo */
            .brand
            {
              background: url("<?=base_url()?>assets/img/logo.png") no-repeat left center;
              height: 20px;
              width: 110px;
            }
          </style>
          <span class="brand"></span>
        <?php } ?>


        <div class="nav-collapse collapse">
          <ul class="nav pull-right">
            <?php if($this->session->userdata('userID')) { ?>
            <li class="dropdown pull-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-large"></i> <?=$this->session->userdata('userName')?></a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1"  href="#profile">Perfil</a></li>
                <li><a tabindex="-1"  href="#configuracoes">Configurações</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1"  href="<?=base_url()?>user/logout">Logout</a></li>
              </ul>
            </li>
            <?php } else { ?> 
              <p class="navbar-text pull-right">
                <i class="icon-user icon-large"></i>
                <a class="navbar-link" href="<?=base_url()?>user/login"> Entrar</a>
              </p>
            <?php } ?>
          </ul>
          <ul class="nav">

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Dashboard"><i class="icon-signal icon-large"></i> Dash</a>
              <ul class="dropdown-menu">
                <li><a href="<?=base_url()?>dashboard" rel="tooltip" title="Estatísticas">Estatísticas</a></li>
                <li><a href="<?=base_url()?>dashboard/apacheInfo" rel="tooltip" title="Dados do apache">Servidor</a></li>
                <li><a href="<?=base_url()?>dashboard/dbInfo" rel="tooltip" title="Dados do apache">TZADI</a></li>
              </ul>
            </li>

            <li <?php if($this->router->class == 'git'){ echo 'class="active"';}?> >
              <a href="<?=base_url()?>git" rel="tooltip" title="Git"><i class="icon-github icon-large"></i> Git</a>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Boas práticas"><i class="icon-lightbulb icon-large"></i> SOS</a>
              <ul class="dropdown-menu">
                <li><a href="<?=base_url()?>gp" rel="tooltip" title="Boas práticas com git"><i class="icon-file"></i> Git</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Ferramentas"><i class="icon-wrench icon-large"></i> Tools</a>
              <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#" class="calcButton">Calculadora</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Tarefas"><i class="icon-ok icon-large"></i> Task</a>
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



    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="globalAlert"></div>
        </div>
      </div>
      <div class="row-fluid">
        <div class="span12 well">
          {content}
        </div>
      </div>
      <hr>
      <footer>
        <p class="pull-right">Powered by: &copy; <a target="_blank" href="http://tzadi.com">Tzadi.com</a> 2013</p>
      </footer>
    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-transition.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-alert.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-scrollspy.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-tab.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-tooltip.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-popover.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-button.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-collapse.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-carousel.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-typeahead.js"></script>

    <script type="text/javascript" src="<?=base_url()?>assets/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript" src="<?=base_url()?>assets/JQuery/jquery.tablesorter.min.js"></script> 

    <!-- Cusom JS -->
    <script src="<?=base_url()?>assets/js/global.js"></script>
    <script src="<?=base_url()?>assets/js/common/topMenu.js"></script>


    <!-- Dialogs -->
    <div class="modal hide fade" id="tzadiDialogs" tabindex="-1"></div>
    <div class="modal hide fade" id="tzadiTaskForm" tabindex="-1"></div>
    <div class="modal hide fade" id="tzadiCalc" tabindex="-1"></div>
    <div class="modal hide fade" id="filter" tabindex="-1"></div>
    <div class="loading"></div>
</body>
</html>
