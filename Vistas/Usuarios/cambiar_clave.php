<?php
    require '../../Share/enviarCorreo.php';
?>

<!doctype html>
<html lang="es-SV">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Copatibilidad -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Titulo Proyecto -->
    <title>Evaluación</title>
        
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../Tools/lib/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../Tools/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Theme Alert -->
  <link rel="stylesheet" href="../../Tools/lib/sweetAlert2/sweetalert2.min.css">
        <!-- Alert -->

</head>
<script src="../../Tools/lib/sweetAlert2/sweetalert2.all.min.js"></script>
<body>
    <div class="container">
        <br>
        <br>
        <div class="row col-12 form-group">
            <div class="offset-md-3 col-6">
                <div class="card ">
                    <div class="card-header bg-dark">
                        <h2 class="text-center font-weight-bold">Cambiar mi Contraseña</h2>
                    </div>
                    <div class="card-body">
                        <form class="col-12" action="" method="POST" >
                            <label for="usuario">Ingrese su Usuario</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" require>
                            <br>
                            <label for="correo">Ingrese correo Vinculado</label>
                            <input type="text" name="correo" id="correo" class="form-control" require>
                            <br>
                            <input type="submit" name="btnEnviar" id="btnEnviar" class="form-control btn btn-success" value="Solicitar Contraseña">
                        </from>
                    </div>
                    
                    <div class="card-footer ">
                        <?php
                            include("../../Share/funciones.php");
                            $conn=OpenCon();

                            //verificar la conexion
                            if ($conn == null){
                                die("No se ha podido conectar con la base de datos :(");
                            }

                            if (isset($_POST['btnEnviar'])) {
                                
                                if($_POST["usuario"]!=" " && $_POST["correo"]!=" " && $_POST["correo"]!=""&& $_POST["usuario"]!=""){
                                    if(usuario($_POST["usuario"])!=null){
                                        $clave= generarClaves(7);
                                        $claveEncrip=password_hash($clave, PASSWORD_DEFAULT);//clave encriptada
                                        
                                            $sql = "UPDATE tblusuarios SET clave='$claveEncrip'WHERE usuario='".$_POST["usuario"]."'";
                                            $codigo=$_POST["usuario"];        
                                            $count = $conn->exec($sql);
                                            if($count > 0){
                                                Print"<script>
                                                Swal.fire({
                                                icon: 'success',
                                                title: 'Hecho!',
                                                text: 'Se Ha Actualizado el registrado!',
                                                });
                                                window.location = '../../Index.php';
                                                </script>";
                                                
                                                //envio de correo con la contrasenia
                                                correoClave($_POST["correo"],$_POST["usuario"],$clave);
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
                                        echo "<script type=\"text/javascript\">
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'OPPS!',
                                            text: 'El usuario no coincide!',
                                        })
                                        </script>"; 
                                    }
                                }
                                else{
                                    echo "<script type=\"text/javascript\">
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'OPPS!',
                                        text: 'Datos Vacios Verifique!',
                                    })
                                    </script>";
                                }
                            }
                                                        
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <footer class=" col- 12 text-center" stiyle="float:bottom">
            <hr>
                <details>
                    <summary><strong>Copyright &copy; 2020 <a href="http://adminlte.io">KANF!!</a>.</strong></summary>
                        <p>
                        <a href="mailto:nancycolatoam@gmail.com">Nancy Alondra Colato Martínez</a><br>
                        <a href="mailto:matinezfidel@gmail.com">Fidel Edgardo García Martínez</a><br>
                        <a href="mailto:keyssiesme@gmail.com">Keyssi Esmaralda Gochez Mejía</a><br>
                        <a href="mailto:rivasnestor95@gmail.com">Nestor Stanley Rivas Díaz</a><br>
                        </p> 
                        <hr>
                        Todos los derechos reservados.
                        <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> Beta
                        </div>
                </details> 
        </footer>
            <!-- jQuery -->
            <script src="../../Tools/lib/jquery/dist/jquery.min.js"></script>
            <script src="../../Tools/lib/jquery-validation/dist/jquery.validate.min.js"></script>
            <!-- jQuery UI 1.11.4 -->
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script src="../../Tools/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Bootstrap 4 -->

            <!-- Alert -->
            <script src="../../Tools/lib/sweetAlert2/sweetalert2.all.min.js"></script>
    
     </div>     
</body>
</html>