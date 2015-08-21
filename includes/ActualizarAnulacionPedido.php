<?php error_reporting(0);
include 'DaoTercerNivel.php';

include 'sesion.class.php';

$daotercer = new DaoTercerNivel();
extract($_REQUEST);
$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
$idAuto2 = $s->get("id_usr");
//error_reporting(E_ALL);
//ini_set('display_errors', true);
$remote_addr = $_SERVER['REMOTE_ADDR'];
try {
    $sql1 = "SELECT * FROM tblsit_hist_clte WHERE ci_rif_cliente= '" . $rif . "' AND id_motivo_anul=$id_motivo ORDER BY id_hist_clte ASC ";
    $result1 = @pg_query($sql1);
    $file1 = pg_fetch_array($result1);
    $f_operacion = $file1['f_operacion'];
    $statusActual = $file1['id_hist_clte'];
    if (!empty($statusActual)) {
        if (isset($email) && ($rol == 3)) {

            echo "<script language='JavaScript'> alert('El motivo de anulaci\u00d3n ha sido establecido previamente')
              location.href = '../AdminSolPenCliPedidos.php';
              exit();
              </script> ";
        }
    } else if (empty($statusActual)) {

        $sqlDetalle = "SELECT * FROM tblxian_detalle_pedido WHERE id_pedido= $id_pedido";
        $resultDetalle = @pg_query($sqlDetalle);
        if ($row = pg_num_rows($resultDetalle) > 0) {
            while ($value = pg_fetch_array($resultDetalle)) {
                $sqlr = '';
                $sqlr.='(nu_cant_reservada  - ' . $value['in_cantidad'] . ' )';
                $sqlv = '';
                $sqlv.='(nu_disp_valery  + ' . $value['in_cantidad'] . ' )';
                $sqlc = "UPDATE tblxian_cantidad_dispon  SET nu_cant_reservada= $sqlr WHERE cod_repuesto = '" . $value['cod_repuesto'] . "' ";
                $sqlz = "UPDATE tblxian_cantidad_dispon  SET nu_disp_valery= $sqlv WHERE cod_repuesto = '" . $value['cod_repuesto'] . "' ";
                $r = @pg_query($sqlc);
                $s = @pg_query($sqlz);
                $lo->Traza($email, 'SQL:' . $sqlc . ' IP:' . $remote_addr . 'RIF cliente' . $rif. '', 'BD');
                $lo->Traza($email, 'SQL:' . $sqlz . ' IP:' . $remote_addr . 'RIF cliente' . $rif. '', 'BD');
            }
        }

        $fecha = strftime("%Y-%m-%d", time());
        $sqla="UPDATE tblxian_pedido SET id_status_pedido= 3, id_motivo_anul=$id_motivo WHERE ci_rif_cliente = '".$rif."' AND id_pedido=$id_pedido ";
        $result2 = pg_query($sqla);
        $sql3 = "INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr,id_motivo_anul, ci_rif_cliente, id_pedido)"
                . "  VALUES ('" . $fecha . "',1, $idAuto2, $id_motivo, '".$rif."', $id_pedido )";
        $result3 = @pg_query($sql3);
        if (isset($result2) && isset($result3)) { 

            if (isset($email) && $rol == 3) {
                $lo->Traza($email, 'El motivo de anulación pedido exitoso. DATOS: IP:' . $remote_addr . ' SQL:' . $sql3 . ' ', 'BD');
                echo "<script language='JavaScript'> alert('El motivo de anulaci\u00d3n del pedido ha sido establecido ')
                            location.href = '../AdminSolPenCliPedidos.php';
                              exit();  
                              </script> ";
            }
        } else if (!isset($result2) && !isset($result3)) {
            if (isset($email) && $rol == 3) {
                $lo->Traza($email, 'El motivo de anulación pedido fallido. DATOS: IP:' . $remote_addr . ' SQL:' .  $sql3. '', 'BD');
                echo "<script language='JavaScript'> alert('El motivo de anulaci\u00d3n del pedido ha sido establecido ')
                            location.href = '../AdminSolPenCliPedidos.php';
                              exit();  
                              </script> ";
            }
        }
    }
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Anulación pedido. EXCEPTION:' . $e . ' IP:' . $remote_addr . ' RIF del cliente' . $rif . '', 'BD');
}
?>
