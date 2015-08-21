<?php include 'sesion.class.php';
      include 'ConexionPGSQL.php';

extract($_REQUEST);
$s = new sesion();
$rol = $s->get('id_rol_usr');
$email = $s->get('email');
$idAuto1 = $s->get("id_usr");
  $remote_addr = $_SERVER['REMOTE_ADDR'];
try {
            $sql1 = "SELECT * FROM tblsit_hist_clte WHERE ci_rif_cliente= '" . $rif . "' AND id_motivo_anul=$id_motivo ORDER BY id_hist_clte ASC ";
            $result1 = @pg_query($sql1);
            $file1 = pg_fetch_array($result1);
            $f_operacion = $file1['f_operacion'];
            $statusActual = $file1['in_status_cliente'];
                if (isset($file1)) {
                    if (isset($email) && ($rol == 2)) {
                       $lo->Traza($email ,  'El motivo de anulación ha sido establecido en fecha: '.$f_operacion.'  DATOS->IP:'. $remote_addr.' ', 'BD');
                       echo "<script language='JavaScript'> alert('El motivo de anulaci\u00f3n ha sido establecido previamente ')
                                location.href = '../AdminSolPenCli.php';
                                          exit();  
                                          </script> ";
                    }
    } else {
                $fecha = strftime("%Y-%m-%d", time());
                $result2 = pg_query("UPDATE tblsit_usr SET in_status_cliente = -1 WHERE ci_rif_cliente = '" . $rif . "' ");
                $sql3 = "INSERT INTO tblsit_hist_clte (f_operacion, in_status_cliente, id_usr, ci_rif_cliente)"
                        . "  VALUES ('" . $fecha . "', -1, $idAuto1, '" . $rif . "' )";
                $result3 = @pg_query($sql3);
                if (isset($result2) && isset($result3)) {
                    if (isset($email) && ($rol == 2)) {
                         $lo->Traza($email,  'El motivo de anulación cliente exitoso.  IP:'. $remote_addr.' ' , 'BD');
                          echo "<script language='JavaScript'> alert('El motivo de anulaci\u00d3n del cliente ha sido establecido ')
                            location.href = '../AdminSolPenCli.php';
                              exit();  
                              </script> ";
            }
        }else if (!isset($result2) && !isset($result3)) {

                    if (isset($email) && ($rol == 2)) {
                         $lo->Traza($email,  'El motivo de anulación cliente fallido.  IP:'. $remote_addr.' '  , 'BD');
                          echo "<script language='JavaScript'> alert('El motivo de anulaci\u00d3n del cliente ha sido establecido ')
                            location.href = '../AdminSolPenCli.php';
                              exit();  
                              </script> ";
            }
        }
        
           
    }
} catch (Exception $e) {
    throw new Exception($e);
     $lo->Traza($email,  'Anulación cliente. EXCEPTION:'. $e.' IP:'. $remote_addr.' SQL:'.$sql3 .''  , 'BD');
}
?>
