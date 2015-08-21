<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

//error_reporting(0);
include 'sesion.class.php';

include 'DaoTercerNivel.php';
$daotercer = new DaoTercerNivel();
extract($_REQUEST);
$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
$idAuto2 = $s->get("id_usr");
$remote_addr = $_SERVER['REMOTE_ADDR'];
extract($_REQUEST);

try {
    $query = "UPDATE tblsit_ciudad SET nb_ciudad='" . $ciudad . "', id_municipio=" . $id_municipio . " "
    . "WHERE id_ciudad='" . $id_ciudad . "' ";
    $result = @pg_query($query);

    if (!isset($result)) {
        $lo->Traza($email, 'Update ciudad fallido. SQL:' . $query . ' IP:' . $remote_addr . ' ', 'BD');
        echo "<script language='JavaScript'> alert('No se pudo actualizar, verifique') 
                                           location.href = '../AdminCiudadEditar.php'; exit();
                                            </script> ";
    } else if (isset($result)) {
        $lo->Traza($email, 'Update ciudad exitoso. SQL:' . $query . ' IP:' . $remote_addr . '', 'BD');
        header('Location:../AdminCiudadEditar.php ');
        exit();
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza($email, 'Update ciudad. EXCEPTION:' . $e . ' IP:' . $remote_addr . '', 'EXCEPTION');
        echo "<script language='JavaScript'> alert('Ha ocurrido una excepción en el envio: " . $e . "') 
                         location.href = '../AdminCiudadEditar.php'; exit();
                         </script> ";
    }
}
?>
