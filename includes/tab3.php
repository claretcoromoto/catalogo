<?php

class tab3{
    
    
    function __construct() {
        ;
    }
    function tabs3($rif, $email){
        echo '
                               
                                <div class="well login-register">
                                 <form class="form-horizontal"  >
                                        <!-- RIF -->
                                        <div class="control-group">
                                            <label class="control-label" for="rif">RIF:</label>
                                            <div class="controls">
                                                <input type="text" readonly title="RIF" class="input-large" placeholder="V106128118" name="rif" id="nombre"  value="'.$rif.'"autofocus />
                                            </div>
                                        </div>   
                                        <!-- email -->
                                        <div class="control-group">
                                            <label class="control-label" for="rif">Correo electrónico:</label>
                                            <div class="controls">
                                                <input type="text" readonly title="username" class="input-large" placeholder="V106128118" name="rif" id="nombre"  value="'.$email.'"autofocus />
                                            </div>
                                        </div>  
                                        </form>
                                       <form  method="post" onsubmit="return checkSubmit();" action="includes/RegistrarDirecciondespacho.php" >
                                        <!-- Direcciones-->
                                         <fieldset align="center">
                                      
                                        <!-- Dirección -->
                                        <div class="control-group">  <legend class="btn btn-danger ">Localización</legend> 
                                            <label class="control-label" for="direccion">Dirección de despacho:</label>
                                            <div class="controls">
                                                <p><textarea rows="2" cols="80"   name="direccion" placeholder="Av. Boulevar Naiguatá, E/S Tanaguarena Caribe"  required ></textarea></p>
                                            </div>
                                        </div> 
                                   


                                        <!-- Buttons <div class="form-actions">-->
                                        <div class="form-actions">
                                            <!-- Buttons -->
                                            <button class="btn btn-danger" type="submit"  name="enviar" class="btn">Registrar</button>
                                          <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                            <a class="btn btn-danger" href="catalogo_final.php">Cancelar</a>

                                        </div> 
                                        </fieldset>
                                    </form>
                                    <label>Sugerencia: </label> Actualice su dirección fiscal.
                                </div>
                           ';
    }
    
}

?>