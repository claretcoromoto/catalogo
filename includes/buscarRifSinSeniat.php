<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';
include 'Rif.php';
include 'Seniat.php';
include 'Dao.php';
extract($_REQUEST);


try {
    
    $dao = new Dao();
    $arr_in = array('ci_rif_cliente', 'tx_login', 'id_rol_usr', 'in_status_cliente');
    $columns = $dao->get_commasA($arr_in, false);
    $_select = $dao->get_select('tblsit_usr', $columns, "ci_rif_cliente = '" . $rif . "'", 'ci_rif_cliente, in_status_cliente', ' ON (true)');
    $result = @pg_query($_select);
    $s = new sesion();
    $rol = $s->get('id_rol_usr');
    $email = $s->get('email');
     $remote_addr = $_SERVER['REMOTE_ADDR'];
    while (pg_num_rows($result) == 0) {
        if (isset($email) && ($rol == 1 )) {
            echo "<script language='JavaScript'> alert('El usuario no est\u00e1 registrado')
                    location.href = '../AdminRegistrarUsuarioSinSeniat.php?rif=$rif';
                              exit();  
                              </script> ";
        } else {
            echo "<script language='JavaScript'> //alert('Ud. no est\u00e1 registrado, registrese') 
                    location.href = '../Registrar_Clientes.php?rif=$rif'; 
                             exit(); </script> ";
        }
    }
    $file = pg_fetch_array($result);

    if ($file['ci_rif_cliente'] == $rif && $file['id_rol_usr'] == 4 && $file['in_status_cliente'] == 1) {
        if (isset($email) && ($rol == 1)) {
             $lo->Traza( $email, 'Buscar RIF para registrar usuario. Desde la IP:' . $remote_addr . ' Al usuario (RIF):' . $rif . '', 'BD');
            echo "<script language='JavaScript'>  alert('El usuario est\u00e1 registrado')
                     location.href = '../AdminMenuPrincipal.php';
                     exit();
                     </script> ";
        } else {
            echo "<script language='JavaScript'> alert('Ud. est\u00e1 registrado, puede loguearse') 
                   location.href = '../login.php';
                   exit();
                   </script> ";
        }
    } else if ($file['ci_rif_cliente'] == $rif && $file['id_rol_usr'] == 4 && $file['in_status_cliente'] == -1) {
        if (isset($email) && ($rol == 1)) {
            echo "<script language='JavaScript'>  alert('El usuario est\u00e1 registrado. En estatus -1')
                     location.href = '../AdminMenuPrincipal.php';
                     exit(); 
                     </script> ";
        } else {
            echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian') 
                    location.href = '../index.php'; 
                    exit();
                    </script> ";
        }
    } else if ($file['ci_rif_cliente'] == $rif && $file['id_rol_usr'] == 4 && $file['in_status_cliente'] == 0) {
        if (isset($email) && ($rol == 1 )) {
            echo "<script language='JavaScript'>  alert('El usuario est\u00e1 registrado. En estatus 0')
                    location.href = '../AdminMenuPrincipal.php'; 
                    exit(); 
                    </script> ";
        } else {
            echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian')
                    location.href = '../index.php';  
                    exit();
                    </script> ";
        }
    } elseif ($file['ci_rif_cliente'] == $rif && $file['id_rol_usr'] == 4 && $file['in_status_cliente'] == 2) {
        if (isset($email) && ($rol == 1 )) {
            echo "<script language='JavaScript'>  alert('El usuario est\u00e1 registrado. En estatus 2') 
                    location.href = '../AdminMenuPrincipal.php'; exit();  </script> ";
        } else {
            echo "<script language='JavaScript'> alert('Pendiente por activar en 24 hrs') 
                     location.href = '../index.php';     exit();  </script> ";
        }
    } else if ($file['ci_rif_cliente'] == $rif && $file['id_rol_usr'] == 4 && $file['in_status_cliente'] == -2) {
        if (isset($email) && ($rol == 1 )) {
            echo "<script language='JavaScript'>  alert('El usuario est\u00e1 registrado. En estatus -2')
                     location.href = '../AdminMenuPrincipal.php';
                     exit();  </script> ";
        } else {
            echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian, para su reactivaci\u00f3n')
                       location.href = '../index.php';
                       exit(); </script> ";
        }
    } else if ($file['ci_rif_cliente'] == $rif && $file['id_rol_usr'] == 5) {
        if (isset($email) && ($rol == 1 )) {
            echo "<script language='JavaScript'>  alert('El usuario est\u00e1 registrado como vendedor')
                     location.href = '../AdminMenuPrincipal.php';
                     exit();  </script> ";
        } else {
            echo "<script language='JavaScript'> alert('Puede loguearse')
                       location.href = '../login.php';
                       exit(); </script> ";
        }
    } else if ($file['ci_rif_cliente'] == $rif && ($file['id_rol_usr'] == 2 || $file['id_rol_usr'] == 3)) {
        if (isset($email) && ($rol == 1 )) {
            echo "<script language='JavaScript'>  alert('El usuario est\u00e1 registrado. En perfil de autorizador')
                     location.href = '../AdminMenuPrincipal.php';
                     exit();  </script> ";
        } else {
            echo "<script language='JavaScript'> alert('Puede loguearse')
                       location.href = '../login.php';
                       exit(); </script> ";
        }
    } else {
        if (isset($email) && ($rol == 1 )) {
            echo "<script language='JavaScript'>  alert('Verifique')  
                    location.href = '../AdminPrincipal.php';
                    exit(); </script> ";
        } else {
            echo "<script language='JavaScript'> alert('Verifique, vuelva a intentarlo') 
                    location.href = '../Buscar_Rif.php'; 
                    exit();  </script> ";
        }
    }
} catch (Exception $e) {
    throw new Exception($e);
     $lo->Traza( $email, 'Buscar RIF para registrar usuario. EXCEPTION: ' . $e . '  Desde la IP:' . $remote_addr . ' Al cliente (RIF):' . $rif . '', 'EXCEPTION');
}
?>
