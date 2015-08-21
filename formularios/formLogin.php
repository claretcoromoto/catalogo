<?php 
class formLogin{
    function __construct() {
;
}
function formlogin(){  
    
    
    echo ' 
<div class="content">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">  
                <div class="well login-register">

                    <h5>Autenticación</h5>
                    <hr />

                    <!-- Login form ^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$-->
                    <form  class="form-horizontal"  method="post" action= "includes/Sessiones.php " >
                        <!-- Email -->
                        <div   class="control-group">
                            <label  class="control-label" for="email" >Correo electrónico:</label>
                            <div class="controls">
                                <input  title="Por favor, introduce un email válido" type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                                        name="email" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus required/>
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="control-group">
                            <label class="control-label" for="password">Contraseña:</label>
                            <div class="controls"> <!-- Password pattern="(?=.*[@ # $ % ])(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,12})$"     title="Introduce la contraseña, entre 6 y 12 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres espaciales" Password pattern="(?=.*[@ # $ % ])(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,12})$"-->
                                <input   type="password" class="input-large" id="password" name="password" placeholder="Password"  required/>
                            </div>
                        </div>
                        <!-- Remember me checkbox and sign in button -->

                        <div class="control-group">
                            <div class="controls">
                                <button  type="submit" name="enviar" class="btn btn-danger"  >Enviar</button>
                                <button  type="reset" class="btn btn-danger">Limpiar</button>
                                <a class="btn btn-danger" href="index.php">Cancelar</a>
                                <a class="btn btn-danger" href="Recuperar_Password.php">Olvidé mi contraseña</a>
                                <!--       <button       <a class="btn btn-danger" href="index.php">Cancelar</a></button> -->
                            </div>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>
' ;

}
}
?>