<?php include 'sesion.class.php';
include 'ConexionPGSQL.php';
include 'Dao.php';


extract($_REQUEST);
$s = new sesion();
        $rol = $s->get('id_rol_usr');
        $email = $s->get('email'); $dao = new Dao();
    try {
       
        $arr_in = array('ci_rif_cliente', 'tx_login', 'id_rol_usr');
        $columns = $dao->get_commasA($arr_in, false);
   $_select = $dao->get_select('tblsit_usr', $columns, "ci_rif_cliente = '" . strtoupper($rif). "'", 'id_rol_usr');
        $result = @pg_query($_select);
        $remote_addr = $_SERVER['REMOTE_ADDR'];
        while (pg_num_rows($result) > 0) {  
            if (isset($email) && ($rol == 1 )) {
                       header("Location:../AdminResetearContrasena.php?rif=$rif");
                         
            } else {
               header("Location: ../AdminRegistrarUsuario.php?rif=$rif");
            }
        }
          
    } catch (Exception $e) {
        throw new Exception($e);
        $lo->Traza($email, 'Buscar RIF resetear clave. Exception:' . $e . ' IP:' . $remote_addr . '', 'EXCEPTION al RIF:'.$rif );
    }


















































?>
