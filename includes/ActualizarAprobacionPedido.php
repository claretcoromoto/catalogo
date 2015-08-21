<?php include 'sesion.class.php';
      include 'ConexionPGSQL.php';

extract($_REQUEST);
$s = new sesion();
$email = $s->get('email');
$rol = $s->get('id_rol_usr');
$remote_addr = $_SERVER['REMOTE_ADDR'];

try {
   $sqlid = "SELECT nu_factura FROM tblxian_pedido WHERE id_pedido=$id_pedido";
    $result = @pg_query($sqlid);
    $nuFactuta = pg_fetch_array($result);

if (empty($nuFactuta['nu_factura'])) {
 if ($nuFactuta['nu_factura']!== $factura) {
      $sqlDetalle = "SELECT * FROM tblxian_detalle_pedido WHERE id_pedido= $id_pedido";
        $resultDetalle = @pg_query($sqlDetalle);
        if ($row = pg_num_rows($resultDetalle) > 0) {
            while ($value = pg_fetch_array($resultDetalle)) {
                $sqlr = '';
                $sqlr.='(nu_cant_reservada  + ' . $value['in_cantidad'] . ' )';
                $sqlv = '';
                $sqlv.='(nu_disp_valery - ' . $value['in_cantidad'] . ' )';
                 $sqlc = "UPDATE tblxian_cantidad_dispon  SET nu_cant_reservada= $sqlr WHERE cod_repuesto = '" . $value['cod_repuesto'] . "' ";
             $sqlz = "UPDATE tblxian_cantidad_dispon  SET nu_disp_valery= $sqlv WHERE cod_repuesto = '" . $value['cod_repuesto'] . "' ";
                $r = @pg_query($sqlc);
                $s = @pg_query($sqlz);
                $lo->Traza($email, 'SQL:' . $sqlc . ' IP:' . $remote_addr . ' RIF del cliente' . $rif . '', 'BD');
                $lo->Traza($email, 'SQL:' . $sqlz . ' IP:' . $remote_addr . ' RIF del cliente' . $rif . '', 'BD');
                if (!isset($r) && !isset($s)) {
                    $lo->Traza($email, 'Reserva fallida. IP:' . $remote_addr . ' EMAIL:' . $email . '', 'BD');
                    echo "<script language='JavaScript'> alert('No se han podido reservar ') 
                          location.href = '../AdminSolPenCliPedidos.php';  exit();
                            </script> ";
                }
            }
        }
$fecha = strftime("%Y-%m-%d", time());
      $sql = "UPDATE tblxian_pedido SET id_status_pedido=2, nu_factura='" . $factura . "' , f_procesamiento='" . $fecha . "' WHERE ci_rif_cliente = '" . $rif . "' AND id_pedido=$id_pedido ";
        $result2 = @pg_query($sql);
        if (isset($result2)) {
            if (isset($email) && ($rol == 3)) {
                $lo->Traza($email, 'Aprobación de pedido exitoso. DATOS: IP:' . $remote_addr . ' IDPedido:' . $id_pedido . '  FACTURA:' . $factura . ' ', 'BD');
                header("Location:../AdminSolPenCliPedidos.php");
            }
        }
    } else {
              
        echo "<script language='JavaScript'> alert('La factura  existe ') 
                          location.href = '../view_autorii_solicitudes.php';  exit();
                            </script> ";
    }
}else {
              
        echo "<script language='JavaScript'> alert('Por favor, rellene el campo vacio') 
                          location.href = '../view_autorii_solicitudes.php';  exit();
                            </script> ";
}} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza('Autor2', 'Aprobación pedido. EXCEPTION:' . $e . ' IP:' . $remote_addr . ' EMAIL:' . $email . '', 'BD');
}
?>
