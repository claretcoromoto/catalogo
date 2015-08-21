<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';

extract($_REQUEST);

try {
    $fecha = strftime("%Y-%m-%d", time());
    $result = pg_query("UPDATE tblsit_usr SET in_status_cliente = -2 WHERE ci_rif_cliente = '" . $rif . "' ");
    $sql = "INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr, id_motivo_anul, ci_rif_cliente)"
            . "  VALUES ('" . $fecha . "',-2,$idAuto1,$id_motivoR, '" . $rif . "' )";
    $result1 = @pg_query($sql);
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    if (isset($result) && isset($result1)) {
        $s = new sesion();
        $rol = $s->get('id_rol_usr');
        $email = $s->get('email');
        if (isset($email) && ($rol == 1 )) {
            $lo->Traza( $email, 'Update exitoso de reactivar cliente.  IP:' . $remote_addr . ' Al cliente (RIF):' . $rif . '', 'BD');
            echo "<script language='JavaScript'> alert('El cliente ha sido reactivado ')
                    location.href = '../AdminBuscarRifReactivarCliente.php';
                              exit();  
                              </script> ";
        }
    }
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Update reactivar cliente IP:' . $remote_addr . ' CATCH:' . $e . '  SQL:' . $sql . '', 'EXCEPTION');
}
?>
