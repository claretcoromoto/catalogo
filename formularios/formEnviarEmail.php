<?php

class formEnviarEmail {

    function __construct() {
        ;
    }

    function formenviarcorreo($nombre, $pass, $email) {
        echo "Hola, has solicitado tu contraseña, si deseas puedes cambiarla pulsando
                   el siguiente link:<br>
                     http://localhost/importadoraxian21febUbuntu/Resetear_Password.php <br>
                    Nombre:$nombre <br>
                    Email:$email  <br>
                    Password: $pass
                    ";
    }

}

?>
