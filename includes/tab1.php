<?php

class tab1{
    
    
    function __construct() {
        ;
    }
    function tabs1($rif, $email, $nombreu,$razon, $persona, $contacto){
        echo ' 
                   <!-- Content -->
                                
                                      <div class="well login-register">
                                    <form class="form-horizontal"  method="post" action="includes/modificar_datos.php" >
                                        <!-- RIF -->
                                        <div class="control-group">
                                            <label class="control-label" for="rif">RIF:</label>
                                            <div class="controls">
                                                <input type="text" readonly title="RIF" class="input-large" placeholder="V106128118" name="rif" id="rif"  value="'.$rif.'"autofocus />
                                            </div>
                                        </div>   
                                        <!-- email -->
                                        <div class="control-group">
                                            <label class="control-label" for="rif">Correo electrónico:</label>
                                            <div class="controls">
                                                <input type="text" readonly title="username" class="input-large" placeholder="V106128118" name="email" id="email"  value="'.$email.'" autofocus />
                                            </div>
                                        </div> 
                                        <fieldset>
                                        <div class="control-group">
                                            <legend  class="btn btn-danger">Pregunta de seguridad</legend> 
                                                <label class="control-label" for="pre">Pregunta segura:</label>
                                                <div class="controls">
                                                    <select name="pre" id="pre"  required>
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
                                                    <input type="text" autocomplete class="input-large" id="resp" name="resp" required >
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
                                         <div class="control-group">
                                            <legend  class="btn btn-danger " >Datos a actualizar</legend> 
                                                <label class="control-label" for="nombre">Nombre:</label>
                                                <div class="controls">
                                                    <input type="text" title="Por favor, introduzca el nombre de pila" class="input-large" placeholder="Juan Pérez" name="nombreu" id="nombreu"  value="'.$nombreu.'" required />
                                                </div>
                                            </div>   
                                            <!-- RIF -->
                                            <div class="control-group">
                                                <label class="control-label" for="razon">Razón social:</label>
                                                <div class="controls">
                                                    <input type="text" title="Por favor, introduzca la razón social" class="input-large"  name="razon" id="razon"  value="'.$razon.'" required />
                                                </div>
                                            </div> 
                                            <!-- RIF -->
                                            <div class="control-group">
                                                <label class="control-label" for="contactof">Nombre de la persona de contacto:</label>
                                                <div class="controls">
                                                    <input type="text" title="Por favor, introduzca el nombre de contacto" class="input-large" name="contacto" id="contacto"  value="'.$persona.'" required />
                                                </div>
                                            </div> 
                                        </fieldset>

                                        <!-- Teléfono Persona de Contacto-->
                                        <div class="control-group">
                                            <label class="control-label" for="telefono">Teléfono persona de contacto:</label>
                                            <div class="controls">
                                                <input type="tel" pattern="[0-9]{11,13}" class="input-large" id="telefono" name="telefono" placeholder="Eg. 582120000000,02120000000 " value="'.$contacto.'" required />
                                            </div>
                                        </div>   
                                      <!-- Buttons <div class="form-actions">-->
                                        <div class="form-actions">
                                            <!-- Buttons -->
                                            <button class="btn btn-danger" type="submit"  name="enviar" class="btn">Cambiar</button>
                                            <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                            <a class="btn btn-danger" href="catalogo_final.php">Cancelar</a>
                                        </div>
                                    </form>
                                </div>
                            ';
    }
    
}

?>