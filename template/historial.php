<?php 
/**


*/
//require_once ("../../core/DBAbstractModel.php");
require_once("../class/alumno/model.php");

require_once("../class/sesion/Sesion.php");
//require_once("../../class/administrador/model.php");
//require_once("../../class/universidad/model.php");

$sesion = new Sesion();

if(!$sesion->checarLogin()){
    header("Location: login.php");
}
if($_GET){
   if(@$_GET['q'] == 'logout'){
    $sesion->logout();
    header("Location: login.php");
   }
   
}
if($_GET['alumno']){
  @$alumno = $_GET['alumno'];
}else{
   header("Location: login.php");
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
    <link rel="shortcut icon"  type="image/png" href="img/favicon.ico">

    <title>Beca renovacion</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="assets/gritter/css/jquery.gritter.css" />


    <link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />


    <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link href="css/table-responsive.css" rel="stylesheet" />

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
                          <?php 
                          if(@$sesion->getPermiso() != '2'){
                            echo '<li><a href="administrador/"><i class="icon-cog"></i>Configuración</a></li>';
                          }
                           ?>
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
                  <div class="col-lg-12">
                      <!--timeline start-->
                      <section class="panel">
                          <div class="panel-body">
                                  <div class="text-center mbot30">
                                    <?php
                                        /**

                                        */
                                         $alumno_data = new Alumno();
                                         $alumno_data->get(intval($alumno));
                                         @$nombre = '';
                                         $nombre .= $alumno_data->getAlu_nombre(); 
                                         $nombre .= " ";
                                         $nombre .= $alumno_data->getAlu_apellidoPaterno();
                                         $nombre .= " ";
                                         $nombre .= $alumno_data->getAlu_apellidoMaterno();

                                         ?>

                                      <h3 class="timeline-title">
                                        <?php echo $nombre; ?>
                                      </h3>
                                      <p class="t-info">Historial de Becas</p>
                                  </div>

                                  <div class="timeline">
                                    <?php 
                                    /**

                                    */
                                    require_once("../class/vistas/model.php");
                                    $vista = new VistaHistorial();
                                    $row = $vista->mostrar(intval($alumno));
                                    for($i = 0; $i < count($row); $i++){
                                      $color = '';
                                      if($i % 2 == 0){
                                        $color = 'blue';
                                      }else{
                                        $color = 'green';
                                      }

                                     if($i % 2 == 0){ echo '<article class="timeline-item alt">';}else{
                                      echo '<article class="timeline-item">';
                                     }
                                            echo '<div class="timeline-desk">';
                                                echo '<div class="panel">';
                                                    echo '<div class="panel-body">';
                                                        echo '<span class="arrow-alt"></span>';
                                                        if($i % 2 == 0){echo '<span class="timeline-icon blue"></span>';}else{
                                                          echo '<span class="timeline-icon green"></span>';
                                                        }
                                                        echo '<span class="timeline-date">'.$row[$i]['cicloEscolar'].'</span>';
                                                        echo '<h1 class="'.$color.'">'.$row[$i]['tipo'].' | Porcentaje Solicitado: '.$row[$i]['porcentajeSolicitado'].' | Porcentaje Acordado: '.$row[$i]['porcentajeAcordado'].'</h1>';
                                                        
                                                       echo '<div class="notification">';
                                                          echo $row[$i]['programa'].'<a href="#">  '.$row[$i]['tipoBeca'].'</a>';
                                                      echo '</div>';

                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</article>';
                                    }

                                     ?>
                                      
                                  </div>

                                  <div class="clearfix">&nbsp;</div>
                              </div>
                      </section>
                      <!--timeline end-->
                  </div>
                 
              </div>

              


              <!-- agregar end-->

              <!--Tabla start -->
              <!--<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Alumnos con becas nuevas
                          </header>
                          <div class="panel-body">
                               <section id="flip-scroll">
                                  <table class="table table-bordered table-striped table-condensed cf">
                                      <thead class="cf">
                                      <tr>
                                          <th>Nombre</th>
                                          <th>Apellidos</th>
                                          <th>Programa    </th>
                                          <th>Tipo de beca</th>
                                          <th>Ciclo escolar</th>
                                          <th >Fecha recepcion</th>
                                          <th >Fecha cita</th>
                                          <th >% Solicitado</th>
                                          <th >Pendiente</th>
                                          <th >Observaciones</th>
                                      </tr>
                                      </thead>
                                      <tbody id="bec-table-beca-alumno">
                                      
                                      </tbody>
                                      
                                      
                                  </table>
                              </section>
                          </div>
                      </section>
                  </div>
              </div>-->






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


    <script type="text/javascript" src="assets/fuelux/js/spinner.min.js"></script>
  <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
  <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  <script type="text/javascript" src="assets/jquery-multi-select/js/jquery.quicksearch.js"></script>

  <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
  <script src="js/respond.min.js" ></script>
    <!--griter-verificar-->
    <script type="text/javascript" src="assets/gritter/js/jquery.gritter.js"></script>
    <!--this page-->
    <script type="text/javascript" src="usr/js/typeahead.js"></script>
    <script type="text/javascript" src="usr/js/app-becarenovacion.js"></script>

    <script src="js/advanced-form-components.js"></script>

    

  </body>
</html>



