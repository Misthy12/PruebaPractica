<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>KANF EVALUACIONES</title>
    <meta charset="UTF-8">
    <!-- Configuraciones Iniciales -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- ESTILOS -->
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="./Tools/lib/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./Tools/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./Tools/lib/animate.css/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./Tools/css/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./Tools/css/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="./Tools/css/css/util.css">
    <link rel="stylesheet" type="text/css" href="./Tools/css/css/main.css">
    <link rel="stylesheet" type="text/css" href="./Tools/css/cssLogin.css">
    

</head>
<body id="login">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="./Tools/img/img-01.png" alt="image Sesion">
                </div>

                <form class="login100-form validate-form" action="" method="POST">
                    <span class="login100-form-title">
                        Inicio de Sesión
                    </span>

                    <div class="wrap-input100 validate-input" >
                        <input class="input100" type="text" name="txtUsuario" id="txtUsuario" placeholder="Usuario">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-user-circle" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" >
                        <input class="input100" type="password" name="txtClave" id="txtClave" placeholder="Contraseña">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" id="btnLog" name="btnLog" type="submit"  >
                            Iniciar
                        </button>
                    </div>

                    <div class="text-center p-t-25">
                        <span class="txt1">
                            Olvide
                        </span>
                        <a class="txt2" href="./Vistas/Usuarios/cambiar_clave.php">
                            Mi Contraseña?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--================================================= SCRIPTS ==========================================-->
    <script src="./Tools/lib/jquery/dist/jquery.min.js"></script>
    <!--===============================================================================================-->
    <script src="./Tools/lib/popper/popper.js"></script>
    <script src="./Tools/lib/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="./Tools/css/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="./Tools/lib/jquery/dist/tilt.jquery.min.js"></script>
    <script>
		$('.js-tilt').tilt({
			scale: 1.1
		});
    </script>
    <!--===============================================================================================-->
    <script src="./Tools/js/main.js"></script>
    <!-- Alert -->
    <script src="Tools/lib/sweetAlert2/sweetalert2.all.min.js"></script>

</body>
</html>

<!--================================================= PHP ==========================================-->
<?php
  include("Share/conexion.php"); //incluimos el archivo que se conecta a la base de datos
  $conn=OpenCon();  

  if (isset($_POST['btnLog'])) { //comprobamos si se envían variables desde el form por el método POST
        $usuario=$_POST["txtUsuario"]; //Capturamos lo digitado por el usuario en la caja de texto de nombre usuario
        $clave=$_POST["txtClave"];//clave encriptada

        //consulta a tabla USUARIOS en bd
        $stmt = $conn->prepare("SELECT * FROM tblUsuarios WHERE usuario=:usuario"); 
        $stmt->bindParam("usuario", $usuario,PDO::PARAM_STR) ;
        $stmt->execute();
        $count=$stmt->rowCount();//verifica si encuentra registro
        $data=$stmt->fetch(PDO::FETCH_OBJ);//asigna los datos recogidos

        if($count>0 && password_verify($clave,$data->clave)){
            $nombreUser=$data->usuario;
            if($data->idRol==1){
            $_SESSION['id']=$data->idUsuario; // Storing user session value
            $_SESSION['nombre']=$nombreUser;
            $_SESSION["login"]="Admin";//identificar la sesion
            print "<script> window.location = './Vistas/Index/IndexAdminLC.php';</script>";
          }
          //PARA ESTUDIANTE
          elseif($data->idRol==3 ){
            
            $idUser=$data->idUsuario;//ide del usuario
            $stmtA = $conn->prepare("SELECT * FROM tblAlumnos  WHERE idUsuario=:idUser"); 
            $stmtA->bindParam("idUser", $idUser,PDO::PARAM_STR) ;
            $stmtA->execute();
            $countA=$stmtA->rowCount();
            $dataAlumn=$stmtA->fetch(PDO::FETCH_OBJ);

            if($countA>0){
            $nombreAlum=$dataAlumn->alumnoNombre." ".$dataAlumn->alumnoApellido;

            $_SESSION['idUser']=$data->idUsuario; // Storing user session value
            $_SESSION['id']=$dataAlumn->idAlumno;
            $_SESSION['nombre']=$nombreAlum;
            $_SESSION['usuario']=$usuario;
            $_SESSION["login"]="Alumno";//identificar la sesion
            print "<script> window.location = './Vistas/Index/IndexAlumno.php';</script>";
            }
          }
          //PARA DOCENTE
          else{
            $nombreUser=$data->usuario;
            $idUser=$data->idUsuario;//id del usuario
            $stmtD = $conn->prepare("SELECT * FROM tblDocentes WHERE idUsuario=:idUser"); 
            $stmtD->bindParam("idUser", $idUser,PDO::PARAM_STR) ;
            $stmtD->execute();
            $countD=$stmtD->rowCount();
            $dataDocen=$stmtD->fetch(PDO::FETCH_OBJ);
            if($countD>0){
            $nombreDocen=$dataDocen->docenteNombre." ".$dataDocen->docenteApellido;

            $_SESSION['idUSer']=$data->idUsuario; // Storing user session value
            $_SESSION['id']=$dataDocen->idDocente; // Storing user session value
            $_SESSION['nombre']=$nombreDocen;
            
            $_SESSION["login"]="Docente";//identificar la sesion
            print "<script> window.location = './Vistas/Index/IndexDocente.php';</script>";
            }
        }

        }
        
        else
        {
            Print"<script>
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR!',
                    text: 'Datos Incorrectos!',
                })
            </script>";
        }
    }
?>
