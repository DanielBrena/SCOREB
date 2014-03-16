<?php

class Seguridad
{
   // private $parametro;
    
    public static function daniel_real_scape_string($parametro){
        return mysql_real_escape_string($parametro);
    }
    
    
    
    public static function daniel_trim($parametro){
       return trim($parametro);
        
    }



    
    
}
?>
