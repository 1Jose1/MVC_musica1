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
				height:120px;
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
				height:90px;
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
			<form action="../controllers/Controlador.php" method="post">
				<?php
					session_start();						
					echo "<h2>Hola ".$_SESSION['nombre']."</h2>";
				?>				
				<div>
					<a href="downmusic.php">Comprar Musicas</a>
					<a href="histfacturas.php">Historial Compras</a>
					<a href="facturas.php">Facturas entre Fechas</a>
					<input type="submit" name="cerrar" value="Cerrar Sesion">
				</div>
			</form>
		</div>
	</body>
</html>
