<?php 

require_once("../../class/sesion/Sesion.php");
require_once("../../class/vistas/model.php");
$sesion = new Sesion();

if(!$sesion->checarLogin() || @$sesion->getPermiso() == '2'){
    header("Location: ../login.php");
}
if($_GET){
   if(@$_GET['q'] == 'logout'){
    $sesion->logout();
    header("Location: ../login.php");
   }
}
if($_GET['alumno']){
  @$alum = $_GET['alumno'];
}else{
  header("Location: otorgarbecas.php");
}

if($_POST){

  $vis = new VistaBecaAlumno();

  @$valor = $_POST['acordado'];
  @$bec = $_POST['id_beca'];

    $vis->actualizar($valor,$bec);
    header("Location: otorgarbecas.php");
  
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

    <title>Otorgar becas</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style-responsive.css" rel="stylesheet" />

      <link href="../assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="../assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/gritter/css/jquery.gritter.css" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body data-page="administradores">
<?php 
$vista = new VistaBecaAlumno();
$row = $vista->abc($alum);
for($i = 0; $i < count($row); $i++){
  $nombre = $row[0]['alu_nombre'];
  $ap = $row[0]['alu_apellidoPaterno'];
  $id_alumno = $row[0]['alu_id'];
  $id_beca = $row[0]['bec_id'];
  $ps = $row[0]['bec_porcentajeSolicitado'];

}



 ?>
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

          
              <div id="modal-show"></div>
            <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            <?php echo "<h2>".$nombre." ".$ap."</h2>"; ?>
                          </header>
                          
                          <div class="panel-body">
                             <form class="form-horizontal" method="post" action="" role="form">
                                <input id="idbeca" type="hidden" name="id_beca" value="<?php echo $id_beca ?>">
                                  <div class="form-group">
                                      <label  class="col-lg-2 col-sm-2 control-label">Porcentaje Solicitado</label>
                                      <div class="col-lg-10">
                                          <input type="text"  disabled="disabled" value="<?php echo $ps; ?>" class="form-control" id="solicitado" placeholder="">
                                      </div>
                                  </div>
                                 
                                  <div class="form-group">
                                      <label  class="col-lg-2 col-sm-2 control-label">Porcentaje Acordado</label>
                                      <div class="col-lg-10">
                                          <input type="text" name="acordado" class="form-control" id="acordado" placeholder="">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button id="submit" type="submit" class="btn btn-danger">Aceptar</button>
                                         <a href="otorgarbecas"><button id="cancelar" type="button"  class="btn btn-default">Cancelar</button></a>
                                          
                                      </div>
                                  </div>
                              </form>
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
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../js/jquery.scrollTo.min.js"></script>
    <script src="../js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../js/respond.min.js" ></script>

    <!--common script for all pages-->
    <script src="../js/common-scripts.js"></script>
 <script type="text/javascript" language="javascript" src="../assets/advanced-datatable/media/js/jquery.js"></script>
    <!--griter-verificar-->
        <script type="text/javascript" language="javascript" src="../assets/advanced-datatable/media/js/jquery.dataTables.js"></script>


      <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
              } );


          } );
      </script>
    <script type="text/javascript" src="../assets/gritter/js/jquery.gritter.js"></script>
    <!--this page-->
 
    <script type="text/javascript" src="js/app-otorgarbeca.js"></script>
  </body>
</html>

