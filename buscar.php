<html ng-app="acumuladorApp">
	<head> 

		<title>buscador</title>
			<?php
				include ('class/BD.php');
				/*Se nombra una variable para crear un nuevo objeto*/
				$obj_o= new BD;
				/* trae la función estilos de bootstrap de la clase */
				echo $obj_o->estilos("bootstrap"); 
			?>
			<script type="text/javascript" src="js/angular.min.js"></script>
			<script type="text/javascript" src="js/nuevo.js"></script>
	</head>

	<body>
		<div ng-controller="acumuladorAppCtrl"><!--Super importante el controlador aquí-->
			<div class='container' >
			  	<br>
			  	<a href="index.php"><button class="btn btn-success">VOLVER</button></a>

		  		<div class='row'>
			  		<div class='col-xs-12 col-md-4 '>
			  		<label><h2>Buscar en manual tecnico angular js</h2></label>
						<input type="text" class="form-control" ng-model="text_busqueda" ng-change="buscar();" placeholder="buscador"> 
						<br>
						<br>
					</div>
				</div>
				<hr>
				<div ng-repeat="x in campos">
					
						   	<img class="img img-responsive" src="{{ x.Imagen }}">
					    </div>
			    	</div>
			    	<br><hr>
				</div>			    
			</div>
		</div>
	</body>
</html>
