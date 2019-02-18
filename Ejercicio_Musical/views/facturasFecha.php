<?php
	
	echo "<center><a href='menu.php'>Volver</a><center><br>";
	
	include_once("../controllers/Controlador.php");
	
	//Mostramos las facturas en la vista
	mostrarFacturasEntreFechas($_REQUEST['fecha1'],$_REQUEST['fecha2']);



?>