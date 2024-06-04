<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecnoMécanica</title>
    <!--Estilos de bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--Iconos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Hoja de estilos-->
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/sb-admin-2.css">
    <!--Icono de pestaña-->
    <link rel="icon" href="../assets/img/logo_icon.png" type="image/png">
</head>

<body class="body-black">
    <!--Barra de navegación-->
    <nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top">
        <div class="container">
            <a href="../TecnoHerramientas/index.html" class="navbar-brand" id="logoContainer">
                <img src="../assets/img/principal/tecno-logo.png" alt="Logo del Instituto Superior Tecnológico Tecnoecuatoriano" width="25" height="25" class="d-inline-block align-text-top p-0 me-0 me-lg-2">
                <span></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarS" aria-controls="navbarS" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list" style="color: black;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarS">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!--
                    <li class="nav-item">
                        <a href="#" class="nav-link">Inicio</a>
                    </li>
                    -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Buscadores
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="../includes/buscar_herramienta.php">Buscador de herramientas</a></li>
                            <li><a class="dropdown-item" href="../includes/buscar_maqueta.php">Buscador de maquetas</a></li>
                            <!--
                          <li><a class="dropdown-item" href="#">Buscador de maquetas</a></li>
                          <li><a class="dropdown-item" href="#">Buscador de lugares</a></li>
                          -->
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="../includes/_sesion/login.php" class="nav-link">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item py-2 py-lg-1 col-12 col-lg-auto">
                        <div class="vr d-none d-lg-flex h-100 mx-lg-2 text-white"></div>
                        <hr class="d-lg-none my-2 text-white-50">
                    </li>
                    <ul class="navbar-nav sm-icons mr-0">
                        <li class="nav-item"><a class="nav-link" href="https://www.facebook.com/Tecnoecuatoriano"><i class="bi bi-facebook"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/tecnoecuatoriano/"><i class="bi bi-instagram"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="https://www.tiktok.com/@tecnoecuatoriano"><i class="bi bi-tiktok"></i></a></li>
                    </ul>
                </ul>
            </div>
        </div>
    </nav><!--Fin barra de navegación-->
    <!-- Inicio Carousel -->
    <div id="carouselE" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselE" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
            </button>
            <button type="button" data-bs-target="#carouselE" data-bs-slide-to="1" aria-current="true" aria-label="Slide 2">
            </button>
            <button type="button" data-bs-target="#carouselE" data-bs-slide-to="2" aria-current="true" aria-label="Slide 3">
            </button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../assets/img/principal/home-1.jpg" class="d-block w-100" alt="">
                <div class="carousel-caption">
                    <h5>Obtener guía</h5>

                    <p>
                        Aprende todo lo que necesitas saber sobre mantenimiento, diagnóstico de problemas comunes,
                        reparaciones básicas y más.
                    </p>

                    <a href="#" class="btn btn-primary mt-3">Mas información</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../assets/img/principal/home-2.jpg" class="d-block w-100" alt="">
                <div class="carousel-caption">
                    <h5>Uso de equipos de protección</h5>

                    <p>
                        Al manipular herramientas, productos químicos y componentes del vehículo, es importante utilizar
                        guantes, gafas de seguridad, casco y ropa adecuada.
                    </p>

                    <a href="#" class="btn btn-primary mt-3">Mas información</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../assets/img/principal/home-3.jpg" class="d-block w-100" alt="">
                <div class="carousel-caption">
                    <h5>Noticias</h5>

                    <p>
                        ¡Mantente al tanto de las últimas novedades en el mundo de la mecánica automotriz!
                    </p>

                    <a href="#" class="btn btn-primary mt-3">Mas información</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselE" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselE" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div><!--Fin slider-->

    </section><!--Fin servicios-->
    <!--Porfolio-->
    <section class="portfolio section-padding">
        <div class="container">
            <!--
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center text-white pb-5">
                        <h2>Playas</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis nobis consequatur assumenda
                            suscipit. <br> atque aliquam autem qui aliquid in dolore consectetur quam, nam ipsam. Dicta
                            mollitia hic nihil ducimus debitis!
                        </p>
                    </div>
                </div>
            </div>
            -->
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-dark pb-2">
                        <div class="card-body text-white ">
                            <div class="img-area mb-4">
                                <img src="assets/img/principal/test-qr.png" class="img-fluid" alt="">
                            </div>
                            <i class="bi bi-qr-code-scan"></i>
                            <h3>Guía</h3>
                            <p class="lead">
                                Nuestra guía detallada te brindará paso a paso instrucciones, consejos prácticos y
                                trucos útiles para mantener tu automóvil en óptimas condiciones. No pierdas la
                                oportunidad de tener a tu alcance esta invaluable herramienta.
                            </p>
                            <button class="btn bg-primary text-white">Descargar guía</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-dark pb-2">
                        <div class="card-body text-white ">
                            <div class="img-area mb-4">
                                <img src="assets/img/principal/equipos-de-proteccion.png" class="img-fluid" alt="">
                            </div>
                            <i class="bi bi-tools"></i>
                            <h3>Uso de equipos de protección</h3>
                            <p class="lead">
                                No comprometas tu seguridad en el taller. Antes de realizar cualquier trabajo, asegúrate
                                de utilizar los equipos de protección adecuados. Guantes, gafas de seguridad, casco y
                                ropa especializada son fundamentales para prevenir lesiones graves. Recuerda que el
                                manejo de herramientas, productos químicos y componentes del vehículo conlleva riesgos.
                            </p>
                            <button class="btn bg-primary text-white">Ver tutorial</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-dark pb-2">
                        <div class="card-body text-white ">
                            <div class="img-area mb-4">
                                <img src="assets/img/principal/noticias.jpg" class="img-fluid" alt="">
                            </div>
                            <i class="bi bi-newspaper"></i>
                            <h3>Noticias</h3>
                            <p class="lead">
                                ¡Descubre todas las últimas noticias y avances tecnológicos del Tecnoecuatoriano! Te
                                ofrecemos acceso exclusivo a información actualizada sobre los avances más recientes en
                                tecnología en Ecuador. Mantente al tanto de las tendencias, innovaciones y desarrollos
                                más emocionantes en el ámbito tecnológico del país.
                            </p>
                            <button class="btn bg-primary text-white">Ver noticias</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Fin porfolio-->



    <!--Pie de página-->
    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold">Nosotros</h5>
                    <hr class="mb-4">
                    <p>
                        Somos estudiantes de la carrera de mecánica y electromecánica automotriz, ingresa al sistema web para revisar todas las funcionalidades.
                    </p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto ">
                    <h5 class="text-uppercase mb-2 font-weight-bold ">Dejanos ayudarte</h5>
                    <hr class="mb-2">
                    <p>
                        <a href="user.php" class="text-white">Tu cuenta</a>
                    </p>
                    <p>
                        <a href="solicitudes.php" class="text-white">Solicitudes</a>
                    </p>
                    <p>
                        <a href="../includes/editar_user.php" class="text-white">Configuración de cuenta</a>
                    </p>
                    <!--
                    <p>
                        <a href="ayuda.php" class="text-white">Ayuda</a>
                    </p>
                    -->
                </div>


            </div>
        </div>
        <hr class="mb-4">
        <div class="text-center">
            <p>
                Copyright Todos los derechos reservados
                <strong>TecnoMecanica 2024</strong>
            </p>
        </div>
    </footer>
    <!--Fin pie de página-->
    <!--Script js de bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>