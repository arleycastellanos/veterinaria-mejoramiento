<!--  
* DUBIER PEREZ 
*/
 -->
<!DOCTYPE html>
<html lang="ES" ng-app="acumuladorApp">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<head>
	<title></title>
	<script src="js/angular.min.js"></script>
	<script src="js/mi_js.js"></script>
	
	
	<meta charset="utf-8">
 

	<?php
		include ('class/BD.php'); //trae las funciones de la pagina BD.php
		$nb_m=new BD();	// llama la clase BD
		
	
     
		
		echo $nb_m->estilos("bootstrap"); //trae la función estilos de bootstrap de la clase
		
	?>
	
</head>
<body>
	<div class="container-fluid">
	<div ng-controller="acumuladorAppCtrl">		


		<div class="row">
			<div class="col-xs-12 col-md-3 col-lg-2 ">
				
              	<?php echo $nb_m->imagen();
              	?>
				<center>
				<?php 	
					echo $nb_m->traer_informacion("sintoma","tb_sintomas","id_sintomas","sintoma","get","ver.php"); // trae la información a mostrar.
				?>
                </center>

				  
			</div><br>	
			<div class="col-xs-12 col-md-8 col-lg-8 ">	
			<div ng-repeat="x in campos">
			<img src="img/" class="img-responsive" alt="">
           
		 	
            <table class="table table-inverse table-bordered">
                <thead>
                  <tr class="bg-success">
                    <th>Enfermedades</th>
                    <th>Sintomas</th>
                    <th>Cantidad sintomas</th>
                
                  </tr>
                </thead>
                 <tbody>
                  <tr class="bg-info">
                    <td>{{ x.Enfermedad }}</td>
                    <td>{{ x.conteo_total }}</td>
                    <td>{{ x.conteo_sintomas }}</td>
                    

                  </tr>
                  </tbody>
            </table>      
                                
        </div>
				 
			</div>
		</div>
		</div>

	</div>
	 <br>
        <a href="buscar.php"><button class="btn btn-success"> AYUDA </button></a>
		
</body>
</html>