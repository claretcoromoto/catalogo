<?php

class formARegistrarUsuarioSinS{
    
    
    function __construct() {
        ;
    }
    function formUsuario($rif, $idusr, $make, $model, $options){
        echo '
              <div class="well login-register">
<form    name="QForm"   id="QForm" class="form-horizontal" method="post" action="includes/RegistrarClientes.php" />


                                        <fieldset> 
                                            <legend  class="btn btn-danger " >Datos Personales</legend> 

                                            <!-- Rif -->
                                            <div class="control-group">
                                                <label class="control-label" for="name">RIF:</label>
                                                <div class="controls">
                                                    <input readonly type="text" class="input-large" id="rif" name="rif" value="'.$rif.'">
                                                    <input readonly type="hidden" class="input-large" id="idvenempre" name="idvenempre" value='.$idusr.' >


                                                </div>
                                            </div>   

                                            <!-- Razón Social-->
                                            <div class="control-group">
                                                <label class="control-label" for="empresa">Razón social:</label>
                                                <div class="controls">
                                                    <input  type="text"  size="100"class="input-large" id="empresa" name="empresa"  >

                                                </div>
                                            </div> 

                                            <!-- Name -->
                                            <div class="control-group">
                                                <label class="control-label" for="name">Nombre y apellido:</label>
                                                <div class="controls">
                                                    <input type="text" class="input-large" id="nombre" name="nombre" placeholder="Nombre y Apellido" required autofocus>
                                                </div>
                                            </div> 
                                            <!-- Nombre del usuario-->
                                            <div class="control-group">
                                                <label class="control-label" for="email">Usuario:</label>
                                                <div class="controls">
                                                    <input type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                                                           name="correo" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus required/>  
                                                </div>   
                                            </div>  
                                            <!-- Rol del usuario-->
                                        </fieldset>  

                                    <fieldset> 
                                        <legend class="btn btn-danger ">Contacto</legend> 
                                        <!-- Nombre de Persona de Contacto-->
                                        <div class="control-group">
                                            <label class="control-label" for="contacto">Nombre de persona de contacto:</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" id="contacto" name="contacto" placeholder="Nombre y Apellido" required >
                                            </div>        
                                        </div>   

                                        <!-- Teléfono Persona de Contacto-->
                                        <div class="control-group">
                                            <label class="control-label" for="telefono">Teléfono persona de contacto:</label>
                                            <div class="controls">

                                                <input type="tel" pattern="[0-9]{11,13}" class="input-large" id="telefono" name="telefono" placeholder="Eg. 582120000000,02120000000 " required >

                                            </div>
                                        </div>                  
                                    </fieldset>
                                        <fieldset >
                                            <legend class="btn btn-danger ">Seguridad</legend> 
                                            <!-- Username   -->

                                            <!-- Password -->
                                            <div class="control-group">
                                                <label class="control-label" for="password">Contraseña:</label>
                                                <div class="controls">
                                                    <input type="password" min="6" max="12" maxlength="12" class="input-large" id="password" name="password" required >
                                                </div>
                                            </div>

                                            <!-- Pregunta segura-->
                                            <div class="control-group">
                                                <label class="control-label" for="preguntaseg">Pregunta secreta:</label>
                                                <div class="controls">
                                                    <select name="preguntaseg" id="preguntaseg"  required>
                                                        <option>¿Cuál es mi mascota preferida?</option>
                                                        <option>¿Cuál es el nombre de mi mascota preferida?</option>
                                                        <option>¿Cuál es el nombre de mi restaurant preferido?</option>
                                                        <option>¿Dónde nació mi mamá?</option>
                                                        <option>¿Dónde nació mi papá?</option>
                                                    </select>
                                                </div>
                                            </div> 

                                            <!-- Respuesta segura-->
                                            <div class="control-group">
                                                <label class="control-label" for="respuestaseg">Respuesta secreta:</label>
                                                <div class="controls">
                                                    <input type="text" autocomplete class="input-large" id="respuestaseg" name="respuestaseg" required >
                                                </div>
                                            </div> 
                                        </fieldset>

                                        <fieldset>
                                            <legend class="btn btn-danger ">Localización</legend> 
                                            <!-- Dirección -->
                                            <div class="control-group">
                                                <label class="control-label" for="direccion">Dirección fiscal:</label>
                                                <div class="controls">
                                                    <p><textarea rows="2" cols="33" name="direccion" placeholder="Av. Boulevar Naiguatá, E/S Tanaguarena Caribe"  required ></textarea></p>
                                                </div>
                                            </div> 
                                            <div class="control-group">
                                                <label class="control-label" for="lstModel">Estado: </label>
                                                <div class="controls">
                                                    <select name="lstMake" id="lstMake" required>
                                                        <option required>  -- Aún no se ha cargado -- </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lstModel">Municipio: </label>
                                                <div class="controls">
                                                    <select name="lstModel" id="lstModel" required>
                                                        <option required>  -- Aún no se ha cargado -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="lstOptions">Ciudad: </label>
                                                <div class="controls">
                                                    <select name="lstOptions" id="lstOptions" required>
                                                        <option required >  -- Aún no se ha cargado -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Buttons -->
                                            <!-- Buttons -->  
                                            <div class="form-actions">
                                                <!-- Buttons -->
                                                  <button class="btn btn-danger" type="submit"  name="enviar"> Registrar</button>
                                                  <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                                <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>
                                            </div>
                                      </form>    </div>    ';
    }
}
?>