<?php 



?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="icon" href="../img/pestaña-logo.png" type="image/png">
  <link rel="stylesheet" href="../assets/css/estilos_recuperar.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <title>Cambiar Contraseña</title>
</head>

<body class="text-center">
  <h1>BIENVENIDOS AL SISTEMA TECNOMECANICA </h1>
  <main class="form-signin w-100 m-auto">
    <form class="needs-validation" action="../includes/recuperar/config/change_passwordCode.php" method="POST" novalidate autocomplete="off">

      <h2 class="h3 mb-3 fw-normal">Por favor ingrese su nueva contraseña</h2>
      <div class="form-floating my-3">
        <input type="password" class="form-control" id="floatingInput" name="new_password" required pattern="[a-zA-Z-0-9\,.-_ÑñáéíóúÁÉÍÓÚ\s]+" maxlength="20" minlength="8" required>
        <input type="hidden" name="IdUsuario" value="<?php echo $_GET['id']; ?>">
        <label for="floatingInput">Ingrese su nueva contraseña</label>
        <div class="valid-feedback">
          <span>Excelente!</span>
        </div>
        <div class="invalid-feedback">
          <span>Cambio de contraseña no válido. minimo 8 y maximo 16 caracteres debe incluir letras, números, y
            caracteres especiales.</span>
        </div>
      </div>
      <button class="w-100  mb-2 btn btn-lg btn-primary" type="submit">Recuperar contraseña</button>
      <a class=" w-100 btn btn-lg btn-warning" href="../includes/_sesion/login.php">Regresar</a>

    </form>
  </main>
  <center>
    <footer> &copy; Copyright Todos los derechos reservados TecnoMecanica 2024</footer>
  </center>
  <div class="capa"></div>


  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>

</body>

</html>