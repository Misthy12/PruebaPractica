<?php
    include "../../Share/header.php";
    include '../../Share/funciones.php';
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row col-12">
          <div class="col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h2 class="font-weight-bold">Evaluaciones Aprobadas</h2>
                  <h3><?php 
                  if(evalDeUnEstudiante($_SESSION["id"])!=0){
                    echo (alumnosAprobados($_SESSION["id"])/evalDeUnEstudiante($_SESSION["id"])*100);
                  }else{echo 0;} ?><sup style="font-size: 20px">%</sup></h3>
                </div>
                <div class="icon">
                  <i class="ion ion-checkmark"></i>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow=" <?php echo (alumnosAprobados($_SESSION["id"])/evalDeUnEstudiante($_SESSION["id"])*100) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (alumnosAprobados($_SESSION["id"])/evalDeUnEstudiante($_SESSION["id"])*100) ?>%">
                  </div>
                </div>
              </div>
            </div>
          <div class="col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h2  class="font-weight-bold">Evaluaciones Repobadas</h2>
                  <h3><?php 
                  if(evalDeUnEstudiante($_SESSION["id"])!=0){
                    echo (alumnosReprobados($_SESSION["id"])/evalDeUnEstudiante($_SESSION["id"]))*100;
                    }else{echo 0;} ?><sup style="font-size: 20px">%</sup></h3>
                </div>
                <div class="icon">
                  <i class="ion ion-close"></i>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow=" <?php echo (alumnosReprobados($_SESSION["id"])/evalDeUnEstudiante($_SESSION["id"])*100) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo (alumnosReprobados($_SESSION["id"])/evalDeUnEstudiante($_SESSION["id"])*100) ?>%"></div>
                </div>
              </div>
            </div>
        </div><!--FIN DEL ROW-->

      
      <?php
         include "../../Share/footer.php";
        ?>
