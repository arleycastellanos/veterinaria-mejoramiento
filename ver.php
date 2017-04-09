<!--
*BUBIER PEREZ
-->
<?php 

$valores            = "";
$caracter_separador = ",";
$total_campos=$_GET['contador'];
echo $total_campos."<br>";
for( $i = 0; $i <= $total_campos; $i ++ )       

        {
              if (isset($_GET['sintoma'.$i]))
               {
                  if ($valore!="") 
                   {
                     $valores+=",".$_GET['sintoma'.$i];
                   }else{
                         $valore+=$_GET['sintoma'];
                        }   
      	       }
   			}
        
        echo $valores;
       include 'class/BD.php';
    $nuevo_obj=new BD();
      echo $nuevo_obj->leer_campo( $nuevo_obj->consultar($valores),"<th>Id_enfermedad</th> <th>Enfermedad</th><th>Id_sintoma</th><th>Sintoma</th><th>Id_Informe</th><th>Id_enfermedad</th><th>Id_Sintoma</th>");
      echo $nuevo_obj->estilos("bootstrap"); //trae la función estilos de bootstrap de la clase

?>


<?php

    include'class/BD.php';
    $nuevo_obj=new BD();    // llama la clase BD
           
     if( isset( $_GET[ 'cadena' ] ) )
    {     
        $valores=$_GET['cadena'];
        echo  $nuevo_obj->consultar($valores);
        //echo $sql;
    }
  ?>