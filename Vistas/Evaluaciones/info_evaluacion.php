<?php
     include '../../Share/header.php';
     include '../../Share/funciones.php';
     if($_GET)
     {
         //CONEXION
        $conn=OpenCon();

        //extraemos datos
        $id=$_GET["codigo"];
         //consulta de Actividades Realizadas
        $sql="SELECT ea.idEvaluacionAlumno , ea.nota, a.alumnoNombre, a.alumnoApellido, ea.estado, e.idEvaluacion,e.codigo, e.fecha, e.idDocente, e.indicaciones FROM tblEvaluacionAlumno ea
        INNER JOIN tblAlumnos a ON ea.idAlumno= a.idAlumno 
        INNER JOIN tblEvaluaciones e ON ea.idEvaluacion = e.idEvaluacion WHERE ea.idEvaluacion = ?";
        $stmm = $conn->prepare($sql);
        $stmm->execute(array($id));
        $count=$stmm->rowCount();
        $rowE=$stmm->fetchAll(PDO::FETCH_OBJ);
        foreach($rowE as $rowE){}
        
        
        //Variable idAR
        $idAR=$rowE->idEvaluacionAlumno;
        //Cerranmos Conexion
        CloseCon($conn);
      }
      else
      {
       $id="";
         echo "<br><div class=\"alert alert alert-danger\" role=\"alert\">
          <strong>Error</strong> No se han enviado variables</div>";
      }
      
      if($count!=NULL){
    ?>
        
        <div class="col-md-6 offset-md-3 col-sm-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h2 class="text-center">Información Evaluacion</h2>
                </div>

                <div class="card-body">
                
                    <h4 class="card-text text-center"><b>Codigo:</b><?php echo $rowE->codigo?></h4>
                    <p class="card-text text-justify"><b>Indicaciones: </b><?php echo $rowE->indicaciones?></p>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Docente:  </b><i><?php echo docentesParaInfoEval($rowE->idDocente) ?> </i></li>
                        <li class="list-group-item"><b>Fecha: </b><?php echo $rowE->fecha?></li>
                        <li class="list-group-item"><b># Intentos Realizados: </b><?php echo $count?></li>
                        <li class="list-group-item"><b># Aprobados: </b><?php echo aprobados($idAR)?></li>
                        <li class="list-group-item"><b># Reprobados: </b><?php echo reprobados($idAR)?></li>
                    </ul>
                </div>

                <div class="card-footer">
                    <a href="listado_evaluaciones.php" class="btn btn-warning">Regresar</a>
                </div>

            </div>
        </div>

        <div class="row">
            <ul class="nav nav-tabs  col-12" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                <a class="nav-link active" id="aprobadas-tab" data-toggle="tab" href="#aprobadas" role="tab" aria-controls="aprobadas" aria-selected="true">Aprobadas</a>
                </li>
                <li class="nav-item" role="presentation">
                <a class="nav-link" id="reprobadas-tab" data-toggle="tab" href="#reprobadas" role="tab" aria-controls="reprobadas" aria-selected="false">Reprobadas</a>
                </li>
            </ul>
         <div class="tab-content col-12" id="myTabContent">
            <div class="tab-pane fade show " id="aprobadas" role="tabpanel" aria-labelledby="aprobadas-tab">
                <div class="card card-body">
                    <?php
                            $conn =OpenCon();
                            $idDocente=$rowE->idDocente;
                            $sqlAA="SELECT ea.idEvaluacionAlumno as id, ea.nota, a.alumnoNombre, a.alumnoApellido, ea.estado FROM tblEvaluacionAlumno ea
                                     INNER JOIN tblAlumnos a ON ea.idAlumno= a.idAlumno WHERE ea.estado='Aprobado'";
                            
                            if(aprobados($rowE->idEvaluacionAlumno)==NULL){
                                ECHO "<h1 class='text-center bg-warning card-footer'>NO EXISTEN APROBADOS!!</h1>";
                            }
                            else{
                                echo "<div class='row col-12'>";
                                //Imprecion de formulario
                                foreach($conn->query($sqlAA) as $rowA){
                                    
                                    echo "<div class='card col-sm-12 col-md-3' >";
                                    echo "<div class='card-header bg-success'> 
                                    <h4 class='text-center'>Aprobada!!</h4>
                                    </div>";
                                    echo "<div class='card-body '>";
                                        echo "<h3 class='text-center'><b>Alumno: </b>".$rowA["alumnoNombre"]." ".$rowA["alumnoApellido"]."</h3>";
                                        echo "<h6 class='h6 text-center font-weight-bold'> <b>Nota: </b>".$rowA["nota"]."</h6>";
                                    echo "</div></div>";
                                }
                                echo "</div>";
                            }
                            CloseCon($conn);
                    ?>
                </div>
            </div>
            </div>
            <div class="tab-pane fade  col-12" id="reprobadas" role="tabpanel" aria-labelledby="reprobadas-tab">
                <div class="card card-body">
                <?php
                            $conn =OpenCon();
                            $sqlAR="SELECT ea.idEvaluacionAlumno as id, ea.nota, a.alumnoNombre, a.alumnoApellido, ea.estado FROM tblEvaluacionAlumno ea
                                     INNER JOIN tblAlumnos a ON ea.idAlumno= e.idAlumno WHERE  ea.estado='Aprobado'";

                         
                            if(reprobados($rowE->idEvaluacionAlumno)==null){
                                ECHO "<h1 class='text-center bg-warning card-footer'>NO EXISTEN REPROBADOS!!</h1>";
                            }
                            else{
                                echo "<div class='row col-12'>";
                                //Imprecion de formulario
                                foreach($conn->query($sqlAR) as $rowR){
                                                                
                                    echo "<div class='card col-sm-12 col-md-3' >";
                                    echo "<div class='card-header bg-danger'> 
                                    <h4 class='text-center'>Reprobado!!</h4>
                                    </div>";
                                    echo "<div class='card-body '>";
                                        echo "<h3 class='text-center'><b>Alumno: </b>".$rowR["alumnoNombre"]." ".$rowR["alumnoApellido"]."</h3>";
                                        echo "<h6 class='h6 text-center font-weight-bold'> <b>Nota: </b>".$rowR["nota"]."</h6>";
                                    echo "</div></div>";
                                    
                                        
                                }
                                echo "</div>";
                            }
                            CloseCon($conn);
                    ?>
                </div>
            </div>
           
        </div>
        
          <!-- LLAMADO AL FOOTER -->
    <?php
      }else{

      }
        include '../../Share/footer.php';
    ?>