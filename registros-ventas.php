<!DOCTYPE html>
<?php  
	session_start(); 
	$mysqli=new mysqli("localhost","root","","registro_tienda"); 
	if (isset($_SESSION['id_usuario'])) {
		include './cabecera.php';
?>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./css/libreria.css">
	<link rel="icon" type="image/png" href="./img/icono.png"/>
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1,width=device-width, height=device-height, target-densitydpi=device-dpi" />	
	<meta name="theme-color" content="#F7AF1D" />
	<title>ABARROTES MARTÍNEZ Y SANCHEZ.</title>
	<script src="./js/inicio.js"></script>
	<script src="./js/tablas.js"></script>
</head>
<body onresize="Ajustar(0)" onload="Ajustar(1);">
	<div>
		<div class="titulo">
			<a href="./registros-ventas.php"><img src="./img/icono2.png"></a> 
			ABARROTES MARTÍNEZ Y SANCHEZ.
			<a id="salir" href="./logout.php" title="Cerrar sesión" onclick="alert( <?php echo "'¡Adios ".$_SESSION['Name']."!'"; ?>  )">SALIR</a>
		</div>
		<div  class="menu-fijo">
			<nav class="header">
				<ul class="nav">
					<li onclick="Tablas(0)">Compras</li>
					<li onclick="Tablas(1)">Ventas <b onclick="Mostras_opciones()">⇨</b></li>
					<li onclick="Tablas(2)">Ventas por Mes</li>
					<li onclick="Tablas(3)">Ventas por Día</li>
					<li onclick="Tablas(4)">Ventas por Cliente</li>
					<li onclick="Tablas(5)">Existencia</li>
					<li onclick="Tablas(6)">Clientes</li>
					<li onclick="Tablas(7)">Proveedores</li>
				</ul>
			</nav>
		</div>	
	</div>
	<div>
		<div class="tb" name="Compra">
			<h2>COMPRAS.</h2>
			<section>
			<b>Insertar</b>
			<br>
			<form name="añadir-compra" onsubmit="return tb1(Producto.value,Precio.value,Cantidad.value,Proveedor.value,Fecha.value)" method="post" action="./consulta_1.php">
				Producto: <input type="text" name="Producto" value="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
				Precio: <input type="number" min="0" name="Precio">
				Cantidad: <input type="number" min="0" name="Cantidad">
				Proveedor: <select name="Proveedor">
								<option value=''></option>
								<?php 
								for ($i=0; $i <$conteo1 ; $i++) { 
									echo "<option value='".$N_Proveedor[$i]."'>".$V_Proveedor[$i]."</option>";
								}
								?>
							</select> 
				Fecha: <input type="date" name="Fecha"  value="<?php echo date("Y-m-d");?>">
				<button type="submit" name="Enviar_1">Enviar</button></PRE>
			</form>	
			</section>
			<br>
			<table>
				<th>Producto</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Precio total</th>
				<th>Proveedor</th>
				<th>Fecha</th>
				<?php 
				for ($i=0; $i <$conteo2 ; $i++) { 
					echo "<tr>";
					echo "<td>$tb1_Producto[$i]</td>";
					echo "<td>$"."$tb1_Precio[$i]</td>";
					echo "<td>$tb1_Cantidad[$i]</td>";
					echo "<td>$"."$tb1_Precio_total[$i]</td>";
					for ($j=0; $j <$conteo1 ; $j++) {
						if ($N_Proveedor[$j]==$tb1_idprov[$i]) {
							echo "<td>$V_Proveedor[$j]</td>";
							
						}
						
					}
					echo "<td>$tb1_Fecha[$i]</td>";
				}
				?>
			</table>
			<br>
		</div>
		<div class="tb" name="Venta">
			<h2>VENTAS.</h2>
			<section>
			<b>Insertar</b>
			<form name="añadir-venta" onsubmit="return tb1(Producto.value,Precio.value,Cantidad.value,Cliente.value,Fecha.value)" method="post" action="./consulta_2.php">
				Producto: 	<select name="Producto">
								<option value=''></option>
								<?php 
								for ($i=0; $i <$conteo5 ; $i++) { 
									echo "<option value='".$tb6_id[$i]."'>".$tb6_Producto[$i]."</option>";
								}
								?>
							</select>	
				Precio: <input type="number" min="0" name="Precio">
				Cantidad: <input type="number" min="0" name="Cantidad">
				Cliente: <select name="Cliente">
								<option value=''></option>
								<?php 
								for ($i=0; $i <$conteo3 ; $i++) { 
									echo "<option value='".$N_Cliente[$i]."'>".$V_Cliente[$i]."</option>";
								}
								?>
							</select>
				Fecha: <input type="date" name="Fecha"  value="<?php echo date("Y-m-d");?>">
				<button type="submit" name="Enviar_2">Enviar</button>
			</form>	
			</section>
			<br>
			<table>
				<th>Producto</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Precio total</th>
				<th>Cliente</th>
				<th>Fecha</th>
				<?php 
				for ($i=0; $i <$conteo4 ; $i++) { 
					echo "<tr>";
					for ($j=0; $j <$conteo5 ; $j++) { 
						if ($tb6_id[$j]==$tb2_Producto[$i]) {
							echo "<td>$tb6_Producto[$j]</td>";
						}	
					}	
					echo "<td>$"."$tb2_Precio[$i]</td>";
					echo "<td>$tb2_Cantidad[$i]</td>";
					echo "<td>$"."$tb2_Precio_total[$i]</td>";
					for ($j=0; $j <$conteo3 ; $j++) { 
						if ($N_Cliente[$j]==$tb2_idcliente[$i]) {
							echo "<td>$V_Cliente[$j]</td>";
						}	
					}
					echo "<td>$tb2_Fecha[$i]</td>";
				}
				?>
			</table>
			<br>
		</div>
		<div class="tb" name="Venta-mes">

			<h2>VENTAS POR MES.</h2>
			<section>
			<b>Consultar</b>
			<form name="consulta-venta-mes" onsubmit="return tb2(Fecha.value)" method="post" action="./registros-ventas.php">
				Mes: <input type="month" name="Fecha">
				<button type="submit" name="venta_1">Enviar</button>
			</form>	
			</section>
			<br>
			<?php 
			if (isset($_POST['venta_1'])) {
				echo "<script>Tablas(2)</script>";
			?>
			<table>
				<th>Producto</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Precio total</th>
				<th>Cliente</th>
				<th>Fecha</th>
				
			<?php 
				$x=1;
				while ($x <= 31) {
					include './consulta_3.php';
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
						for ($j=0; $j <$conteo3 ; $j++) { 
							if ($N_Cliente[$j]==$tb5_idcliente[$i]) {
								echo "<td>$V_Cliente[$j]</td>";
							}	
						}
						echo "<td>$tb5_Fecha[$i]</td>";
					}
				$x++;	
				}
			}
			?>
			</table>	
			<br>
		</div>
		<div class="tb" name="venta-dia">
			<h2>VENTAS POR DÍA.</h2>
			<section>
			<b>Consultar</b>
			<form name="consulta-venta-dia" onsubmit="return tb2(Fecha.value)" method="post" action="./registros-ventas.php">
				Fecha: <input type="date" name="Fecha"  value="<?php echo date("Y-m-d");?>">
				<button type="submit" name="venta_2">Enviar</button>
			</form>	
			</section>
			<br>
			<?php 
			if (isset($_POST['venta_2'])) {
				echo "<script>Tablas(3)</script>";
				include './consulta_4.php';
			?>
			<table>
				<th>Producto</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Precio total</th>
				<th>Cliente</th>
				<th>Fecha</th>
				
			<?php 
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
					for ($j=0; $j <$conteo3 ; $j++) { 
						if ($N_Cliente[$j]==$tb5_idcliente[$i]) {
							echo "<td>$V_Cliente[$j]</td>";
						}	
					}
					echo "<td>$tb5_Fecha[$i]</td>";
				}
			}
			?>
			</table>	
			<br>
		</div>
		<div class="tb" name="venta-cliente">
			<h2>VENTAS POR CLIENTE.</h2>
			<section>
			<b>Consultar</b>
			<form name="consulta-venta-cliente"  onsubmit="return tb2(Cliente.value)" method="post" action="./registros-ventas.php">
				Cliente: <select name="Cliente">
								<option value=''></option>
								<?php 
								for ($i=0; $i <$conteo3 ; $i++) { 
									echo "<option value='".$N_Cliente[$i]."'>".$V_Cliente[$i]."</option>";
								}
								?>
							</select>
				<button type="submit" name="venta_3">Enviar</button>
			</form>	
			</section>
			<br>
			<?php 
			if (isset($_POST['venta_3'])) {
				echo "<script>Tablas(4)</script>";
				include './consulta_5.php';
			?>
			<table>
				<th>Producto</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Precio total</th>
				<th>Cliente</th>
				<th>Fecha</th>
				
			<?php 
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
					for ($j=0; $j <$conteo3 ; $j++) { 
						if ($N_Cliente[$j]==$tb5_idcliente[$i]) {
							echo "<td>$V_Cliente[$j]</td>";
						}	
					}
					echo "<td>$tb5_Fecha[$i]</td>";
				}
			}
			?>
			</table>	
			<br>
		</div>
		<div class="tb" name="existencia">
			<h2>EXISTENCIAS.</h2>
			<br>
			<table>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>Proveedor</th>
				<?php 
					for ($i=0; $i <$conteo5 ; $i++) { 
					echo "<tr>";
					echo "<td>".$tb6_Producto[$i]."</td>";
					echo "<td>".$tb6_Cantidad[$i]." unidades</td>";
					for ($j=0; $j <$conteo1 ; $j++) { 
						if ($N_Proveedor[$j]==$tb6_Proveedor[$i]) {
							echo "<td>".$V_Proveedor[$j]."</td>";
						}
						
					}
					
				}



				?> 
			</table>
			<br>
		</div>
		<div class="tb" name="Cliente">
			<h2>CLIENTES.</h2>
			<section style="border-radius: 8px;">
				<b>Insertar</b>
				<form name="insertar-cliente"  onsubmit="return tb2(Cliente.value)" method="post" action="./consulta_6.php">
					Nombre: <input type="text" name="Cliente" value="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
					<button type="submit" name="Enviar_6">Enviar</button>
				</form>
			</section>
			<section style="border-radius: 8px;">
				<b>Consultar</b>
				<form name="insertar-cliente"  onsubmit="return tb2(Cliente.value)" method="post" action="./recibo.php">
					Nombre: <select name="Cliente">
								<option value=''></option>
								<?php 
								for ($i=0; $i <$conteo3 ; $i++) { 
									echo "<option value='".$N_Cliente[$i]."'>".$V_Cliente[$i]."</option>";
								}
								?>
							</select>
					<button type="submit" name="Enviar_6">Enviar</button>
				</form>
			</section>
			<br>
			
			<br>
		</div>
		<div class="tb" name="Proveedores">
			<h2>PROVEEDORES.</h2>
			<section>
			<b>Insertar</b>
			<form name="Proveedores" onsubmit="return tb2(Proveedor.value)" method="post" action="./consulta_9.php">
				
				Proveedor: <input type="text" min="0" name="Proveedor" value="" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
				<button type="submit" name="Enviar_9">Enviar</button>
			</form>	
			</section>
			<br>
			<table>
				
				<th>Proveedor</th>
				<th width="10%">Cantidad de compras</th>
				<th>Proveedor</th>
				<th width="10%">Cantidad de compras</th>
				<?php 
				$i=0;
				while ($i <$conteo1) {
					echo "<tr>";
					echo "<td width='10%''>";
					echo $V_Proveedor[$i];
					echo "</td>";
					echo "<td>";
					echo $Num_Compras[$i];
					echo "</td>";
					$j=$i+1;
					if (isset($V_Proveedor[$j])) {
						echo "<td width='10%'>";
						echo $V_Proveedor[$j];
						echo "</td>";
						echo "<td>";
						echo $Num_Compras[$j];
						echo "</td>";
					}
					else{
						echo "<td width='10%'>";
						echo "</td>";
						echo "<td>";
						echo "</td>";
					}
					
					$i=$j+1;
				}
				


				?>
			</table>
			<br>
		</div>
	</div>
	<br>
