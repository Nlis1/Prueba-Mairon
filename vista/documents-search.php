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
    <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/main.css">
	<script src="../vista/librerias/jquery-3.1.1.min.js"></script>
	<script src="/prueba-mairon/script/main.js"></script>
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
				<a href="../vista/home.php" class="nav-link text-white" aria-current="page">
				<i class="bi bi-house"></i>
				Home
				</a>
			</li>
			<li>
				<a href="./documents.php" class="nav-link text-white active">
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
				<strong><?php echo $_SESSION['usuario']; ?></strong>
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

		<!-- Content page -->
		<div class="container-fluid">
			<div class="page-header">
			  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> <small>Documentos</small></h1>
			</div>
			<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
		</div>

		<div class="container-fluid">
			<ul class="breadcrumb breadcrumb-tabs">
			  	<li>
			  		<a href="../vista/documents.php" class="btn btn-info">
			  			<i class="zmdi zmdi-plus"></i> &nbsp; Nuevo Documento
			  		</a>
			  	</li>
			  	<li>
			  		<a href="../vista/documents-search.php" class="btn btn-primary">
			  			<i class="zmdi zmdi-search"></i> &nbsp; Listar Documentos
			  		</a>
			  	</li>
			</ul>
		</div>

		<div class="container-fluid">
			<form action="../api.php/document" method="GET" class="FormularioAjax Busqueda">
				<div class="row" style="justify-content: center; display: flex; ">
					<div class="col-xs-12 col-md-8 col-md-offset-2">
						<div class="form-group label-floating">
							<span class="control-label">¿A quién estas buscando?</span>
							<input class="form-control" type="text" name="busqueda_inicial" >
						</div>  
					</div>
					<div class="col-xs-12">	
						<p class="text-center">
							<button type="submit" class="btn btn-primary btn-raised btn-sm"><i class="zmdi zmdi-search"></i> &nbsp; Buscar</button>
						</p>
					</div>
				</div>
			</form>
		</div>

		<!-- <div class="container-fluid">
			<form action="../ajax/buscadorAjax.php" method="POST" data-form="default" class="FormularioAjax BusquedaEliminada" enctype="multipart/form-data">
				<p class="lead text-center">Su última búsqueda fue <strong><?php echo  $_SESSION['busqueda'] ?></strong></p>
				<div class="row" >
					<input class="form-control" type="hidden" name="eliminar_busqueda" value="1">
					<div class="col-xs-12">
						<p class="text-center">
							<button type="submit" class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-delete"></i> &nbsp; Eliminar búsqueda</button>
						</p>
					</div>
				</div>
			</form>
		</div> -->

		
		<?php
          require_once(__DIR__ . '/../modelo/DocumentModelo.php');

            $insDocument = new DocumentModelo();
            $datos = $insDocument->get("");
            $contador=1;
        ?>
		<!-- Panel listado de busqueda de administradores -->
		<div class="container-fluid">
		<div class="panel panel-primary">
			<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; BUSCAR DOCUMENTO</h3>
			</div>
			<div class="panel-body" style="height: 480px; padding-bottom: 120px; overflow: scroll;">
			<form method="POST" action="../api.php/document/ class="FormularioAjax Busqueda">
				<div class="table-responsive">
				<table class="table table-hover text-center">
					<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">CODIGO</th>
						<th class="text-center">NOMBRE</th>
						<th class="text-center">CONTENIDO</th>
						<th class="text-center">TIPO</th>
						<th class="text-center">PROCESO</th>
						<th class="text-center">ACTUALIZAR</th>
						<th class="text-center">ELIMINAR</th>
					</tr>
					</thead>

					<tbody id="respuesta-busqueda">
						<?php 
                            foreach ($datos as $row) {
                               ?> 
                               <tr>
                                <td><?php echo  $contador ?></td>
                                <td><?php echo $row['DOC_CODIGO'] ?></td>
                                <td><?php echo $row['DOC_NOMBRE']  ?></td>
                                <td><?php echo $row['DOC_CONTENIDO']?></td>
                                <td><?php echo $row['DOC_ID_TIPO']?></td>
                                <td><?php echo $row['DOC_ID_PROCESO']?></td>

                                <td>
                                <a href="./mydocuments.php?id=<?php echo $row['DOC_ID'] ?>" class="btn btn-success btn-raised btn-xs">
                                <i class="bi bi-arrow-clockwise"></i>
                                </a>
                                </td>

                                <td>
                                    <form class="FormularioAjax eliminarDocumento" method="POST" action="../api.php/document/<?php echo $row['DOC_ID'] ?>">
										<input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-raised btn-xs">
                                         	<i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            <?php
                         $contador++;
                        }
                         ?>
					</tbody>
				</table>
				</div>
			</form>
			</div>
		</div>
		</div>

	</section>



  </body>
</html>