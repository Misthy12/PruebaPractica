<?php
include("../../Share/header.php");
?>
    <title>Docentes</title>
    
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10 col-md-7">
                        <h4 class="text-center">Docentes Registrados</h4>
                    </div>
                    
                    <div class="col-lg-2 col-md-2">
                        <a href="agregar_docente.php" class="btn-primary btn" ><i class="fas fa-plus"></i> Agregar</a>
                    </div>
                </div>
            </div>

            <!-- Consulta a la base de datos -->
            <?php
            include '../../Share/conexion.php';
            $conn =OpenCon();
            $sql="SELECT d.idDocente as id, d.docenteNombre as nombre, d.docenteApellido as apellido, d.telefono, u.usuario, u.clave, d.idUsuario FROM tblDocentes d
                    INNER JOIN tblUsuarios u ON d.idUsuario = u.idUsuario";
            ?>
            <div class="card-body table-responsive">
                <table class="table  table-hover table-striped ">
                    <thead class="bg-dark text-center">
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Telefono</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        <?php
                        foreach( $conn->query($sql) as $row){
                                echo "<tr>";
                                    echo "<td>".$row["id"]."</td>";
                                    echo "<td>".$row["nombre"]." ".$row["apellido"]."</td>";
                                    echo "<td>".$row["usuario"]."</td>";
                                    echo "<td>".$row["telefono"]."</td>";
                                    echo "<td>";
                                        echo "<a class='btn btn-sm btn-warning' href=\"./editar_docente.php?codigo=". $row["id"]."\" ><i class='fas fa-edit'></i></a> \n";
                                        echo "<a class=\"btn btn-sm btn-danger\" href=\"./eliminar_docente.php?codigo=". $row["id"]."\"><i class=\"far fa-trash-alt\"></i></a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            
                
                <?php
                
                    CloseCon($conn);
                   
                    //VALIDACION DE ELIMINACION
                    if (isset($_GET['result'])){
                        if($_GET['result'] == 1){
                            Print"<script>
                            Swal.fire({
                              icon: 'success',
                              title: 'Hecho!',
                              text: 'Se Ha Eliminado el registro!',
                            })
                            </script>";
                        }elseif($_GET['result'] == 2){
                            Print"<script>
                            Swal.fire({
                              icon: 'error',
                              title: 'UPPS!',
                              text: 'No se puede eliminar el docente posee actividades creadas!',
                            })
                            </script>";
                        }else{
                            Print"<script>
                            Swal.fire({
                              icon: 'error',
                              title: 'OPPS!',
                              text: 'No se ha podido eliminar!',
                            })
                            </script>";
                        }
                    }
                ?>
            </div>
        </div>
        
    <?php
    //incluimos footer
    include "../../Share/footer.php";
    ?>