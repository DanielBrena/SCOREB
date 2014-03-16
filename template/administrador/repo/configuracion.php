<?php 

require_once("../class/sesion/Sesion.php");
require_once("../class/administrador/model.php");
require_once("../class/universidad/model.php");

$sesion = new Sesion();

if(!$sesion->checarLogin() && $sesion->getPermiso != 1){
    header("Location: login.php");
}
if($_GET){
   if($_GET['q'] == 'logout'){
    $sesion->logout();
    header("Location: login.php");
   }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Configuración</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <link href="css/style-responsive.css" rel="stylesheet" />



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
          <div class="sidebar-toggle-box">
              <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
          </div>
          <!--logo start-->
          <a href="index.html" class="logo" >Be<span>ca</span></a>
          <!--logo end-->
          <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
              <!-- settings start -->
              
              <!-- notification dropdown end -->
          </ul>
          </div>
          <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                  <li>
                      <input type="text" class="form-control search" placeholder="Search">
                  </li>
                  <!-- user login dropdown start-->

                  <?php 
                    
                    $administrador = new Administrador();
    

                    $administrador->get(intval($sesion->getId()));
                    ?>
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <img alt="" src="img/avatar1_small.jpg">
                          <span class="username"><?php print $administrador->getAdm_nombre()." " .$administrador->getAdm_apellidoPaterno(); ?></span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <div class="log-arrow-up"></div>
                          
                          <li><a href="configuracion.php?q=logout"><i class="icon-key"></i>Cerrar sesion</a></li>
                      </ul>
                  </li>
                  <!-- user login dropdown end -->
              </ul>
          </div>
      </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a href="index.php">
                          <i class="icon-dashboard"></i>
                          <span>Inicio</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="icon-user"></i>
                          <span>Administración</span>
                      </a>
                      <ul class="sub">
                         
                          <li><a  href="cicloEscolar">Ciclo escolar</a></li>
                          <li><a  href="programas">Programas</a></li>
                          <li><a  href="tipoBecas">Tipos de becas</a></li>
                          <li><a  href="administradores">Administradores</a></li>
                      </ul>
                  </li>

                  

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->

               <div class="row">
                  <div class="col-lg-12">
                      <!--latest product info start-->
                    
                      <!--latest product info end-->
                      <!--twitter feedback start-->
                      <section class="panel post-wrap pro-box">
                          <aside class="post-highlight terques v-align">
                              <div class="panel-body">
                                <?php 

                                /**

                                */
                                $universidad = new Universidad();
                                $universidad->get(1); 
                                 ?>
                                  <h2><?php echo $universidad->getUni_descripcion(); ?></h2>
                              </div>
                          </aside>
                          <aside>
                              <div class="post-info">
                                  <span class="arrow-pro left"></span>
                                  <div class="panel-body">
                                      <div class="text-center twite">
                                          <h1><?php echo  $universidad->getUni_nombre(); ?></h1>
                                      </div>

                                     
                                  </div>
                              </div>
                          </aside>
                      </section>
                      <!--twitter feedback end-->
                  </div>
                  
              </div>
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="icon-user"></i>
                          </div>
                          <div class="value">
                              <h1 class="count">
                                  0
                              </h1>
                              <p>Alumnos</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol red">
                              <i class=" icon-calendar-empty"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count2">
                                  <?php 
                                    require_once("../class/ciclo/model.php");
                                    $ciclo = new CicloEscolar();
                                    echo count($ciclo->mostrar());

                                   ?>
                              </h1>
                              <p>Ciclos escolares</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol yellow">
                              <i class="icon-book"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count3">
                                  <?php 
                                    require_once("../class/programa/model.php");
                                    $programa = new Programa();
                                    echo count($programa->mostrar());

                                   ?>
                              </h1>
                              <p>Programas</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class=" icon-bookmark-empty"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count4">
                                  <?php 
                                    require_once("../class/tipoBeca/model.php");
                                    $tipoBeca = new TipoBeca();
                                    echo count($tipoBeca->mostrar());

                                   ?>
                              </h1>
                              <p>Tipos de becas</p>
                          </div>
                      </section>
                  </div>
                  
              </div>

               <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Registro
                              <span class="tools pull-right">
                                <a class="icon-chevron-down" href="javascript:;"></a>
                                <a class="icon-remove" href="javascript:;"></a>
                            </span>
                          </header>
                          <div id="logs" class="panel-body profile-activity">
                              
                              <!--<div class="activity terques">
                                  <span>
                                      <i class="icon-shopping-cart"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow"></div>
                                              <i class=" icon-time"></i>
                                              <h4>10:45 AM</h4>
                                              <p>Purchased new equipments for zonal office setup and stationaries.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="activity alt purple">
                                  <span>
                                      <i class="icon-rocket"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow-alt"></div>
                                              <i class=" icon-time"></i>
                                              <h4>12:30 AM</h4>
                                              <p>Lorem ipsum dolor sit amet consiquest dio</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="activity blue">
                                  <span>
                                      <i class="icon-bullhorn"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow"></div>
                                              <i class=" icon-time"></i>
                                              <h4>10:45 AM</h4>
                                              <p>Please note which location you will consider, or both. Reporting to the VP  you will be responsible for managing.. </p>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="activity alt green">
                                  <span>
                                      <i class="icon-beer"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow-alt"></div>
                                              <i class=" icon-time"></i>
                                              <h4>12:30 AM</h4>
                                              <p>Please note which location you will consider, or both.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>-->

                          </div>
                      </section>
                  </div>
                  <div class="col-lg-6">
                              <section class="panel">
                                  <header class="panel-heading">
                                      Opciones
                                  </header>
                                  <div class="panel-body">
                                      
                                      <div class="row m-bot15">
                                          <div class="col-sm-3 text-center">
                                             <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label">Activar registro</label>
                                                
                                            </div>   
                                          </div>
                                          <div class="col-sm-3 text-center">
                                             <div class="form-group">
                                                <label class="col-lg-2 col-sm-2 control-label"></label>
                                                
                                            </div>   
                                          </div>
                                          <div class="col-sm-6 text-center">
                                              <div class="switch switch-square"
                                                   data-on-label="<i class=' icon-ok'></i>"
                                                   data-off-label="<i class='icon-remove'></i>">
                                                  <input id="opcion-cb" type="checkbox" checked="" />
                                              </div>
                                          </div>
                                      </div>
                                      
                                  </div>
                              </section>
                              
                          </div>
                  
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              Realizado por Daniel Brena Aquino
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>

  <!--custom switch-->
  <script src="js/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="js/jquery.tagsinput.js"></script>
  <!--custom checkbox & radio-->
  <script type="text/javascript" src="js/ga.js"></script>

  <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
  <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>

  <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script src="js/respond.min.js" ></script>


  <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
    <script type="text/javascript" src="js/daniel/recargar_log.js"></script>
  <!--script for this page-->
  <script src="js/form-component.js"></script>



  </body>
</html>
