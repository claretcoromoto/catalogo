<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';

extract($_REQUEST);
              
             $sesion = new sesion();
                $rol = $sesion->get('id_rol_usr');
                $email = $sesion->get('email');
                $rifCliente=$sesion->get('rifCliente');
                $remote_addr = $_SERVER['REMOTE_ADDR'];
                  
    try {
   $sql="UPDATE tblsit_usr SET id_usr_vendedor =$idUsrVendedor WHERE ci_rif_cliente = '" . strtoupper($rifenviar) . "' ";
   $result = @pg_query($sql);
        if (isset($result)) {
             if (isset($email) && ($rol == 1 )) {
                 $lo->Traza($email, 'Update exitoso de reasignar cliente.  IP:' . $remote_addr . ' SQL: ' . $sql . '', 'BD');
                 header('Location:../AdminReasignarCliente.php?rif='.$rifCliente.'&rifVende=' . $rifenviar. ' ');
                
            }
        }
    } catch (Exception $e) {
        throw new Exception($e);
         $lo->Traza($email, 'Reasignar vendedor a  cliente.  IP:' . $remote_addr . ' CATCH:' . $e . '', 'EXCEPTION');
    }




?>
