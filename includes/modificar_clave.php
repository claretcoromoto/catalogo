<?php

include 'DaoSegNivel.php';


extract($_REQUEST);

$daoseg = new DaoSegNivel();
if (!($daoseg->selectNumRif($rif))) {
    echo "<script language='JavaScript'> alert( 'El rif no est\u00e1 registrado en nuestro sistema') 
                          location.href = '../mod_cliente.php'; 
                          exit();
                         </script> ";
} else if (!($daoseg->selectNumEmail($email))) {
    echo "<script language='JavaScript'> alert( 'El correo electr\u00f3nico no est\u00e1 registrado en nuestro sistema') 
                          location.href = '../mod_cliente.php'; 
                          exit();
                         </script> ";
} else if (!($daoseg->selectPre($pre))) {
    echo "<script language='JavaScript'> alert( 'La pregunta segura no coincide') 
                           location.href = '../mod_cliente.php';   exit();
                            </script> ";
} else if (!($daoseg->selectResp($resp))) {
    echo "<script language='JavaScript'> alert( 'La respuesta no coincide') 
                          location.href = '../mod_cliente.php';   exit();
                            </script> ";
} else {
    try {

        $sqlre = "SELECT nb_usuario, ci_rif_cliente, tx_clave FROM tblsit_usr  WHERE  tx_login ='" . $email . "' AND ci_rif_cliente='" . $rif . "' AND tx_resp_segur='" . $resp . "'";
        $result = @pg_query($sqlre);
        $rowresp = pg_num_rows($result);
        $lo->Traza($email, 'Cambio de contrase\u00f1a->SQL:' . $sqlre, 'PERFIL');
        if ($rowresp > 0) {
            $file = pg_fetch_array($result);
            $n = $file['nb_usuario'];
            $pas = sha1($clavea);
            if (strcmp($file['tx_clave'], $pas) == 0) {
                if (strcmp($password, $repassword) == 0) {
                    $sql = "UPDATE tblsit_usr SET tx_clave = '" . sha1($password) . "' WHERE tx_login=  '" . $email . "' AND ci_rif_cliente ='" . $rif . "' ";
                    $result = @pg_query($sql);
                    $lo->Traza($email, 'Cambio de contrase\u00f1a->SQL:' . $sqlre, 'PERFIL');
                    if (isset($result)) {
                        echo "<script language='JavaScript'> alert( 'Contrase\u00f1a actualizada exitosamente') 
                          location.href = '../mod_cliente.php'; 
                          exit();
                         </script> ";
                    }
                } else {
                    echo "<script language='JavaScript'> alert( 'La nueva contrase\u00f1a no se corresponde') 
                          location.href = '../mod_cliente.php'; 
                          exit();
                         </script> ";
                }
            } else {
                echo "<script language='JavaScript'> alert( 'La contrase\u00f1a actual no se corresponde') 
                          location.href = '../mod_cliente.php'; 
                          exit();
                         </script> ";
            }
        } else {
            echo "<script language='JavaScript'> alert( 'La respuesta segura es inválida') 
                          location.href = '../mod_cliente.php'; 
                          exit();
                         </script> ";
        }
    } catch (Exception $e) {
        $this->SetError($e->getMessage());
        if ($this->exceptions) {
            throw $e;
            $lo->Traza($email, 'SQL:  ->' . $sqlre . '   o   SQL2: ' . $sql, 'Ocurrió exception:   ' . $e);
        }
    }
}
?>
