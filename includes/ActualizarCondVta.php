<?php
error_reporting(0);
include 'Dao.php';
include 'ConexionPGSQL.php';
require_once "sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");

extract($_REQUEST);
try {


$monto1=number_format($monto, 2, '.', '');
 $sql = "UPDATE tblxian_cond_vta SET nu_monto_minimo=$monto1, iva=$iva "
            . " WHERE id_cond_venta=$idcond ";
 
    $result = @pg_query($sql); 
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    if (!isset($result)) {
      $lo->Traza($email, 'SQL fallido:' . $sql . ' IP:' . $remote_addr . ' ', 'BD');
        echo "<script language='JavaScript'> alert('No se pudo actualizar, verifique') 
                                           location.href = '../AdminActualizarCondicionesVta.php';  exit();
                                            </script> ";
    } else {

        $lo->Traza($email, 'SQL exitoso:' . $sql . ' IP:' . $remote_addr . ' ', 'BD');
        header("Location: ../AdminCondicionesVta.php");
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza($email, 'Exception.  IP:' . $remote_addr . ' CATCH:' . $e . '   SQL: ' . $sql . '', 'EXCEPTION');
    }
}
?>
