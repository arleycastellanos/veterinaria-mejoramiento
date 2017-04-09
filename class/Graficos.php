<?php 
	class Graficos
	{

		function estilos($carpeta=null)
			{
				$salida="";

				$salida=" <link rel='stylesheet'  type='text/css' href='$carpeta/css/bootstrap.css'>
						 <script src='$carpeta/js/jquerymin.js'></script>
						 <script src='$carpeta/js/bootstrap.min.js'></script>";
				return $salida;		 
			}
			function imagen()
			{
			
				$salida="<img class='img img-responsive' src='img/Captura.png'>";
				
			}


		
		
	}




 ?>