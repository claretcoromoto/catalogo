<?php

include 'ConexionPGSQL.php';
error_reporting(E_ALL);
require_once "sesion.class.php";
$sesion = new sesion();

$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
if (!isset($email) && $rol!=4 || $rol!=5) {
    header("Location: ../login.php");
        } 
 if ($rol == 4) {
                 header("Location: ../catalogo_final.php");
            } else if ($rol == 5) {
                   header("Location: ../Buscar_Rif_Cliente.php");
                }  else {
                   return false;
}
?>