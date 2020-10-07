<?php
include "../../Share/header.php";
include "../../Share/conexion.php";
//consulta para Docentes
$conn=OpenCon();
$sqlDocentes="SELECT * FROM tblDocentes";
//consulta para eval
// realizamos la consulta para obtener el mayor id insertado
$sqlEval = "SELECT MAX(idEvaluacion) AS id FROM tblEvaluaciones";
$query = $conn->prepare($sqlEval);
$query->execute();
$row = $query->fetch();
$idEval=$row['id']+1;
//consulta para pregunta
// realizamos la consulta para obtener el mayor id insertado
$sqlP = "SELECT MAX(idPregunta) AS id FROM tblPreguntas";
$queryP = $conn->prepare($sqlP);
$queryP->execute();
$rowP = $queryP->fetch();
$idPreg=$rowP['id'];
CloseCon($conn);
?>

<title>Evaluaciones</title>

    <div class="col-md-8 offset-md-2 col-sm-12">
        <div class="card">
        <div class="card-header bg-success">
                <h4 class="text-center">Agregar Evaluacion</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="form">
                    <div class="">
                        <hr>
                        <h4 class="text-center font-weight-bold">Informacion Evaluacion</h4>
                        <hr>
                    </div>
                    <div class="row col-12 form-group">
                        <div class="col-md-3 col-sm-12">
                            <label for="codigo">Codigo Evaluacion</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" required/>
                            <br>
                        </div>

                        <div class="col-md-3 col-sm-12">
                            <label for="fecha">Fecha Activa</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" require>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="docente">Docente</label>
                            <select name="docente" id="docente" type="text" class="form-control"  required>
                                <?php   
                                    foreach ($conn->query($sqlDocentes) as $valor) {
                                        echo "<option value='".$valor["idDocente"]."'>".$valor["docenteNombre"]." ".$valor["docenteApellido"]."</option>";
                                    }
                                ?>
                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="">
                        <hr>
                        <h4 class="text-center font-weight-bold">Preguntas</h4>
                        <hr>
                    </div>
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="cant">Cantidad de Preguntas</label>
                            <input type="email" name="cant" id="cant" class="form-control" require>
                            <br>
                        </div>
                        <div  class="col-md-6 col-sm-12">
                        <br>
                        <input type="button" value="Crear" id="btnPreguntas" class="btn btn-primary" >
                        </div>
                    </div>
                    <div class="row col-12 form-group">
                        <?php
                            // //tipo de pregunta
                            // $sqlTP="SELECT * FROM tbltipopreguntas";

                            // //repeticion
                            // if(isset($_POST["btnPreguntas"])){
                            //     for($i=1;$i<$_POST["cant"];$i++){
                            //         $idPr=$idPreg+$i;
                            //         echo "<input type='text' name='idEval' id='idVal' class='form-control col-3' value='$idEval' require>";
                            //         echo "<input type='text' name='idPregu' id='idPregu' class='form-control col-3' value='$idPr' require>";
                            //         echo "<select name='tipo' id='tipo' type='text' class='form-control col-6' required>";
                            //         foreach ($conn->query($sqlTP) as $valor) {
                            //             echo "<option value='".$valor["idTipo"]."'>".$valor["tipo"]."</option>";
                            //         }
                            //         echo "<input type='button' name='btnPreg' id='btnPreg' class='form-control btn btn-primary col-12' value='Enviar' >";
                            //         echo "</select>";
                            //         if(isset($_POST["btnPreg"])){
                            //             if($_POST["tipo"]="1"){
                            //                 echo "<input type='number' name='pondercion' id='pondercion' class='form-control col-3' step='0.1' placeholder='Ponderacion' require>";
                            //                 echo "<select type='text' name='rCorrecta' id='rCorrecta' class='form-control col-6' placeholder='Respuesta Correcta' require>";
                            //                 echo "<option value='V'>Vedadero</option>";
                            //                 echo "<option value='F'>Falso</option>";
                            //                 echo "</select>";
                            //              }
                            //         }
                                    
                            //     }
                            // };
                        ?>
                    </div>

                    </form>
            </div>

            <div class="card-footer">
   
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){
                       

                        //verificar la conexion
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :(");
                        }

                        if($_POST["codigo"]!="" && $_POST["fecha"]!="" && $_POST["docente"]!=""){
                           
                            $sqlEvaluacion = "INSERT INTO tblEvaluaciones(codigo, fecha, idDocente) VALUES ('".$_POST["codigo"]."','".$_POST["fecha"]."','".$_POST["docente"]."')";
                            $count = $conn->exec($sqlEvaluacion);
                            $idEval = $conn->lastInsertId();//extrae el id del ultimo registro insertado en la bd
                            
                            

                            if($count > 0){
                                Print"<script>
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Hecho!',
                                  text: 'Se Ha registrado el Usuario!',
                                })
                                </script>";
                            }else{
                                Print"<script>
                                Swal.fire({
                                  icon: 'error',
                                  title: 'OPPS!',
                                  text: 'No se Ha realizado el Registro!',
                                })
                                </script>";
                            }
                            CloseCon($conn);
                        }
                        else{
                            echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                                echo "Aun faltan campos por llenar!! :<";
                                echo "</div>";
                        }
                    }
                echo "
            </div>
        </div>
    </div>";//fin del div card-footer, CARD, COL

        //incluimos footer
        include "../../Share/footer.php";
        ?>