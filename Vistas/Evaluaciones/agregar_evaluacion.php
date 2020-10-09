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
<div class="jumbotrong bg-white col-sm-12 col-md-12">
    <div class=" ">
        
        <h4 class="text-center text-uppercase font-weight-bold">Datos de Evaluación</h4>
        <hr>
        <div class="row col-12 form-group">           
            <div class="col-md-2 col-sm-12">
                <label for="codigo" class="control-label ">Codigo</label>
                <input class="form-control" type="text" name="codigo" readonly id="codigo" value="<?php echo generarCodigo(4) ?>" required />
            </div>
            <div class="col-md-3 col-sm-12">
                <label for="Fecha" class="control-label">Fecha</label>
                <input class="form-control" type="date" name="Fecha" id="Fecha" value="" />
            </div>
            <div class="col-md-3 col-sm-12">
                <label for="rol" class="control-label ">Docente</label>
                <select name="idDocente" id="idDocente" type="text" class="form-control" required>
                    <?php
                        foreach ($conn->query($sqlDocentes) as $valord) {
                        echo "<option value='" . $valord["idDocente"] . "'>" . $valord["docenteNombre"] . " " . $valord["docenteApellido"] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-4 col-sm-12">
                <label for="Indicaciones" class="control-label">Indicaciones</label>
                <textarea class="form-control" id="Indicaciones" name="Indicaciones" rows="2"></textarea>
                <input class="form-control" type="hidden" name="idEvaluacion" id="idEvaluacion" />
            </div>              
        </div>
        <div class="row col-12 form-group">
            <div class="col-12 ">
                <hr>
                 <h5 class="text-center text-uppercase font-weight-bold">Preguntas</h5>
                <hr>
            </div>
            
                <div class="col-md-3 col-sm-12">
                    <label class="control-label " for="idTipo">Tipo</label>
                    <select name="idTipo" id="idTipo" type="text" class="form-control" required>
                        <option value="">.:Seleccione:.</option>
                        <?php
                            foreach ($conn->query($sqlTipo) as $valorp) {
                                echo "<option value='" . $valorp["idTipo"] . "'>" . $valorp["tipo"] . "</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="col-md-8 col-sm-12">
                    <label class="control-label" for="pregunta" for="pregunta">Pregunta</label>
                    <input class="form-control" type="text" name="pregunta" id="pregunta" value="" placeholder="Ingrese la pregunta" required />
                </div>
                <div class="col-md-1 col-sm-12">
                 <button title="Agregar Pregunta" class="btn btn-warning" name="btnAgregar" id="btnAgregar"><i class="fa fa-plus"></i></button>
                </div>


            <div id="FormTrueFalse" style="display: none;" class="col-md-12 col-sm-12">
            <br>
                <label for="Respuesta" class="control-label ">Respuesta</label>
                <select name="Respuesta" id="Respuesta" class="form-control col-md-4 col-sm-12">
                    <option value="">.:Seleccione:.</option>
                    <option value="Verdadero">Verdadero</option>
                    <option value="Falso">Falso</option>
                </select>
            </div>


            <div id="FormMultiple" style="display: none;" class="col-md-12 col-sm-12">
                <br>
                <label for="RespuestaV" class="control-label">Respuestas</label>
                <div class="row col-12">
                    <input class="form-control col-md-3 col-sm-12" type="text" name="RespuestaV" id="RespuestaV" value="" placeholder="Ingrese la Respuesta Correcta" />
                    <input class="form-control col-md-3 col-sm-12" type="text" name="RespuestaF1" id="RespuestaF1" value="" placeholder="Ingrese la Respuesta Incorrecta" />                            
                    <input class="form-control col-md-3 col-sm-12" type="text" name="RespuestaF2" id="RespuestaF2" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                    <input class="form-control col-md-3 col-sm-12" type="text" name="RespuestaF3" id="RespuestaF3" value="" placeholder="Ingrese la Respuesta Incorrecta" />
                </div>
            </div>
            <div class="col-12">
            <br>
            <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-10"><h5 class="text-center text-uppercase font-weight-bold">Detalles Evaluacion</h5></th>
                            <th class="col-1"><button title="Guardar Evaluacion" class="btn btn-success" name="btnGuardar" id="btnGuardar"> <i class="fas fa-save"></i></button></th>
                            <th class="col-1"><a href="listado_evaluaciones.php" title="Cancelar" class="btn btn-danger"><i class="fas fa-times"></i></a></th>
                        </tr>
                    </thead>
                </table>
            </div>
                <div class="card-body " style="overflow-x:scroll">
                    <!-- Date -->
                    <div class="table-responsive">
                        <table id="TablaCL" class="table table-bordered table-dark table-striped">
                            <thead  class="">
                                <tr class="text-center">
                                    <th>N°</th>
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
        </div><!-- </div> row col-12 form-group -->
    </div><!-- </div> bgWhite -->
</div><!-- </div> jumbotrond -->
<div class="card-footer">
    <!-- ENVIO DE DATOS -->
    <?php
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


        //enviar preguntas
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