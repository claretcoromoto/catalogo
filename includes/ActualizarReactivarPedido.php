<?php error_reporting(0);

include 'sesion.class.php';
//include 'ConexionPGSQL.php';
include 'DaoTercerNivel.php';
$daotercer = new DaoTercerNivel();
extract($_REQUEST);
$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
$admin = $s->get("id_usr");

$remote_addr = $_SERVER['REMOTE_ADDR'];
try {
    $sql1 = "SELECT * FROM tblsit_hist_clte WHERE ci_rif_cliente= '" . $rif . "' AND id_motivo_anul=$id_motivo AND id_pedido=$id_pedido  ORDER BY id_hist_clte ASC ";
    $result1 = @pg_query($sql1);
    $file1 = pg_fetch_array($result1);
    $f_operacion = $file1['f_operacion'];
    $statusActual = $file1['id_hist_clte'];
    if (!empty($statusActual)) {
        if (isset($email) && ($rol == 1)) {
            echo "<script language='JavaScript'> alert('El motivo de reactivaci\u00d3n ha sido establecido previamente')
              location.href = '../AdminReactivarPedidos.php';
              exit();
              </script> ";
        }
    } else if (empty($statusActual)) {

        $sqlDetalle = "SELECT * FROM tblxian_detalle_pedido WHERE id_pedido= $id_pedido";
        $resultDetalle = @pg_query($sqlDetalle);
        if ($row = pg_num_rows($resultDetalle) > 0) {
            while ($value = pg_fetch_array($resultDetalle)) {
                $sqlr = '';
                $sqlr.='(nu_cant_reservada + ' . $value['in_cantidad'] . ' )';
                $sqlv = '';
                $sqlv.='(nu_disp_valery  - ' . $value['in_cantidad'] . ' )';
                $sqlc = "UPDATE tblxian_cantidad_dispon  SET nu_cant_reservada= $sqlr WHERE cod_repuesto = '" . $value['cod_repuesto'] . "' ";
                $sqlz = "UPDATE tblxian_cantidad_dispon  SET nu_disp_valery= $sqlv WHERE cod_repuesto = '" . $value['cod_repuesto'] . "' ";
                $r = @pg_query($sqlc);
                $s = @pg_query($sqlz);
                $lo->Traza($email, 'SQL:' . $sqlc . ' IP:' . $remote_addr . '  Id pedido' . $id_pedido . '', 'BD');
                $lo->Traza($email, 'SQL:' . $sqlz . ' IP:' . $remote_addr . '  Id pedido' . $id_pedido . '', 'BD');
            }
        }

        $fecha = strftime("%Y-%m-%d", time());
       $sq = "UPDATE tblxian_pedido SET id_status_pedido= 4 WHERE ci_rif_cliente = '" . $rif . "' AND id_pedido=$id_pedido ";
        $result2 = @pg_query($sq);
      $sql3 = "INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr,id_motivo_anul, ci_rif_cliente, id_pedido)"
        . "  VALUES ('" . $fecha . "',1, $admin, $id_motivo, '" . $rif . "' ,$id_pedido)";
        $result3 = @pg_query($sql3);
        if (isset($result2) && isset($result3)) {
            if (isset($email) && ($rol == 1)) {
                $lo->Traza($email, 'Reactivar pedido exitoso. DATOS: IP:' . $remote_addr . ' EMAIL:' . $email . ' IDPedido:' . $id_pedido . '', 'BD');
                echo "<script language='JavaScript'> alert('El pedido ha sido reactivado ')
                            location.href = '../AdminReactivarPedidos.php';
                              exit();  
                              </script> ";
            }
        }
    }
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Reactivar pedido. EXCEPTION:' . $e . ' IP:' . $remote_addr . '  Id pedido' . $id_pedido . '', 'BD');
}
?>
