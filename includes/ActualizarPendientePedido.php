<?php error_reporting(0);

include 'sesion.class.php';
include 'DaoTercerNivel.php';
$daotercer = new DaoTercerNivel();
extract($_REQUEST);
$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
$idAuto2 = $s->get("id_usr");
//error_reporting  (E_ALL);
//ini_set ('display_errors', true);
$remote_addr = $_SERVER['REMOTE_ADDR'];

try {       

        $fecha = strftime("%Y-%m-%d", time());
        $result2 = pg_query("UPDATE tblxian_pedido SET id_status_pedido= 1 WHERE ci_rif_cliente = '" . $rif . "' AND id_pedido=$id_pedido ");
        $sql3 = "INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr, ci_rif_cliente, id_pedido)"
        . "  VALUES ('" . $fecha . "',1, $idAuto2, '" . $rif . "', $id_pedido )";
        $result3 = @pg_query($sql3);
        if (isset($result2) && isset($result3)) {
            if (isset($email) && ($rol == 3)) {
                $lo->Traza($email, 'Actualizar pendiente pedido. IP:' . $remote_addr . ' RIF:' . $rif . '', 'BD');
                echo "<script language='JavaScript'> alert('El  pedido ha sido aprobado ')
                            location.href = '../AdminSolPenCliPedidos.php';
                              exit();  
                              </script> ";
            }
        }
   
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Actualizar pendiente pedido. EXCEPTION:' .$e . '  IP:' . $remote_addr . ' RIF:' . $rif . '', 'BD');
}
?>
