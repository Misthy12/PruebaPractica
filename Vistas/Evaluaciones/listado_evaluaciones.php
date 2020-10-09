<?php
include("../../Share/header.php");
include '../../Share/funciones.php';
?>
    <title>Evaluaciones</title>
    
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10 col-md-7">
                        <h4 class="text-center">Evaluaciones Registradas</h4>
                    </div>
                    
                    <div class="col-lg-2 col-md-2">
                        <a href="agregar_evaluacion.php" class="btn-success btn" ><i class="fas fa-plus"></i> Agregar</a>
                    </div>
                </div>
            </div>

            <!-- Consulta a la base de datos -->
            <?php
            
            $conn =OpenCon();
            //id docente
            $docente= $_SESSION["id"];
            if($_SESSION["login"]=="Docente"){
                $sql="SELECT e.idEvaluacion as id, e.codigo, e.fecha, e.idDocente, d.docenteNombre as nombre, d.docenteApellido as apellido, e.indicaciones FROM tblEvaluaciones e
                    INNER JOIN tblDocentes d ON e.idDocente = d.idDocente WHERE e.idDocente=$docente";
            }else{
            $sql="SELECT e.idEvaluacion as id, e.codigo, e.fecha, e.idDocente, d.docenteNombre as nombre, d.docenteApellido as apellido, e.indicaciones FROM tblEvaluaciones e
                    INNER JOIN tblDocentes d ON e.idDocente = d.idDocente";
                    }
            ?>
            <div class="card-body table-responsive">
                <table class="table  table-hover table-striped ">
                    <thead class="bg-dark text-center">
                        <tr>
                            <th>N°</th>
                            <th>Codigo</th>
                            <th>Docente</th>
                            <th>Fecha</th>
                            <th>Indicacion</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        <?php
                        foreach( $conn->query($sql) as $row){
                                echo "<tr>";
                                    echo "<td>".$row["id"]."</td>";
                                    echo "<td>".$row["codigo"]."</td>";
                                    echo "<td>".$row["nombre"]." ".$row["apellido"]."</td>"; 
                                    echo "<td>".$row["fecha"]."</td>";
                                    echo "<td>".$row["indicaciones"]."</td>";
                                    echo "<td>";
                                        echo "<a class='btn btn-sm btn-warning' href=\"../Evaluaciones/editar_evaluacion.php?codigo=". $row["id"]."\" ><i class='fas fa-edit'></i></a> \n";
                                        if(actividadRealizada($row["id"])!=null){
                                        echo "<a class='btn btn-sm btn-info' href=\"../Evaluaciones/info_evaluacion.php?codigo=". $row["id"]."\" ><i class='fas fa-info'></i></a> \n";
                                        }
                                        echo "<a class=\"btn btn-sm btn-danger\" href=\"./eliminar_evaluacion.php?codigo=". $row["id"]."\"><i class=\"far fa-trash-alt\"></i></a>";
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