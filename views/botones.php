<!DOCTYPE html>
<html>
<head>
	<title>Botones de transferencia</title>
	<style>
		body {
			background-color: #f7f7f7;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		form {
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
			margin: 50px auto;
			max-width: 500px;
			padding: 20px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			border: none;
			border-radius: 5px;
			color: #fff;
			cursor: pointer;
			font-size: 16px;
			padding: 10px;
			transition: background-color 0.3s ease;
			width: 100%;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<form action="#" method="get">
		<h1> Bienvenido Selecciona tu tipo de usuario:</h1>
		<input type="submit" name="boton1" value="Colaboradores">
		<input type="submit" name="boton2" value="Estudiantes">
	</form>
	<?php
		if(isset($_GET['boton1'])){
			header('Location: colaboradores.php');
			exit();
		}
		if(isset($_GET['boton2'])){
			header('Location: estudiantes.php');
			exit();
		}
	?>
</body>
</html>