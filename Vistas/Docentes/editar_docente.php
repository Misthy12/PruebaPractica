
<?php
    include "../../Share/header.php";
    if($_GET){
        //CONEXION
        include "../../Share/conexion.php";
        $conn=OpenCon();

        //extraemos datos
        $id=$_GET["codigo"];
        $stmm = $conn->prepare("SELECT d.idDocente, d.correo, d.docenteNombre as nombre, d.docenteApellido as apellido, d.telefono, u.usuario, u.clave, d.idUsuario FROM tblDocentes d
        INNER JOIN tblUsuarios u ON d.idUsuario = u.idUsuario WHERE d.idDocente=$id");
        $stmm->execute(array($id));
        $row=$stmm->fetchAll(PDO::FETCH_OBJ);
        foreach($row as $row){}

        CloseCon($conn);
    }
        else
        {
        $id="";
            echo "<br><div class=\"alert alert alert-danger\" role=\"alert\">
            <strong>Error</strong> No se han enviado variables</div>";
        }
    
     
?>

   <title>Docentes</title>

   <div class="col-md-8 offset-md-2 col-sm-12">
       <div class="card">
           <div class="card-header bg-warning">
               <h4 class="text-center ">Editar</h4>
           </div>
           <div class="card-body">
                <form action="" method="POST">
                    <div class="row col-12 form-group">
                        <div class="col-md-6 col-sm-12">
                            <label for="nombre">Nombre Docente</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $row->nombre?>" required/>
                            <br>
                        </div>
                        
                        <div class="col-md-6 col-sm-12" >
                            <label for="apellido">Apellido Docente</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $row->apellido?>" required/>
                            <br>
                        </div>
                    </div>
                    <div class="row col-12 form-group">
                        <div class="col-md-3 col-sm-12">
                            <label for="tel">Telefono</label>
                            <input type="tel" name="tel" id="tel" class="form-control" value="<?php echo $row->telefono?>" required/>
                            <br>
                        </div>
                        
                        <div class="col-md-3 col-sm-12" >
                            <label for="user">Usuario</label>
                            <input type="text" name="user" id="user" class="form-control" value="<?php echo $row->usuario?>" readonly/>
                            <br>
                        </div>
                        <div class="col-md-6 col-sm-12" >
                            <label for="correo">Correo</label>
                            <input type="email" name="correo" id="correo" class="form-control" value="<?php echo $row->correo?>" />
                            <br>
                        </div>
                    </div>

                    <div class="row col-12 form-group">
                            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $row->id?>" required/>
                            <input type="Submit" value="Guardar" name="submit" class="btn btn-success "> 

                            <?php
                                if($_SESSION["login"] ="Docente"){
                                    echo "<a href='../Index/IndexDocente.php' class='btn btn-warning ' style='margin-left:3px'>Regresar</a>";
                                }else{
                                    echo "<a href='../Docentes/listado_Docentes.php' class='btn btn-warning '>Regresar</a>";
                                }
                            ?>
                        
                    </div>
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

                        if($_POST["nombre"]!="" && $_POST["apellido"]!="" && $_POST["tel"]!="" ){
                           
                            $sql = "UPDATE tblDocentes SET docenteNombre='".$_POST["nombre"]."', docenteApellido='".$_POST["apellido"]."', telefono='".$_POST["tel"]."', correo='".$_POST["correo"]."' WHERE id='".$_POST["id"]."'";
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
