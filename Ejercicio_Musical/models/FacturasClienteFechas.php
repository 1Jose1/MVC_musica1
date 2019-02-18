<?php


//Metodo que nos muestra las facturas de un cliente
//Le pasamos la conexion y el Id del cliente
//No nos retorna, nos muestra
function facturasClienteFecha($conexionMySQL,$id,$fecha1,$fecha2){
	$respuesta=mysqli_query($conexionMySQL,"select InvoiceId,InvoiceDate,CustomerId from Invoice where CustomerId = ".$id." and CAST(InvoiceDate AS DATE) > '".$fecha1."' and CAST(InvoiceDate AS DATE) < '".$fecha2."';");
	
	
	while($fila=mysqli_fetch_assoc($respuesta)){	
	echo "<center><table border='1'>
			<tr>
				<td>InvoiceId</td>
				<td>InvoiceDate</td>
				<td>CustomerId</td>				
			</tr>
			<tr>
				<td>".$fila['InvoiceId']."</td>
				<td>".$fila['InvoiceDate']."</td>
				<td>".$fila['CustomerId']."</td>				
			</tr>
			</table><center><br>";
		//Metodo que mostrara los productos dentro de cada factura
		lineaAlinea($conexionMySQL,$fila['InvoiceId']);
	}
	
	
	
}

//Metodo que mostrara los productos dentro de cada factura
//Le pasamos la conexion y el id dela factura
//No nos retorna, nos muestra
function lineaAlineaFecha($conexionMySQL,$idLine){
	$respuesta=mysqli_query($conexionMySQL,"select InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity
											from InvoiceLine
											where InvoiceId = ".$idLine.";");
	echo "<center><table border='1'>
			<tr>
				<td>Id Producto</td>
				<td>Id Pedido</td>
				<td>Track</td>
				<td>Precio Unidad</td>
				<td>Cantidad</td>
			</tr>";
	while($fila=mysqli_fetch_assoc($respuesta)){
	echo "<tr>
				<td>".$fila['InvoiceLineId']."</td>
				<td>".$fila['InvoiceId']."</td>
				<td>".$fila['TrackId']."</td>
				<td>".$fila['UnitPrice']."</td>
				<td>".$fila['Quantity']."</td>
			</tr>";
	}
	echo "</table></center><br>";
}


?>