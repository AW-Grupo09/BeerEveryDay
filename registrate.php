<?php 
	session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/registrate.css" />
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="css/common.css">
</head>

<body>

	<div id="contenedor">
		<?php require ('comun/header.php'); ?>

		<div class="container">
			<div class="titulo">
				<p><h1> ¡Bienvenido, cervecero! </h1></p>
				<p><h2> Estás a punto de unirte a BeerEveryday... </h2></p>
		    </div>

			<?php if(!isset($_SESSION['regFailed'])){?>
				<div class="form">



	      			<form enctype="multipart/form-data" class="form-style" action="logica/procesarRegistro.php" method="post">
	      				<fieldset>
						<legend> Formulario de registro: </legend>

						<div class="imgcontainer">
					   		<img src="img/users/default.png" alt="Avatar" class="avatar">
					    </div>

	          			
          				<label>Nombre de usuario: </label>
          				<input type="text" name="id" required/>
	          			
			              <label>Nombre: </label>
			              <input type="text" name="nombre" required autofocus/>
			            
			              <label>Apellidos: </label>
			              <input type="text" name="apellidos" value="" required/>
			            
			              <label>Fecha de nacimiento: </label>
			              <input type="date" name="fechaNac" placeholder="aaaa/mm/dd" required/>
			           
			              <label>Ciudad: </label>
			              <input type="text" name="ciudad" value=""/>
	            		
			              <label>Mail:</label>
			              <input type="email" name="mail" placeholder="example123@example.com" required/>
			            
			              <label>Repita mail:</label>
			              <input type="email" name="remail" placeholder="Ambos mail deben coindicir" required/>
			            
			              <label>Contraseña: </label>
			              <input type="password" name="pass" value="" required/>
			            
			              <label>Repita contraseña: </label>
			              <input type="password" name="repass" placeholder="Ambas contraseñas deben coindicir" value="" required/>
			            
			      			<p><label class="foto_per_label">Foto de perfil: </label></p>
			              	<p><input id="archivo" class="foto_per" name="archivo" type="file"/></p>
			            
			         <!--
			            <li>
			            	<label>¿Qué rol desea adoptar? </label> <br>
			            	<form>
			            		<input type="radio" name="rol" value="registrado" checked> Registrado <br>
			            		<input type="radio" name="rol" value="vendedor"> Vendedor <br>			            		
			            	</form>
			            </li>
			        -->
			            
			              <p><button class="submit" type="submit">Regístrate</button></p>
			           
			            
			              <p><button type="reset">Reestablecer</button></p>
			            
			              
			            
			            	<p>Al hacer clic en "Registrarte", aceptas los
			            	<a href="terminos.php"> términos y condiciones del servicio </a> y confirmas que has leído nuestra
			            	<a href="politicadeprivacidad.php"> Política de privacidad. </a> </p>

			            	<div>
						    <!--<button type="button" class="cancelbtn">Atrás</button>-->
						    <input type="button" value="Atrás" class="atrasbtn" onclick = "location='./index.php'"/>
						    
						 </div>
			           
	    			</form>
			
		</div>

		<?php }
		else{
			if($_SESSION['regFailed']){
				echo "<p> " . $_SESSION["msg"] . " </p>";
				echo "<p> <a href='registrate.php'> Inténtalo de nuevo </a> </p>";
				$_SESSION['regFailed'] = NULL;
			}
		}


		?>

		<?php require('comun/footer.php'); ?>

	</div> <!-- Fin del contenedor -->

	

</body>
</html>