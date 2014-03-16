<?php 

require_once("../../class/sesion/Sesion.php");
require_once("../../class/administrador/model.php");
$sesion = new Sesion();

/*if(empty($sesion->checarLogin())){
    header("Location: login.php");
}
*/
if(!$sesion->checarLogin() && $sesion->getPermiso != 1){
    header("Location: ../login");
}
if($_GET){
   if($_GET['q'] == 'logout'){
    $sesion->logout();
    header("Location: ../login");
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

    <title>Ciclo escolar</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/gritter/css/jquery.gritter.css" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap-datetimepicker/css/datetimepicker.css" />


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
          <a href="index" class="logo" >be<span>ca</span></a>
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
                  
                  <!-- user login dropdown start-->
                  <?php 
                    
                    $administrador = new Administrador();
    

                    $administrador->get(intval($sesion->getId()));
                    ?>

                  <li class="dropdown">
                      <a data-toggle="dropdown" class="" href="#">
                          <img alt="" src="">
                          <span class="username"><?php print $administrador->getAdm_nombre()." " .$administrador->getAdm_apellidoPaterno(); ?></span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                          <div class="log-arrow-up"></div>
                          <li><a href=""><i class=""></i></a></li>
                          <li><a href="configuracion"><i class="icon-cog"></i> Configuración</a></li>
                          <li><a href=""><i class=""></i></a></li>
                          <li><a href="cicloEscolar.php?q=logout"><i class="icon-key"></i>Cerrar sesion</a></li>
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
                      <a href="index">
                          <i class="icon-dashboard"></i>
                          <span>Inicio</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;">
                          <i class="icon-user"></i>
                          <span>Administración</span>
                      </a>
                      <ul class="sub" style="display: block;">
                          
                          <li class="active"><a  href="cicloEscolar">Ciclo escolar</a></li>
                          <li ><a  href="programas">Programas</a></li>
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
                      <section class="panel">
                        <div id="validar-ciclo-escolar"></div>
                          <header class="panel-heading">
                              Ciclo escolar
                          </header>
                          <div class="panel-body">
                              <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Ciclo escolar</label>
                                      <div class="col-lg-6">
                                         
                                       
                                          <div class="input-group input-large date dpYears" data-date="13-07-2013"  data-date-format="mm-dd-yyyy">

                                              <input id="dan-fechaInicio-ciclo-escolar" value="" type="text" class="form-control form-control-inline input-medium default-date-picker dpd1" name="from">

                                              <span class="input-group-addon">Hasta</span>

                                              <input id="dan-fechaFinal-ciclo-escolar" value="" type="text" class="form-control form-control-inline input-medium default-date-picker dpd2" name="to">
                                          </div>

                                        

                                      </div>
                                  </div><!--fin group-->
                                 
                                  <div class="form-group">
                                      <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Descripción</label>
                                     <div class="col-md-9">
                                              <textarea id="dan-informacion-ciclo-escolar" class="wysihtml5 form-control" rows="10"></textarea>
                                     </div>
                                  </div><!--fin group-->

                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button id="enviar-ciclo-escolar" type="button" class="btn btn-danger">Enviar</button>
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
                          <header class="panel-heading">
                              Ciclos escolares
                          </header>
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  
                                  <th class="hidden-phone"><i class="icon-calendar-empty"></i> Inicio ciclo escolar  </th>
                                  <th class="hidden-phone"><i class="icon-calendar-empty"></i> Fin ciclo escolar  </th>

                                  <th><i class="icon-info"></i> Descripcion</th>
                                  <th><i class="icon-check-sign"></i> Activo</th>
                                  
                                  <th><i class=" icon-edit"></i> Editar</th>
                                  
                              </tr>
                              </thead>
                              <tbody id="tabla_ciclo_escolar">
                              
                              
                              
                             
                              </tbody>
                          </table>
                          <!--Modal-->

                           <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  
                          </div>

                          <div class="modal fade" id="myModalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Eliminar</h4>
                                          </div>
                                          <div class="modal-body">

                                              Eliminar ciclo escolar

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                                              <button id="eliminar-ciclo-escolar-m" class="btn btn-warning" type="button">Eliminar</button>
                                          </div>
                                      </div>
                                  </div>
                          </div>
                            <!--Fin modal-->

                            <div class="modal fade" id="myModalActivar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Activar</h4>
                                          </div>
                                          <div class="modal-body">

                                              Activar ciclo escolar

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                                              <button id="activar-ciclo-escolar-m" class="btn btn-warning" type="button">Activar</button>
                                          </div>
                                      </div>
                                  </div>
                          </div>
                          <div class="modal fade" id="myModalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Editar ciclo escolar</h4>
                                          </div>
                                          <div id="modal-editar-ciclo-escolar" class="modal-body">

                                              

                                          </div>
                                          <div class="modal-footer">

                                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                                            <button id="enviar-ciclo-escolar-m" class="btn btn-danger" type="button"> Aceptar</button>

                                            
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
             Realizado por Daniel Brena Aquino.
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
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="../text/javascript" src="assets/gritter/js/jquery.gritter.js"></script>
    <script src="../js/respond.min.js" ></script>
    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="js/jquery.stepy.js"></script>
    
    <script src="js/daniel/formulario_ciclo_escolar.js"></script>
   
   <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
  <script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

 <script src="js/advanced-form-components.js"></script>

  

  </body>
</html>
