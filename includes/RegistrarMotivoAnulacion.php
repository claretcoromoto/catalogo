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



   $sql = "INSERT INTO tblxian_motivo_anul (nb_motivo_anul,in_activo,in_tipo,tx_login ) VALUES ('$nombre',1,$tipo,'$email')";
    $result = @pg_query($sql);
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    if (!isset($result)) {
        header('Location:../AdminConfigMotivoAnulacion.php'); 
        $lo->Traza($email, 'SQL fallido:' . $sql . ' IP:' . $remote_addr . ' ', 'BD');
    } else {
         header('Location:../AdminConfigMotivoAnulacion.php');
         $lo->Traza($email, 'SQL exitoso:' . $sql . ' IP:' . $remote_addr . ' ', 'BD');
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza($email, 'Exception.  IP:' . $remote_addr . ' CATCH:' . $e . '   SQL: ' . $sql . '', 'EXCEPTION');
    }
}
?>
