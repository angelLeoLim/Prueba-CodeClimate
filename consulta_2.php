<!DOCTYPE html>
<?php 
	session_start(); 
	if (isset($_SESSION['id_usuario'])) {
		$mysqli=new mysqli("localhost","root","","registro_tienda"); 
		$Producto =$_POST['Producto'];
		$Precio=$_POST['Precio'];
		$IDCliente=$_POST['Cliente'];
		$Cantidad =$_POST['Cantidad'];
		$Precio_total=$Precio*$Cantidad;
		$Fecha =$_POST['Fecha'];
		


		//comprobar existencias
		
		$sql = "SELECT IDproveedor FROM tbproductos WHERE ID = '$Producto'";
		$result=$mysqli->query($sql);
		$row = $result->fetch_assoc();
		$IDproveedor = $row['IDproveedor'];
		$sql = "SELECT Cantidad FROM tbproductos WHERE ID = '$Producto' and IDproveedor = '$IDproveedor'";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		$row = $result->fetch_assoc();
		$Cantidad_tb = $row['Cantidad'];
		
?>	
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/libreria.css">
	<link rel="icon" type="image/png" href="./img/icono.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="theme-color" content="#F7AF1D" />
	<title>Agregar compra</title>
</head>
<body>
	<?php
		if ($Cantidad_tb>$Cantidad) {
			$sql = "SELECT Cantidad FROM tbproductos WHERE ID = '$Producto' and IDproveedor = '$IDproveedor'";
			$result=$mysqli->query($sql);
			$row = $result->fetch_assoc();
			$Cantidad_existencias = $row['Cantidad'];
			$Cantidad_existencias=$Cantidad_existencias-$Cantidad;
			$sql = "UPDATE tbproductos SET Cantidad ='$Cantidad_existencias'  WHERE ID = '$Producto' and  IDproveedor='$IDproveedor'";
			$result=$mysqli->query($sql);
			$sql="INSERT INTO tbventas ( IDcliente, IDProducto, Precio, Cantidad, Fecha, Precio_total) VALUES ( '$IDCliente', '$Producto', '$Precio', '$Cantidad','$Fecha','$Precio_total')";
			$result=$mysqli->query($sql);
		}
		else{
			if ($Cantidad_tb==0) {
				echo "<script>alert('Producto agotado')</script>";
			}
			else{
				echo "<script>alert('No se cuenta con suficiente ')</script>";
			}
		}
		header("location: ./registros-ventas.php "); 
	}
	else{
		header("location: ./index.php");
	}
?>
</body>
</html>
