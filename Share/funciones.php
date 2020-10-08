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
         CloseCon($conn);
    }
 
    function numeroEvaluaciones(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblEvaluaciones");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count/100);
         CloseCon($conn);
    }
 
    function numeroUsuarios(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idUsuario FROM tblUsuarios");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
    }
    function numeroDocentes(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idDocente FROM tblDocentes");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
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

     function aprobados($id){
          //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Aprobado' AND idEvaluacion=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }

     function reprobados($id){
          //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Reprobado' AND idEvaluacion=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }
     
     function docentesParaInfoEval($id){
          //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT * FROM tblDocentes WHERE idDocente=$id");
         $stmt->execute();
         $rowE=$stmt->fetchAll(PDO::FETCH_OBJ);
          foreach($rowE as $rowE){
               $nombre=$rowE->docenteNombre." ".$rowE->docenteApellido;
          }
         return($nombre);
         CloseCon($conn);
     }

     function alumnosAprobados($id){
          //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Aprobado' AND idAlumno=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }
     
     function alumnosReprobados($id){
          //consulta a bd
         $conn=OpenCon();
         //consulta de Num de cupones
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Reprobado' AND idAlumno=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }

?>