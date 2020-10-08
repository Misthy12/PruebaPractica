<?php
include "../../Share/header.php";
include "../../Share/funciones.php";
//include "../../Share/conexion.php";
//consulta para roles
$conn = OpenCon();
// $sqlDocentes = "SELECT * FROM tbldocentes";
$sqlTipo = "SELECT * FROM tbltipopreguntas";

//consulta de editar 
if($_GET){
    //extraemos datos
    $id=$_GET["codigo"];
    $sql="SELECT e.idEvaluacion as id, e.codigo, e.fecha, e.idDocente, d.docenteNombre as nombre, d.docenteApellido as apellido FROM tblEvaluaciones e
                    INNER JOIN tblDocente d ON e.idDocente = d.idDocente WHERE e.idEvaluacion = $id";;
    $stmm = $conn->prepare($sql);
    $stmm->execute(array($id));
    $rowE=$stmm->fetchAll(PDO::FETCH_OBJ);
    foreach($rowE as $rowE){}
  CloseCon($conn);
  }
  else
  {
   $id="";
     echo "<br><div class=\"alert alert alert-danger\" role=\"alert\">
      <strong>Error</strong> No se han enviado variables</div>";
  }

CloseCon($conn);
?>
<title>Evaluaciones</title>
<div class="col-sm-12">
    <div class="card">
        <div class="card-header bg-success">
            <h4 class="text-center">Agregar Evaluación</h4>
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-center">Evaluación</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-4">
                                <label class="control-label col-md-3">Codigo</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="codigo" id="codigo" value="<?php echo $rowE["codigo"]?>" readonly required />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label class="control-label col-md-3">Fecha</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="date" name="Fecha" id="Fecha" value="<?php echo $rowE["fecha"]?>"  />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="rol" class="control-label col-md-3">Docente</label>
                                <div class="col-md-9">
                                    <select name="idDocente" id="idDocente" type="text" class="form-control" required>
                                        <option value="<?php echo $rowE["idDocente"]?> "><?php echo $rowE["nombre"]." ". $rowE["apellido"]?></option>
                                        <?php
                                        foreach ($conn->query($sqlDocentes) as $valord) {
                                            echo "<option value='" . $valord["idDocente"] . "'>" . $valord["docenteNombre"]." ". $valord["docenteApellido"]. "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="control-label col-md-3">Indicaciones</label>
                                <textarea class="form-control" id="Indicaciones" name="Indicacion" rows="2"><?php echo $rowE["codigo"]?></textarea>

                            </div>
                            <div class="row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-center">Preguntas</h4>
                    <button title="Agregar Pregunta" class="btn btn-warning" name="btnAgregar" id="btnAgregar"><i class="fa fa-plus"></i></button>
                </div>
                <div class="card-body">
                    <div class="row col-12">
                        <div class="form-group col-md-3 col-sm-12">
                            <label class="control-label col-md-3 col-sm-12" for="idTipo">Tipo</label>
                            <select name="idTipo" id="idTipo" type="text" class="form-control col-sm-12" required>
                                <option value="">.:Seleccione:.</option>
                                <?php
                                foreach ($conn->query($sqlTipo) as $valorp) {
                                    echo "<option value='" . $valorp["idTipo"] . "'>" . $valorp["tipo"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-9 col-sm-12">
                            <label class="control-label col-md-3 col-sm-12" for="pregunta">Pregunta</label>
                            <div class="col-md-9 col-sm-12">
                                <input class="form-control" type="text" name="pregunta" id="pregunta" value="" placeholder="Ingrese la pregunta" required />
                            </div>

                        </div>
                    </div>
                

                    <div id="FormTrueFalse" style="display: none;" class="form-group  col-12">
                            <label for="Respuesta"  class="col-md-3 col-sm-12">Respuesta</label>
                            <select name="Respuesta" id="Respuesta" class="form-control col-md-4 col-sm-12">
                                <option value="">.:Seleccione:.</option>
                                <option value="1">Verdadero</option>
                                <option value="0">Falso</option>
                            </select>
                    </div>
                    
                        
                    <div id="FormMultiple" style="display: none;" class="row form-group  col-12">
                        <label for="RespuestaV" class="col-md-12">Respuesta</label>
                        <input class="form-control col-md-12" type="text" name="RespuestaV" id="RespuestaV" value="" placeholder="Ingrese la Respuesta Correcta" />
                        <input class="form-control col-md-12" type="text" name="RespuestaF1" id="RespuestaF1" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                        <input class="form-control col-md-12" type="text" name="RespuestaF2" id="RespuestaF2" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                        <input class="form-control col-md-12" type="text" name="RespuestaF3" id="RespuestaF3" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="text-center">Detalles Evaluacion</h4>
                <div class="offset-md-10 col-md-2" >
                    <button title="Guardar Evaluacion" class="btn btn-success" name="btnGuardar" id="btnGuardar"> <i class="fas fa-save"></i></button>
                    <a href="listado_evaluaciones.php" title="Cancelar" class="btn btn-default"><i class="fas fa-times"></i></a>
                </div>
            </div>
            <div class="card-body " style="overflow-x:scroll">
                <!-- Date -->
                <div class="table-responsive">
                    <table id="TablaCL" class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Tipo</th>
                                <th>Pregunta</th>
                                <th>Respuesta</th>
                                <th hidden>Incorrecta1</th>
                                <th hidden>Incorrecta2</th>
                                <th hidden>Incorrecta3</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="fila">

                            <tr hidden>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="card-footer">
    <!-- ENVIO DE DATOS -->
    <?php
    if (isset($_POST["submit"])) {


        //verificar la conexion
        if ($conn == null) {
            die("No se ha podido conectar con la base de datos :(");
        }

        if ($_POST["codigo"] != "" && $_POST["fecha"] != "" && $_POST["docente"] != "") {

            $sqlEvaluacion = "INSERT INTO tblEvaluaciones(codigo, fecha, idDocente, indicaciones) VALUES ('" . $_POST["codigo"] . "','" . $_POST["fecha"] . "','" . $_POST["docente"] . "','" . $_POST["Indicaciones"] . "')";
            $count = $conn->exec($sqlEvaluacion);
            $idEval = $conn->lastInsertId(); //extrae el id del ultimo registro insertado en la bd



            if ($count > 0) {
                print "<script>
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Hecho!',
                                  text: 'Se Ha registrado el Usuario!',
                                })
                                </script>";
            } else {
                print "<script>
                                Swal.fire({
                                  icon: 'error',
                                  title: 'OPPS!',
                                  text: 'No se Ha realizado el Registro!',
                                })
                                </script>";
            }
            CloseCon($conn);
        } else {
            echo "<div class=\"alert alert-danger \" role=\"alert\" >";
            echo "Aun faltan campos por llenar!! :<";
            echo "</div>";
        }
    }
    echo "
            </div>
        </div>
    </div>"; //fin del div card-footer, CARD, COL

    //incluimos footer
    include "../../Share/footer.php";
    ?>
    <script>
        $(document).ready(function() {
            $("#idTipo").change(function() {
                var tipo = $("#idTipo").val();
                if (tipo == 2) {
                    $("#FormTrueFalse").css("display", "block");
                    $("#FormMultiple").css("display", "none");
                } else if (tipo == 1) {
                    $("#FormTrueFalse").css("display", "none");
                    $("#FormMultiple").css("display", "block");
                }
            });
        });
    </script>