<?php include_once "ConexionPGSQL.php";


extract($_REQUEST);
try {
    $sqlusr = "SELECT tx_login, id_rol_usr, in_status_usr, in_status_cliente FROM tblsit_usr WHERE tx_login = '" . $email . "'   AND tx_clave = '" . sha1($password) . "'        GROUP BY id_usr, ci_rif_cliente, tx_login, id_rol_usr, in_status_usr, in_status_cliente  HAVING  id_rol_usr = 1 OR id_rol_usr = 2 OR id_rol_usr = 3 OR id_rol_usr = 4 OR id_rol_usr = 5  ";

    $ru = @pg_query($sqlusr);
    $u = pg_fetch_array($ru);

    $u['tx_login'];
    if (!$email == $u['tx_login'] && !sha1($password) == $u['tx_clave']) {
        echo "<script language='JavaScript'> alert('Verifique el usuario y/o clave, por favor ') 
                          location.href = '../login.php';  exit();
                            </script> ";
    }

    $sql = "SELECT id_usr, ci_rif_cliente, tx_login, tx_clave, id_rol_usr, in_status_usr, in_status_cliente FROM tblsit_usr WHERE tx_login = '" . $email . "' AND tx_clave = '" . sha1($password) . "' GROUP BY id_usr, ci_rif_cliente, tx_login, tx_clave, id_rol_usr, in_status_usr, in_status_cliente HAVING  id_rol_usr = 1 OR id_rol_usr = 2  OR id_rol_usr = 3  OR  id_rol_usr = 4 OR id_rol_usr = 5  ";
    $result = @pg_query($sql);
    $n = pg_num_rows($result);
    if (isset($n) > 0) {
        require_once "sesion.class.php";
        $sesion = new sesion();
        $session = pg_fetch_array($result);

        if ($email == $session['tx_login'] && sha1($password) == $session['tx_clave'] && ($session['id_rol_usr'] == 1 ) && $session['in_status_usr'] == 1) {
            $sesion->set("email", $email);
            $sesion->set("id_usr", $session['id_usr']);
            $sesion->set("id_rol_usr", $session['id_rol_usr']);
            header('Location: ../AdminMenuPrincipal.php');
            $lo->Traza($email, 'Administrador', 'LOGIN');
        } else if ($email == $session['tx_login'] && sha1($password) === $session['tx_clave'] && $session['id_rol_usr'] == 2 && $session['in_status_usr'] == 1) {
            $sesion->set("email", $email);
            $sesion->set("id_usr", $session['id_usr']);
            $sesion->set("id_rol_usr", $session['id_rol_usr']);
            header('Location: ../view_autori_cliente.php');
            $lo->Traza($email, 'Autorizador I (clientes)', 'LOGIN');
        } else if ($email == $session['tx_login'] && sha1($password) === $session['tx_clave'] && ($session['id_rol_usr'] == 3) && $session['in_status_usr'] == 1) {
            $sesion->set("email", $email);
            $sesion->set("id_usr", $session['id_usr']);
            $sesion->set("id_rol_usr", $session['id_rol_usr']);
            header('Location: ../view_autorii_solicitudes.php');
            $lo->Traza($email, 'Autorizador de pedido', 'LOGIN');
        } else if ($email == $session['tx_login'] && sha1($password) === $session['tx_clave'] && $session['id_rol_usr'] == 4 && $session['in_status_usr'] == 1 && $session['in_status_cliente'] == 1) {
            $sesion->set("email", $email);
            $sesion->set("id_usr", $session['id_usr']);
            $sesion->set("id_rol_usr", $session['id_rol_usr']);
            $sesion->set("rif", $session['ci_rif_cliente']);
            header('Location:../catalogo_final.php');
            $lo->Traza($email, 'Cliente en estatus aprobado', 'LOGIN');
        } else if ($email == $session['tx_login'] && sha1($password) === $session['tx_clave'] && $session['id_rol_usr'] == 4 && $session['in_status_usr'] == 1 && $session['in_status_cliente'] == 2) {

            echo "<script language='JavaScript'> alert('Espere un m\u00e1ximo de 24 horas para la activaci\u00f3n del registro') 
                          location.href='../login.php';  
                          exit();
                            </script> ";
            $lo->Traza($email, 'Cliente en estatus pendiente', 'LOGIN');
        } else if ($email === $session['tx_login'] && sha1($password) === $session['tx_clave'] && $session['id_rol_usr'] == 4 && $session['in_status_usr'] == 1 && $session['in_status_cliente'] == -1) {
            $sesion->set("email", $email); // alert('Comun\u00edquese con su vendedor de confianza actualizar')
            $sesion->set("rif", $session['ci_rif_cliente']);

            echo "<script language='JavaScript'   > 
                    var com=confirm('Si desea actualizar sus datos, pulse Aceptar sino  Cancelar');
                    if(com==true){
                    location.href ='../Actualizar_Clientes.php?rif=$session[ci_rif_cliente]';
                    }else{
                     location.href ='../index.php';
                    
                   }
                     exit();
                            </script> ";
            $lo->Traza($email, 'Entrando a actualizar cliente', 'LOGIN');
        } else if ($email == $session['tx_login'] && sha1($password) == $session['tx_clave'] && $session['id_rol_usr'] == 4 && $session['in_status_usr'] == 1 && $session['in_status_cliente'] == 0) {

            echo "<script language='JavaScript'> alert('Comun\u00edquese con su vendedor de confianza') 
                          location.href = '../login.php';  exit();
                            </script> ";
            $lo->Traza($email, 'Cliente en estatus 0', 'LOGIN');
        } else if ($email == $session['tx_login'] && sha1($password) == $session['tx_clave'] && $session['id_rol_usr'] == 4 && $session['in_status_usr'] == 1 && $session['in_status_cliente'] == -2) {

            echo "<script language='JavaScript'> alert('Comun\u00edquese con su vendedor de confianza') 
                          location.href = '../login.php';  exit();
                            </script> ";
            $lo->Traza($email, 'Cliente en estatus -2', 'LOGIN');
        } else {
            if ($email == $session['tx_login'] && sha1($password) == $session['tx_clave'] && $session['id_rol_usr'] == 5 && $session['in_status_usr'] == 1) {
                $sesion->set("email", $email);
                $sesion->set("id_usr", $session['id_usr']);
                $sesion->set("id_rol_usr", $session['id_rol_usr']);
                header('Location: ../catalogo_final.php');
                $lo->Traza($email, 'Vendedor ', 'LOGIN');
            }
        }
// fin de if else de vendedores
    } else {
        echo "<script language='JavaScript'> alert('Ud. no est\u00e1 registrado en nuestro sistema. Reg\u00edstrese.') 
                      location.href = '../Buscar_Rif.php';  exit();
                          </script> ";
        return 0;
    }
} catch (Exception $e) {
    $this->SetError($e->getMessage());
    if ($this->exceptions) {
        throw $e;
        $lo->Traza($email, 'SQL' . $sql, 'Ocurrió exception:   ' . $e);
    }
}

?>