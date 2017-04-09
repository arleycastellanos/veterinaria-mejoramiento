<?php 
/**
*DUBIER PEREZ
*/

include ('Graficos.php');
class BD extends Graficos

	{

		public $conexion; //variable publica


		function BD ()
		{//esta funcion es el constructor.
			$this->conexion=$this->crear_conexion();
		}//fin de la funcion



		 function crear_conexion ()
		 {//esta funcion se encarga de crear la conexion con el servidor.
		 	include('config.php');
		 	return mysqli_connect($servidor,$usuario,$clave,$bd);
		 }



		 function consultar_tablas($campo_a_mostrar,$sql_antes=null)

		 {//esta funcion se encarga realizar la consulta en la tabla.		 	
		 	$sql = "SELECT $sql_antes $campo_a_mostrar from tb_enfermedades ,tb_sintomas , tb_informe where tb_informe.id_enfermedad=tb_enfermedades.id_enfermedad and tb_informe.id_sintomas=tb_sintomas.id_sintomas";
		 	$resultado = $this->conexion->query( $sql );	
		 	return $resultado;
		 }


		 function leer_campo ($resultado,$th)
		   {//esta funcion se encarga de traer los datos de la tabla.
				 	$salida = 
				      "<table class='table-bordered table-striped'>
				        <thead>
		                 <tr>
		                  $th
		                 </tr>
		                </thead>";
		    $salida .= "<tr>";

		 	while( $fila = mysqli_fetch_array( $resultado ) )
				{
					for( $i = 0; $i < mysqli_num_fields( $resultado ); $i ++ )
					$salida .="<td>".$fila[ $i ]."</td>";
					$salida .= "</tr>";
				}
			$salida .= "</table>";

			return $salida;	
		 }


		 function traer_informacion( $nombre_lista, $tabla, $campo_llave_primaria, $campo_a_mostrar,$method,$action )
		   {//esta funcion se encarga de traer la informacion en pantalla
				$salida = "";
			      include 'config.php';

		$sql = "SELECT * FROM  $tabla ";
		                          //este son los codigos del titulo//	
			if($sn_pruebas=="s") echo "<h2><b><p class='bg-success'>SELECCIONE SU SINTOMA</p></b></h2>";
		$resultado = $this->conexion->query( $sql );

		$salida = "<SELECT  id='sintomas' ng-model='lista' ng-change='cargar_datos_php()' multiple size='20' class='form-control'>";
								$contador=0;
							while( $fila = mysqli_fetch_assoc( $resultado ) )
							{
									
									
								$salida .=
									 "<tr>
									 	<td>
										 
											<option value='".$fila[ $campo_llave_primaria ]."'>".$fila[ $campo_a_mostrar ]."</option>

										</td>
									 </tr>";
									
							}
							
							
		$salida .=" </tbody>
					</table>
					<input type='hidden'  >
					
				 ";

		return $salida;	


		}


		 function consultar($valores)

		 {//esta funcion se encarga realizar la consulta en la tabla.
		 	 	include( "config.php" );
        	
		        header("Access-Control-Allow-Origin: *");
		        header("Content-Type: application/json; charset=UTF-8");
		        
		        $conn = new mysqli( $servidor, $usuario, $clave, $bd );
		        

		     		$sql = "SELECT tb_enfermedades.enfermedad , COUNT(tb_informe.id_enfermedad) as conteo_sintomas , (SELECT COUNT(tb_informe.id_enfermedad) conteo_total FROM tb_informe where tb_enfermedades.id_enfermedad = tb_informe.id_enfermedad GROUP BY id_enfermedad) as conteo_total FROM tb_informe , tb_enfermedades WHERE tb_informe.id_enfermedad = tb_enfermedades.id_enfermedad AND tb_informe.id_sintomas in($valores) GROUP BY tb_informe.id_enfermedad";
			        $result = $this->conexion->query( $sql );	
		        
		            $outp = "";
		       
		        
		        while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
		        {
		            if ($outp != "") {$outp .= ",";}
		            $outp .= '{"Enfermedad":"'.utf8_encode($rs["enfermedad"]).'",';            
		            $outp .= '"conteo_sintomas":"'.$rs["conteo_sintomas"].'",';         
		           	$outp .= '"abc":"'.$sql.'",';
		            $outp .= '"conteo_total":"'.$rs["conteo_total"].'"}';
		            
		          
		        }
		        
		        $outp ='{"records":['.$outp.']}';
		        $conn->close();
		        
		        return $outp;

		 }

		
	}

	function buscar()
		{
			    
	        include( "config.php" );
	        
	        /*Esta conexión se realiza para la prueba con angularjs*/
	        header("Access-Control-Allow-Origin: *");
	        header("Content-Type: application/json; charset=UTF-8");
	        
	        $conn = new mysqli( $servidor, $usuario, $clave, $bd );
	        
	        //Se busca principalmente por alias.
	        
	        $consulta = explode(",", $_GET['busqueda']);
	        //echo $consulta;
	        if($_GET['busqueda'] == "manual tecnico" || $_GET ['busqueda']=="url") {
	        	$sql = "SELECT * FROM tb_buscar";
	        	}else{

	        $sql  = " SELECT * FROM tb_buscar  WHERE ";
	        for ($i=0; $i < count($consulta); $i ++) 
	        { 
	        	
	        	$sql .= " titulo LIKE '%".$consulta[$i]."%'";
	        	//$sql .= " OR definicion LIKE '%".$consulta[$i]."%'";
	        	if ($i < (count($consulta)-1)) $sql.=" or ";
	          }

	         }
	        
	        //echo $sql;
	        //La tabla que se cree debe tener la tabla aquí requerida, y los campos requeridos abajo.
	        $result = $conn->query( $sql );
	        
	        $outp = "";
	        
	        while($rs = $result->fetch_array( MYSQLI_ASSOC )) 
	        {
	            //Mucho cuidado con esta sintaxis, hay una gran probabilidad de fallo con cualquier elemento que falte.
	            if ($outp != "") {$outp .= ",";}
	            
	            $outp .= '{"Titulos":"'. utf8_encode($rs["titulos"]).'",';
	            $outp .= '"definicion":"'.utf8_encode($rs["definicion"]).'",';     // <-- La tabla MySQL debe tener este campo.
	            $outp .= '"Imagen":"'.$rs["url"].'"}';            // <-- La tabla MySQL debe tener este campo.
	        }
	        
	        $outp ='{"records":['.$outp.']}';
	        $conn->close();
	        
	        echo($outp);
		} 	 

 ?>