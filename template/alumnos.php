<?php 

require_once("../class/sesion/Sesion.php");
require_once("../class/vistas/model.php");
$sesion = new Sesion();

if(!$sesion->checarLogin() ){
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
    <link rel="shortcut icon"  type="image/png" href="img/favicon.ico">

    <title>Alumnos</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    

      <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/gritter/css/jquery.gritter.css" />

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
     
      <!--sidebar end-->
      <!--main content start-->
      <section id="main">
          <section class="wrapper site-min-height">
              <!-- page start-->
              
              <!-- agregar start-->

              <!--<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Alumnos
                          </header>
                          <div id="modal-show"></div>
                          <div class="panel-body">
                             <form class="form-horizontal" role="form">
                                <input id="pro-id-1" type="hidden" value="">
                                  <div class="form-group">
                                      <label  class="col-lg-2 col-sm-2 control-label">Nombre</label>
                                      <div class="col-lg-10">
                                          <input type="text" class="form-control" id="pro-nombre-1" placeholder="Nombre">
                                      </div>
                                  </div>
                                 
                                  
                                  
                              </form>
                          </div>
                      </section>
                  </div>
              </div>-->

              

              <!-- agregar end-->

              <!--Tabla start -->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                        <header class="panel-heading">
                            Alumnos nuevos
                        </header>
                        <div class="panel-body">
                           <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th class="hidden-phone">Apellido Materno</th>
                                    <th>Programa</th>
                                    <th>Sexo</th>
                                    <th>Tipo de Beca</th>
                                    <th>Pendiente</th>
                                    <th class="hidden-phone">Renovación e Historial</th>
                                   
                                </tr>
                                </thead>
                                <tbody id="table-alumnos-1">
                                <?php 
                                require_once("../class/alumno/model.php");
                                $alumnos = new VistaBecaAlumno();
                                $row = $alumnos->mostrar_alumnos();
                                for ($i=0; $i < count($row); $i++) { 
                                  echo '<tr class="gradeX">';
                                  echo '<td>'.$row[$i]['alu_id'].'</td>';
                                  echo '<td>'.$row[$i]['alu_nombre'].'</td>';
                                  echo '<td>'.$row[$i]['alu_apellidoPaterno'].'</td>';
                                  echo '<td class="hidden-phone">'.$row[$i]['alu_apellidoMaterno'].'</td>';
                                  echo '<td class="hidden-phone">'.$row[$i]['pro_nombre'].'</td>';
                                  echo '<td class="hidden-phone">'.$row[$i]['alu_sexo'].'</td>';
                                  echo '<td class="hidden-phone">'.$row[$i]['tip_nombre'].'</td>';
                                  echo '<td class="hidden-phone">'.$row[$i]['bec_pendiente'].'</td>';
                                  echo '<td class="center hidden-phone">';
                                  if($row[$i]['cic_activar'] == '0' && $row[$i]['bec_porcentajeAcordado'] >= 0){
                                     echo '<a href="becarenovacion?alumno='.$row[$i]['alu_id'].'"><button data-id=""  class="btn btn-primary btn-xs confirm-activar"><i class="icon-check "></i></button></a>';
                                  }
                                  
                                  if($row[$i]['bec_porcentajeAcordado'] != 0 ){
                                    echo '<a href="historial?alumno='.$row[$i]['alu_id'].'"><button data-id="" class="btn btn-danger btn-xs confirm-delete"><i  class="icon-book"></i></button>';
                                  }
                                  
                                  
                                  if($row[$i]['cic_activar'] == '1' && $row[$i]['bec_porcentajeAcordado'] == 0){
                                      echo '<a href="editar?alumno='.$row[$i]['abc_id'].'"><button data-id="" class="btn btn-success btn-xs confirm-edit"><i  class="icon-edit"></i></button>';
                                  }
                                  echo '</td>';
                                  echo '</tr>';
                                }
                                ?>
                                
                                </tbody>
                            </table>
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
              
           Desarrollado por Daniel Brena Aquino y Tamara Pérez Vázquez
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script src="js/respond.min.js" ></script>


  <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <!--script for this page only-->

      <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
              } );
          } );
      </script>

    <!--this page-->
   
  </body>
</html>

