<?php

include 'sesion.class.php';

$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
$idAuto2 = $s->get("id_usr");
include 'DaoSegNivel.php';
$rif=$s->get('rifAdmin');
extract($_REQUEST);
if (isset($_POST['enviar'])) {
    


    if (isset($rifAdmin) && isset($nombre) && isset($contacto) && isset($telefono) && isset($direccion) && isset($estatusUsr) &&  isset($estatusCli) && isset($rolAdmin)) {

        if (!is_numeric($telefono)) {
            echo "<script language='JavaScript'> alert('Por favor, debe escribir un número de tel\u00e9fono v\u00e1lido') 
                          exit();
                          </script> ";
        }

$remote_addr = $_SERVER['REMOTE_ADDR'];

//$sqlupdate="UPDATE  tblsit_usr nb_nombre= $nombre,   ";
        $dao_update = new DaoSegNivel(); //actualizarCliente($rif, $nombre, $direccion, $id_ciudad, $contacto, $telefono);
        $result = $dao_update->ActualizarUsuariosAdmin(strtoupper($rifAdmin), $nombre, $contacto, $telefono, $direccion, $rolAdmin, $estatusUsr, $estatusCli );
        if (!isset($result)) {
        $lo->Traza($email, 'Update fallido de usuario.  IP:' . $remote_addr . ' RIF:' . strtoupper($rifAdmin). '', 'BD');
            echo "<script language='JavaScript'> alert('No se pudo actualizar, verifique') 
                                           location.href = '../AdminMenuPrincipal.php';  exit();
                                            </script> ";
        } else if (isset($result)) {
            $lo->Traza($email, 'Update exitoso de usuario.  IP:' . $remote_addr . ' RIF:' . $rifAdmin. '', 'BD');
            echo "<script language='JavaScript'> alert('Actualizaci\u00f3n exitosa') 
                                           location.href = '../AdminMenuPrincipal.php';  exit();
                                            </script> ";
        }
    } else {
        echo "<script language='JavaScript'> alert('Verifique los campos') 
                                          location.href = '../AdminActualizarUsuario.php?rif=$rif';  exit();
                                            </script> ";
    }
}
?>
