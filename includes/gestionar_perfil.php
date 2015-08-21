<?php require_once "sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
        if (!isset($email)&& $rol !== 4 && $rol !== 5) {
            header("Location: ../login.php");
        }    if ($rol == 4) {
           header("Location: ../mod_cliente.php");
            } else if ($rol == 5) {
                header("Location: ../mod_vendedor.php");
            } 
        
?>