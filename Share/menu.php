<?php
  include('validar.php');
?>


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<!-- Navbar -->  
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links --> 
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>  
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link text-dark  font-weight-bold  ">Evaluaciones KANF!!</a>
      </li>
    </ul>  
  </nav>  
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
       <i class="brand-image img-circle mt-2 text-xl nav-icon " style="color:#fff" >KE</i>

      <span class="brand-text font-weight-light text-center text-uppercase"><b><i>KANF Evaluaciones!!<i></b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <a class="brand-link">
        <i class="brand-image img-circle mt-2 text-lg nav-icon fas fa-user" style="color:#fff" ></i>
        <span class="brand-text font-weight-light text-center"><?php echo $_SESSION["nombre"]?></span>
      </a>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
          <?php
              if($_SESSION["login"]=="Alumno"){
               echo "<a href='../../Vistas/Index/IndexAlumno.php' class='nav-link active'>";
              }
              else if($_SESSION["login"]=="Docente"){
                echo "<a href='../../Vistas/Index/IndexDocente.php' class='nav-link active'>";
              }
              else{
                echo "<a href='../../Vistas/Index/IndexAdminLC.php' class='nav-link active'>";
              }
            ?>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php
              if($_SESSION["login"]=="Alumno"){?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Evaluaciones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Alumnos/misEvaluaciones.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis Evaluaciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Vistas/Evaluaciones/realizar_evaluacion.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Realizar Evaluacion</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                <?php echo $_SESSION['nombre']; ?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Alumnos/editar_alumno.php?codigo=<?php echo$_SESSION['id']?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis Datos Personales</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
              }
              if($_SESSION["login"]=="Docente"||$_SESSION["login"]=="Admin" ){?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Evaluaciones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Evaluaciones/listado_evaluaciones.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Evaluaciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Vistas/Evaluaciones/agregar_evaluacion.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Evaluación</p>
                </a>
              </li>
            </ul>
          </li>
              <?php }
              if($_SESSION["login"]=="Docente"){?>
              <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-id-card"></i>
                          <p>
                          <?php echo $_SESSION["nombre"]; ?>
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="../../Vistas/Docentes/editar_docente.php?codigo=<?php echo$_SESSION['id']?>" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Mis Datos</p>
                            </a>
                          </li>
                        </ul>
                      </li>
              <?php

              }
                        
              if($_SESSION["login"]=="Admin"){?>    
          
          <li class="nav-item has-treeview">
             <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Usuarios/listado_usuarios.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Listado Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Vistas/Usuarios/agregar_usuario.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Usuario</p>
                </a>
              </li>
            </ul>
          </li>         
          <li class="nav-item has-treeview">
             <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Docentes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Docentes/listado_docentes.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Listado Docentes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Vistas/Docentes/agregar_docente.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Docente</p>
                </a>
              </li>
            </ul>
          </li>         
          <li class="nav-item has-treeview">
             <a href="#" class="nav-link">
              <i class="nav-icon fas fa-child"></i>
              <p>
                Alumnos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../Vistas/Alumnos/listado_alumnos.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Listado Alumnos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../Vistas/Alumnos/agregar_alumno.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agregar Alumnos</p>
                </a>
              </li>
            </ul>
          </li>         
          </li>
          <?php }?> 
          <li class="nav-item has-treeview">
            <a href="../../Share/salir.php" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Salir
              </p>
            </a>
          </li>        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
   <br>