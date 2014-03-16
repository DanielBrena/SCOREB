<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inicioSesion
 *
 * @author daniel
 */
require_once('../class/sesion/Sesion.php');
$sesion = new Sesion();

$sesion->login("brena", "12345");

$sesion->checarLogin();


?>
