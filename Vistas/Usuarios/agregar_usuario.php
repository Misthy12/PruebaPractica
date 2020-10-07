<?php
include "../../Share/header.php";
include "../../Share/conexion.php";
//consulta para roles
$conn=OpenCon();
$sqlRoles="SELECT * FROM tblRoles";
CloseCon($conn);
?>
    <title>Usuarios</title>
    <div class="col-md-8 offset-md-2 col-sm-12">
        <div class="card">
            <div class="card-header bg-success">
                <h4 class="text-center">Agregar Usuario</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="form">
                   
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="nombreUsuario">Nombre Usuario</label>
                            <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" required/>
                            <br>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="clave">Contraseña</label>
                            <input type="password" name="clave" id="clave" class="form-control" required/>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        
                        <label for="rol">Rol</label>
                        <select name="rol" id="rol" type="text" class="form-control"  required>
                            <?php   
                                foreach ($conn->query($sqlRoles) as $valor) {
                                    echo "<option value='".$valor["idRol"]."'>".$valor["rol"]."</option>";
                                }
                            ?>
                        </select>
                        <br>
                    </div>
                    
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    <a href="listado_usuarios.php" class="btn btn-info">Regresar</a>
                    <br>
                </form>
            </div>

            <div class="card-footer">
   
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){
                       

                        //verificar la conexion
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :(");
                        }

                        if($_POST["nombreUsuario"]!="" && $_POST["clave"]!="" && $_POST["rol"]!=""){
                            $clave=password_hash($_POST["clave"], PASSWORD_DEFAULT);//clave encriptada
                            $sql = "INSERT INTO tblusuarios(usuario, clave, idRol)
                                    VALUES ('".$_POST["nombreUsuario"]."','".$clave."','".$_POST["rol"]."')";

                            $count = $conn->exec($sql);
                            if($count > 0){
                                Print"<script>
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Hecho!',
                                  text: 'Se Ha registrado el Usuario!',
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
