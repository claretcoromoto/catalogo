<?php

class tab2{
    
    
    function __construct() {
        ;
    }
    function tabs2($rif, $email){
        
        
        echo ' 
                      <div class="well login-register">
                                    <form class="form-horizontal"  onsubmit="return checkSubmit();" method="post" action="includes/modificar_clave.php" >
                                      <!-- RIF -->
                                        <div class="control-group">
                                            <label class="control-label" for="rif">RIF:</label>
                                            <div class="controls">
                                                <input type="text" readonly title="RIF" class="input-large" placeholder="V106128118" name="rif" id="rif"  value="'.$rif.'" autofocus />
                                            </div>
                                        </div>   
                                        <!-- email -->
                                        <div class="control-group">
                                            <label class="control-label" for="rif">Correo electrónico:</label>
                                            <div class="controls">
                                                <input type="text" readonly title="Usuario o username" class="input-large" placeholder="V106128118" name="email" id="email"  value="'.$email.'" autofocus />
                                            </div>
                                        </div> 
                                        <fieldset>
                                             <div class="control-group"><legend  class="btn btn-danger " >Preguntas de seguridad</legend> 
                                                <label class="control-label" for="preguntaseg">Pregunta segura</label>
                                                <div class="controls">
                                                    <select name="pre" id="preguntaseg"  required>
                                                        <option> ¿Cuál es mi mascota preferida?</option>
                                                        <option> ¿Cuál es el nombre de mi mascota preferida?</option>
                                                        <option> ¿Cuál es el nombre de mi restaurant preferido?</option>
                                                        <option> ¿Dónde nació mi mamá?</option>
                                                        <option> ¿Dónde nació mi papá?</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <!-- Respuesta segura-->
                                            <div class="control-group">
                                                <label class="control-label" for="respuestaseg">Respuesta segura:</label>
                                                <div class="controls">
                                                    <input type="text" autocomplete class="input-large" id="respuestaseg" name="resp" required >
                                                </div>
                                            </div> 
                                            <div class="control-group">
                                                <label class="control-label" for="rif">Contraseña actual</label>
                                                <div class="controls">
                                                    <input type="password" min="6" max="12" maxlength="12"  title="Por favor, introduzca la contraseña antigua" class="input-large" placeholder="**********"  name="clavea" id="clavea"  required autofocus />
                                                </div>
                                            </div> 
                                        </fieldset>
                                        <fieldset>
                                       <!-- Password -->
                                            <div class="control-group"><legend  class="btn btn-danger " >Actualizar contraseña</legend> 
                                                <label class="control-label" for="password">Nueva contraseña:</label>
                                                <div class="controls">
                                                    <input type="password" min="6" max="12" maxlength="12"  title="Por favor, introduzca la nueva contraseña " class="input-large" id="password" placeholder="**********" name="password"  required>
                                                </div>
                                            </div>
                                            <!-- Password -->
                                            <div class="control-group">
                                                <label class="control-label" for="password">Confirmar contraseña:</label>
                                                <div class="controls">
                                                    <input type="password"  min="6" max="12" maxlength="12" title="Por favor, confirme la nueva contraseña " class="input-large" id="repassword" name="repassword" placeholder="**********" required>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!-- Buttons <div class="form-actions">-->
                                        <div class="form-actions">
                                            <!-- Buttons -->
                                            <button class="btn btn-danger" type="submit" >Modificar</button>
                                            <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                            <a class="btn btn-danger" href="catalogo_final.php">Cancelar</a>
                                        </div>
                                    </form>
                                </div>
                           ';
    }
    
}

?>