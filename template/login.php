<!DOCTYPE html>
<?php 
  


//require_once("../class/sesion/Sesion.php");
include("../class/sesion/Sesion.php");
//require_once( dirname( __FILE__ ) . '/class/sesion/Sesion.php' );

$sesion = new Sesion();
if($sesion->checarLogin()){
  header("Location: index.php");
}


  if($_SERVER["REQUEST_METHOD"] == "POST"){
      

      $admin = $_POST['admin'];
      $clave = $_POST['clave'];
      
      
      $sesion->login($admin, $clave);

      if($sesion){
        header("Location: index.php");
      }else{
        print "Bad";
      }

   
  }
  
 ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Control de Becas">
    <meta name="author" content="Daniel Brena Aquino">
    <meta name="keyword" content="Ulsa, La Salle Oaxaca, Universidad La Salle">
    <link rel="shortcut icon"  type="image/png" href="img/favicon.ico">

    <title>Acceso</title>

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

  <body class="login-body">

    <div class="container">

      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">Acceso</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" name="admin" placeholder="Correo o usuario" autofocus required>
            <input type="password" class="form-control" name="clave" placeholder="Clave" required>
            <label class="checkbox" >
                <!---<input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>-->
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Acceder</button>
            <!-- <p>or you can sign in via social network</p>
           <div class="login-social-link">
                <a href="index.html" class="facebook">
                    <i class="icon-facebook"></i>
                    Facebook
                </a>
                <a href="index.html" class="twitter">
                    <i class="icon-twitter"></i>
                    Twitter
                </a>
            </div>
            <!--<div class="registration">
                Don't have an account yet?
                <a class="" href="registration.html">
                    Create an account
                </a>
            </div>
          -->

        </div>

          <!-- Modal -->
         <!-- <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>-->
          <!-- modal -->

      </form>

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>


  </body>
</html>
