
<!DOCTYPE html>
<?php  
	session_start(); 
	$mysqli=new mysqli("localhost","root","","registro_tienda"); 
	include './cabecera.php';
	include './consulta_5.php';
	if (isset($_SESSION['id_usuario'])) {
		
		$Cliente=$_POST['Cliente'];
		$sql = "SELECT ID , Nombre FROM tbclientes WHERE ID = '$Cliente'";
		$result=$mysqli->query($sql);
		$row = $result->fetch_assoc();
		$V_Cliente = $row['Nombre'];

		
?>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/libreria.css">
	<link rel="icon" type="image/png" href="./img/icono.png"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="theme-color" content="#F7AF1D" />
	<title>ABARROTES MARTÍNEZ Y SANCHEZ.</title>
	<script src="./js/inicio.js"></script>
	<script src="./js/tablas.js"></script>
</head>
<body>
	<div align="center">
	<?php 		
	$total_final=0;				
	echo "<h1>RECIBO DE VENTAS DE $V_Cliente</h1>";
	echo '<TABLE bgcolor="white">';
		echo '<th colspan=5><h3>ABARROTES MARTÍNEZ Y SANCHEZ.</h3></th>';
		echo '<tr>';
		echo'<th colspan=5>Cliente: '.$V_Cliente.'</th>';
		echo "<tr>";
		echo "<th>Producto</th>";
		echo "<th>Precio</th>";
		echo "<th>Cantidad</th>";
		echo "<th>Precio Total</th>";
		echo "<th>Fecha</th>";
		for ($i=0; $i <$conteovd ; $i++) { 
			echo "<tr>";
			for ($j=0; $j <$conteo5 ; $j++) { 
				if ($tb6_id[$j]==$tb5_Producto[$i]) {
					echo "<td>$tb6_Producto[$j]</td>";
				}	
			}	
			echo "<td>$"."$tb5_Precio[$i]</td>";
			echo "<td>$tb5_Cantidad[$i]</td>";
			echo "<td>$"."$tb5_Precio_total[$i]</td>";
			echo "<td>$tb5_Fecha[$i]</td>";
			$total_final=$total_final+$tb5_Precio_total[$i];
		}
			
			


		echo "<tr>";
		echo "<th>Precio total</th>";
		echo "<th colspan=2>$".$total_final."</th>";
	echo '</TABLE>';

		?>
	<br>	
	<a href="./index.php">REGRESAR</a>
	</div>
</body>
</html>
<?php  
	}
	else{
		header("location: ./index.php");
	}
	

?>


