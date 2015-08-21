<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';

extract($_REQUEST);

try {
    $s = new sesion();
    $rol = $s->get('id_rol_usr');
    $email = $s->get('email');

    $sql = "SELECT ci_rif_cliente FROM tblsit_usr  WHERE id_rol_usr = 4 AND  in_status_cliente = 1  AND ci_rif_cliente='" . $rif . "'  ";
    $result = @pg_query($sql);
    $row = pg_num_rows($result);
    if ($row > 0) { 
        if (isset($email) && $rol == 1 ) {
        $lo->Traza($email, 'Buscar RIF  reasignar cliente, exitoso.  IP:' . $remote_addr . ' RIF del cliente:' . $rif . '', 'BD');
               header("Location:../AdminReasignarCliente.php?rif=$rif");
               
       }
    } else {
        if ($row === 0) {
            if (isset($email) && $rol == 1 ) {
                  $lo->Traza($email, 'Buscar RIF  reasignar cliente. Fallido.  IP:' . $remote_addr . ' RIF del cliente:' . $rif . '', 'BD');
                    header("Location: ../AdminBuscarRifReasignarUnCliente.php");
              
            }
        }
    }
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Exception:  ' . $e . ' IP:' . $remote_addr . ' SQL:' . $sql . '', 'BD');
}
?>
