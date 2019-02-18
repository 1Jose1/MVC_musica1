<html>
	<head>	
		<style type="text/css">
			*{
				margin:0;
				padding:0;
			}
			
			#inicio{
				width:350px;
				margin:2% auto;
				height:150px;
				background-color:white;
				border:1px solid black;
				text-align:center;
			}
			#inicio h2{
				background-color:black;
				height:30px;
				color:white;
				font-style:italic;
			}
			#inicio div{
				width:100%;
				height:120px;
				display:flex;				
				flex-direction:column;
				flex-wrap:no-wrap;				
				justify-content:space-around;
				align-items:center;				
			}
			#inicio div a,#inicio div input{				
				width:60%;				
			}
			
		</style>		
	</head>
	<body>
		<div id="inicio">
			<form action="" method="post">
				<?php
					session_start();						
					echo "<h2>Hola ".$_SESSION['nombre']."</h2>";
				 ?>	
				<div>
				
					<select name="musica">
						<?php
							include_once("../models/IniciarConexion.php");
							include_once("../models/CierreConexion.php");
							
							$conexionMySQL=iniciarConexion();						
							
							$opciones=mysqli_query($conexionMySQL,"select Name,TrackId from Track limit 50");
							
							while($fila=mysqli_fetch_assoc($opciones)){
								echo "<option value=".$fila['TrackId'].">".$fila['Name']."</option>";
							}
							
							cierreConexion($conexionMySQL);						 
						?>	
							
					</select>
					
					<input type="submit" name="anadirCarro" value="Anadir Carrito">
					<input type="submit" name="limpiar" value="Limpiar Carro">
					<input type="submit" name="comprar" value="Comprar">

					
					<a href='menu.php'>Volver</a>	
					
				</div>
			</form>
		</div>
	</body>
</html>

<?php
	include_once("../controllers/Controlador.php");
	
	
	if(isset($_REQUEST['anadirCarro'])){	
		anadirCarrito($_REQUEST['musica']);
	}else if(isset($_REQUEST['limpiar'])){
		limpiarCarro();
	}else if(isset($_REQUEST['comprar'])){
		comprar();
	}
	
	
	
	//Array de productos de este usuario
	$arrayProductos=compruebaLaExistenciaCookie();
	var_dump($arrayProductos);
	




?>