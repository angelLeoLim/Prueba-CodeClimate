<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/libreria.css">
	<link rel="icon" type="image/png" href="./img/icono.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="theme-color" content="#F7AF1D" />
	<title>Registro de Compras</title>
	<style type="text/css">
		.a1{
			font-size: 4em;
    	    -webkit-transform: rotate(90deg);
    	    -moz-transform: rotate(90deg);
    	    margin-left: auto;
    	    margin-right: auto;
    	    left: 0;
			position: relative;
			width: 200px;
		}
		div{
			text-align:center; 
			font-size: 25px;
		}
	</style>
</head>
<body>
	<?php  
	if (isset($_POST['Registrar'])){
			$Correo=$_POST['correo'];
			$Pass=$_POST['Pass1'];
			$Nombre=$_POST['Name'];
			$Telefono=$_POST['cel'];
			

			$comp_email=false;

			$servername="localhost";
			$username="root";
			$password="";
			$dbname="registro_tienda";
			$conexion=new mysqli($servername,$username,$password,$dbname);
			if ($conexion->connect_error) {
				die("Conexión fallida: ". $conexion->connect_error);
			}

			$consulta="SELECT Email FROM tbusers";
			$respuesta=$conexion->query($consulta);
			if ($respuesta->num_rows > -1){
				while ($columna=$respuesta->fetch_assoc()) {
					if ($columna["Email"]==$Correo){
						$comp_email=true;
					}

				}
			}
			if ($comp_email===true) {
				?>
				<div>
					<p style="font-size: 2em;">YA TE HAS REGISTRADO CON ESE EMAIL.</p>
					<P class="a1">:(</P><br>
					<p><a href="./index.php">Vuelve a intentarlo.</a></p>
				</div>
				<?php
			}
			else{
				$insertar="INSERT INTO tbusers ( Email, Pass, Name, Cel) VALUES ( '$Correo', '$Pass', '$Nombre', '$Telefono')";
				$conexion->query($insertar);
				?>
				<div>
					<p style="font-size: 2em;">TE HAS REGISTRADO CORRECTAMENTE.</p>
					<P class="a1">:)</P><br>
					<p><a href="./index.php">Vuelve a inicio.</a></p>
				</div>
				<?php
			}

		}
		else{
			header('Location: ./index.php');
		}
?>
</body>
</html>