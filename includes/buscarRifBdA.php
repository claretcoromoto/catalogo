<?php include 'sesion.class.php';
include 'ConexionPGSQL.php';
include 'Rif.php';
include 'Seniat.php';
include 'Dao.php';
extract($_REQUEST);
       
        $dao = new Dao();
        try {
            $arr_in = array('ci_rif_cliente', 'tx_login','id_rol_usr', 'in_status_cliente');
            $columns = $dao->get_commasA($arr_in, false);
            $rifi=  strtoupper($rif);
            $_select = $dao->get_select('tblsit_usr', $columns, "ci_rif_cliente = '" . $rifi. "'", 'ci_rif_cliente, in_status_cliente', ' ON (true)');
            $result = @pg_query($_select);
            $s = new sesion();
               $rol = $s->get('id_rol_usr');
              $email = $s->get('email');
               $remote_addr = $_SERVER['REMOTE_ADDR'];
           while(pg_num_rows($result)==0) {
                if (isset($email) && ($rol == 1 )) {
                        header('Location:../AdminRegistrarUsuario.php?rif='.$rifi.'');
                 
                } 
            }
            $file = pg_fetch_array($result);
          
            if ($file['ci_rif_cliente'] == $rifi && $file['id_rol_usr'] == 1) {
               if (isset($email) && ($rol == 1 )) {
                       $lo->Traza( $email, 'Buscar RIF para actualizar datos de usuario. Desde la IP:' . $remote_addr . ' Al cliente (RIF):' . $rifi . '', 'BD');
                   header('Location:../AdminActualizarUsuario.php?rif='.$rifi.'');
                   
                } 
            } else  if ($file['ci_rif_cliente'] == $rifi && $file['id_rol_usr'] == 2) {
               if (isset($email) && ($rol == 1 )) {
                       $lo->Traza( $email, 'Buscar RIF para actualizar datos de usuario. Desde la IP:' . $remote_addr . ' Al cliente (RIF):' . $rifi . '', 'BD');
                   header('Location:../AdminActualizarUsuario.php?rif='.$rifi.'');
                   
                } 
            } else  if ($file['ci_rif_cliente'] == $rifi && $file['id_rol_usr'] == 3) {
               if (isset($email) && ($rol == 1 )) {
                       $lo->Traza( $email, 'Buscar RIF para actualizar datos de usuario. Desde la IP:' . $remote_addr . ' Al cliente (RIF):' . $rifi . '', 'BD');
                   header('Location:../AdminActualizarUsuario.php?rif='.$rifi.'');
                   
                } 
            } else  if ($file['ci_rif_cliente'] == $rifi && $file['id_rol_usr'] == 4) {
               if (isset($email) && ($rol == 1 )) {
                       $lo->Traza( $email, 'Buscar RIF para actualizar datos de usuario. Desde la IP:' . $remote_addr . ' Al cliente (RIF):' . $rifi . '', 'BD');
                   header('Location:../AdminActualizarUsuario.php?rif='.$rifi.'');
                   
                } 
            } else  if ($file['ci_rif_cliente'] == $rifi && $file['id_rol_usr'] == 5) {
               if (isset($email) && ($rol == 1 )) {
                       $lo->Traza( $email, 'Buscar RIF para actualizar datos de usuario. Desde la IP:' . $remote_addr . ' Al cliente (RIF):' . $rifi . '', 'BD');
                   header('Location:../AdminActualizarUsuario.php?rif='.$rifi.'');
                   
                } 
            }  else {
               if (isset($email) && ($rol == 1 )) {
                    echo "<script language='JavaScript'>  alert('Verifique')  
                    location.href = '../AdminMenuPrincipal.php';
                    exit(); </script> ";
                } 
            }
             } catch (Exception $e) {
            throw new Exception($e);
              $lo->Traza( $email, 'Buscar RIF para registrar usuario. EXCEPTION: ' . $e . '  Desde la IP:' . $remote_addr . ' Al cliente (RIF):' . $rif . '', 'EXCEPTION');
        }
    
?>
