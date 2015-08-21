<?php include 'DaoSegNivel.php';
require_once "sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
extract($_REQUEST);
try{
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $dao_update = new DaoSegNivel();
        $result = $dao_update->ActualizarCategoriaAdmin($ids, $ina);
        if (!isset($result)) {  //  $remote_addr = $_SERVER['REMOTE_ADDR'];
                         $lo->Traza($email ,  'Update categoria activo/inactivo fallido.  DATOS->IP:'. $remote_addr.' ', 'BD');
           header("Location:../AdminCategoriaRepuesto.php");
                        
        } else if (isset($result)) {
            $lo->Traza($email ,  'Update categoria activo/inactivo exitoso. DATOS->IP:'. $remote_addr.' ', 'BD');
             header("Location:../AdminCategoriaRepuesto.php");
        }
}  catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Exception:  ' . $e . ' IP:' . $remote_addr . ' SQL:' .   $result  . '', 'BD');
}
?>
