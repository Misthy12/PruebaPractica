<?php
include "../../Share/header.php";
include "../../Share/conexion.php";

?>
    <title>Docente</title>
    <div class="col-md-8 offset-md-2 col-sm-12">
        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-center">Agregar Docente</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="form">
                   
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="nombre">Nombre Docente</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required/>
                            <br>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="apellido">Apellido Docente</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" required/>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <label for="tel">Telefono</label>
                        <input type="text" name="tel" id="tel" class="form-control" require>
                        <br>
                    </div>
                    <div class="">
                    <hr>
                        <h4 class="text-center font-weight-bold">Usuario</h4>
                    <hr>
                    </div>

                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="nombreUsuario">Nombre Usuario</label>
                            <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" required/>
                            <br>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="clave">Clave</label>
                            <input type="password" name="clave" id="clave" class="form-control" required/>
                            <br>
                            <input type="hidden" name="rol" id="rol" class="form-control" value="2" required/>
                        </div>
                    </div>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_docentes.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>

            <div class="card-footer">
   
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){
                        // include '../../Share/conexion.php';
                         $conn=OpenCon();

                        //verificar la conexion
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :(");
                        }

                        if($_POST["nombre"]!="" && $_POST["apellido"]!="" && $_POST["tel"]!="" && $_POST["nombreUsuario"]!="" && $_POST["clave"]!=""){
                            $idUser="";
                            //envia el usuario
                            $clave=password_hash($_POST["clave"], PASSWORD_DEFAULT);//clave encriptada
                                                
                            $sqlUser="INSERT INTO tblUsuarios(usuario, clave, idRol) VALUES ('".$_POST["nombreUsuario"]."','".$clave."','".$_POST["rol"]."')";
                            $count=$conn->exec($sqlUser);
                            $idUser = $conn->lastInsertId();//extrae el id del ultimo registro insertado en la bd
                            //echo $idUser;

                            //envia el docente
                            $sql ="INSERT INTO tblDocentes(docenteNombre, docenteApellido, telefono, idUsuario)
                                    VALUES ('".$_POST["nombre"]."','".$_POST["apellido"]."','".$_POST["tel"]."','".$idUser."')";
                            $count += $conn->exec($sql);
                            if($count > 1){
                                Print"<script>
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Hecho!',
                                  text: 'Se ha realizado el Registro!',
                                })
                                </script>";
                            }else{
                                Print"<script>
                                Swal.fire({
                                  icon: 'error',
                                  title: 'OPPS!',
                                  text: 'No se Ha realizado el Registro!',
                                })
                                </script>";
                            }
                            CloseCon($conn);
                        }
                        else{
                            echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                                echo "Aun faltan campos por llenar!! :<";
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
