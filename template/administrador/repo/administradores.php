<?php 

require_once("../../class/sesion/Sesion.php");
require_once("../../class/administrador/model.php");
require_once("../../class/log/model.php");
$sesion = new Sesion();

if(!$sesion->checarLogin() && $sesion->getPermiso != 1){
    header("Location: login");
}
if($_GET){
   if($_GET['q'] == 'logout'){
    $sesion->logout();
    header("Location: login");
   }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $array_data_administrador = array(
      'adm_id' => '',
      'adm_nombre' => addslashes($_POST['adm_nombre']),
      'adm_apellidoPaterno' => addslashes($_POST['adm_apellidoPaterno']),
      'adm_apellidoMaterno' => addslashes($_POST['adm_apellidoMaterno']),
      'adm_correo' => addslashes($_POST['adm_correo']),
      'adm_usuario' => addslashes($_POST['adm_usuario']),
      'adm_clave' => addslashes($_POST['adm_clave']),
      'adm_permiso' => addslashes($_POST['adm_permiso'])
    );

    $administrador_alta = new Administrador();
    $administrador_alta->set($array_data_administrador);


    $administrador_alta->get(intval(( $sesion->getId() )));
    $log = new Log();

    $array_data_logs = array(
      'log_id'=>'',
      'log_descripcion'=>'Alta|Ciclo escolar',
      'log_creador' =>$administrador_alta->getAdm_nombre()
    );
    $log->set($array_data_logs);


   
    
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

    <title>Administradores</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/gritter/css/jquery.gritter.css" />
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
          <a href="index.html" class="logo" >be<span>ca</span></a>
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
                          <img alt="" src="">
                          <span class="username"><?php print $administrador->getAdm_nombre()." " .$administrador->getAdm_apellidoPaterno(); ?></span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended logout">
                        <li><a href=""><i class=""></i></a></li>
                        <li><a href="configuracion"><i class="icon-cog"></i> Configuración</a></li>
                        <li><a href=""><i class=""></i></a></li>
                        <li><a href="administradores.php?q=logout"><i class="icon-key"></i>Cerrar sesion</a></li>
                      
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
                      <ul class="sub">
                          
                          <li><a  href="cicloEscolar">Ciclo escolar</a></li>
                          <li><a  href="programas">Programas</a></li>
                          <li><a  href="tipoBecas">Tipos de becas</a></li>
                          <li class="active"><a  href="administradores">Administradores</a></li>
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
                          <div id="validar_administrador">
                            <script> </script>
                          </div>
                          <header class="panel-heading">
                              Crear administradores
                          </header>
                          
                          <div class="panel-body">
                              <div class="stepy-tab">
                                  <ul id="default-titles" class="stepy-titles clearfix">
                                      <li id="default-title-0" class="current-step">
                                          <div>Paso 1</div>
                                      </li>
                                      <li id="default-title-1" class="">
                                          <div>Paso 2</div>
                                      </li>
                                      <li id="default-title-2" class="">
                                          <div>Paso 3</div>
                                      </li>
                                  </ul>
                              </div>
                              <form class="form-horizontal"  method="POST" id="default">
                                  <fieldset title="Paso 1" class="step" id="default-step-0">
                                      <legend> </legend>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Nombre</label>
                                          <div class="col-lg-10">
                                              <input type="text" name="adm_nombre" id="dan-nombre" class="form-control" placeholder="Nombre" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Apellido Paterno</label>
                                          <div class="col-lg-10">
                                              <input type="text" name="adm_apellidoPaterno" id="dan-apellidoP" class="form-control" placeholder="Apellido paterno" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Apellido Materno</label>
                                          <div class="col-lg-10">
                                              <input type="text" name="adm_apellidoMaterno" id="dan-apellidoM" class="form-control" placeholder="Apellido materno" >
                                          </div>
                                      </div>
                                      

                                  </fieldset>

                                  <fieldset title="Paso 2" class="step" id="default-step-1" >
                                      <legend> </legend>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Direccion de correo</label>
                                          <div class="col-lg-10">
                                              <input type="email" name="adm_correo" id="dan-correo" class="form-control" placeholder="Correo electronico" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Usuario</label>
                                          <div class="col-lg-10">
                                              <input type="text" name="adm_usuario" id="dan-usuario" class="form-control" placeholder="Usuario">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Clave</label>
                                          <div class="col-lg-10">
                                              <input type="password" name="adm_clave" id="dan-clave" class="form-control" placeholder="Clave" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Permiso</label>
                                          <div class="col-lg-10">
                                             
                                              <select id="dan-permiso" name="adm_permiso" class="form-control m-bot15" required>
                                                  <option value="1" >1</option>
                                                  <option value="2">2</option>
                                                  
                                              </select>

                                          
                                              </div>
                                              
                                          
                                      </div>

                                  </fieldset>
                                 
                                  <fieldset title="Paso 3" class="step" id="default-step-2" >
                                      <legend> </legend>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Nombre</label>
                                          <div class="col-lg-10">
                                              <p id="dan-nombre_" class="form-control-static"></p>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label class="col-lg-2 control-label">Apellido paterno</label>
                                          <div class="col-lg-10">
                                              <p id="dan-apellidoP_" class="form-control-static"></p>
                                          </div>
                                      </div>
                                       <div class="form-group">
                                          <label class="col-lg-2 control-label">Apellido materno</label>
                                          <div class="col-lg-10">
                                              <p id="dan-apellidoM_" class="form-control-static"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Correo electronico</label>
                                          <div class="col-lg-10">
                                              <p id="dan-correo_" class="form-control-static"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Usuario</label>
                                          <div class="col-lg-10">
                                              <p id="dan-usuario_" class="form-control-static"></p>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Permiso</label>
                                          <div class="col-lg-10">
                                              <p id="dan-permiso_" class="form-control-static"></p>
                                          </div>
                                      </div>
                                     
                                      
                                  </fieldset>
                                  <input type="submit" id="enviar" class="finish btn btn-danger" value="Finish"/>
                              </form>
                          </div>
                      </section>
                  </div>
              </div>

               <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Administradores
                          </header>
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th><i class="icon-key"></i> Permiso</th>
                                  <th class="hidden-phone"><i class="icon-male"></i> Nombre Completo</th>
                                  <th><i class="icon-envelope-alt"></i> Correo electronico</th>
                                  <th><i></i> </th>
                                  <th><i class=" icon-edit"></i> Editar</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody id="tabla_administradores">
                               <?php 

                                $administradores = new Administrador();
                                $filas = $administradores->mostrar();
                                for ($i=0; $i < count($filas); $i++) { 
                                  print '<tr>';
                                  print '<td>'.$filas[$i]['adm_permiso'].'</td>';
                                  print '<td class="hidden-phone">'.$filas[$i]['adm_nombre']." ".$filas[$i]['adm_apellidoPaterno'].'</td>';
                                  print '<td class="hidden-phone">'.$filas[$i]['adm_correo'].'</td>';
                                  print '<td><spam class="label label-info label-mini">'.$filas[$i]['adm_estado'].'</spam></td>';
                                  print '<td>';
                                  //print '<button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>';
                                  print '<a href="../actualizacion/'.$filas[$i]['adm_id'].'"><button  class="btn btn-primary btn-xs"><i class="icon-pencil confirm-edit"></i></button></a>';
                                  print '<button data-id="'.$filas[$i]['adm_id'].'" class="btn btn-danger btn-xs confirm-delete"><i  class="icon-trash"></i></button>';
                                  print '</td>';
                                  print '<tr>';
                                }

                                ?>
                              
                              
                             
                              </tbody>
                          </table>
                          <!--Modal-->

                           <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  
                          </div>

                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Eliminar</h4>
                                          </div>
                                          <div class="modal-body">

                                              Eliminar administrador

                                          </div>
                                          <div class="modal-footer">
                                              <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                                              <button id="eliminar" class="btn btn-warning" type="button"> Eliminar</button>
                                          </div>
                                      </div>
                                  </div>
                          </div>
                            <!--Fin modal-->
                          <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                              <h4 class="modal-title">Exito!</h4>
                                          </div>
                                          <div class="modal-body">

                                              Se ha creado un nuevo administrador

                                          </div>
                                          <div class="modal-footer">
                                              <button id="aceptar" class="btn btn-danger" type="button"> Aceptar</button>
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
     <script src="../js/daniel/formulario_administrador.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/gritter/js/jquery.gritter.js"></script>
    <script src="../js/respond.min.js" ></script>


    <!--common script for all pages-->
    <script src="../js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="../js/jquery.stepy.js"></script>
   


  <script>

      //step wizard

      $(function() {
          $('#default').stepy({
              backLabel: 'Previous',
              block: true,
              nextLabel: 'Next',
              titleClick: true,
              titleTarget: '.stepy-tab'
          });
      });
  </script>


  </body>
</html>
