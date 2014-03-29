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

    <title>Administración</title>

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
              <input type="hidden" id="-a" value="<?php echo $administrador->getAdm_nombre(); ?>">
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
                          <li id="tipo-becas"><a  href="tiposbecas">Tipos de becas</a></li>
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
              
              <!-- agregar start-->

              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Crear administrador
                          </header>
                          <div id="modal-show"></div>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="cmxform form-horizontal tasi-form" id="" >
                                      <div class="form-group ">
                                         <input class=" form-control" id='adm-id-1' type="hidden" />
                                          <label  class="control-label col-lg-2">Nombre</label>
                                          <div class="col-lg-10">
                                              <input class=" form-control" id='adm-nombre-1' type="text" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label  class="control-label col-lg-2">Apellido paterno</label>
                                          <div class="col-lg-10">
                                              <input class=" form-control" id="adm-apellido_paterno-1"  type="text" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Apellido materno</label>
                                          <div class="col-lg-10">
                                              <input class="form-control " id="adm-apellido_materno-1" type="text" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Correo electronico</label>
                                          <div class="col-lg-10">
                                              <input class="form-control " id="adm-correo-1"  type="email" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label class="control-label col-lg-2">Usuario</label>
                                          <div class="col-lg-10">
                                              <input class="form-control " id="adm-usuario-1" type="text" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="confirm_password" class="control-label col-lg-2">Clave</label>
                                          <div class="col-lg-10">
                                              <input class="form-control " id="adm-clave-1"  type="password" />
                                          </div>
                                      </div>
                                      
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Permiso</label>
                                          <div class="col-lg-10">
                                            <select id="adm-permiso-1"  class="form-control m-bot15" required>
                                              <option value="1" >1</option>
                                              <option value="2">2</option>
                                            </select>
                                          </div>
                                      </div>
                                      

                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">

                                              <button class="btn btn-danger" id="adm-enviar-1" type="button">Enviar</button>
                                              <button class="btn btn-default" style="display:none;" id="adm-cancelar-1" type="button">Cancelar</button>
                                              <button class="btn btn-primary" style="display:none;" id="adm-actualizar-1" type="button">Actualizar</button>
                                              
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </div>
              </div>

              <!-- agregar end-->

              <!--Tabla start -->
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
                                  
                              </tr>
                              </thead>
                              <tbody id="adm-table-administradores">
                               <?php 

                                /*$administradores = new Administrador();
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
                                */

                                ?>
                              
                             
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
    <script type="text/javascript" src="js/app-administradores.js"></script>

  </body>
</html>

