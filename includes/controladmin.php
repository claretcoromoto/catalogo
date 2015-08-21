<?php
include 'admin.php';

include 'sesion.class.php';
$sesion = new sesion();
$rol = $sesion->get('id_rol_usr');
$email = $sesion->get('email');

$admin= new admin();

          echo $accion=$_POST["accion"];
                    if ($accion==1){
                    $idven=$_POST['idven'];
                    $rifcli=$_POST['rifcli'];
                        $result= $admin->actualizarIdven($idven, $rifcli);
                      if( isset($result))
                   {
                                echo true;
                   }
                    else
                                echo false;
                   }

?>