<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Evaluaciones KANF</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="./Tools/lib/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="./Tools/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="./Tools/css/cssLogin.css">
  <!-- Theme Alert -->
  <link rel="stylesheet" href="Tools/lib/sweetAlert2/asweetalert2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" id="login">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
        <div class="login-logo card-header">
          <a href="#" class="text-uppercase font-weight-bold "><em>Evaluaciones KANF!</em></a>
        </div>
      <div class="card-body login-card-body">
        <div class="text-center"><i class="fas fa-user-circle text-center fa-4x"></i></div>
        <p class="login-box-msg h5">Iniciar Sesión</p>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="Estudiante-tab" data-toggle="tab" href="#Estudiante" role="tab" aria-controls="Estudiante" aria-selected="true">Estudiante</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="docente-tab" data-toggle="tab" href="#docente" role="tab" aria-controls="docente" aria-selected="false">Docente</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Administrador</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="Estudiante" role="tabpanel" aria-labelledby="Estudiante-tab">
    <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" id="email" name="email" class="form-control" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <label for="remember">
                  <a href="Registro.php">Registrarme.</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" id="btnEstudiante" name="btnEstudiante" class="btn btn-primary btn-block">INICIAR</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>
    <div class="tab-pane fade" id="docente" role="tabpanel" aria-labelledby="docente-tab">
    <form action="" method="post">
    <div class="input-group mb-3">
            <input type="text" id="email" name="email" class="form-control" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" id="btnDocente" name="btnDocente" class="btn btn-primary btn-block">INICIAR</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>
    <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
    <form action="" method="post">
    <div class="input-group mb-3">
            <input type="text" id="email" name="email" class="form-control" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" id="btnAdmin" name="btnAdmin" class="btn btn-primary btn-block">INICIAR</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
    </div>
  </div>
        
      </div>
      <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="Tools/lib/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="Tools/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="Tools/dist/js/adminlte.min.js"></script>
<!-- Alert -->
<script src="Tools/lib/sweetAlert2/sweetalert2.all.min.js"></script>

</body>
</html>
<?php
include("Share/conexion.php"); //incluimos el archivo que se conecta a la base de datos
$conn=OpenCon();
if (isset($_POST['btnEstudiante'])) { //comprobamos si se envían variables desde el form por el método POST
  $email=$_POST["email"]; //Capturamos lo digitado por el usuario en la caja de texto de nombre usuario
  $clave=$_POST["password"];//clave encriptada
  $stmt = $conn->prepare("SELECT a.idAlumno, a.alumnoNombre a.alumnoApellido, a.clave, u.usuario, u.clave, u.idRol  FROM tblAlumnos a
                          INNER JOIN tblUsuarios u ON a.IdUsuario = u.idUsuario WHERE u.usuario=:email"); 
  $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
  //$stmt->bindParam("clave", $clave,PDO::PARAM_STR) ;
  $stmt->execute();
  $count=$stmt->rowCount();
  $data=$stmt->fetch(PDO::FETCH_OBJ);
  if($count>0 && password_verify($clave,$data->password)&& $data->idRol=3 ){
    $alumno= $data->nombreAlumno."".$data->apellidoAlumno;
    //variables allevar
    $_SESSION['id']=$data->idAlumno; // Storing user session value
    $_SESSION["nombre"]=$alumno;
    $_SESSION["login"]="Estudiante";//identificar la sesion
    print "<script> window.location = './Vistas/Index/IndexClientes.php';</script>";
  }
  else
  {
    ?>
    <script>
    Swal.fire({
      icon: 'error',
      title: 'ERROR!',
      text: 'Datos Alumno Incorrectos!',
    })
    </script>
    <?php
  } 
}
else if (isset($_POST['btnDocente'])) { //comprobamos si se envían variables desde el form por el método POST
  $email=$_POST["email"]; //Capturamos lo digitado por el usuario en la caja de texto de nombre usuario
  $clave=$_POST["password"];//clave encriptada
  //$hash_password= hash('sha256', $password); //Password encryption 
  $stmt = $conn->prepare("SELECT d.idDocente, d.docenteNombre, d.docenteApellido, u.usuario, u.clave, u.idRol  FROM tblDocentes d
                          INNER JOIN tblUsuarios u ON d.IdUsuario = u.idUsuario WHERE u.usuario=:email"); 
  $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
  //$stmt->bindParam("clave", $clave,PDO::PARAM_STR) ;
  $stmt->execute();
  $count=$stmt->rowCount();
  $data=$stmt->fetch(PDO::FETCH_OBJ);
  if($count>0 && password_verify($clave,$data->clave)&& $data->idRol=2 ){
    $docente=$data->nombreDocente." ".$data->apellidoDocente;
    //variables allevar
    $_SESSION['id']=$data->idDocente; // Storing user session value
    $_SESSION["nombre"]=$docente;
    //$_SESSION["sucursal"]=$data->nombreSucursal;
    $_SESSION["login"]="Docente";//identificar la sesion
    print "<script> window.location = './Vistas/Index/IndexEmpresas.php';</script>";
  }
  else
  {
    ?>
    <script>
    Swal.fire({
      icon: 'error',
      title: 'ERROR!',
      text: 'Datos de Docente Incorrectos!',
    })
    </script>
    <?php
  } 
}

else if (isset($_POST['btnAdmin'])) { //comprobamos si se envían variables desde el form por el método POST
  $email=$_POST["email"]; //Capturamos lo digitado por el usuario en la caja de texto de nombre usuario
  $clave=$_POST["password"];//clave encriptada
  //$hash_password= hash('sha256', $password); //Password encryption 
  $stmt = $conn->prepare("SELECT * FROM tblUsuarios WHERE u.usuario=:email"); 
  $stmt->bindParam("email", $email,PDO::PARAM_STR) ;
  //$stmt->bindParam("clave", $clave,PDO::PARAM_STR) ;
  $stmt->execute();
  $count=$stmt->rowCount();
  $data=$stmt->fetch(PDO::FETCH_OBJ);
  if($count>0 && password_verify($clave,$data->password) && $data->idRol=1 ){
    //variables allevar
    $_SESSION['id']=$data->idUsuario; // Storing user session value
    $_SESSION["nombre"]=$data->nombreUsuario;
    $_SESSION["login"]="Admin";//identificar la sesion
    print "<script> window.location = './Vistas/Index/IndexAdminLC.php';</script>";
  }
  else
  {
    ?>
    <script>
    Swal.fire({
      icon: 'error',
      title: 'ERROR!',
      text: 'Datos Administrador Incorrectos!',
    })
    </script>
    <?php
  } 
}
?>