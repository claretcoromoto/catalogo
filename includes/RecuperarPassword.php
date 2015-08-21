<?php

include 'DaoSegNivel.php';
require_once '../Correo/EnviarEmail.php';

extract($_REQUEST);
try {
    $daoseg = new DaoSegNivel();

    $remote_addr = $_SERVER['REMOTE_ADDR'];
    if (($daoseg->selectNumRif($rif)<0)) {
        echo "<script language='JavaScript'> alert( 'El rif no est\u00e1 registrado en nuestro sistema') 
                          location.href = '../index.php'; 
                          exit();
                         </script> ";
    } else if (($daoseg->selectNumEmail($email))<0) {
        echo "<script language='JavaScript'> alert( 'El correo electr\u00f3nico no est\u00e1 registrado en nuestro sistema') 
                          location.href = '../index.php'; 
                          exit();
                         </script> ";
    } else if (($daoseg->selectPre($preg))<0) {
        echo "<script language='JavaScript'> alert( 'La pregunta segura coincide') 
                          location.href = '../index.php';  exit();
                            </script> ";
    } else if (($daoseg->selectResp($resp)<0)) {
        echo "<script language='JavaScript'> alert( 'La respuesta no coincide') 
                          location.href = '../index.php';  exit();
                            </script> ";
    } else {

        $aleatoria = rand(100000, 999000);
        $result = $daoseg->actualizarClaveAleatoria($rif, $aleatoria);
        $file = $daoseg->selectUsr($email, $rif);
        $n = $file['nb_usuario'];
        if (isset($result)) {
          $lo->Traza($email, 'Clave aleatoria exitosa.  IP:' . $remote_addr . ' EMAIL:' . $email . '', 'BD');
          $body = "
           
                  <br>
                   Hola!  $n <br>
                Has solicitado recuperar tu contraseña, pulsa <br>
                el siguiente link:
                    <a href='http://ambientedeprueba.com/20141112-xian/Resetear_Password.php' target='_parent'>Restablezca su password</a> 
                   <br>  Recuerda introducir los siguientes datos para el restablecimiento de la contraseña:
                   <br> Username:  $email 
                   <br> Clave provisional= $aleatoria  <br>
                   <hr>
             
                 <address>
                 <i ></i>Importadora Xian C.A.</span><br>
                 Av. Boulevar Naiguatá, E/S Tanaguarena Caribe<br>
                 Caraballeda, Edo. Vargas – Venezuela<br>
                 <abbr>Teléfonos:</abbr> +58212 353.42.77 | 212 353.42.81 | 212 353.38.84
                 </address>
                      
                     ";
            //| To  |                host          |  port |          FromMail            |   password   |        FromUser         |           Subject|	         | Body | 	
            smtpmailer($email, 'mail.ambientedeprueba.com', '465', 'soporte@ambientedeprueba.com', 'Soporte2014', 'Importadora Xian, C.A', 'Enviando contraseña provisional', $body);
        } else if (!isset($result)) {
            echo "<script language='JavaScript'> alert( 'Fallo en el envio') 
                          location.href = '../login.php';  exit();
                            </script> ";
           $lo->Traza($email, 'Clave aleatoria fallida.  IP:' . $remote_addr . ' EMAIL:' . $email . '', 'BD');
        }
    }
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Recuperación de contraseña. IP:' . $remote_addr . ' CATCH:' . $e . '', 'EXCEPTION');
}
?>
                 

