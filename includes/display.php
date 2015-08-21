<?php

/*
 * Visualizar imágenes desde postgresql
 * 
 */

include 'includes/ConexionPGSQL.php';
$sql = "SELECT encode(img_imagen, 'base64') AS img_imagen FROM tblxian_repuesto WHERE cod_repuesto= '".$_REQUEST['id']."'";
$ref = @pg_query($sql);
$result = pg_fetch_object($ref);
    header("Content-type:'image/jpg'");
    echo base64_decode($result->img_imagen);
?>

