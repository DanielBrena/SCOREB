<?php 

require_once("../../class/sesion/Sesion.php");

$sesion = new Sesion();

if(!$sesion->checarLogin() || @$sesion->getPermiso() == '2'){
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
<html  lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Control de Becas">
    <meta name="author" content="Daniel Brena Aquino">
    <meta name="keyword" content="Ulsa, La Salle Oaxaca, Universidad La Salle">
    <link rel="shortcut icon"  type="image/png" href="../img/favicon.ico">

    <title>Programas</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="../assets/gritter/css/jquery.gritter.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body data-page="administradores">

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
                          <li><a href=""><i class=""></i></a></li>
                          <li><a href="index"><i class="icon-cog"></i> Configuración</a></li>
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
      
      <!--sidebar end-->
      <!--main content start-->
      <section id="main">
          <section class="wrapper site-min-height">
              <!-- page start-->
              
              <!-- agregar start-->

              <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                             Agregar informacion de becas nuevas
                          </header>
                          <div id="modal-show"></div>
                          <div class="panel-body">
                             <form class="form-horizontal" role="form">
                                <input id="mat-id-1" type="hidden" value="">

                                 <div class="form-group">
                                          <label  class="control-label col-lg-4">Programa</label>
                                          <div class="col-lg-6">
                                            <select id="mat-programa-1"  class="form-control m-bot15" required>
                                              <option value="1" >Lic. Arquitectura</option>
                                              <option value="2">2</option>-->
                                            </select>
                                          </div>
                                  </div>
                                 
                                  

                                  <div class="form-group">

                                      <label class="col-lg-4 col-sm-2 control-label">Solicitudes</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mat-bajas-1" placeholder="">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-lg-4 col-sm-2 control-label">Alumnos beneficiados</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mat-reinscripcion-1" placeholder="">
                                      </div>
                                  </div>


                                  <div class="form-group">
                                    <label class="col-lg-4 col-sm-2 control-label">Becas al 100 % solicitadas</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mat-reinscripcion-1" placeholder="">
                                      </div>
                                  </div>


                                  <div class="form-group">
                                    <label class="col-lg-4 col-sm-2 control-label">Becas al 100 % otorgadas</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mat-reinscripcion-1" placeholder="">
                                      </div>
                                  </div>

                                  <!--<div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button id="mat-enviar-1" type="button" class="btn btn-danger">Enviar</button>
                                          <button id="mat-actualizar-1" type="button" style="display:none;" class="btn btn-primary">Actualizar</button>
                                          <button id="mat-cancelar-1" type="button" style="display:none;" class="btn btn-default">Cancelar</button>
                                      </div>
                                  </div>-->
                              </form>
                          </div>

                      </section>

                  </div>

                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                            </br>
                          </header>
                          <div id="modal-show"></div>
                          <div class="panel-body">
                             <form class="form-horizontal" role="form">
                            
                                 <div class="form-group">
                                    <label class="col-lg-4 col-sm-2 control-label">Becas al 100 % solicitadas no dictaminadas</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mat-reinscripcion-1" placeholder="">
                                      </div>
                                  </div>


                                  <div class="form-group">
                                    <label class="col-lg-4 col-sm-2 control-label">Matricula esperada</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mat-reinscripcion-1" placeholder="">
                                      </div>
                                  </div>


                                  <div class="form-group">
                                    <label class="col-lg-4 col-sm-2 control-label">Becas presupuestadas</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mat-reinscripcion-1" placeholder="">
                                      </div>
                                  </div>


                                  <div class="form-group">
                                    <label class="col-lg-4 col-sm-2 control-label">Disponibilidad de becas</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mat-reinscripcion-1" placeholder="">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-lg-4 col-sm-2 control-label">Disponibilidad real de becas</label>
                                      <div class="col-lg-6">
                                          <input type="text" class="form-control" id="mat-reinscripcion-1" placeholder="">
                                      </div>
                                  </div>
                              </form>
                          </div>

                      </section>

                  </div>
              </div>

              <div class="row">
                <div class="col-lg-12">

                      <section class="panel">
                        <button type="button" id="bec-enviar-1" class="btn btn-primary btn-small btn-block">Enviar</button>
                         <button id="mat-actualizar-1" type="button" style="display:none;" class="btn btn-primary btn-small btn-block">Actualizar</button>
                        <button id="mat-cancelar-1" type="button" style="display:none;" class="btn btn-default btn-small btn-block">Cancelar</button>
                      </section>

                </div>
                
              </div>

              <!-- agregar end-->

              <!--Tabla start -->
               <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Información de becas nuevas
                          </header>
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th ><i></i> Programa </th>
                                  <th><i ></i> Solicitudes</th>
                                  <th><i ></i>Alumnos beneficiados</th>
                                  <th><i></i>Becas al 100% solicitadas</th>
                                  <th><i></i>Becas al 100% otorgadas</th>
                                  <th><i ></i>Becas al 100% solicitadas no dictaminadas</th>
                                  <th><i ></i>Matrciula esperada</th>
                                  <th><i></i>Becas presupuestadas</th>
                                  <th><i ></i>Disponibilidad de becas</th>
                                  <th><i ></i>Disponibilidad real de becas</th>
                                  <th><i></i>Editar</th>
                              </tr>
                              </thead>
                              <tbody id="mat-table-matricula">
                               
                              
                             
                              </tbody>
                          </table>
                          <!--Modal-->
                          
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
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../js/respond.min.js" ></script>

    <!--common script for all pages-->
    <script src="../js/common-scripts.js"></script>

    <!--griter-verificar-->
    <script type="text/javascript" src="../assets/gritter/js/jquery.gritter.js"></script>
    <!--this page-->
    <script type="text/javascript" src="js/app-infobecanueva.js"></script>

  </body>
</html>

