<?php
include "../../Share/header.php";
include "../../Share/funciones.php";
//include "../../Share/conexion.php";
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
                                    <input class="form-control" type="text" name="codigo" readonly id="codigo" value="<?php echo generarCodigo(4) ?>" placeholder="Ingrese un Codigo" required />
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
                                            echo "<option value='" . $valord["idDocente"] . "'>" . $valord["docenteNombre"] . " " . $valord["docenteApellido"] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="control-label col-md-3">Indicaciones</label>
                                <textarea class="form-control" id="Indicaciones" name="Indicaciones" rows="2"></textarea>

                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="hidden" name="idEvaluacion" id="idEvaluacion" />
                            </div>
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
                        <label for="Respuesta" class="col-md-3 col-sm-12">Respuesta</label>
                        <select name="Respuesta" id="Respuesta" class="form-control col-md-4 col-sm-12">
                            <option value="">.:Seleccione:.</option>
                            <option value="Verdadero">Verdadero</option>
                            <option value="Falso">Falso</option>
                        </select>
                    </div>


                    <div id="FormMultiple" style="display: none;" class="row form-group  col-12">
                        <label for="RespuestaV" class="col-md-12">Respuesta</label>
                        <div class="row">
                            <input class="form-control col-md-3" type="text" name="RespuestaV" id="RespuestaV" value="" placeholder="Ingrese la Respuesta Correcta" />
                            <input class="form-control col-md-3" type="text" name="RespuestaF1" id="RespuestaF1" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                            <input class="form-control col-md-3" type="text" name="RespuestaF2" id="RespuestaF2" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                            <input class="form-control col-md-3" type="text" name="RespuestaF3" id="RespuestaF3" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="text-center">Detalles Evaluacion</h4>
                <div class="offset-md-10 col-md-2">
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
<<<<<<< Updated upstream
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

=======
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
=======
            var i = 0;
            $("#btnAgregar").click(function() {
                i++;
                var tipo = document.getElementById("idTipo");
                var ntipo = tipo.options[tipo.selectedIndex].text;
                var pregunta = $("#pregunta").val();
                var idTipo = $("#idTipo").val();
                var idDocente = $("#idDocente").val();
                var cod = $("#codigo").val();
                var Fecha = $("#Fecha").val();
                if (idTipo == 2) {
                    var Respuesta = $("#Respuesta").val();
                } else {
                    var Respuesta = $("#RespuestaV").val();
                }
                //var Respuesta = $("#Respuesta").val();
                //var RespuestaV = $("#RespuestaV").val();
                var RespuestaF1 = $("#RespuestaF1").val();
                var RespuestaF2 = $("#RespuestaF2").val();
                var RespuestaF3 = $("#RespuestaF3").val();
                var Indicaciones = $("#Indicaciones").val();
                if (cod == "" || idDocente == "" || Fecha == "" || Respuesta == "" || idTipo == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'OPPS!',
                        text: 'Verifique los Datos Faltantes!',
                    })

                } else {

                    var contador = $("#fila").html();

                    var HTML = "<tr><td>" + i + "</td><td class= id hidden>" + idTipo + "</td><td>" + ntipo + "</td><td>" + pregunta + "</td><td>" + Respuesta + "</td><td hidden>" + RespuestaF1 + "</td><td hidden>" + RespuestaF2 + "</td><td hidden>" + RespuestaF3 + "</td><td><button id='btnDel' class='btn btn-danger'>Quitar</button></td></tr>";
                    $("#fila").html(contador + HTML);
                    $("#pregunta").val("");
                    $("#Respuesta").val("");
                    $("#RespuestaV").val("");
                    $("#RespuestaF1").val("");
                    $("#RespuestaF2").val("");
                    $("#RespuestaF3").val("");

                }
            });

        });

        $("body").on('click', 'button#btnDel', function() {
            var col = $(this).parents('tr');
            $(this).parents('tr').remove();
        });


        //enviar factura
        $("#btnGuardar").click(function() {
            var idDocente = $("#idDocente").val();
            var cod = $("#codigo").val();
            var Fecha = $("#Fecha").val();
            var Indicaciones = $("#Indicaciones").val();
            if (cod == "" || Fecha == "" || idDocente == "" || Indicaciones == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'OPPS!',
                    text: 'Verifique los Datos Faltantes!',
                })
            } else {
                //cargando datos tabla primaria
                var url = 'crear_evaluacion.php';
                var dataE = {
                    codigo: cod,
                    fecha: Fecha,
                    idDocente: idDocente,
                    indicaciones: Indicaciones
                };
                $.ajax({
                    type: "POST",
                    url: url,
                    data: dataE,
                    success: function(id) {
                        $("#idEvaluacion").val(id);
                        llenarP();
                    }
                });
                //creando detalleExamen


            }

>>>>>>> Stashed changes
        });

        function llenarP() {
            $(".id").parent("tr").find("td:eq(0)").each(function() {
                var codigo = $("#idEvaluacion").val();
                var columna = $(this).parents('tr');
                var idTipo = columna.find("td:eq(1)").text();
                var pregunta = columna.find("td:eq(3)").text();
                var respuesta = columna.find("td:eq(4)").text();
                var respuestaf1 = columna.find("td:eq(5)").text();
                var respuestaf2 = columna.find("td:eq(6)").text();
                var respuestaf3 = columna.find("td:eq(7)").text();


                var dataP = {
                    codigo: codigo,
                    idTipo: idTipo,
                    pregunta: pregunta,
                    respuesta: respuesta,
                    respuestaf1: respuestaf1,
                    respuestaf2: respuestaf2,
                    respuestaf3: respuestaf3

                };
                var url = 'detalle_evaluacion.php';
                $.ajax({
                    type: "POST",
                    url: url,
                    data: dataP,
                    success: function(data) {
                        if (data != "SI") {
                            Swal.fire({
                                icon: 'error',
                                title: 'OPPS!',
                                text: 'Verifique!',
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'EXITO!',
                                text: 'Evaluacion Creada!',
                            })
                            location.reload();
                        }

                    }
                });

            });
        }
    </script>