<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';

extract($_REQUEST);

$sesion = new sesion();
$rol = $sesion->get('id_rol_usr');
$email = $sesion->get('email');

try {
 echo  $rifcli;
       $remote_addr = $_SERVER['REMOTE_ADDR'];
  
        $result = @pg_query("UPDATE tblsit_usr SET id_usr_vendedor =$idven WHERE ci_rif_cliente = '" . $rifcli . "' ");
        if (isset($result)) {
            if (isset($email) && $rol == 1) {
                $lo->Traza($email, 'Update exitoso de reasignar clienteS.  IP:' . $remote_addr . '  IDVENDEDOR: ' . $idven . ' RIF:' . $rifcli . '', 'BD');
                header('Location:../AdminReasignarTodosClientes.php');
            }
        }else{
           if (isset($email) && $rol == 1) {
               $lo->Traza($email, 'No existe el vendedor.  IP:' . $remote_addr . '  IDVENDEDOR: ' . $idven . ' RIF:' . $rifcli . '', 'BD');
                 header('Location:../AdminReasignarTodosClientes.php');
           /* echo "<script language='JavaScript'> alert('El vendedor no existe') 
                          location.href = '../AdminReasignarTodosClientes.php'; 
                          exit(); exit();
                            </script> ";*/
           }
       
    }
    
    
    
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Reasignar vendedor a  clienteS.  IP:' . $remote_addr . ' CATCH:' . $e . '', 'EXCEPTION');
}
?>
