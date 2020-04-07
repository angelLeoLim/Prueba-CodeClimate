<?php 
	$Fecha=$_POST['Fecha'];
	if ($x<10) {
		$Fecha=$Fecha."-0".$x;
	}
	else{
		$Fecha=$Fecha."-".$x;
	}
	$sql = "SELECT ID  FROM tbventas";
	$result=$mysqli->query($sql);
	$rows = $result->num_rows;
	$sql = "SELECT ID , IDcliente, IDproducto, Precio, Cantidad, Precio_total, Fecha FROM tbventas WHERE Fecha = '$Fecha' ";
	$result=$mysqli->query($sql);
	$rowsb = $result->num_rows;
	for ($i=0; $i<$rows ; $i++){ 
		$y=$i+1;
		$row = $result->fetch_assoc();
		$tb5_id[$i]=$row['ID'];
		$tb5_idcliente[$i]=$row['IDcliente'];
		$tb5_Producto[$i]=$row['IDproducto'];
		$tb5_Precio[$i]=$row['Precio'];
		$tb5_Cantidad[$i]=$row['Cantidad'];
		$tb5_Precio_total[$i]=$row['Precio_total'];	
		$tb5_Fecha[$i]=$row['Fecha'];

	}
	$conteovd=$rowsb;
?>