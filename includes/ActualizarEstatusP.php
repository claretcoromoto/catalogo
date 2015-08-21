<?php include 'DaoSegNivel.php';
require_once "sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');

  

extract($_REQUEST);
$remote_addr = $_SERVER['REMOTE_ADDR'];
        $dao_update = new DaoSegNivel(); 
        
        $result = $dao_update->ActualizarEstatusP($ids, $ina);
        if (!isset($result)) {
            $lo->Traza($email, 'Actualización fallida estatus del pedido.  IP:     ' . $remote_addr . ' ROL:' . $rol . '', 'BD');
  header('Location:../AdminEstatusP.php');
        } else if (isset($result)) {
                $lo->Traza($email, 'Actualización exitosa estatus del pedido.  IP: ' . $remote_addr . ' ROL:' . $rol . '', 'BD');
        header('Location:../AdminEstatusP.php');
                                         
        }
     
?>
