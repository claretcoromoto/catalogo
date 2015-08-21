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



    $sql = "INSERT INTO tblxian_cond_vta (nu_monto_minimo, fe_ini_vigencia, fe_fin_vigencia, id_usr, in_activo, iva) "
    . "VALUES ($montomin, '" . $fecha1 . "' , '" . $fecha2 . "' , $idusr,  1, $iva)";
    $result = @pg_query($sql);
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    if (!isset($result)) {
        $lo->Traza($email, 'SQL fallido:' . $sql . ' IP:' . $remote_addr . ' ', 'BD');
        echo "<script language='JavaScript'> alert('No se pudo registrar, verifique') 
                                           location.href = '../AdminRegistrarCondVta.php';  exit();
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
