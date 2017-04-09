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