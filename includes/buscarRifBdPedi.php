<?php

include 'ConexionPGSQL.php';
include 'sesion.class.php';
include 'Dao.php';

$sesion = new sesion();
$email = $sesion->get('email');
$rol = $sesion->get('id_rol_usr');
//establecemos un valor para los errores presentados y si es que existen colocaremos en lugar de estos el valor 1.
if (!$sesion->get('carrito')) {
//si no existe la variable de sesión carro 
    echo "<script language='JavaScript'> alert('Carrito false') 
     location.href = 'catalogo_final.php';
    </script> ";
} else {
    $remote_addr = $_SERVER['REMOTE_ADDR'];
// $carro = false;
    $carro = $sesion->get('carrito');
    $rol = $sesion->get('id_rol_usr');
    $id = $sesion->get("id_usr");
    $formpago = $sesion->get('formpago');
    $mon = $sesion->get('monto');
    $moni = $sesion->get('montiva');
    $montal = $sesion->get('montotal');
    if (isset($_POST["rifi"])) {
        $rifseniat = strtoupper(trim(htmlentities(strip_tags($_POST['rifi']))));

        try {
            $_select = "SELECT ci_rif_cliente, in_status_cliente, id_usr_vendedor  FROM tblsit_usr WHERE ci_rif_cliente= '" . $rifseniat . "'  AND id_usr_vendedor = " . $id . " AND in_status_cliente=1 ";
            $result = @pg_query($_select);
            $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' SQL:' . $_select . '', 'BD');
            if (pg_num_rows($result) > 0) {
                $lo->Traza($email, 'Buscar RIF pedido.  IP:' . $remote_addr . ' RIF:' . $rifseniat . '', 'BD');
                echo "<script language='JavaScript'>                
                       location.href = '../Registrar_pedido.php?rif=$rifseniat&formpago=$formpago&monto=$mon&montiva=$moni&montotal=$montal';exit();</script> ";
            } else {
                if (!pg_num_rows($result)) {
                    $lo->Traza($email, 'Buscar RIF pedido.  IP:' . $remote_addr . ' RIF:' . $rifseniat . '', 'BD');
                    echo "<script language='JavaScript'   > 
                    var com=confirm('Ud. no tiene asignado este cliente o Si desea registrarlo, pulse Aceptar sino  Cancelar para verificar el RIF');
                    if(com==true){
                    location.href ='../Buscar_Rif_Cliente.php';
                    }else{
                      location.href = '../Registrar_pedido.php?formpago=$formpago&monto=$mon&montiva=$moni&montotal=$montal'; 
                      }
                    exit(); 
                            </script> ";
                }
            }
        } catch (Exception $e) {
            throw new Exception($e);
              $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' EXCEPTION:' . $e. '', 'EXCEPTION');
        }
    }
}
?>
