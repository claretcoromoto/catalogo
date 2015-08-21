<?php

include 'ConexionPGSQL.php';
include 'sesion.class.php';

extract($_REQUEST);

try {
    $password = '12345';
    $result = pg_query("UPDATE tblsit_usr SET tx_clave = '" . sha1($password) . "' WHERE ci_rif_cliente = '" . $rif . "' ");
    $s = new sesion();
    $rol = $s->get('id_rol_usr');
    $email = $s->get('email');
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    if (isset($result)) {
        if (isset($email) && ($rol == 1 )) {
            $lo->Traza($email, 'Resetear clave exitoso. Realizado al RIF: ' . $rif . ' DATOS->IP:' . $remote_addr . ' ', 'BD');
            echo "<script language='JavaScript'> alert('La contrase\u00f1a ha sido reseteada')
                    location.href = '../AdminMenuPrincipal.php';
                              exit();  
                              </script> ";
        }
    }
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Resetear clave. IP:' . $remote_addr . ' CATCH:' . $e . '', 'EXCEPTION');
}
?>
