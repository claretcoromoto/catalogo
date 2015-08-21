<?php
include 'ConexionPGSQL.php';//encode(img_imagen, 'base64') AS    coalesce(archivo_oid,-1) as archivo_oid
echo $query = pg_query("SELECT  coalesce(archivo_oid,-1) AS img_imagen FROM tblxian_repuesto"
        . " WHERE cod_repuesto= '" . $_REQUEST['id']. "'");
$ref = @pg_query($query);
$result = pg_fetch_object($ref);
    header("Content-type:'image/jpg'");
  $image = base64_decode($result->img_imagen);
  echo $image;

    ?>

