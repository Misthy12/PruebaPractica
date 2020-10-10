
    <?php
    
    include "../../Share/header.php";
    
   if($_GET){
       //CONEXION
       include "../../Share/conexion.php";
       $conn=OpenCon();

       //extraemos datos
       $id=$_GET["codigo"];
       $sql="SELECT u.idUsuario, u.usuario,u.clave, u.clave, r.rol, u.idRol FROM tblusuarios u
                    INNER JOIN tblRoles r ON u.idRol = r.idRol WHERE u.idUsuario = $id";
       $stmm = $conn->prepare($sql);
       $stmm->execute(array($id));
       $row=$stmm->fetchAll(PDO::FETCH_OBJ);
       foreach($row as $row){}

       //consulta para roles
       $sqlRoles="SELECT * FROM tblRoles";
     CloseCon($conn);
     }
     else
     {
      $id="";
        echo "<br><div class=\"alert alert alert-danger\" role=\"alert\">
         <strong>Error</strong> No se han enviado variables</div>";
     }
     
   ?>

   <title>Usuarios</title>

   <div class="col-md-8 offset-md-2 col-sm-12">
       <div class="card">
           <div class="card-header bg-warning">
               <h4 class="text-center ">Editar</h4>
           </div>
           <div class="card-body">
                <form action="" method="POST">
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="nombreUsuario">Nombre Usuario</label>
                            <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" value="<?php echo $row->usuario?>" required/>
                            <br>
                        </div>
                        
                        <div class="col-md-6 col-sm-12" >
                            <label for="clave">Contraseña</label>
                            <input type="password" name="clave" id="clave" class="form-control" value="<?php echo $row->clave?>" readonly/>
                            <br>
                        </div>
                    </div>
                    <div class="row col-12 form-group">
                        <div class="col-md-12 col-sm-12">
                        
                            <label for="rol">Rol</label>
                            <select name="rol" id="rol" type="text" class="form-control"  required>
                            <option  value="<?php echo $row->idRol?>" ><?php echo $row->rol?></option>
                                <?php   
                                    foreach ($conn->query($sqlRoles) as $valor) {
                                        echo "<option value='".$valor["idRol"]."'>".$valor["rol"]."</option>";
                                    }
                                ?>
                            </select>
                            <br>
                        </div>
                    </div>
                    
                    <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->idUsuario?>" required/>
                    <input type="Submit" value="Guardar" name="submit" class="btn btn-success">
                    
                    <?php
                        if($_SESSION["login"]=="Admin"){
                            echo "<a href='../Usuarios/listado_usuarios.php' class='btn btn-warning'>Regresar</a>";
                        }
                    ?>
                    <br>
                </form>
            </div>

            <div class="card-footer">
 
                <!-- ENVIO DE DATOS -->
                <?php
                    if(isset($_POST["submit"])){

                        //verificar la conexion
                        
                        if ($conn == null){
                            die("No se ha podido conectar con la base de datos :'( ");
                        }

                        if($_POST["nombreUsuario"]!="" && $_POST["clave"]!=""){

                            $sql = "UPDATE tblusuarios SET usuario='".$_POST["nombreUsuario"]."', clave='".$_POST["clave"]."', idRol='".$_POST["rol"]."' WHERE idUsuario='".$_POST["id"]."'";
                            $codigo=$_POST["id"];        
                            $count = $conn->exec($sql);
                            if($count > 0){
                                Print"<script>
                                Swal.fire({
                                  icon: 'success',
                                  title: 'Hecho!',
                                  text: 'Se Ha Actualizado el registrado!',
                                })
                                </script>";
                            }else{
                                Print"<script>
                                Swal.fire({
                                  icon: 'error',
                                  title: 'OPPS!',
                                  text: 'No se Ha realizado la actualización!',
                                })
                                </script>";
                            }
                            CloseCon($conn);
                        }
                        else{
                            echo "<div class=\"alert alert-danger \" role=\"alert\" >";
                                echo "Aun faltan campos por llenar!! :(";
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
