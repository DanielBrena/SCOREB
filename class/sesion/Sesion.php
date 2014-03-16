<?php

include($_SERVER['DOCUMENT_ROOT']."/SCOREB/class/administrador/model.php");

class Sesion {

   
    public $mensaje;
    private $id;
    private $permiso;

    function __construct() {
        //session_start();
        session_start();
        //$this->checarLogin();
        @$this->id=$_SESSION['adminID'];
            
    }

    public function checarLogin() {
      return @$_SESSION['login'];

    }

    public function login($username = '', $clave = '') {
        $administrador = new Administrador();
        $log = $administrador->login($username, $clave);
        
        if($log){
           // $_SESSION['adminID'] = $administrador->getAdm_id();
            $_SESSION['adminID'] = $administrador->getAdm_id();
            $this->id = $administrador->getAdm_id();
            $this->permiso = $administrador->getAdm_permiso();
            $_SESSION['login'] = true;
            return true;
          
        }else{
             return false;
             
        }
        
       /* $administrador = new Administrador();
        $log = $administrador->login($username, $clave);
        if ($log) {


            $this->adminID = $administrador->getAdm_id();
            $this->permisoID = $administrador->getAdm_permiso();
            $_SESSION['adminID'] = $this->adminID;
            $_SESSION['permisoID'] = $this->permisoID;
            $this->estado = true;
                header("Location: index.php");
           // header("Location: ". dirname(__FILE__)."/../template/index.php");
            
        } else {
            $this->mensaje = "Clave incorrecta o usuario incorrecto";
        }*/
    }
    
    public function logout(){

        $_SESSION['login'] = false;
        $this->id = null;
        $this->permiso = null;
        session_destroy();
    }

    /*public function logout() {
        session_destroy();
        unset($this->adminID);
        unset($this->permisoID);
        $this->estado = false;
        header("Location: login.php");
    }
    
    public function getEstado() {
        return $this->estado;
    }

    public function getAdminID() {
        return $this->adminID;
    }

    public function getPermisoID() {
        return $this->permisoID;
    }
*/

     public function getId() {
        return $this->id;
    }

    public function getPermiso() {
        return $this->permiso;
    }


}

?>