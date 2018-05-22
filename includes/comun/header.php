<link rel="icon" href="img/favicon.jpeg" type="image/ico">

<div class="header">
	<div id = "up">
		<div id="titulo">
			<a href="index.php"> <img src="./img/logo.png"/> </a>
		</div>
		
		<div id="login">

			<?php 

			if(isset($_SESSION["login"]) && ($_SESSION["login"]===true))
				echo "Hola " . $_SESSION["nombreUsuario"] . "";
			else
				echo "No has iniciado sesión";

			// habra que cambiar algo
			if(isset($_SESSION["login"])&&($_SESSION["login"] == true)){ ?>
				<a href = 'perfil.php'> Perfil </a> 
				<a href = 'logout.php'> Salir </a> 

			<?php } else { ?>
				<a href = 'login.php'> Login </a> 
				<a href = 'registrate.php'> Regístrate </a> 
				
			<?php } ?>

		</div>

	</div>
		
	<!--<div id = "items">
		<a id="item" href = 'index.php'> HOME </a>
		<a id="item" href = 'catalogo.php'> CATÁLOGO </a> 
		<a id="item" href = 'mostrarGrupos.php'> GRUPOS </a> 
		<a id="item" href = 'mostrarCesta.php'> MI CESTA </a>
		<a id="item" href = 'listaPedidos.php'> MIS PEDIDOS </a>
		<a id="item" href = 'misGrupos.php'> MIS GRUPOS </a>

	</div>-->

	<div id = "items">
		<ul class="nav">
				<li><a href='index.php'>HOME</a></li>
				<li><a href='catalogo.php'>CATÁLOGO</a>	</li>
				<li><a href='mostrarGrupos.php'>GRUPOS</a>
					<ul>
						<li><a href='misGrupos.php'>MIS GRUPOS</a></li>
					</ul>
				</li>
				<li><a href='perfil.php'>MI CUENTA</a>
					<?php 
					if(isset($_SESSION['login']) && $_SESSION['login']) { ?>
						<ul>
							<!--<li><a href='perfil.php'>MI PERFIL</a>-->
							<li><a href='listaPedidos.php'>MIS PEDIDOS</a></li>
							<li><a href = 'mostrarCesta.php'> MI CESTA </a> </li>
							<?php 
								if(isset($_SESSION['esAdmin']) && $_SESSION['esAdmin']){ ?>
									<li><a href = 'admin.php'> ADMIN </a> </li>
								<?php } ?>
						</ul>
					<?php } ?>
				</li>
			</ul>
	</div>

</div> <!-- Cierre de header-->

