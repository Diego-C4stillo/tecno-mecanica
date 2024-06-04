<?php
error_reporting(0);

session_start([
  'use_only_cookies' => 1,
  'cookie_lifetime' => 1,
  'cookie_secure' => 0,
  'cookie_httponly' => 0,
  'use_strict_mode' => 1,
]);

$actualsesion = isset($_SESSION['Usuario']) ? $_SESSION['Usuario'] : null;
$alert = '';
if (isset($actualsesion) || is_array($actualsesion) || !empty($actualsesion)) {
  header("Location: ../../views/user.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie-edge">
  <title>Iniciar sesión</title>

  <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../../assets/img/logo_icon.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css " href="../../assets/css/sb-admin-2.min.css">
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <link rel="icon" href="../../assets/img/logo.png" type="image/x-icon" />
  <script src="../../assets/js/fonts.js"></script>

</head>

<body>
  <!--  <img class="wave"src="../assets/img/wave.png" alt="">  -->
  <div class="contenedor">
    <div class="contenido-login">

      <form action="../functions.php" method="POST">
        <img class="img-user" src="../../assets/img/logo_icon.png" alt="Imagen de usuario">
        <h2>TecnoMecánica</h2>
        <h1>Inciar sesión</h1>

        <div class="input-div nit">
          <div class="i">
            <i class="fa fa-user"></i>
          </div>
          <div class="div">
            <input type="text" name="txtUser" id="txtUser" placeholder="USUARIO">
          </div>
        </div>

        <div class="input-div pass">
          <div class="i">
            <i class="fa fa-lock"></i>
          </div>
          <div class="div">

            <input type="password" name="txtPassword" id="txtPassword" placeholder="CONTRASEÑA">

            <input type="hidden" name="accion" value="acceso_usuario">
          </div>
        </div>

        <button class="btn" style="color: #fff" type="submit"> Iniciar sesión </button>
        <a class="regresar" href="../../views/principal.php">¿Regresar?</a>
        <a href="../recuperar.php">¿Olvidaste tú contraseña?</a>
        <?php echo (isset($alert)) ? $alert : ''; ?>
        <?php
        if (isset($_GET['messages'])) {
        ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php
            switch ($_GET['messages']) {
              case 'error':
                echo 'Usuario y contraseña incorrecto';
                break;
            }
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
        }
        ?>
        <!-- Mensajes si se recupera la contraseña-->
        <?php
        if (isset($_GET['message'])) {

        ?>
          <div class="alert alert-primary" role="alert">
            <?php
            switch ($_GET['message']) {
              case 'ok':
                echo 'Por favor, revisa tu correo';
                break;
              case 'success_password':
                echo 'Inicia sesión con tu nueva contraseña';
                break;

              default:
                echo 'Algo salió mal, intenta de nuevo';
                break;
            }
            ?>
          </div>
        <?php
        }
        ?>

      </form>
    </div>
  </div>
  <!-- Js personalizado -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>