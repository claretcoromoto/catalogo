<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';

extract($_REQUEST);
$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
$idAuto1 = $s->get("id_usr");
$remote_addr = $_SERVER['REMOTE_ADDR'];
try {
    $sql = "SELECT * FROM tblsit_hist_clte WHERE ci_rif_cliente= '" . $rif . "' "
            . " AND in_status_cliente=$sancionar "
            . " ORDER BY id_hist_clte ASC ";
    $result = @pg_query($sql);
    $file = pg_fetch_array($result);
    $f_operacion = $file['f_operacion'];
    if (!isset($file)) {
        $fecha = strftime("%Y-%m-%d", time());
        $rs = pg_query("UPDATE tblsit_usr SET in_status_cliente =0 WHERE ci_rif_cliente = '" . $rif . "' ");
        $in = "INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr, ci_rif_cliente)"
                . "  VALUES ('" . $fecha . "',0, $idAuto1, '" . $rif . "' )";
        $pgq = @pg_query($in);
        if (isset($rs) && isset($pgq)) {

            if (isset($email) && ($rol == 2)) {
                 $lo->Traza('Admin', 'Update exitoso de sancionar cliente.  IP:' . $remote_addr . ' RIF:' . $rif . '', 'BD');
                echo "<script language='JavaScript'> alert('La sanci\u00f3n del cliente ha sido establecida ')
                                        location.href = '../AdminSolPenCli.php';
                                          exit();  
                              </script> ";
            }
        }
    } else {
         $lo->Traza('Admin', 'Update fallido o realizado previamente de sancionar cliente.  IP:' . $remote_addr . ' RIF:' . $rif . '', 'BD');
        echo "<script language='JavaScript'> alert('El motivo de anulaci\u00f3n ha sido establecido previamente')
                                            location.href = '../AdminSolPenCli.php';
                                                      exit();    
                                                      </script> ";
    }
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza('Admin', 'Update sancionar cliente IP:' . $remote_addr . ' CATCH:' . $e . '', 'EXCEPTION');
}
?>
