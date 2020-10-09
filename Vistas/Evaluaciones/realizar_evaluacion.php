<?php
include "../../Share/header.php";
//CONEXION
include "../../Share/conexion.php";
?>
<div class="card">
    <div class="card-header bg-success">
        <h3 class="text-center  font-weight-bold">Buscar Evaluacion</h3>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="row col-12 form-group">
                <div class="col-9">
                    <label for="Codigo">Codigo Evaluacion</label>
                    <input type="text" name="Codigo" id="Codigo" class="form-control" required />
                </div>
                <div class="col-3">
                    </BR>
                    <input type="Submit" value="Buscar" name="btnEvaluacion" id="btnEvaluacion" class="btn-blo btn btn-success">
                </div>
            </div>
        </form>
    </div>
</div>
<?php
if (isset($_POST["btnEvaluacion"])) {
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
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="text-center  font-weight-bold"><?php echo $rowe->indicaciones; ?></h3>
                </div>
                <div class="card-body">
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
                                    <input type="radio" class="form-check-input" name="optradio1" value="<?php echo $rowp['seleccion1']; ?>"><?php echo $rowp['seleccion1'];?>
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

//incluimos footer
include "../../Share/footer.php";
?>