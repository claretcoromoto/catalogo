<?php

$query = pg_query("SELECT  encode(img_imagen, 'base64') AS img_imagen FROM tblxian_repuesto WHERE cod_repuesto= '" . $_REQUEST['id']. "'");
$raw = pg_fetch_array($query);
header('Content-type: image/gif');
echo base64_decode($raw['img_imagen']);

?>

