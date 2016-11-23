<html>
	<style>
		table {
			border-collapse: collapse;
		}
		td {
			border: 1px solid black;
			width: 50px;
			text-align: center;
		}
		th{
			padding: 5px;
		}
	</style>
	<head>
		<title>Metodo Simplex</title>
	</head>
	<body>	
		<?php
			include("calcula.php");
			$calcula = new simplex();
			$linha1 = $_POST["l1"];
			$linha2 = $_POST["l2"];
			$linha3 = $_POST["l3"];
			$linha4 = $_POST["l4"];
			$calcula->iniciar($linha1, $linha2, $linha3, $linha4);
		?>
	</body>
</html>