<?php

include 'ConexionPGSQL.php';
include 'sesion.class.php';



$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
extract($_REQUEST);
$remote_addr = $_SERVER['REMOTE_ADDR'];
try {
    $query = "UPDATE tblsit_municipio SET nb_municipio='" . $estado . "', id_estado= id_estado=".$id_estado."  WHERE id_municipio='" . $id_municipio . "' ";
    $result = @pg_query($query);

    if (!isset($result)) {
        $lo->Traza($email, 'Update Municipio fallido.  IP:' . $remote_addr . ' ', 'BD');
        header('Location:../AdminEstado.php');
    } else {
        $lo->Traza($email, 'Update Muncipio exitoso.  IP:' . $remote_addr . '', 'BD');
        header('Location:../AdmiMunicipio.php');
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza($email, 'Update estado. EXCEPTION:' . $e . ' IP:' . $remote_addr . ' ', 'BD');
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                       location.href = '../AdmiMunicipio.php';  exit();
                         </script> ";
    }
}
?>
