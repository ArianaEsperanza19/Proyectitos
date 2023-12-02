<aside id="lateral">

	<div id="login" class="block_aside">
		<?php
		if (!isset($_SESSION['identidad'])) :
			echo "<h3>Entrar a la web</h3>
						<form action='index.php?controller=Usuarios&action=login' method='post'>
							<label for='email'>Email</label>
							<input type='email' name='email' />
							<label for='password'>Contraseña</label>
							<input type='password' name='password' />
							<input type='submit' value='Enviar' />
							<ul>
							<li><a href='index.php?controller=Usuarios&action=registrar'>Registrarse</a></li>
							</ul>
						</form>
					";
		else :
			require_once "./models/ModeloDB.php";
			
			$id = $_SESSION['identidad'];
			$identificar = new ModeloDB();
			$identidad = $identificar->conseguir('usuarios','nombre',"id=$id");
			$identidad = $identidad->fetchColumn();
			echo "<h3>#$id $identidad</h3>";
			echo "<ul><li><a href='#'>Mis pedidos</a></li>";
			if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
				echo "
				<li><a href='#'>Gestionar pedidos</a></li>
				<li><a href='index.php?controller=Categorias&action=gestionar'>Gestionar categorias</a></li>
				<li><a href='index.php?controller=Productos&action=gestionar'>Gestionar productos</a></li>
					";
			}
			echo "<li><a href='index.php?controller=Usuarios&action=logout'>Cerrar Sesion</a></li></ul>";

		endif;
		?>
	</div>

</aside>
<div id="central">