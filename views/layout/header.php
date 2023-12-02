<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<title>Tienda de Camisetas</title>
	<link rel="stylesheet" href="assets/css/styles.css" />
</head>

<body>
	<div id="container">
		<!-- CABECERA -->
		<header id="header">
			<div id="logo">
				<img src="assets/img/camiseta.png" alt="Camiseta Logo" />
				<a href="index.php">
					Tienda de camisetas
				</a>
			</div>
		</header>

		<!-- MENU -->
		<nav id="menu">
			<ul>
				<li>
					<a href="?controller=Productos&action=index">Inicio</a>
				</li>

				<?php
				require_once "models/utiles/menuLayout.php";
				$categorias = menuLayout::desplegar();
				if($categorias){
					foreach ($categorias as $categoria) {
						echo "
							<li>
							<a href='?controller=Categorias&action=filtrar&categoria=$categoria[0]'>$categoria[1]</a>
							</li>
							";
					}
				}
				?>
			</ul>
		</nav>

		<div id="content">