<?php
if (isset($_POST['codigo'])) {
    include '../../Share/conexion.php';
    $conn = OpenCon();
    $cod =$_POST['codigo'];
    if ($_POST["codigo"] != "" && $_POST["pregunta"] != "" && $_POST["respuesta"] != ""&& $_POST["idTipo"] != "") {
        $sqlPreguntas = "INSERT INTO tblpreguntas(idEvaluacion, idTipoPregunta,pregunta, respuestaCorrecta,seleccion1,seleccion2,seleccion3) VALUES ('" . $_POST["codigo"] . "','" . $_POST["idTipo"] . "','" . $_POST["pregunta"] . "','" . $_POST["respuesta"] . "','" . $_POST["respuestaf1"] . "','" . $_POST["respuestaf2"] . "','" . $_POST["respuestaf3"] . "')";
        $count = $conn->exec($sqlPreguntas);      

        if ($count > 0) {
            echo "SI";
        } else {
            echo "Error SQL";
            CloseCon($conn);
        }
    } else {
        echo "Cod: $cod";
    }
}