<?php

// Iniciar Conexion con la Base de Datos
	function iniciarConexion(){		
		// Parametros para la Base de Datos
		$servername="10.131.98.19";
		$usuario="root";
		$contrasena="rootroot";
		$baseDatos="spotify";
				
		$conexionMySQL=mysqli_connect($servername,$usuario,$contrasena,$baseDatos);		
		return $conexionMySQL;
	}	

?>
