<?php
//CONECCION PARA PDO
function OpenCon(){
    /*Conexion a una Base de Datos MySql*/
    $dsn = 'mysql:dbname=bd_evaluaciones;host=127.0.0.1';
    $usuario = 'root';
    $contrasena = '';
    try{
       $mbd = new PDO($dsn,$usuario,$contrasena,array(PDO::ATTR_PERSISTENT => true));
    } 
    catch (PDOException $e){
       die('Fallo la conexión: ' .$e->getMessage());
       $mbd = null;
    }
    return $mbd;
 }
 function CloseCon($mbd){
    $mbd = null;
 }
?>