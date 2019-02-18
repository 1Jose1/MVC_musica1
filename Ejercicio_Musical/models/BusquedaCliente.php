<?php	
	
	//Esta funcion busca al Empleado y comprueba su existencia, si no es que no existe
	//Le pasamos el Correo y la Contraseña
	//Nos da un Array con el CustomerId y el nombre si no lo encuentra la longitud del arraysera 0
	function buscarCliente($conexionMySQL,$correo,$password){		
		//Array donde se almacenaran los datos
		$datos=[];		
		
		$respuesta=mysqli_query($conexionMySQL,"select FirstName,CustomerId,LastName,Email from Customer where LastName='".$password."' and Email='".$correo."';");
					
		if(mysqli_num_rows($respuesta)==1){
			$respuesta=mysqli_fetch_assoc($respuesta);
			//Introducimos los Datos
			array_push($datos,$respuesta['CustomerId']);
			array_push($datos,$respuesta['FirstName']);
		}		
			
		return $datos;
	}

?>
