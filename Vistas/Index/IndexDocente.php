<?php 
  include "../../Share/header.php";
  
  include '../../Share/funciones.php';
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Panel de ofertas  -->
        <div class="row col-12">
            <div class="col-md-4 col-sm-12">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h2 class="font-weight-bold">Evaluaciones Aprobadas</h2>
                  <h3><?php
                    if(evalDeUnDocente($_SESSION["id"])!=0){
                        echo (activAprobadas($_SESSION["id"])/evalDeUnDocente($_SESSION["id"]))*100; 
                        } else { echo 0;} ?><sup style="font-size: 20px">%</sup></h3>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark"></i>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow=" <?php echo (activAprobadas($_SESSION["id"])/evalDeUnDocente($_SESSION["id"]))*100 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (alumnosAprobados($_SESSION["id"])/evalDeUnEstudiante($_SESSION["id"]))*100 ?>%">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h2  class="font-weight-bold">Evaluaciones Repobadas</h2>
                  <h3><?php 
                   if(evalDeUnDocente($_SESSION["id"])!=0) { 
                       echo (activReprobadas($_SESSION["id"])/evalDeUnDocente($_SESSION["id"]))*100;
                    }else{echo 0;} ?><sup style="font-size: 20px">%</sup></h3>
                </div>
                <div class="icon">
                  <i class="ion ion-close"></i>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow=" <?php echo (activReprobadas($_SESSION["id"])/evalDeUnDocente($_SESSION["id"]))*100 ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (alumnosReprobados($_SESSION["id"])/evalDeUnEstudiante($_SESSION["id"]))*100 ?>%"></div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h2  class="font-weight-bold">Evaluaciones Totales</h2>
                  <h3><?php 
                   if(evalDeUnDocente($_SESSION["id"])!=0) { 
                       echo evalDeUnDocente($_SESSION["id"]);
                    }else{echo 0;} ?><sup style="font-size: 20px"></sup></h3>
                </div>
                <div class="icon">
                  <i class="fas fa-file"></i>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
              </div>
            </div>
        </div>
        <div class="row col-12">
                <div class="col-12">
                    <hr>
                    <h3 class="text-center "><b>Evaluaciones Activas</b></h3>
                    <hr>
                </div>

                <?php
                    $conn =OpenCon();
                    //para fehas
                    $fecha_actual = date("Y-m-d");
                    $idDocente=$_SESSION["id"];

                    //Consulta e evaluacion
                    if(evalDeUnDocente($idDocente)!=null){
                    $sql="SELECT * FROM tblEvaluaciones WHERE idDocente =$idDocente ";
                    
                    foreach( $conn->query($sql) as $row){
                         $fecha = $row["fecha"];
                    if($fecha == $fecha_actual){
                        echo "<div class='card col-sm-12 col-md-4' >";
                                echo "<div class='card-header bg-success'> 
                                        <h4 class='text-center'>Evaluación Activa</h4>
                                        <h5 class='text-center'><b>Codigo : </b>".$row["codigo"]."</h5>
                                    </div>";
                                echo "<div class='card-body '>";
                                    echo "<h6 class='h5 text-center font-weight-bold'> Fecha a Realizar: ".$row["fecha"]."</h6>";
                                    echo "<p class='text-lg-justify'><b>ACTIVIDAD! </b>".$row["indicaciones"]."</p> <hr>";
                                echo "</div>";
                        echo "</div>";
                    }
                                    
                    }
                }else{
                        echo "<div class='col-12 bg-warning'>
                            <h3 class='text-center'><b>NO POSEE ACTIVIDADES ACTIVAS!!</b> </h3>
                        </div>";
                    }
                

                ?>
            </div>
        </div>
        <?php
         include "../../Share/footer.php";
        ?>