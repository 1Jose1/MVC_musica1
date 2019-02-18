<?php
	
	
	//Inserta la Factura en la base de datos
	//Le pasamos la conexion y el id del cliente
	//Nos retorna el id de la factura (que usaremos para las lineas de factura)
	function insertarFactura($conexionMySQL,$idCliente){
        //Nos retorna el max del id para asignar un id de Factura correcto
		$idInvoice=idMaxInvoice($conexionMySQL);
		$respuesta=mysqli_query($conexionMySQL,"INSERT INTO Invoice (InvoiceId, CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total) VALUES(".$idInvoice.", ".$idCliente.", CURDATE(), 'null', 'null', 'null', 'null', 'null', 0)");
         
		if($respuesta==true){
			echo "Se ha insertado correctamente.";			
		}else{
            trigger_error("Error al insertar el pedido.");
            die();
        }
		return $idInvoice;
	}


	//Nos develve el ultimo id de factura +1
	//Le pasamos la conexion SQL
	//Nos retorna el numero de factura que vamos a usar
	function idMaxInvoice($conexionMySQL) {        
        $respuesta = mysqli_query($conexionMySQL,"SELECT MAX(InvoiceId) FROM Invoice;");
        $respuesta = mysqli_fetch_assoc($respuesta);
        $idInvoice = $respuesta['MAX(InvoiceId)'];

        return $idInvoice+1;
   }



?>