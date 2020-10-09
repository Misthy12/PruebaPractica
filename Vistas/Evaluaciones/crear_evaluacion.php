<?php
if (isset($_POST['codigo'])) {
    include '../../Share/conexion.php';
    $conn = OpenCon();

    if ($_POST["codigo"] != "" && $_POST["fecha"] != "" && $_POST["idDocente"] != "") {
        $sqlEvaluacion = "INSERT INTO tblevaluaciones(codigo, fecha, idDocente, indicaciones) VALUES ('" . $_POST["codigo"] . "','" . $_POST["fecha"] . "','" . $_POST["idDocente"] . "','" . $_POST["indicaciones"] . "')";
        $count = $conn->exec($sqlEvaluacion);
        $idEval = $conn->lastInsertId(); //extrae el id del ultimo registro insertado en la bd

        if ($count > 0) {
            echo "$idEval";
        } else {
            echo "Error SQL";
            CloseCon($conn);
        }
    } else {
        echo "Datos NULL";
    }
}
