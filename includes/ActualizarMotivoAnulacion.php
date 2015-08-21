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



    $sql = "UPDATE tblxian_motivo_anul SET nb_motivo_anul= ' $nombre ', in_tipo=$tipo,  tx_login='$email' WHERE id_motivo_anul=' $id ' ";
    $result = @pg_query($sql);
    $remote_addr = $_SERVER['REMOTE_ADDR'];
    if (isset($result)) {
        $lo->Traza($email, 'SQL fallido:' . $sql . ' IP:' . $remote_addr . ' ', 'BD');
        header('Location:../AdminConfigMotivoAnulacion.php');
    } else {

        $lo->Traza($email, 'SQL exitoso:' . $sql . ' IP:' . $remote_addr . ' ', 'BD');
         header('Location:../AdminEditarMotivoA.php');
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza($email, 'Exception.  IP:' . $remote_addr . ' CATCH:' . $e . '   SQL: ' . $sql . '', 'EXCEPTION');
    }
}
?>
