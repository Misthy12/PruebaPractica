<?php
    if (isset($_GET['codigo'])) {
        include '../../Share/funciones.php';

        $conn = OpenCon();
            
        // Verificamos la conexión
        if ($conn->connect_error) {
            die("No se pudo conectar a la base de datos :( ");
            header('Location: ./listado_evaluaciones.php?result=3');
        } 
        
        if(actividadRealizada($_GET['codigo'])==null){
            $sth = $conn->prepare("DELETE FROM tblPreguntas WHERE tblPreguntas.idEvaluacion = ?");
            $sth->execute(array($_GET['codigo']));
            $count = $sth->rowCount();

            $sthE = $conn->prepare("DELETE FROM tblEvaluaciones WHERE tblEvaluaciones.idEvaluacion = ?");
            $sthE->execute(array($_GET['codigo']));
            $count += $sthE->rowCount();

                if ($count > 1) {
                    header('Location: ./listado_evaluaciones.php?result=1');                
                    exit();
                } else {
                    header('Location: ./listado_evaluaciones.php?result=0');
                    exit();
                }
                CloseCon($conn);
        }else{
            header('Location: ./listado_evaluaciones.php?result=2');
        }
    } else {
        header('Location:./listado_evaluaciones.php?result=0');
    }
?>