<?php include 'DaoSegNivel.php';
require_once "sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
  

extract($_REQUEST);
$remote_addr = $_SERVER['REMOTE_ADDR'];
        $dao_update = new DaoSegNivel(); //actualizarCliente($rif, $nombre, $direccion, $id_ciudad, $contacto, $telefono);
        $result = $dao_update->ActualizarRolAdmin($ids, $ina);
        if (!isset($result)) {
            $lo->Traza($email, 'Actualización fallida.  IP:' . $remote_addr . ' EMAIL:' . $email . '', 'BD');
  header('Location:../AdminRolUsuario.php');
        } else if (isset($result)) {
                $lo->Traza($email, 'Actualización exitosa.  IP:' . $remote_addr . ' EMAIL:' . $email . '', 'BD');
        header('Location:../AdminRolUsuario.php');
                                         
        }
     
?>
