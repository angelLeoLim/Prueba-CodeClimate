<!DOCTYPE html>
<?php
	$mysqli=new mysqli("localhost","root","","registro_tienda"); 
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
    session_start(); 
    if (isset($_SESSION['id_usuario'])){
		header("location: ./registros-ventas.php");
	}

	
	if (!empty($_POST['login'])) {
		$User=$_POST['User'];
		$Pass=$_POST['Pass'];

		$sql = "SELECT IDUser , Name FROM tbusers WHERE Email = '$User' AND Pass = '$Pass'";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			$row = $result->fetch_assoc();
			$_SESSION['id_usuario'] = $row['IDUser'];
			$_SESSION['Name'] = $row['Name'];
			header("location: ./registros-ventas.php");
		}
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" type="image/png" href="./img/icono.png"/>
	<link rel="stylesheet" type="text/css" href="./css/principal.css">
	<title>Registro de Compras</title>
	
</head>
<body>
	<div>
		<table class="formularios" id="f1">
			<th id="Registro1" align="center"><h3><b>Registrarse</b></h3></th>
			<tr>
			<td valign="top">
				<form name="Registro2" id="Registro" method="post" action="./users.php" onsubmit=" return Comprobar_Registro(Name.value,correo.value,cel.value,Pass1.value,Pass2.value,Registro.name)">
					Nombre<br>	   
					<input type="text" name="Name" maxlength="50"><br>
					Correo<br>            
					<input type="email" name="correo"><br>	
					Telefono<br>
					<input type="tel" name="cel" maxlength="10"><br>
					Contraseña<br>        
					<input type="password" name="Pass1"><br>	
					Repite contraseña<br>
					<input type="password" name="Pass2"><br><br>
					<button type="submit" name="Registrar" value="Registrar">Registrar</button> 
					<button type="reset">Borrar</button>
					<br><br>
					<button onclick="Iniciar_sesion()" id="b1">Iniciar Sesión</button>	
				</form>
			</td>
		</table>
		<table class="formularios" id="f2">
			<th id="Ingreso" align="center"><h3><b>Iniciar sesión</b></h3></th>
			<tr>
			<td valign="top">
				<form name="Ingreso" id="Ingreso" method="post" action="./index.php"  onsubmit="return Ingresar_cuenta(User.value,Pass.value)">
					Correo<br>    
					<input type="text" name="User"><br>
					Contraseña<br> 
					<input type="password" name="Pass"><br><br>
					<button type="submit" name="login" value="false">Ingresar</button>
					<br><br>
					<button onclick="Registrarse()" id="b2">Registrarse</button>
				</form>	
			</td>
		</table>
	</div>
	<script src="./js/inicio.js"></script>
	


</body>
</html>