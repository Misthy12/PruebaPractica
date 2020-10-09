    <?php 
      include "../../Share/header.php";
      include "../../Share/funciones.php";
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo numeroUsuarios(); ?></h3>

                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="../../Vistas/Usuarios/listado_usuarios.php" class="small-box-footer">Más informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo numeroEvaluaciones() ?><sup style="font-size: 20px">%</sup></h3>

                <p>Evaluaciones</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="../../Vistas/Evaluaciones/listado_evaluaciones.php" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3> <?php echo numeroDocentes(); ?> </h3>

                <p>Docentes</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="../../Vistas/Docentes/listado_docentes.php" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3> <?php echo numeroAlumnos()?> </h3>

                <p>Alumnos</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="../../Vistas/Alumnos/listado_alumnos.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
           <!-- /.row (main row) -->
          <!-- Panel de ofertas  -->
          </div>

          <div class="row">
            <!-- CONSULTA PARA EXTARER DATOS -->
            <?php
                
            ?>
          </div><!--FIN DEL ROW-->
      </div><!--FIN DEL ROW-->

        <?php      
         include "../../Share/footer.php";
        ?>

        
