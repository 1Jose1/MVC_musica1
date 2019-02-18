<?php	

	//Agregamos los includes
		include_once("../models/IniciarConexion.php");
		include_once("../models/CierreConexion.php");
		include_once("../models/BusquedaCliente.php");
		include_once("../models/FacturasCliente.php");	
		include_once("../models/FacturasClienteFechas.php");	
		include_once("../models/InsertarFactura.php");	
		include_once("../models/InsertarLineasFactura.php");	

	//Controlador
	if(isset($_REQUEST['comprobacion'])){
		include_once("controllers/Controlador.php");	
		comprobacionCliente(trim($_REQUEST['correo']),trim($_REQUEST['contrasena']));
	}else if(isset($_REQUEST['cerrar'])){
		destruirSesion();
		header("Location: ../index.php");
	}	
	
	
	
	
	//Comroubea que el cliente existe
	//Recibe el correo y la password
	//No retorna pero confirma la existencia del empleado y almacena sus sesiones	
	function comprobacionCliente($correo,$password){		
		//Abrimos la conexionMySQL
		$conexionMySQL=iniciarConexion();
		
		//Busqueda del empleado
		$cliente=buscarCliente($conexionMySQL,$correo,$password);
		if(count($cliente)==2){
			guardarSesion($cliente[0],$cliente[1]);
			header("Location: ../views/menu.php");
		}else{
			trigger_error("Cliente no existe");
			die();
		}
		
		//Cierre de Conexion
		cierreConexion($conexionMySQL);		
	}
	
	
	//Guardamos Variables de Sesion
	function guardarSesion($id,$nombre){
		session_start();		
		$_SESSION['id']=$id;
		$_SESSION['nombre']=$nombre;
	}
	
	//Destruimos la Sesion
	function destruirSesion(){
		session_start();
		session_destroy();
	}

	//Esta funcion mostrara las Facturar del Cliente
	//No le pasamos nada porque ya lo tenemos almacenado en las sesiones
	//Nos retornara una vista de tablas con la informacion que venimos buscando
	function mostrarFacturas(){
		//Abrimos la conexionMySQL
		$conexionMySQL=iniciarConexion();
		
		//Abrimos la sesion 
		session_start();		
		
		//Nos mostrara las facturas detalladamente
		facturasCliente($conexionMySQL,$_SESSION['id']);
		
		//Cierre de Conexion
		cierreConexion($conexionMySQL);	
	}
	
	//Esta funcion mostrara las Facturar del Cliente entre dos Fechas
	//Le pasamos las 2 fechas y no es necesario ningun id porque ya contamos con el en las sesiones
	//Nos retornara una vista de tablas con la informacion que venimos buscando
	function mostrarFacturasEntreFechas($fecha1,$fecha2){
		//Abrimos la conexionMySQL
		$conexionMySQL=iniciarConexion();
		
		//Abrimos la sesion 
		session_start();		
		
		//Nos mostrara las facturas detalladamente
		facturasClienteFecha($conexionMySQL,$_SESSION['id'],$fecha1,$fecha2);
		
		//Cierre de Conexion
		cierreConexion($conexionMySQL);	
	}
	
	
	
	// set_error_handler("errores");
	
	//Errores
	function errores($error_level,$error_message){
			echo "<div style='border:6px double red;width:60%;margin:5% 20% 5% 20%;'>Codigo: ".$error_level." /",$error_message."</div>";
			echo '<center><a href="../index.html">Atras</a></center>';
			die();			
	}
	
	//Metodo que nos retorna la array del cliete con sus productos
	//No le enviamos nada porque tenemos la sesion
	//Nos retornara el array
	function compruebaLaExistenciaCookie(){
		$arrayProductos=array();
		if(isset($_COOKIE[$_SESSION['id']])){
			$arrayProductos=unserialize($_COOKIE[$_SESSION['id']]);
		}else{			
			setcookie($_SESSION['id'],serialize($arrayProductos));
		}
		return $arrayProductos;
	}
	
	
	//Metodo que introduce en el carrito si es repetrido no lo suma
	//Le enviamos el nombre de la cancion
	//No nos retorna nada ,solo actualiza las cookies
	function anadirCarrito($musicaId){
		$arrayProductos=compruebaLaExistenciaCookie();
		$repetido=false;
		for($i=0;$i<count($arrayProductos);$i++){
			if($arrayProductos[$i]==$musicaId){
				$repetido=true;
			}
		}		
		if($repetido==false){			
			array_push($arrayProductos,$musicaId);		
			setcookie($_SESSION['id'],serialize($arrayProductos));
		}	
		header("Location: ../views/downmusic.php");
	}
	
	
	//Funcion que limpia el carrito 
	//No le enviamos nada ya que solo necesitamos del id de sesion
	//No nos retorna nada
	function limpiarCarro(){		
		setcookie($_SESSION['id'],"borrar", time()-9999);	
		header("Location: ../views/downmusic.php");
	}
	
	//Funcion que añadira los productos a la base de datos y nos limpia el carro	
	//No le enviamos nada por que solo requerimos de las cookies
	//No nos retorna nada	
	function comprar(){
		$arrayProductos=compruebaLaExistenciaCookie();
		if(count($arrayProductos)>0){
			//Abrimos la conexionMySQL
			$conexionMySQL=iniciarConexion();
			
			//Funcion de modelo que insrta la factura y retorna el id de la facutura
			$invoiceId=insertarFactura($conexionMySQL,$_SESSION['id']);
			//Funcion que inserta las lineas de la factura
			insertarLineasFactura($conexionMySQL,$invoiceId,$arrayProductos);
			
			//Cierre de Conexion
			cierreConexion($conexionMySQL);	
		}
		limpiarCarro();
	}
	
	
?>