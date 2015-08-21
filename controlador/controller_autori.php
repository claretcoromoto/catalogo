<?php

include '../includes/ConexionPGSQL.php';
include '../includes/sesion.class.php';
include '../modelo/model_autori_consultar.php';
include '../modelo/model_autori_actualizar.php';
include '../modelo/model_autori_registrar.php';





$sesion = new sesion();
$email = $sesion->get('email');
$idadmin = $sesion->get('id_usr');
$rol = $sesion->get('id_rol_usr');

$modelactualizar = new model_autori_actualizar();
$modelconsultar = new model_autori_consultar();
$modelregistrar = new model_autori_registrar();

$accion = $_POST["accion"];
$fecha = strftime("%Y-%m-%d", time());
$remote_addr = $_SERVER['REMOTE_ADDR'];
try{
if ($accion == 0) {  //consultar y obtener el rif y el id motivo de saprobacion
                    $rif = $_POST['rifcli'];

                    $result = $modelconsultar->consultarmotivoreachist($rif);
                    $file = pg_fetch_array($result);
                     $lo->Traza($email, 'Consultar historial.  IP:' . $remote_addr . '', 'BD');
                    $estatus = $file['id_status_cliente'];
                    if ($estatus === 1) {
                        echo "<script language='JavaScript'> alert('El cliente ha sido aprobado previamente')
                                                                               location.href = '../view_autori_cliente.php';
                                                                                         exit();  
                                                                                         </script> ";
                    } else {
                        $actualizarapro = $modelactualizar->actualizarcliaregistrado($rif);
                        $registrarhist = $modelregistrar->insertarHistclientearegistrado($fecha, $idadmin, $rif);
                        if (isset($actualizarapro) && isset($registrarhist)) {
                            echo "<script language='JavaScript'> alert('El cliente ha sido aprobado')
                                                                               location.href = '../view_autori_cliente.php';
                                                                                         exit();  
                                                                                         </script> ";
                        }
                    }
}
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'En el controlador autorizador I. EXCEPTION:' . $e . ' IP:' . $remote_addr . '  ', 'BD');
}
?>