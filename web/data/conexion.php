<?php 
    // $con = new mysqli('localhost', 'root', '', 'giotdb');
    // $tildes = $con->query("SET NAMES 'utf8'");
    
    // if($con -> connect_error){
    //     die('Conexion no establecida: ' . $con -> connect_error);
    // }else{
    //     //echo "Conexion establecida"; 
    // }

    $con = new mysqli('localhost', 'tarek_admin', 'AccubCirpOtyim5', 'tarek_giotdb');
    $tildes = $con->query("SET NAMES 'utf8'");
    
    if($con -> connect_error){
        die('Conexion no establecida: ' . $con -> connect_error);
    }else{
        //echo "Conexion establecida"; 
    }

?>