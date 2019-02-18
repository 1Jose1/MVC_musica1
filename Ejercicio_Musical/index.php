<?php
	
	//Las variebles de sesion se pueden ver gracias a esto
	session_start();
	
	//Comprobamos si la Sesion estaba abierta
	if(isset($_SESSION['id'])){
		header("Location: views/menu.php");
	}

?>
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
				flex-direction:row;
				flex-wrap:wrap;				
				justify-content:center;
				align-items:center;					
			}
			#inicio div p,#inicio div input{				
				width:40%;				
			}
			
		</style>		
	</head>
	<body>
		<div id="inicio">
			<form action="/controllers/controlador.php" method="post">
				<h2>Login</h2>
				<div>
					<p>Correo: </p><input type="text" name="correo">
					<p>Contrasena: </p><input type="password" name="contrasena">
					<input type="submit" name="comprobacion" value="Enviar">
				</div>
			</form>
		</div>
	</body>
</html>

