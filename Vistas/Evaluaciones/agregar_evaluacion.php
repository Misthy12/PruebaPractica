<?php
include "../../Share/header.php";
include "../../Share/conexion.php";
//consulta para roles
$conn = OpenCon();
$sqlDocentes = "SELECT * FROM tbldocentes";
$sqlTipo = "SELECT * FROM tbltipopreguntas";
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
                                    <input class="form-control" type="text" name="codigo" id="codigo" value="" placeholder="Ingrese un Codigo" required />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label class="control-label col-md-3">Fecha</label>
                                <div class="col-md-9">
                                    <input class="form-control" type="date" name="Fecha" id="Fecha" value="" />
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="rol" class="control-label col-md-3">Docente</label>
                                <div class="col-md-9">
                                    <select name="idDocente" id="idDocente" type="text" class="form-control" required>
                                        <?php
                                        foreach ($conn->query($sqlDocentes) as $valord) {
                                            echo "<option value='" . $valord["idDocente"] . "'>" . $valord["docenteNombre"] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="control-label col-md-3">Indicaciones</label>
                                <textarea class="form-control" id="Indicaciones" name="Indicacion" rows="2"></textarea>

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
                    <button title="Agregar Pregunta" class="btn btn-info" name="btnAgregar" id="btnAgregar"><i class="fa fa-plus"></i></button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-3">
                            <label class="control-label col-md-3" for="idTipo">Tipo</label>
                            <select name="idTipo" id="idTipo" type="text" class="form-control" required>
                                <option value="">.:Seleccione:.</option>
                                <?php
                                foreach ($conn->query($sqlTipo) as $valorp) {
                                    echo "<option value='" . $valorp["idTipo"] . "'>" . $valorp["tipo"] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-9">
                            <label class="control-label col-md-3" for="pregunta">Pregunta</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="pregunta" id="pregunta" value="" placeholder="Ingrese la pregunta" required />
                            </div>

                        </div>
                    </div>
                </div>

                <div id="FormTrueFalse" style="display: none;">
                    <label for="">Repuesta</label>
                    <select name="Respuesta" id="Respuesta">
                        <option value="">.:Seleccione:.</option>
                        <option value="1">Verdadero</option>
                        <option value="0">Falso</option>
                    </select>
                </div>
                <div id="FormMultiple" style="display: none;>
                                <label for=" RespuestaV">Repuesta</label>
                    <input class="form-control" type="text" name="RespuestaV" id="RespuestaV" value="" placeholder="Ingrese la Respuesta Correcta" />
                    <input class="form-control" type="text" name="RespuestaF1" id="RespuestaF1" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                    <input class="form-control" type="text" name="RespuestaF2" id="RespuestaF2" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                    <input class="form-control" type="text" name="RespuestaF3" id="RespuestaF3" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="text-center">Detalles Evaluacion</h4>
                <div class=" col-sm-offset-8 col-sm-4" align="right">
                    <button title="Guardar Evaluacion" class="btn btn-success" name="btnGuardar" id="btnGuardar"> <i class="fas fa-save"></i></button>
                    <a href="listado_evaluaciones.php" title="Cancelar" class="btn btn-default"><i class="fas fa-times"></i></a>
                </div>
            </div>
            <div class="card-body" style="overflow-x:scroll">
                <!-- Date -->
                <table id="TablaCL" class="table table-bordered table-responsive">
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

<div class="card-footer">
    <!-- ENVIO DE DATOS -->
    <?php
    if (isset($_POST["submit"])) {


        //verificar la conexion
        if ($conn == null) {
            die("No se ha podido conectar con la base de datos :(");
        }

        if ($_POST["codigo"] != "" && $_POST["fecha"] != "" && $_POST["docente"] != "") {

            $sqlEvaluacion = "INSERT INTO tblEvaluaciones(codigo, fecha, idDocente) VALUES ('" . $_POST["codigo"] . "','" . $_POST["fecha"] . "','" . $_POST["docente"] . "')";
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