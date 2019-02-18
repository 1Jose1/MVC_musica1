<?php

// Iniciar Conexion con la Base de Datos
	function iniciarConexion(){		
		// Parametros para la Base de Datos
		$servername="localhost";
		$usuario="root";
		$contrasena="rootroot";
		$baseDatos="musica";
				
		$conexionMySQL=mysqli_connect($servername,$usuario,$contrasena,$baseDatos);		
		return $conexionMySQL;
	}	

?>
