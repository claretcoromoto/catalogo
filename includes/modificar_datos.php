<?php

include 'DaoSegNivel.php';

if (isset($_POST["enviar"])) {
extract($_REQUEST);
        $daoseg = new DaoSegNivel();
       
$sqlusr = "SELECT tx_login, id_rol_usr, in_status_usr, in_status_cliente FROM tblsit_usr WHERE tx_login = '" . $email . "'   AND tx_clave = '" . sha1($clavea) . "' ";

    $ru = @pg_query($sqlusr);
    $u = pg_fetch_array($ru);
  if (!($daoseg->selectNumRif($rif)))  {
            echo "<script language='JavaScript'> alert( 'El rif no est\u00e1 registrado en nuestro sistema') 
                          location.href = '../mod_cliente.php'; 
                          exit();
                         </script> ";
        } else if (!($daoseg->selectNumEmail($email)) && !sha1($clavea) == $u['tx_clave']) {
            echo "<script language='JavaScript'> alert( 'El correo electr\u00f3nico y/o clave no est\u00e1n registrado en nuestro sistema') 
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

$sql = "UPDATE tblsit_usr SET nb_usuario = '". $nombreu. "',
                                                 razon_social_cliente='" . $razon . "',
                                                       nb_persona_contacto='" . $contacto . "',
                                                             tx_telf_contacto='" . $telefono . "'
                   WHERE tx_login=  '" . $email . "' AND ci_rif_cliente ='" . $rif . "' ";
          $result=@pg_query($sql);
            if (isset($result)) {
            
              echo "<script language='JavaScript'> alert( 'Datos actualizados exitosamente') 
                          location.href = '../mod_cliente.php'; 
                          exit();
                         </script> ";
            } else if (!isset($sql)){
                echo "<script language='JavaScript'> alert( 'Datos no actualizados') 
                          location.href = '../mod_cliente.php'; 
                          exit();
                         </script> ";
            }
        }
    }
?>
