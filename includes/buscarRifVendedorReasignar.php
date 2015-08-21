<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';
include 'Rif.php';
include 'Seniat.php';

extract($_REQUEST);


try {
    $sesion = new sesion();
    $rol = $sesion->get('id_rol_usr');
    $email = $sesion->get('email');
    $rifCliente=$sesion->get('rifCliente');
    $sql = "SELECT ci_rif_cliente FROM tblsit_usr  WHERE id_rol_usr = 5 "
            . " AND  in_status_usr = 1  "
            . "AND ci_rif_cliente='" . $rifi . "'  ";

    $result = @pg_query($sql);
    $row = pg_num_rows($result);
    
  
    if ($row > 0) {
     
        if (isset($email) && ($rol == 1 )) {
            echo "<script language='JavaScript'> //alert('El usuario  est\u00e1 reasigado al vendedor ')
                     location.href = '../AdminReasignarCliente.php?rif=$rifCliente&rifVende=$rifi';
                              exit();  
                              </script> ";
        }
    } else {
        if ($row === 0) {
            if (isset($email) && ($rol == 1 )) {
                echo "<script language='JavaScript'> alert('El vendedor no existe')
                    location.href = '../AdminReasignarCliente.php?rif=$rifCliente';
                              exit();  
                              </script> ";
            }
        }
    }
} catch (Exception $e) {
    throw new Exception($e);
}
?>
