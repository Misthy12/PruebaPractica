<?php
include "../../Share/header.php";
if($_GET){
    //CONEXION
    include "../../Share/conexion.php";
    $conn = OpenCon();
    
    //extraemos datos
    $id=$_GET["codigo"];
    $stmm=$conn->prepare("SELECT e.idEvaluacion as id, e.codigo, e.fecha, e.idDocente, d.docenteNombre as nombre, d.docenteApellido as apellido, e.indicaciones FROM tblEvaluaciones e
                    INNER JOIN tblDocentes d ON e.idDocente = d.idDocente WHERE e.idEvaluacion=$id");
    $stmm->execute(array($id));
    $row=$stmm->fetchAll(PDO::FETCH_OBJ);
    foreach($row as $row){}

    //consulta docentes
    $sqlDocentes="SELECT*FROM tblDocentes";
    //cerramos conexion
  CloseCon($conn);
  }
  else
  {
   $id="";
     echo "<br><div class=\"alert alert alert-danger\" role=\"alert\">
      <strong>Error</strong> No se han enviado variables</div>";
  }
?>
<title>Evaluaciones</title>
<div class="col-md-8 offset-md-2 col-sm-12">
    <div class="card">
         <div class="card-header bg-warning">
               <h4 class="text-center ">Editar</h4>
         </div>
         <div class="card-body">
            <form action="" method="POST">
                <div class="row col-12 form-group"> 
                     <div class="col-md-4 col-sm-12">
                        <label for="codigo" class="control-label ">Codigo</label>
                        <input class="form-control" type="text" name="codigo"  id="codigo" value="<?php echo $row->codigo ?>" required readonly/>
                     </div>
                     <div class="col-md-4 col-sm-12">
                            <label for="Fecha" class="control-label">Fecha</label>
                            <input class="form-control" type="date" name="Fecha" id="Fecha" value="<?php echo $row->fecha ?>" />
                     </div>
                     <div class="col-md-4 col-sm-12">
                            <label for="rol" class="control-label ">Docente</label>
                            <select name="idDocente" id="idDocente" type="text" class="form-control" required>
                                <option value="<?php echo $row->idDocente ?>"><?php echo $row->nombre." ". $row->apellido?></option>
                                <?php
                                    foreach ($conn->query($sqlDocentes) as $valord) {
                                        echo "<option value='" . $valord["idDocente"] . "'>" . $valord["docenteNombre"] . " " . $valord["docenteApellido"] . "</option>";
                                    }
                                ?>
                            </select>
                     </div>
                </div>          
                    <div class="row col-12 form-group"> 
                        <div class="col-12">
                            <label for="Indicaciones" class="control-label">Indicaciones</label>
                            <textarea class="form-control" id="Indicaciones" name="Indicaciones" rows="2"><?php echo $row->indicaciones?></textarea>
                            <input class="form-control" type="hidden" name="idEvaluacion" id="idEvaluacion" />
                        </div>              
                    </div>
                    <div class="row col-12 form-group">
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->id?>" required/>
                        <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                        <a href='../Evaluaciones/listado_evaluaciones.php' class='btn btn-warning ' style='margin-left:3px'>Regresar</a>
                    </div>
                    <br>
            </form>
         </div>
            <div class="card-footer">
 
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){

                        //verificar la conexion
                        
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :'( ");
                        }

                        if($_POST["Fecha"]!="" && $_POST["Indicaciones"]!=""){

                            $sql = "UPDATE tblEvaluaciones SET fecha='".$_POST["Fecha"]."', idDocente='".$_POST["idDocente"]."', indicaciones='".$_POST["Indicaciones"]."' WHERE idEvaluacion='".$_POST["id"]."'";
                            $codigo=$_POST["id"];        
                            $count = $conn->exec($sql);
                            if($count > 0){
                                Print"<script>
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Hecho!',
                                  text: 'Se Ha Actualizado el registrado!',
                                })
                                </script>";
                            }else{
                                Print"<script>
                                Swal.fire({
                                  icon: 'error',
                                  title: 'OPPS!',
                                  text: 'No se Ha realizado la actualización!',
                                })
                                </script>";
                            }
                            CloseCon($conn);
                        }
                        else{
                            echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                                echo "Aun faltan campos por llenar!! :(";
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