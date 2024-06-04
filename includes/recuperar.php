<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/pestaña-logo.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/estilos_recuperar.css">
  <title>Recuperar contraseña</title>
</head>
<body >
<h1>BIENVENIDOS AL SISTEMA TECNOMECANICA</h1>
<main class="form-signin w-100 m-auto">
  <form action="../includes/recuperar/config/recoveryCode.php" method="POST">
  
    <h2 class="h3 mb-3 fw-normal text-center">Por favor, agregar correo electrónico</h2>
    <div class="form-floating my-3">
      <input type="email" class="form-control caja" id="floatingInput" placeholder="Ingrese correo electrónico" name="email">
      <label for="floatingInput">Ingrese un correo electrónico</label>
    </div>
    <div class="form__boton">
    <button class=" btn btn-lg btn boton mr-3" type="submit">Recuperar</button>
    <a class="btn boton" href="../includes/_sesion/login.php">Regresar</a>
    </div>
  </form>
</main>
<center><footer> &copy;  2024 Todos los derechos reservados TecnoMecanica</footer></center>
<div class="capa"></div>
    
  </body>
</html>