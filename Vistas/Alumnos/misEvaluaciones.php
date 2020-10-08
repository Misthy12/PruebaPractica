<?php 
  include "../../Share/header.php";
//   include "../../Share/conexion.php";
  include '../../Share/funciones.php';
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Panel de ofertas  -->
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
            <div class="tab-pane fade show active" id="aprobadas" role="tabpanel" aria-labelledby="aprobadas-tab">
                <div class="card card-body">
                    <?php
                            $conn =OpenCon();
                            $hoy= date("Y-m-d");//fecha actual
                            $idUser=$_SESSION["id"];

                            $sql="SELECT ea.idEvaluacionAlumno as id, ea.nota, e.codigo, e.fecha, e.idDocente, ea.idAlumno, ea.estado FROM tblEvaluacionAlumno ea
                                    INNER JOIN tblEvaluaciones e ON ea.idEvaluacion= e.idEvaluacion WHERE ea.idAlumno=$idUser AND ea.estado='Aprobado'";

                            if(alumnosAprobados($idUser)==NULL){
                                ECHO "<h1 class='text-center bg-warning card-footer text-uppercase'>No tiene registros de aprobado!!</h1>";
                            }
                            echo "<div class='row col-12'>";
                            //Imprecion de formulario
                            foreach($conn->query($sql) as $row){
                               
                                echo "<div class='card col-sm-12 col-md-3' >";
                                echo "<div class='card-header bg-success'> 
                                <h4 class='text-center'>Aprobada!!</h4>
                                <h6 class='text-center'><b>Codigo: </b>".$row["codigo"]."</h6>
                                </div>";
                                echo "<div class='card-body '>";
                                    echo "<h3 class='text-center'><b>Docente: </b>".docentesParaInfoEval($row["idDocente"])."</h3>";
                                    echo "<h6 class='h6 text-center font-weight-bold'> <b>Fecha: </b>".$row["fecha"]."</h6>";
                                    echo "<p class='text-lg-center'> <b>NOTA: </b>".$row["nota"]."</p> <hr>";
                                echo "</div></div>";
                                    
                            }
                            echo "</div>";
                            CloseCon($conn);
                    ?>
                </div>
            </div>
            <div class="tab-pane fade  col-12" id="reprobadas" role="tabpanel" aria-labelledby="reprobadas-tab">
                <div class="card card-body">
                <?php
                            $conn =OpenCon();
                            $hoy= date("Y-m-d");//fecha actual
                            // $idUser=$_SESSION["idAlumno"];

                            $sql="SELECT ea.idEvaluacionAlumno as id, ea.nota, e.codigo, e.fecha, e.idDocente, ea.idAlumno, ea.estado FROM tblEvaluacionAlumno ea
                                    INNER JOIN tblEvaluaciones e ON ea.idEvaluacion= e.idEvaluacion WHERE ea.idAlumno=$idUser AND ea.estado='Reprobado'";

                            if(alumnosReprobados($idUser)==NULL){
                                ECHO "<h1 class='text-center bg-warning card-footer text-uppercase'>No tiene registros de reprobado!!</h1>";
                            }
                            echo "<div class='row col-12'>";
                            //Imprecion de formulario
                            foreach($conn->query($sql) as $row){
                                
                                echo "<div class='card col-sm-12 col-md-3' >";
                                echo "<div class='card-header bg-danger'> 
                                <h4 class='text-center'>Reprobada!!</h4>
                                <h6 class='text-center'><b>Codigo: </b>".$row["codigo"]."</h6>
                                </div>";
                                echo "<div class='card-body'>";
                                    echo "<h3 class='text-center'><b>Docente: </b>".docentesParaInfoEval($row["idDocente"])."</h3>";
                                    echo "<h6 class='h6 text-center font-weight-bold'> <b>Fecha: </b>".$row["fecha"]."</h6>";
                                    echo "<p class='text-lg-center'> <b>NOTA: </b>".$row["nota"]."</p> <hr>";
                                echo "</div></div>";
                                    
                            }
                            echo "</div>";
                            CloseCon($conn);
                    ?>
                </div>
            </div>
           
        </div>
        </div>
        <?php
         include "../../Share/footer.php";
        ?>