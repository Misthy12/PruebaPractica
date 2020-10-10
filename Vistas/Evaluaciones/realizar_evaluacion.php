<?php
include "../../Share/header.php";
//CONEXION
include "../../Share/conexion.php";
$n=0;
?>
<div class="row col-12">
    <div class="col-md-8 offset-md-2 col-sm-12 ">
        <div class="card ">
            <div class="card-header bg-primary">
                <h3 class="text-center  font-weight-bold">Buscar Evaluacion</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row col-12 form-group">
                        <div class="col-md-9 col-sm-8">
                            <input type="text" name="Codigo" id="Codigo" class="form-control" placeholder="Ingrese Codigo de Evaluacion" required />
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <input type="Submit" value="Buscar" name="btnEvaluacion" id="btnEvaluacion" class="btn col-sm-12 btn-success">
                        </div>
                    </div>
                </form>
        
<!-- ========================== BUSQUEDA EVAL ==================================== -->
<?php
if (isset($_POST["btnEvaluacion"])) {
    $n=1;
    $conn = OpenCon();
    //extraemos datos
    $id = $_POST["Codigo"];
    $stmm = $conn->prepare("SELECT *from tblevaluaciones where codigo =?");
    $stmm->execute(array($id));
    $rowe = $stmm->fetchAll(PDO::FETCH_OBJ);
    foreach ($rowe as $rowe) {
    }
    if ($rowe != null) {
        $data = date('Y-m-d');
        if ($rowe->fecha > $data) {
            print "<script>
            Swal.fire({
                icon: 'info',
                title: 'OPPS!',
                text: 'Aun no es la fecha!',
            })
            </script>";
        } else if ($rowe->fecha < $data) {
            print "<script>
            Swal.fire({
                icon: 'info',
                title: 'OPPS!',
                text: 'La Fecha Ya Paso!',
            })
            </script>";
        } else {           
?>
       
                <!-- ======================= IMPRESION EVAL ==================================== -->
                <hr>
                <h5 class="text-justify font-italic"><b>INDICACIONES: </b><?php echo $rowe->indicaciones?></h5>
                <hr>
                    <?PHP
                    $i = 1;
                    $stmm1 = "SELECT *from tblpreguntas where idEvaluacion = $rowe->idEvaluacion";
                    foreach ($conn->query($stmm1) as $rowp) {
                    ?>
                    <br>
                        <label for="Respuesta"><?php echo "$i - ".$rowp['pregunta']."?"; ?></label>
                        <?php
                        if ($rowp["idTipoPregunta"] == 2) { ?>
                            <select name="Respuesta" id="Respuesta" class="form-control">
                                <option value="Verdadero">Verdadero</option>
                                <option value="Falso">Falso</option>
                            </select>
                        <?php } else { ?>

                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="<?php echo $rowp['seleccion1']; ?>"><?php echo $rowp['seleccion1'];?>
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="<?php echo $rowp['respuestaCorrecta']; ?>"><?php echo $rowp['respuestaCorrecta']; ?>
                                </label>
                            </div>
                            <div class="form-check-inline disabled">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="<?php echo $rowp['seleccion2'];  ?>"><?php echo $rowp['seleccion2'];  ?>
                                </label>
                            </div>
                            <div class="form-check-inline disabled">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optradio" value="<?php echo $rowp['seleccion3'];  ?>"><?php echo $rowp['seleccion3'];  ?>
                                </label>
                            </div>
                    <?php
                        }
                        $i++;
                    }
                    ?>

                </div>
            </div>
        </div>
<?php
        }
        
    } else {
        print "<script>
        Swal.fire({
            icon: 'error',
            title: 'ERROR!',
            text: 'No existe tal Evaluacion!',
        })
        </script>";
    }
    CloseCon($conn);
}
echo "</div></div></div>";//fin del row

//incluimos footer
include "../../Share/footer.php";
?>