<?php 
/**


*/
//require_once ("../../core/DBAbstractModel.php");
require_once("../../class/sesion/Sesion.php");
//require_once("../../class/administrador/model.php");
//require_once("../../class/universidad/model.php");
require_once("../../class/programa/model.php");
require_once("../../class/administrador/model.php");
require_once("../../class/ciclo/model.php");
require_once("../../class/tipoBeca/model.php");
require_once("../../class/configuracion/model.php");
$sesion = new Sesion();
  //var_dump($sesion->getPermiso());
if(!$sesion->checarLogin() || @$sesion->getPermiso() == "2"){
    header("Location: ../login.php");
}
if($_GET){
   if($_GET['q'] == 'logout'){
    $sesion->logout();
    header("Location: ../login.php");
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
    <link rel="shortcut icon"  type="image/png" href="../img/favicon.ico">

    <title>Administración</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />

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
          <a href="../index" class="logo" >SCO<span>REB</span></a>
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
                          
                          <li><a href="index.php?q=logout"><i class="icon-key"></i> Log Out</a></li>
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
                         
                          <li id="ciclo-escolares"><a  href="ciclosescolares">Ciclos escolares</a></li>
                          <li id="programas"><a  href="programas">Programas</a></li>
                          <li id="tipo-becas"><a  href="tipobecas">Tipos de becas</a></li>
                          <li id="administradores"><a  href="administradores">Administradores</a></li>
                          <li id="otorgarbeca"><a  href="otorgarbecas">Otorgar becas</a></li>
                          <li id="matricula"><a  href="matricula">Matricula</a></li>
                          <li id="alumnos"><a  href="alumnos">Alumnos</a></li>
                          <li id="cambiarPorcentajeAcordado"><a  href="cambiarPorcentajeAcordado">Porcentajes acordados</a></li>
                          <li id="infobecanueva"><a  href="infobecanueva">Información becas nuevas</a></li>
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
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="icon-user"></i>
                          </div>
                          <div class="value">
                              <h1 class="count">
                                   <?php 
                                  $admin = new Administrador();
                                  $row_a = $admin->mostrar();
                                 
                                  echo count($row_a);
                                   ?>
                              </h1>
                              <p>Administradores</p>
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
                                  $ciclo = new CicloEscolar();
                                  $row_c = $ciclo->mostrar();
                                 
                                  echo count($row_c);
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
                                  $programa = new Programa();
                                  $row_p = $programa->mostrar();
                                 
                                  echo count($row_p);
                                   ?>
                              </h1>
                              <p>Programas</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class=" icon-unchecked (alias)"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count4">
                                   <?php 
                                  $tipobeca = new TipoBeca();
                                  $row_tb = $tipobeca->mostrar();
                                 
                                  echo count($row_tb);
                                   ?>
                              </h1>
                              <p>Tipos de becas</p>
                          </div>
                      </section>
                  </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <section class="panel">
                <?php 

                /**

                */
                $admin_info = new Administrador();
                $admin_info->get(intval($sesion->getID()));
                 ?>
                    <div class="bio-graph-heading">
                             Universidad La Salle Oaxaca.
                      </div>
                      <div class="panel-body bio-graph-info">
                              <h1>Administrador</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>Nombre </span>: <?php echo " ".$admin_info->getAdm_nombre(); ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Apellido Paterno </span>: <?php echo " ".$admin_info->getAdm_apellidoPaterno(); ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Usuario </span>: <?php echo " ".$admin_info->getAdm_usuario(); ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Correo</span>:<?php echo " ".$admin_info->getAdm_correo(); ?></p>
                                  </div>
                                  
                              </div>
                      </div>
                  </section>
              <!-- page end-->

              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Configuracion porcentaje para la Matricula esperada.
                          </header>
                          <div class="panel-body">
                              <form class="form-inline" role="form">
                                  <div class="form-group">
                                      
                                      
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-5">
                                            <div class="input-group m-bot15">
                                              <?php 
                                              /**
                                              
                                              */
                                              $configuracion = new Configuracion();
                                              $configuracion->get(intval(2));
                                              $valor = $configuracion->getCon_valorConfiguracion();
                                              $id = $configuracion->getCon_id();
                                               ?>
                                              <input  type="text" <?php echo 'value="'.$valor.'" data-id="'.$id.'"'; ?> class="form-control" id="porcentaje-matricula" placeholder="0">
                                              <span class="input-group-addon">%</span>
                                            </div>
                                     
                                     </div>
                                  
                                  <button type="button" id="enviar-porcentaje" class="btn btn-success">Actualizar</button>
                              </form>

                          </div>
                      </section>

                  </div>
              </div>
          </section>
      </section>
                </div>
              </div>
              

              
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
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../js/respond.min.js" ></script>

    <!--common script for all pages-->
    <script src="../js/common-scripts.js"></script>

    <!--this page-->
    
    <script type="text/javascript" src="js/app-index.js"></script>
  
  </body>
</html>

