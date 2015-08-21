<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';


extract($_REQUEST);

try {
    $sqlH = "SELECT id_motivo_anul FROM tblsit_hist_clte WHERE ci_rif_cliente='" . $rif . "' ORDER BY id_motivo_anul ASC";
    $resultH = @pg_query($sqlH);
    $rowH = pg_fetch_array($resultH);
    $idM = $rowH['id_motivo_anul'];
    if (!isset($idM)) {
          $sql = "SELECT ci_rif_cliente FROM tblsit_usr  WHERE id_rol_usr = 4 "
                . " AND  (in_status_cliente = -1 OR in_status_cliente = 0)  "
                . "AND ci_rif_cliente='" . $rif . "'  ";
        $result = @pg_query($sql);
      

        $s = new sesion();
        $rol = $s->get('id_rol_usr');
        $email = $s->get('email');
        $remote_addr = $_SERVER['REMOTE_ADDR'];
          
                    //header("Location:../AdminBuscarRifReactivarCliente.php");
        if ($row = pg_num_rows($result) > 0) {
           
                header("Location:../AdminReactivarCliente.php?id=$idM&rif=$rif");
                $lo->Traza($email, 'Buscar RIF  reactivar cliente exitoso.  IP:' . $remote_addr . ' RIF del cliente:' . $rif . '', 'BD');
           
        } else {  //$lo->Traza($email, 'Buscar RIF  reactivar cliente fallido.  IP:' . $remote_addr . ' RIF del cliente:' . $rif . '', 'BD');  // header('Location:../AdminBuscarRifReactivarCliente.php');
            
           echo '<script type="text/javascript"> alert("Verifique")  
                    location.href = "../AdminMenuPrincipal.php";
                    exit(); </script> ';        
        }
    } else {
             
           echo '<script type="text/javascript"> alert("Verifique")  
                    location.href = "../AdminBuscarRifReactivarCliente.php";
                    exit(); </script> ';  
    }
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Exception:  ' . $e . ' IP:' . $remote_addr . ' SQL:' . $sql . '', 'BD');
}
?>
