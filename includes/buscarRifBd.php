<?php

require_once "sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$rol = $sesion->get('id_rol_usr');

include 'ConexionPGSQL.php';
include 'Dao.php';

if (isset($_GET['enviar'])) {

    extract($_REQUEST);


    $dao = new Dao();
    try {
        $upper = strtoupper($rif);
        $arr_in = array('ci_rif_cliente', 'in_status_cliente');
        $columns = $dao->get_commasA($arr_in, false);
        $_select = $dao->get_select('tblsit_usr', $columns, "ci_rif_cliente = '" . $upper . "' ", 'ci_rif_cliente');
        $result = @pg_query($_select);
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $file = pg_fetch_array($result);
        if ($row = pg_num_rows($result) ===0) {
            if (isset($email) && ($rol == 5)) {
                $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $upper . '', 'BD');
                header('Location:../Registrar_Clientes_Ven.php?rif=' . $rif . ' ');
        }  
            exit();
        } 
        if ($upper == $file['ci_rif_cliente'] && $file['in_status_cliente'] == 1) {
            $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $upper . '', 'BD');
            echo "<script language='JavaScript'> alert('El cliente est\u00e1 registrado en la base de datos')                 
                                           location.href = '../Buscar_Rif_Cliente.php';  exit();                                                          
                                        </script> ";
        } else if ($upper == $file['ci_rif_cliente'] && $file['in_status_cliente'] == -1) {
            $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $upper . '', 'BD');
            echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian')                 
                                          location.href = '../Buscar_Rif_Cliente.php';  exit();     
                                          exit();                                                          
                                        </script> ";
        } else if ($upper == $file['ci_rif_cliente'] && $file['in_status_cliente'] == 0) {
            $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $upper . '', 'BD');
            echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian')                 
                                           location.href = '../Buscar_Rif_Cliente.php';  exit();             
                                        </script> ";
        } else if ($upper == $file['ci_rif_cliente'] && $file['in_status_cliente'] == 2) {
            $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $upper . '', 'BD');
            echo "<script language='JavaScript'> alert('Pendiente por activar en 24 hrs')                 
                                         location.href = '../Buscar_Rif_Cliente.php';  exit();            
                                        </script> ";
        } else if ($upper == $file['ci_rif_cliente'] && $file['in_status_cliente'] == -2) {
            $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $upper . '', 'BD');
            echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian, para su reactivaci\u00f3n')                 
                                          location.href = '../Buscar_Rif_Cliente.php';  exit();               
                                        </script> ";
        } else {
            echo "<script language='JavaScript'> alert('Verifique, vuelva a intentarlo')                 
                                           location.href = '../Buscar_Rif_Cliente.php';  exit();                                                          
                                        </script> ";
        }
    } catch (Exception $e) {
        throw new Exception($e);
        $lo->Traza($email, 'Buscar RIF.  IP:' . $remote_addr . ' RIF:' . $upper . '', 'BD');
    }
}
?>
