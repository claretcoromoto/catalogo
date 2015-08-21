<?php
include 'ConexionPGSQL.php';
require_once '../Correo/EnviarEmail.php';

if (isset($_POST["enviar"])) {
    extract($_REQUEST);
  
   
 
      $sql="SELECT nb_usuario, tx_clave FROM tblsit_usr  WHERE  tx_login ='".$email."' ";
       $result= @pg_query($sql);
       $numrow= pg_num_rows($result);
       if (isset($numrow))
        $file = pg_fetch_array($result);
        $n= $file['nb_usuario'];
     
        if(strcmp( $file['tx_clave'], sha1($passpro))==0){
            if (strcmp($password,$repassword)==0) {
            $sql = pg_query("UPDATE tblsit_usr SET tx_clave = '" . sha1($password) . "' WHERE tx_login=  '" . $email . "' ");
                if (isset($sql)) {
                   

                    $body = "
                         
                  <br>
                   Hola! $n
                  <p> Su Contraseña ha sido cambiada satisfactoriamente.
                    De igual forma le recordamos sus nuevos datos de acceso a la aplicación:<br>
                    Username: $email <br>
                    Nueva Clave= '".$_POST['password']."'
                  </p>  
                  
                   <br>
                   <br>
                     <hr>
                 <address>
                Importadora Xian C.A.<br>
                 Av. Boulevar Naiguatá, E/S Tanaguarena Caribe<br>
                 Caraballeda, Edo. Vargas – Venezuela<br>
                 <abbr>Teléfonos:</abbr> +58212 353.42.77 | 212 353.42.81 | 212 353.38.84
                 </address>
                             
                             ";
					 //| To  |                host          |  port |          FromMail            |   password   |        FromUser         |           Subject|	         | Body | 	
smtpmailer($email, 'mail.ambientedeprueba.com', '465', 'soporte@ambientedeprueba.com', 'Soporte2014', 'Importadora Xian, C.A', 'Confirmación de contraseña', $body);
                } else {
                    echo "<script language='JavaScript'> alert('Error al actualizar contrase\u00f1a') 
                          location.href = '../Recuperar_Password.php';  exit();
                            </script> ";
                }
            } else {
                echo "<script language='JavaScript'> alert('Verifique que coincidan') 
                          location.href = '../Recuperar_Password.php';  exit();
                            </script> ";
            }
        } else {

            echo "<script language='JavaScript' charset=UTF-8> alert('Clave provisional inv\u00e1lida') 
                          location.href = '../Recuperar_Password.php';  exit();
                            </script> ";
        }
    }

 
    
    

?>
