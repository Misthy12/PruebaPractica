<?php
    if (isset($_GET['codigo'])) {
        include '../../Share/funciones.php';
        $conn = OpenCon();
            
        // Verificamos la conexión
        if ($conn->connect_error) {
            die("No se pudo conectar a la base de datos :( ");
            header('Location: ./listado_docentes.php?result=0');
        } 
        
        if(evalDeUnDocente($_GET['codigo'])==null){
        $sql = "DELETE FROM tblDocentes WHERE idDocente = ?";
        $sth = $conn->prepare($sql);
        $sth->execute(array($_GET['codigo']));
        $count = $sth->rowCount();

            if ($count > 0) {
                header('Location: ./listado_docentes.php?result=1');                
                exit();
            } else {
                header('Location: ./listado_docentes.php?result=0');
                exit();
            }
            CloseCon($conn);
        }else{
            header('Location: ./listado_docentes.php?result=2');
        }
    } else {
        header('Location:./listado_docentes.php?result=0');
    }
?>e