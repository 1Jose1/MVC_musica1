<?php
	//Inserta las lineas de factura en la base de datos
	//Le pasamos la conexion sql, el id de la factura y un array con los id de los track
	//No nos retorna nada
	function insertarLineasFactura($conexionMySQL,$invoiceId,$arrayProductos){			
		for($i=0;$i<count($arrayProductos);$i++){
				//Sacamos el InvoiceId
				$idInvoiceLine = idMaxInvoiceLine($conexionMySQL);
				//Sacamos el Precio de la Unidad
				$precio=sacamosPrecioTrack($conexionMySQL,$arrayProductos[$i]);
				//Insertamos
				$respuesta=mysqli_query($conexionMySQL,"INSERT INTO InvoiceLine (InvoiceLineId, InvoiceId, TrackId, UnitPrice, Quantity) VALUES(".$idInvoiceLine.", ".$invoiceId.", ".$arrayProductos[$i].", ".$precio.", 1);");
				if ($respuesta==true) {
					echo "Se ha insertado correctamente.";
				}else {
					trigger_error("Error al insertar los productos en el pedido.");
					die();
				}
		}
	}       
	
	//Funcion que devuelve el IdLine maximo + uno para usarlo en las insercciones
	//Le pasamos la conexion sql
	//Nos retorna el idLine
	function idMaxInvoiceLine($conexionMySQL) {
        $respuesta = mysqli_query($conexionMySQL,"SELECT MAX(InvoiceLineId) FROM InvoiceLine;");
        $respuesta = mysqli_fetch_assoc($respuesta);
        $idInvoiceLine = $respuesta['MAX(InvoiceLineId)'];

        return $idInvoiceLine+1;
    }
	
	//Funcion que nos retorna el precio de un track
	//Le pasamos el Id del track y la conexion sql
	//Nos retorna el precio de ese track
	function sacamosPrecioTrack($conexionMySQL,$idTrack){
		$precio=mysqli_query($conexionMySQL,"SELECT UnitPrice FROM Track WHERE TrackId = ".$idTrack.";");
		$precio = mysqli_fetch_assoc($precio);
		return $precio['UnitPrice'];
	}
   
   






?>