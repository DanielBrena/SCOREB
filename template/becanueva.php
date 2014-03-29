<?php 

require_once("../class/sesion/Sesion.php");

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
<html  lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Control de Becas">
    <meta name="author" content="Daniel Brena Aquino">
    <meta name="keyword" content="Ulsa, La Salle Oaxaca, Universidad La Salle">
    <link rel="shortcut icon"  type="image/png" href="img/favicon.ico">

    <title>Beca nueva</title>

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

                  <div class="col-lg-3">

                      <section class="panel">
                          <header class="panel-heading">
                             Proceso alumno

                             <button id='alu-validar-1' style="display:none;" class="btn btn-primary btn-xs confirm-activate"><i class="icon-check-sign"></i></button>

                          </header>
                          <div id="modal-show"></div>
                          <div class="panel-body">
                             <form class="form-horizontal" role="form">
                                
                                  <div class="form-group">
                                      <input type='hidden' id="alu-id-1" value="">
                                      <div class="col-lg-12">
                                          <input type="text" class="form-control" id="alu-nombre-1" placeholder="Nombre">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      
                                      <div class="col-lg-12">
                                          <input type="text" class="form-control" id="alu-apellido-paterno-1" placeholder="Apellido paterno">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      
                                      <div class="col-lg-12">
                                          <input type="text" class="form-control" id="alu-apellido-materno-1" placeholder="Apellido materno">
                                      </div>
                                  </div> 

                                  <div class="form-group">
                                         
                                          <div class="col-lg-12">
                                            <select id="alu-sexo-1"  class="form-control m-bot15" required>
                                              <option value="Masculino" >Masculino</option>
                                              <option value="Femenino">Femenino</option>
                                            </select>
                                          </div>
                                  </div>

                                  <div class="form-group">
                                         
                                          <div class="col-lg-12">
                                             <div class="input-group  date dpYears" data-date="2014-01-01"  data-date-format="yyyy-mm-dd">

                                        
                                              <span class="input-group-addon">Fecha de cita</span>

                                              <input size="15" id="bec-fechacita-1" placeholder="" type="text" value="" readonly class="form_datetime form-control">
                                               </div>
                                          </div>
                                  </div>

                              </form>
                          </div>
                      </section>
                  </div>

                  <div class="col-lg-4">
                      <section class="panel">
                          <header class="panel-heading">
                             Proceso beca - Programas y fechas
                             <button id="bec-validar-pro-fe-1" style="display:none;" class="btn btn-primary btn-xs confirm-activate"><i class="icon-check-sign"></i></button>
                          </header>
                          <div id="modal-show"></div>
                          <div class="panel-body">

                             <form class="form-horizontal" role="form">
                                
                                <div class="form-group">
                                          <label class="col-lg-2 control-label">Programa</label>
                                          <div class="col-lg-10">
                                            <select id="bec-programa-1"  class="form-control m-bot15" required>
                                              <!--<option value="1" >1</option>
                                              <option value="2">2</option>-->
                                            </select>
                                          </div>
                                  </div>

                                  <div class="form-group">
                                          <label class="col-lg-2 control-label">Tipo de beca</label>
                                          <div class="col-lg-10">
                                            <select id="bec-tipobeca-1"  class="form-control m-bot15" required>
                                              <!--<option value="1" >1</option>
                                              <option value="2">2</option>-->
                                            </select>
                                          </div>
                                  </div>

                                  <div class="form-group">
                                          <label class="col-lg-2 control-label">Quien recibe</label>
                                          
                                            <div class="col-lg-10">
                                             <input type="text" class="form-control" id="bec-recibe-1" placeholder="Nombre de quien recibe">
                                           
                                          </div>
                                  </div>

                                 
                                  <div class="form-group">
                                          <label class="col-lg-2 control-label">Asistencia</label>
                                          <div class="col-lg-10">
                                            <select id="bec-asistencia-1"  class="form-control m-bot15" required>
                                              <option value="1" >Asistió</option>
                                              <option value="0">No asistió</option>
                                            </select>
                                          </div>
                                  </div>
                                

                                  
                                      
                                                                  
                            </form>

                            


                          </div>
                      </section>
                  </div>

                 <div class="col-lg-2">
                    <section class="panel">
                          <header class="panel-heading">
                             Proceso beca - Porcentajes
                             <button id="bec-validar-porcentajes-1" style="display:none" class="btn btn-primary btn-xs confirm-activate"><i class="icon-check-sign"></i></button>

                          </header>
                          <div id="modal-show"></div>
                          <div class="panel-body">

                             <form class="form-horizontal" role="form">
                                
                                <div class="form-group">
                                          <label class="col-lg-5 control-label">Porcentaje solicitado</label>
                                          <div class="col-lg-7">
                                           
                                           <div class="input-group m-bot15">
                                              
                                              <input type="text" class="form-control" id="bec-porcentajesolicitado-1" placeholder="0">
                                              <span class="input-group-addon">%</span>
                                            </div>
                                        
                                          </div>
                                </div>

                                <div class="form-group">

                                          <label class="col-lg-5 control-label">Porcentaje acordado</label>
                                          <div class="col-lg-7">
                                            <div class="input-group m-bot15">
                                              
                                              <input disabled="disabled" type="text" value="0" class="form-control" id="bec-porcentajeacordado-1" placeholder="0">
                                              <span class="input-group-addon">%</span>
                                            </div>
                                            
                                        
                                          </div>
                                </div>

                                  
                                                                  
                            </form>

                            


                          </div>
                    </section>
                  </div>

                  <div class="col-lg-3">

                      <section class="panel">
                          <header class="panel-heading">
                             Proceso beca - Pendientes y observaciones
                             <button id="bec-activar-pen-ob-1"  class="btn btn-primary btn-xs confirm-activate"><i class="icon-check-sign"></i></button>
                          </header>
                          <div id="modal-show"></div>
                          <div class="panel-body">
                             <form class="form-horizontal" role="form">

                                <div class="form-group">
                                      <label  class="col-lg-4 col-sm-2 control-label">Pendiente</label>
                                     <div class="col-md-8">
                                              <textarea id="bec-pendiente-1" class="wysihtml5 form-control" rows="2"></textarea>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                      <label  class="col-lg-4 col-sm-2 control-label">Observaciones</label>
                                     <div class="col-md-8">
                                              <textarea id="bec-observacion-1" class="wysihtml5 form-control" rows="2"></textarea>
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
                        <button type="button" id="bec-enviar-1" class="btn btn-primary btn-small btn-block">Crear becario</  button>
                      </section>

                </div>
                
              </div>


              <!-- agregar end-->

              <!--Tabla start -->
              <div class="row">
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
                                          <th>Sexo</th>
                                          <th>Programa    </th>
                                          <th>Tipo de beca</th>
                                          <th>Ciclo escolar</th>
                                          <th >Recibe</th>
                                          <th >Fecha cita</th>
                                          <th >% Solicitado</th>
                                          <th>Pendientes</th>
                                          <th>Tipo</th>
                                         
                                      </tr>
                                      </thead>
                                      <tbody id="bec-table-beca-alumno">
                                      
                                      </tbody>
                                      
                                      
                                  </table>
                              </section>
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
    <script type="text/javascript" src="usr/js/app-becanueva.js"></script>
    <script src="js/advanced-form-components.js"></script>

    

  </body>
</html>

