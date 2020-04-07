<!DOCTYPE html>
<?php 
	session_start(); 

	if (isset($_SESSION['id_usuario'])) {
		$mysqli=new mysqli("localhost","root","","registro_tienda"); 
		$proveedor =$_POST['Proveedor'];
		$sql="INSERT INTO tbproveedores (Proveedor) VALUES ( '$proveedor')";
		$result=$mysqli->query($sql);
		echo $proveedor ;
		header("location: ./registros-ventas.php ") ;
	}
	else{
		header("location: ./index.php");
	}
?>
<html lang="es">
<head>
	<title>Agregar proveedor</title>
</head>
<body>

</body>
</html>