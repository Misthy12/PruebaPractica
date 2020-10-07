<?php
    include "conexion.php";

    //funciones para IndexAdmin 
    function numeroAlumnos(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idAlumno FROM tblAlumnos");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
    }
 
    function numeroEvaluaciones(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblEvaluaciones");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count/100);
    }
 
    function numeroUsuarios(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idUsuario FROM tblUsuarios");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
    }
    function numeroDocentes(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idDocente FROM tblDocentes");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
    }

    function generarCodigo($longitud) {
        $key = '';
        $letras = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numeros='1234567890';
        $max = strlen($letras)-1;
        $max2 = strlen($numeros)-1;

        for($i=0;$i < $longitud;$i++) {
            $key .= $letras{mt_rand(0,$max)};
            $key .= $numeros{mt_rand(0,$max2)};
        }
            return $key;
        
       }
?>