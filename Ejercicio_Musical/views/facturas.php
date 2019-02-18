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
				height:180px;
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
				height:250x;
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
			<form action="facturasFecha.php" method="post">
				<?php
					session_start();						
					echo "<h2>Hola ".$_SESSION['nombre']."</h2>";
				?>				
				<div>
					
					<div><label>Fecha 1</label><input type="text" name="fecha1"></div>
					<div><label>Fecha 2</label><input type="text" name="fecha2"></div>
					<br>			
					<input type="submit" name="facturasFechas" value="Mostras Facturas">
					
					<a href='menu.php'>Volver</a>	
				</div>
			</form>
		</div>
	</body>
</html>


<?php


?>
