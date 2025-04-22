<?php 
    session_start(); // Iniciar o reanudar la sesión

    if (!isset($_SESSION["usuario"])) { // Si no hay un usuario en sesión
        header("Location: login.php"); // Redirigir al login
        exit(); // Detener la ejecución del script
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="../vista/librerias/jquery-3.1.1.min.js"></script>
	  <script src="../script/main.js"></script>
</head>
<body>
    
<div class="d-flex">
<section class="full-box cover dashboard-sideBar">
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height:700px">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="./home.php" class="nav-link active" aria-current="page">
        <i class="bi bi-house"></i>
          Home
        </a>
      </li>
      <li>
        <a href="./documents.php" class="nav-link text-white">
        <i class="bi bi-calendar"></i>
          Documents
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
        <i class="bi bi-grid"></i>
          Process
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
        <i class="bi bi-person-circle"></i>
          Types
        </a>
      </li>
    </ul>
    <hr>
    <div>
      <a href="#" class="d-flex align-items-center text-white text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong></strong>
        <a href="../logout.php"  class="btn btn-dark"><i class="bi bi-box-arrow-left"></i></a>
      </a>
    </div>
  </div>
  </section>

  <section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<nav class="full-box dashboard-Navbar">
			<ul class="full-box list-unstyled text-right">
				<li class="pull-left">
					<a href="#!" class="btn-menu-dashboard"><i class="zmdi zmdi-more-vert"></i></a>
				</li>
				<li>
					<a href="search.html" class="btn-search">
						<i class="zmdi zmdi-search"></i>
					</a>
				</li>
			</ul>
		</nav>

        <?php

            $id = $_GET['id'] ?? null;
            require_once '../modelo/DocumentModelo.php';

            $insDocument = new DocumentModelo();
            $datos = $insDocument->get("",$id);
        ?>

            <div class="container-fluid">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> &nbsp; ACTUALIZAR EL DOCUMENTO</h3>
								</div>
								<div class="panel-body">
									<form class="FormularioAjax ActualizarDocument" method="POST" action="../api.php/document/<?php echo $id ?>">
										<input type="hidden" name="_method" value="PUT">
										<fieldset>
											<div class="container-fluid">
												<div class="row">
													<div class="col-xs-12  col-sm-6">
														<div class="form-group label-floating">
															<label class="control-label">CODIGO *</label>
															<input pattern="[0-9-]{1,30}" class="form-control" type="text" name="codigo-up" value="<?php echo $datos['DOC_CODIGO'];?>" required="">
														</div>
													</div>
													<div class="col-xs-12 col-sm-6">
														<div class="form-group label-floating">
															<label class="control-label">NOMBRE *</label>
															<input  class="form-control" type="text" name="nombre-up" value="<?php echo  $datos['DOC_NOMBRE'];?>" required="">
														</div>
													</div>
													<div class="col-xs-12 col-sm-6">
														<div class="form-group label-floating">
															<label class="control-label">CONTENIDO *</label>
															<input  class="form-control" type="text" name="contenido-up" value="<?php echo $datos['DOC_CONTENIDO'];?>"required="">
														</div>
													</div>
                                                    
                            <div class="col-xs-12 col-sm-6">
														<div class="form-group label-floating">
															<label class="control-label">TIPO *</label>
															<select name="type-up" class="form-control">
                                  <?php
                                                
                                    require_once "../modelo/TypeModel.php";

                                    $instype= new TypeModel();
                                    $results = $instype->get();

                                    foreach ($results as $row) {
                                      $selected = ($row['TIP_ID'] == $datos['DOC_ID_TIPO']) ? 'selected' : '';
                                      echo '<option value="'.htmlspecialchars($row['TIP_ID']).'" '.$selected.'>'
                                           .htmlspecialchars($row['TIP_PREFIJO']).'</option>';
                                  }
                                  ?>
                                  </select>
														</div>
													</div>

													<div class="col-xs-12 col-sm-6">
														<div class="form-group label-floating">
															<label class="control-label">PROCESO *</label>
                              <select name="process-up" class="form-control">
                                        <?php
                                           require_once "../modelo/ProcessModel.php";

                                            $insprocess= new ProcessModel();
                                            $results = $insprocess->get();

                                            foreach ($results as $row) {
                                              $selected = ($row['PRO_ID'] == $datos['DOC_ID_PROCESO']) ? 'selected' : '';
                                              echo '<option value="'.htmlspecialchars($row['PRO_ID']).'" '.$selected.'>'
                                                   .htmlspecialchars($row['PRO_PREFIJO']).'</option>';
                                          }
                                        ?>
                            </select>														
                          </div>
													</div>
												</div>
											</div>
										</fieldset>
										<br>
										<p class="text-center" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i>Actualizar</button>
										</p>
									</form>
								</div>
							</div>
						</div>
</body>
</html>