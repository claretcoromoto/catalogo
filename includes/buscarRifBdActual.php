<?php

include 'ConexionPGSQL.php';
include 'Dao.php';

if (isset($_POST['enviar'])) {

    if (isset($_POST["rif"])) {
        $rifseniat =   strtoupper(trim(htmlentities(strip_tags($_POST['rif']))));
        $dao = new Dao();
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        try {
            $arr_in=array('ci_rif_cliente', 'in_status_cliente');
            $columns=  $dao->get_commasA($arr_in, false);
            $_select = $dao->get_select('tblsit_usr',  $columns , "ci_rif_cliente = '" . $rifseniat . "' ", 'ci_rif_cliente');
            $result = @pg_query($_select);
            $row = pg_num_rows($result);
            $file = pg_fetch_array($result);
            if ($row === 0) {
                 $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $rifseniat. '', 'BD');
                         echo "<script language='JavaScript'>                
                                           location.href = '../AdminRegistrarUsuario.php?rif=$rifseniat';  exit();                                                          
                                        </script> ";
            } else if (isset ($email)  && $file['in_status_cliente'] == 1) {
                $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $rifseniat. '', 'BD');
                echo "<script language='JavaScript'> alert('El cliente  est\u00e1 registrado en la base de datos')                 
                                           location.href = '../AdminBuscarRifBd.php';  exit();                                                          
                                        </script> ";
            } else if (isset ($email)  && $file['in_status_cliente'] == -1) {
                $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $rifseniat. '', 'BD');
                echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian')                 
                                           location.href = '../AdminMenuPrincipal.php';
                                          exit();                                                          
                                        </script> ";
            } else if (isset ($email)  && $file['in_status_cliente'] == 0) {
                $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $rifseniat. '', 'BD');
                echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian')                 
                                           location.href = '../AdminMenuPrincipal.php';    exit();            
                                        </script> ";
            } else if (isset ($email)  && $file['in_status_cliente'] == 2) {
                $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $rifseniat. '', 'BD');
                echo "<script language='JavaScript'> alert('Pendiente por activar en 24 hrs')                 
                                           location.href = '../AdminMenuPrincipal.php';     exit();          
                                        </script> ";
            } else if (isset ($email)  && $file['in_status_cliente'] == -2) {
                $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $rifseniat. '', 'BD');
                echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian, para su reactivaci\u00f3n')                 
                                           location.href = '../AdminMenuPrincipal.php';      exit();           
                                        </script> ";
            } else {
                echo "<script language='JavaScript'> alert('Verifique, vuelva a intentarlo')                 
                                           location.href = '../AdminBuscarRifBd.php';  exit();                                                          
                                        </script> ";
            }
        } catch (Exception $e) {
            throw new Exception($e);
            $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' EXCEPTION:' . $e. '', 'EXCEPTION');
        }
    }
}
?>
