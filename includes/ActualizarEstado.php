<?php

include 'ConexionPGSQL.php';
include 'sesion.class.php';



$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
extract($_REQUEST);
$remote_addr = $_SERVER['REMOTE_ADDR'];
try {
    $query = "UPDATE tblsit_estado SET nb_estado='" . $estado . "' WHERE id_estado='" . $id_estado . "' ";
    $result = @pg_query($query);

    if (!isset($result)) {
        $lo->Traza($email, 'Update Estado fallido.  IP:' . $remote_addr . ' ', 'BD');
        header('Location:../AdminEstado.php');
    } else {
        $lo->Traza($email, 'Update Estado exitoso.  IP:' . $remote_addr . '', 'BD');
        header('Location:../AdminEstado.php');
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza($email, 'Update estado. EXCEPTION:' . $e . ' IP:' . $remote_addr . ' ', 'BD');
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                       location.href = '../AdminEstado.php';  exit();
                         </script> ";
    }
}
?>
