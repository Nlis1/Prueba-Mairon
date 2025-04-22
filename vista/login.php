<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php 
    session_start(); // Iniciar o reanudar la sesión

    if (isset($_SESSION["usuario"])) { // Si no hay un usuario en sesión
        header("Location: home.php"); // Redirigir al login
        exit(); // Detener la ejecución del script
    }
    
?>


<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://ailabschool.com/wp-content/uploads/2023/10/Img-IA-1920-x-1080-2-1536x864.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="../login.php">
            <div>
                <h3>Iniciar Sesion</h3> <br>
            </div>
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
          <label class="form-label" for="form3Example3">Usuario</label>
            <input type="text" id="username" name="usuario" class="form-control form-control-lg"
              placeholder="Ingresa el email" />
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
          <label class="form-label" for="form3Example4">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" class="form-control form-control-lg"
              placeholder="Ingresa la contraseña" />
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Recuerdame
              </label>
            </div>
            <a href="#!" class="text-body">Olvidaste la contraseña?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <input type="submit" value="Iniciar sesión" class="btn btn-danger" stiyle="color: #FFF;">
            <p class="small fw-bold mt-2 pt-1 mb-0">No tienes una cuenta?<a href="#!"
                class="link-info">Registrate</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2020. All rights reserved.
    </div>
  </div>

  </section>
</body>
</html>