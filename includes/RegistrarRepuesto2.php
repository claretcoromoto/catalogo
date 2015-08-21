<?php

error_reporting(0);
ini_set('display_errors', true);

include 'ConexionPGSQL.php';
 if (!isset($_FILES['up'])) {
     echo 'no agarro';
    }


  echo $result= pg_query("insert into tblxian_repuesto (cod_repuesto, tx_descripcion, nu_precio_contado, nu_precio_credito, nu_cant_disponible, id_categoria, nb_imagen, img_imagen, tam_imagen, tipo_imagen) "
            . "values ('TX111', "
            . "'EJE DE ENCENDIDO' , "
            . "to_number('209,032639718251',"
            . "'999999999999D999'),"
            . "to_number('209,032639718251','999999999999D999') ,"
            . "4,"
            . "9,"
            . " 'TX111.GIF', decode('".bin2hex(file_get_contents( $uploadDir))."','hex'))");
if($result){
    echo 'inserto image';
    
}  else {
    echo 'nada';    
}
?>

