<?php

include 'DaoSegNivel.php';

if (isset($_POST["enviar"])) {


    if (isset($_POST["rol"]) && isset($_POST['email']) && isset($_POST['preguntaseg']) && isset($_POST['respuestaseg'])) {
        $daoseg = new DaoSegNivel();
        $rol= strtoupper(trim(htmlentities(strip_tags($_POST['rol']))));
        $email = strtolower(trim(htmlentities(strip_tags($_POST['email']))));
        $pre = trim($_POST['preguntaseg']);
        $resp = trim(htmlentities(strip_tags($_POST['respuestaseg'])));
        $passant = trim(htmlentities(strip_tags($_POST['clavea'])));
        $password = trim(htmlentities(strip_tags($_POST['password'])));
        $repassword = trim(htmlentities(strip_tags($_POST['repassword'])));

     if (!($daoseg->selectNumEmailV($passant ,$email))) {
            echo "<script language='JavaScript'> alert( 'La clave es incorrecta') 
                          location.href = '../mod_vendedor.php'; 
                          exit();
                         </script> ";
        } else if (!($daoseg->selectPreV($pre))) {
            echo "<script language='JavaScript'> alert( 'La pregunta segura no coincide') 
                              location.href = '../mod_vendedor.php';   exit();
                            </script> ";
        } else if (!($daoseg->selectRespV($resp))) {
            echo "<script language='JavaScript'> alert( 'La respuesta no coincide') 
                               location.href = '../mod_vendedor.php';   exit();
                            </script> ";
        } else {


            $sqlre = "SELECT nb_usuario, ci_rif_cliente, tx_clave, id_rol_usr FROM tblsit_usr  WHERE  tx_login ='" . $email . "' AND id_rol_usr='" . $rol . "' AND tx_resp_segur='" . $resp . "'";
            $result = @pg_query($sqlre);
            $rowresp = pg_num_rows($result);
            if ($rowresp > 0) {
                $file = pg_fetch_array($result);
                $n = $file['nb_usuario'];

                if (strcmp($file['tx_clave'], sha1($passant)) == 0) {
                    if (strcmp($password, $repassword) == 0) {
                        $sql = @pg_query("UPDATE tblsit_usr SET tx_clave = '" . sha1($password) . "' WHERE tx_login=  '" . $email . "' AND id_rol_usr='" . $rol . "' ");
                        if (isset($sql)) {
                            echo "<script language='JavaScript'> alert( 'Contrase\u00f1a actualizada exitosamente') 
                               location.href = '../mod_vendedor.php'; 
                          exit();
                         </script> ";
                        }
                    } else {
                        echo "<script language='JavaScript'> alert( 'La nueva contrase\u00f1a no se corresponde') 
                               location.href = '../mod_vendedor.php'; 
                          exit();
                         </script> ";
                    }
                } else {
                    echo "<script language='JavaScript'> alert( 'La contrase\u00f1a actual no se corresponde') 
                                location.href = '../mod_vendedor.php'; 
                          exit();
                         </script> ";
                }
            } else {
                echo "<script language='JavaScript'> alert( 'La respuesta segura es inválida') 
                               location.href = '../mod_vendedor.php';  
                          exit();
                         </script> ";
            }
        }
    }
    
}
?>
