<!DOCTYPE html>
<?php 
	session_start(); 
	if (isset($_SESSION['id_usuario'])) {
		$mysqli=new mysqli("localhost","root","","registro_tienda"); 
		$Nombre =$_POST['Cliente'];
		$sql = "SELECT Nombre FROM tbclientes ";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		$row = $result->fetch_assoc();
		for ($i=0; $i < $rows; $i++) { 
			$Comprobar_nombre[$i]=$row['Nombre'];

		}
		$registrar=true;
		for ($j=0; $j < $rows; $j++) { 
			if ($Comprobar_nombre[$j]==$Nombre) {
				$registrar=false;
			}
			else{
				$registrar=true;
			}
		}
		if ($registrar===true) {
			$sql="INSERT INTO tbclientes (Nombre) VALUES ('$Nombre')";
			$result=$mysqli->query($sql);
		}

		
		 
?>	
<html lang="es">
<head>
	<title>Agregar compra</title>
</head>
<body>

</body>
</html>
<?php 
	header("location: ./registros-ventas.php ");
	}
	else{
		header("location: ./index.php");
	}
?>

