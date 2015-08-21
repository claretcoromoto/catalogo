<?php

include '../includes/ConexionPGSQL.php';
include '../includes/sesion.class.php';
include '../modelo/model_admin_consultar.php';
include '../modelo/model_admin_actualizar.php';
include '../modelo/model_admin_registrar.php';





$sesion = new sesion();
$email = $sesion->get('email');
$idadmin = $sesion->get('id_usr');
$rol = $sesion->get('id_rol_usr');
$remote_addr = $_SERVER['REMOTE_ADDR'];
$modelactualizar = new model_admin_actualizar();
$modelconsultar = new model_admin_consultar();
$modelregistrar = new model_admin_registrar();

$accion = $_POST["accion"];
$fecha = strftime("%Y-%m-%d", time());
try{
if($accion==0){// busca el RIF en la tblsit_usr para coprobar que si está en estatus Reactivado o No
                    $rif = $_POST['rifcli'];
                    $result = $modelconsultar->consultarmotivohist($rif);
                    $lo->Traza($email, 'Consultar historial.  IP:' . $remote_addr . '', 'BD');
                    if ($file = pg_fetch_array($result)) {
                        echo $file['id_motivo_anul'];
                    } else {
                        return false;
                    }
    
}

if ($accion == 1) {
 
                    $rif = $_POST['rifcli'];
                    $result = $modelconsultar->buscarestatuscli($rif);
                    $lo->Traza($email, 'Buscar estatus cliente.  IP:' . $remote_addr . '', 'BD');
                    if ($file = pg_fetch_array($result)) {
                        echo $file['in_status_cliente'];
                    } else {
                        return false;
                    }
    
}

if ($accion == 2) { //obtener el id_motivo de anulación
                    $rif = $_POST['rifcli'];

                    $result = $modelconsultar->consultarmotivohist($rif);
                    $lo->Traza($email, 'Consultar motivo anulación.  IP:' . $remote_addr . '', 'BD');
                    if ($file = pg_fetch_array($result)) {
                        echo $file['id_motivo_anul'];
                    } else {
                        return false;
                    }
}

if ($accion == 3) { //consultat y obtener el rif del cliente
                    $rif = $_POST['rifcli'];
                    
                    $result = $modelconsultar->buscarestatcli($rif);
                    $lo->Traza($email, 'Buscar estatus cliente.  IP:' . $remote_addr . '', 'BD');
                    if ($file = pg_fetch_array($result)) {
                        echo $file['ci_rif_cliente'];
                    } else {
                        return false;
                    }
}

if ($accion == 4) {  //consultar y obtener el rif y el id motivo de anulación
                   $rif = $_POST['rifcli'];
                   $id_motivo = $_POST['id'];
                   
                   $result = $modelconsultar->consultarhistmotivos($rif, $id_motivo);
                   $file = pg_fetch_array($result);
$lo->Traza($email, 'Consultar historial motivos de anulación.  IP:' . $remote_addr . '', 'BD');
                   echo $statusActual = $file['in_status_cliente'];
                   if (!empty($file)) {
                       echo "<script language='JavaScript'> alert('El motivo de anulaci\u00f3n ha sido establecido previamente en:'$f_operacion)
                                                               location.href = '../view_admin_buscar_rif_anularcliente.php';
                                                                         exit();  
                                                                         </script> ";
                   } else if (isset($file)) {

                       $actualizaranul = $modelactualizar->actualizarclianul($rif);
                       $registrarhist = $modelregistrar->insertarHistclienteanula($fecha, $idadmin, $id_motivo, $rif);

                       if (isset($registrarhist)) {

                           echo "<script language='JavaScript'> alert('Se ha establecido el motivo de anulaci\u00f3n')
                                                               location.href = '../view_admin_buscar_rif_anularcliente.php';
                                                                         exit();  
                                                                         </script> ";
                       }
                   }
}// fin action 4





if ($accion == 5) {  //consultar y obtener el rif y el id motivo de anulación
                   
                   $rif = $_POST['rif'];
                 
                   $result = $modelconsultar->consultarmotivoreachist($rif);
                   $file = pg_fetch_array($result);
$lo->Traza($email, 'Consultar historial motivo.  IP:' . $remote_addr . '', 'BD');
                  $statusActual = $file['in_status_cliente'];
                   if ($statusActual==-2) {
                       echo "<script language='JavaScript'> alert('El motivo de reactivaci\u00f3n ha sido establecido previamente')
                                                               location.href = '../view_admin_buscar_rif_reactivarcliente.php';
                                                                         exit();  
                                                                         </script> ";
                   } else if ($statusActual!==-2) {

                       $actualizarreac = $modelactualizar->actualizarclireact($rif);
                       $registrarhist = $modelregistrar->insertarHistclientereact($fecha, $idadmin, $rif);

                       if (isset($actualizarreac) && isset($registrarhist)) {
                      
                           echo "<script language='JavaScript'> alert('Se ha establecido el motivo de reactivaci\u00f3n')
                                                               location.href = '../view_admin_buscar_rif_reactivarcliente.php';
                                                                         exit();  
                                                                         </script> ";
                       }
                   }
}// fin action 5


if ($accion == 6) {  //consultar y obtener el rif y el id motivo de sancion
                   $rif = $_POST['rifcli'];
                   $id_motivo = $_POST['id'];
                   
                   $result = $modelconsultar->consultarhistmotivos($rif, $id_motivo);
                   $lo->Traza($email, 'Consultar historial motivos.  IP:' . $remote_addr . '', 'BD');
                   $file = pg_fetch_array($result);

                   $statusActual = $file['in_status_cliente'];
                   if (!empty($file)) {
                       echo "<script language='JavaScript'> alert('El motivo de anulaci\u00f3n ha sido establecido previamente en:'$f_operacion)
                                                               location.href = '../view_admin_buscar_rif_sancionarcliente.php';
                                                                         exit();  
                                                                         </script> ";
                   } else if (isset($file)) {

                       $actualizaranul = $modelactualizar->actualizarclisancion($rif);
                       $registrarhist = $modelregistrar->insertarHistclientesancion($fecha, $idadmin, $id_motivo, $rif);

                       if (isset($registrarhist)) {

                           echo "<script language='JavaScript'> alert('Se ha establecido el motivo de sanci\u00f3n')
                                                               location.href = '../view_admin_buscar_rif_sancionarcliente.php';
                                                                         exit();  
                                                                         </script> ";
                       }
                   }
}// fin action 6
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'En el controlador administrador. EXCEPTION:' . $e . ' IP:' . $remote_addr . '  ', 'BD');
}
?>