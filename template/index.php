<?php 

require_once("../class/sesion/Sesion.php");
require_once("../class/alumno/model.php");
require_once("../class/vistas/model.php");
require_once("../class/programa/model.php");
$sesion = new Sesion();

if(!$sesion->checarLogin()){
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
    <meta name="description" content="Sistema de Control de Becas">
    <meta name="author" content="Daniel Brena Aquino">
    <meta name="keyword" content="Ulsa, La Salle Oaxaca, Universidad La Salle">
    <link rel="shortcut icon"  type="image/png" href="img/favicon.ico">

    <title>Inicio</title>

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

  <body data-page="index">

  <section  id="container" class="">
      <!--header start-->
      <header class="header white-bg">
          <div class="sidebar-toggle-box">
              <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
          </div>
          <!--logo start-->
          <a href="index" class="logo" >SCO<span>REB</span></a>
          <!--logo end-->
         
          <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                 
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          
                          <span class="username">

                          <?php 
                          /**
                            Nombre de la sesion

                            */

                          $administrador = new Administrador();
                          $administrador->get(intval($sesion->getId()));
                          echo $administrador->getAdm_nombre()." ".$administrador->getAdm_apellidoPaterno();

                           ?>

                          </span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <div class="log-arrow-up"></div>
                          <li><a href=""><i class=""></i></a></li>
                          <?php 
                          if(@$sesion->getPermiso() != '2'){
                            echo '<li><a href="administrador/"><i class="icon-cog"></i>Configuración</a></li>';
                          }
                           ?>
                          
                          <li><a href=""><i class=""></i></a></li>
                          <li><a href="index.php?q=logout"><i class="icon-key"></i>Cerrar sesión</a></li>
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

                  

                  

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <a href="becanueva">
                            <div class="symbol terques">
                                <i class="icon-user"></i>
                            </div>
                          </a>
                          <div class="value">
                              <h1 class="count">
                                  <?php 
                                  $becanueva = new VistaBecaAlumno();
                                 $row = $becanueva->mostrar_param('Nueva');
                                 echo count($row);
                                  ?>
                              </h1>
                              <p>Becas nuevas</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <a href="alumnos">
                            <div class="symbol red">
                                <i class="icon-group"></i>
                            </div>
                          </a>
                          <div class="value">
                              <h1 class=" count2">
                                  <?php 
                                  $alumnos = new Alumno();
                                  $row2 = $alumnos->mostrar();
                                 
                                  echo count($row2);
                                   ?>
                              </h1>
                              <p>Alumnos</p>
                          </div>
                      </section>
                  </div>

                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          
                            <div class="symbol yellow">
                                <i class="icon-user"></i>
                            </div>
                          
                          <div class="value">
                              <h1 class="count">
                                  <?php 
                                  $becarenovacion = new VistaBecaAlumno();
                                  $row = $becarenovacion->mostrar_param('Renovacion');
                                  echo count($row);
                                  ?>
                              </h1>
                              <p>Renovaciones</p>
                          </div>
                      </section>
                  </div>

                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class="icon-book"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count3">
                                  <?php 
                                  $programa = new Programa();
                                 $row_p = $programa->mostrar();
                                 
                                 echo count($row_p);
                                   ?>
                              </h1>
                              <p>Programas</p>
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
              
            Desarrollado por Daniel Brena Aquino y Tamara Pérez Vázquez
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/respond.min.js" ></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <!--this page-->
   
  </body>
</html>

