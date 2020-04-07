<!DOCTYPE html>
<?php 
	session_start(); 
	if (isset($_SESSION['id_usuario'])) {
		$mysqli=new mysqli("localhost","root","","registro_tienda"); 
		$IDproveedor =$_POST['Proveedor'];
		$Producto =$_POST['Producto'];
		$Precio =$_POST['Precio'];
		$Cantidad =$_POST['Cantidad'];
		$Precio_total=$Precio*$Cantidad;
		$Fecha =$_POST['Fecha'];
		$sql="INSERT INTO tbcompras ( IDproveedor, Producto, Precio, Cantidad, Fecha, Precio_total) VALUES ( '$IDproveedor', '$Producto', '$Precio', '$Cantidad','$Fecha','$Precio_total')";
		$result=$mysqli->query($sql);
		
		$variableSinUsar


		//Aqui se empieza a modificar la tabla de existencias

		$sql = "SELECT Cantidad FROM tbproductos WHERE Producto = '$Producto' and IDproveedor='$IDproveedor' ";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		echo "<script>alert(".$rows.")</script>";
		if ($rows>0) {
			$sql = "SELECT Cantidad FROM tbproductos WHERE Producto = '$Producto' and IDproveedor='$IDproveedor' ";
			$result=$mysqli->query($sql);
			$row = $result->fetch_assoc();
			$Cantidad_existencias=$row['Cantidad'];	
			$Cantidad_existencias=$Cantidad_existencias+$Cantidad;
			$sql = "UPDATE tbproductos SET Cantidad ='$Cantidad_existencias'  WHERE Producto = '$Producto' and IDproveedor='$IDproveedor'";
			$result=$mysqli->query($sql);
		}
		else{
			$sql="INSERT INTO tbproductos (Producto, Cantidad, IDproveedor) VALUES ( '$Producto', '$Cantidad', '$IDproveedor')";
			$result=$mysqli->query($sql);
		}


		$sql = "SELECT Proveedor  FROM tbproveedores WHERE ID ='$IDproveedor' ";

		$result=$mysqli->query($sql);
		$row = $result->fetch_assoc();
		$Proveedor=$row['Proveedor'];
		$sql = "SELECT Num_Compras FROM tbproveedores WHERE Proveedor='$Proveedor' ";
		$result=$mysqli->query($sql);
		$row = $result->fetch_assoc();
		$Num_Compras=$row['Num_Compras'];
		$Num_Compras++;
		echo "<script>alert(".$Num_Compras.")</script>";
		$sql = "UPDATE tbproveedores SET Num_Compras ='$Num_Compras'  WHERE Proveedor = '$Proveedor'";
		$result=$mysqli->query($sql);
		header("location: ./registros-ventas.php "); 
	}
	else{
		header("location: ./index.php");
	}
?>
<html lang="es">
<head>
	<title>Agregar compra</title>
</head>
<body>

</body>
</html>