</body>
</html>
<?php  
	}
	else{
		header("location: ./index.php");
	}
	/*  
	TABLAS

	CREATE TABLE registro_tienda.tbclientes( ID int(11) NOT NULL AUTO_INCREMENT, Nombre varchar(50) NOT NULL, PRIMARY KEY (ID) )ENGINE=InnoDB DEFAULT CHARSET=latin1
	
	CREATE TABLE registro_tienda.tbcompras( ID int(11) NOT NULL AUTO_INCREMENT, IDproveedor int(11) DEFAULT NULL, Producto varchar(50) DEFAULT NULL, Precio float DEFAULT NULL, Cantidad int(11) DEFAULT NULL, Precio_total float DEFAULT NULL, Fecha date DEFAULT NULL, PRIMARY KEY (ID) )ENGINE=InnoDB DEFAULT CHARSET=latin1
	
	CREATE TABLE registro_tienda.tbproductos( ID int(11) NOT NULL AUTO_INCREMENT, Producto varchar(50) NOT NULL, Cantidad int(11) NOT NULL, IDproveedor int(11) NOT NULL, PRIMARY KEY (ID) )ENGINE=InnoDB DEFAULT CHARSET=latin1
	
	CREATE TABLE registro_tienda.tbproveedores( ID int(11) NOT NULL AUTO_INCREMENT, Proveedor varchar(50) NOT NULL, Num_Compras int(11) NOT NULL, PRIMARY KEY (ID) ) ENGINE=InnoDB DEFAULT CHARSET=latin1

	CREATE TABLE registro_tienda.tbusers ( IDUser int(11) NOT NULL AUTO_INCREMENT, Name varchar(100) DEFAULT NULL, Email varchar(50) DEFAULT NULL, Cel varchar(20) DEFAULT NULL, Pass varchar(50) DEFAULT NULL, PRIMARY KEY (IDUser) ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	CREATE TABLE registro_tienda.tbventas( ID int(11) NOT NULL AUTO_INCREMENT, IDcliente int(11) NOT NULL, IDProducto int(11) NOT NULL, Precio float NOT NULL, Cantidad int(11) NOT NULL, Precio_total float NOT NULL, Fecha date NOT NULL, PRIMARY KEY (ID) )ENGINE=InnoDB DEFAULT CHARSET=latin1;



	INSERT INTO registro_tienda.tbclientes(ID, Nombre) VALUES (1, 'RAUL PEREZ'), (2, 'SARA LOPEZ'); 

	INSERT INTO registro_tienda.tbcompras (ID, IDproveedor, Producto, Precio, Cantidad, Precio_total, Fecha) VALUES (1, 1, 'PAN BLANCO', 22, 20, 440, '2017-03-01'), (2, 1, 'PAN INTEGRAL', 24, 18, 432, '2017-03-01'), (3, 1, 'MEDIAS NOCHES', 18, 10, 180, '2017-03-01'), (4, 1, 'PAN TOSTADO', 25, 12, 300, '2017-03-01');

	INSERT INTO registro_tienda.tbproductos (ID, Producto, Cantidad, IDproveedor) VALUES (1, 'PAN BLANCO', 16, 1), (2, 'PAN INTEGRAL', 18, 1), (3, 'MEDIAS NOCHES', 6, 1), (4, 'PAN TOSTADO', 10, 1); 

	INSERT INTO registro_tienda.tbproveedores (ID, Proveedor, Num_Compras) VALUES (1, 'BIMBO', 4), (2, 'GAMESA', 0), (3, 'BARCEL', 0), (4, 'SABRITAS', 0), (5, 'LALA', 0); 

	INSERT INTO registro_tienda.tbusers (IDUser, Name, Email, Cel, Pass) VALUES (1, 'Eduardo MartÃ­nez', 'atorre2012@gmail.com', '2253568789', 'eduleo'), (2, 'Admin', 'admin@localhost.com', '0000000000', 'admin'); 

	INSERT INTO registro_tienda.tbventas (ID, IDcliente, IDProducto, Precio, Cantidad, Precio_total, Fecha) VALUES (1, 1, 1, 26, 4, 104, '2017-03-11'), (2, 2, 4, 28, 2, 56, '2017-03-11'), (3, 1, 3, 25, 2, 50, '2017-03-12'), (4, 2, 3, 25, 2, 50, '2017-02-28');

	*/
		
?>


