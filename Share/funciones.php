<?php
    include "conexion.php";

    //funciones para IndexAdmin 
    function numeroAlumnos(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de alumnos
         $stmt = $conn->prepare("SELECT idAlumno FROM tblAlumnos");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
    }
 
    function numeroEvaluaciones(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de evaluaciones
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblEvaluaciones");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count/100);
         CloseCon($conn);
    }
 
    function numeroUsuarios(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de usuarios
         $stmt = $conn->prepare("SELECT idUsuario FROM tblUsuarios");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
    }
    //busqueda de usuario
    function usuario($usuario){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de usuarios
         $stmt = $conn->prepare("SELECT idUsuario FROM tblUsuarios");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
    }


    //generar contrasenias
    function generarClaves($long){
     $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
     $password = "";
     //Reconstruimos la contraseña segun la longitud que se quiera
     for($i=0;$i<$long;$i++) {
        //obtenemos un caracter aleatorio escogido de la cadena de caracteres
         $password .= substr($str,rand(0,62),1);
     }
     return $password;
    }
    //
    function numeroDocentes(){
         //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de docentes
         $stmt = $conn->prepare("SELECT idDocente FROM tblDocentes");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
    }

    //genera codigo de evluacion
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
     
     //numero de aprobados de una evaluacion
     function aprobados($id){
          //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de aprobados de eval
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Aprobado' AND idEvaluacion=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }

     //numero de reprobados de una evaluacion
     function reprobados($id){
          //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de reprobados de una evaluacion
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Reprobado' AND idEvaluacion=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }
     
     //numero de reprobados de una evaluacion
     function actividadRealizada($id){
          //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de reprobados de una evaluacion
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE idEvaluacion=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }
     
     //informacion de un docente
     function docentesParaInfoEval($id){
          //consulta a bd
         $conn=OpenCon();
 
         //consulta 
         $stmt = $conn->prepare("SELECT * FROM tblDocentes WHERE idDocente=$id");
         $stmt->execute();
         $rowE=$stmt->fetchAll(PDO::FETCH_OBJ);
          foreach($rowE as $rowE){
               $nombre=$rowE->docenteNombre." ".$rowE->docenteApellido;
          }
         return($nombre);
         CloseCon($conn);
     }

     //numero de aprobados de un alumno
     function alumnosAprobados($id){
          //consulta a bd
         $conn=OpenCon();
 
         //consulta de Num de aprobados de alumno
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Aprobado' AND idAlumno=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }
     
     //Numero de reprobados de un alumno
     function alumnosReprobados($id){
          //consulta a bd
         $conn=OpenCon();
         //consulta de Num de reporbados de alumno
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Reprobado' AND idAlumno=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }
     
     //Numero de evaluaciones realizadas por un alumno
     function evalDeUnEstudiante($id){
          //consulta a bd
         $conn=OpenCon();
         //consulta de Num de eval de alumno
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE idAlumno=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }

     //Numero de reprobados de una evaluacion de un docente
     function activReprobadas($id){
          //consulta a bd de docente para extraer el id de eval
         $conn=OpenCon();
         $sql=$conn->prepare("SELECT *FROM tblEvaluaciones WHERE idDocente = $id");
         $sql->execute();
         $rowE=$sql->fetchAll(PDO::FETCH_OBJ);
         foreach($rowE as $rowE){}
          $eval=$rowE->idEvaluacion;

          //consulta de Num de eval reprobed
          $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Reprobado' AND idEvaluacion=$eval");
          $stmt->execute();
          $count=$stmt->rowCount();
          return($count);
          // CloseCon($conn);
     }
     
     //Numero de aprobados de una evaluacion de un docente
     function activAprobadas($id){
           //consulta a bd de docente para extraer el id de eval
         $conn=OpenCon();
         $sql=$conn->prepare("SELECT *FROM tblEvaluaciones WHERE idDocente = $id");
         $sql->execute();
         $rowE=$sql->fetchAll(PDO::FETCH_OBJ);
         foreach($rowE as $rowE){}
         $eval=$rowE->idEvaluacion;
          //consulta de Num de aproved
           $stmt = $conn->prepare("SELECT idEvaluacion FROM tblevaluacionalumno WHERE estado='Aprobado' AND idEvaluacion=$eval");
               $stmt->execute();
               $count=$stmt->rowCount();
               return($count);
               CloseCon($conn);
          
     }
     //Numero de aprobados de una evaluacion de un docente
     function evalDeUnDocente($id){
          //consulta a bd
         $conn=OpenCon();
         //consulta de Num de aproved
         $stmt = $conn->prepare("SELECT idEvaluacion FROM tblEvaluaciones WHERE  idDocente=$id");
         $stmt->execute();
         $count=$stmt->rowCount();
         return($count);
         CloseCon($conn);
     }
     

?>