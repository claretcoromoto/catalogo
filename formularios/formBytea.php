<?php
    

class formLogin {

    function _construct() {
        
    }
   
    
    function login() {
      
       
        echo '
<div class="content">

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">  
                   <div class="well login-register">
                  
                   <h5>Loguearse</h5>
                   <hr />

                    <!-- Login form -->
                    <form class="form-horizontal"  method="post" action= "'.$_SERVER['PHP_SELF'].'" >
                      <!-- Email -->
                      <div class="control-group">
                        <label class="control-label" for="email" >Correo Electrónico:</label>
                        <div class="controls">
                          <input type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                          name="email" pattern="^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" autofocus required/>
                          </div>
                      </div>
                      <!-- Password -->
                      <div class="control-group">
                        <label class="control-label" for="password">Contraseña:</label>
                        <div class="controls">
                            <input type="password" class="input-large" id="password" name="password" placeholder="Password" required>
                        </div>
                      </div>
                      <!-- Remember me checkbox and sign in button -->
                      <div class="control-group">
                        <div class="controls">
                          <label class="checkbox">
                            <input type="checkbox"> Recuerdame
                          </label>
                          <br>
                          <button type="submit" name="enviar" class="btn">Enviar</button>
                          <button type="reset" class="btn">Limpiar</button>
                        </div>
                      </div>
                    </form>
                   </div>
      </div>
    </div>
  </div>

</div>';
    }

}

?>
