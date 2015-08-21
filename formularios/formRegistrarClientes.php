<?php
class formRegistrarClientes{
    
    function __construct() {
        ;
    }
    function registrarClientes($rifseniat, $empresa, $estado, $municipio, $ciudad){
        echo '
                          <!--    <div class="container-fluid">-->
                             <!--     <div class="row-fluid"> -->
                                <div class="span7">  
                                    <div class="well login-register">
                                        <h5>Registrar cliente</h5>
                                        <!-- Register form (not working)-->
                                        <form class="form-horizontal" method="post" action="includes/RegistrarClientes.php" />
                                        <div align="center "><h5>El Rif solicitado está registrado en el Seniat  </h5></div>
                                       
                                        <!-- Rif -->
                                        <div class="control-group">
                                            <label class="control-label" for="name">RIF:</label>
                                            <div class="controls">
                                                <input unabled type="text" class="input-large" id="rif" name="rif" value="'.$rifseniat.'" >
                                            </div>
                                        </div>   
                                        
                                        <!-- Razón Social-->
                                        <div class="control-group">
                                            <label class="control-label" for="name">Razón social:</label>
                                            <div class="controls">
                                                <input type="text"  size="100"class="input-large" id="empresa" name="empresa" value="'.$empresa.'" >
                                            </div>
                                        </div> 
                                        
                                        <!-- Name -->
                                        <div class="control-group">
                                            <label class="control-label" for="name">Nombre:</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" id="nombre" name="nombre"  placeholder="Juan Pérez" required autofocus>
                                            </div>
                                        </div> 
                                        
                                        <!-- Nombre de Persona de Contacto-->
                                        <div class="control-group">
                                            <label class="control-label" for="contacto">Nombre de persona de contacto:</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" id="contacto" name="contacto" required >
                                            </div>        
                                        </div>   
                                        
                                        <!-- Teléfono Persona de Contacto-->
                                        <div class="control-group">
                                            <label class="control-label" for="telefono">Telefono de persona de contacto:</label>
                                            <div class="controls">
                                           <input type="tel" class="input-large" id="telefono" name="telefono" required >
                                         </div>
                                        </div>                  
                                             
                                             <!-- Username   -->
                                       <div class="control-group">
                                       <label class="control-label" for="email">Usuario:</label>
                                       <div class="controls">
                                       <input type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                     name="email" pattern="/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/" autofocus required/>  
                                   </div>   
                                 </div>  
                                          <!-- Password -->
                                        <div class="control-group">
                                            <label class="control-label" for="password">Contraseña:</label>
                                            <div class="controls">
                                                <input type="password" class="input-large" id="password" name="password" required >
                                            </div>
                                        </div>
                                        
                                        <!-- Pregunta segura-->
                                        <div class="control-group">
                                            <label class="control-label" for="preguntaseg">Pregunta segura:</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" id="preguntaseg" name="preguntaseg" required >
                                            </div>
                                        </div> 
                                        
                                        <!-- Respuesta segura-->
                                        <div class="control-group">
                                            <label class="control-label" for="respuestaseg">Respuesta segura:</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" id="respuestaseg" name="respuestaseg"required >
                                            </div>
                                        </div> 
                                        
                                        <!-- Dirección -->
                                        <div class="control-group">
                                            <label class="control-label" for="direccion">Dirección:</label>
                                            <div class="controls">
                                                <p><textarea rows="2" cols="33" name="direccion" required >Aqui puedes poner tu dirección</textarea></p>
                                            </div>
                                        </div> 

                                        <!-- Select box Estado  -->
                                        <div class="control-group" >
                                            <label class="control-label" for="select">Estado:</label>
                                            <div class="controls" required >                               
                                                <select id="estado" name="estado" onChange="mostrar(this.value);>
                                                   "' . $estado . '"
                                                </select>
                                            </div>
                                        </div>  


                                        <!-- Select box Municipio-->
                                        <div class="control-group">
                                            <label class="control-label" for="select">Municipio:</label>
                                            <div class="controls" >                               
                                                <select id="municipio" name="municipio" onChange="mostrar(this.value);>
                                                        "' . $municipio . '"
                                                </select>
                                            </div>
                                        </div>  


                                        <!-- Select box Ciudad -->
                                        <div class="control-group">
                                            <label class="control-label" for="select">Ciudad:</label>
                                            <div class="controls">                               
                                                <select id="ciudad" name="ciudad" onChange="mostrar(this.value);>
                                                         "' . $ciudad . '"
                                                </select>
                                            </div>
                                        </div>  
                                      
                                        <!-- Checkbox  
                                        <div class="control-group">
                                            <div class="controls">
                                                <label class="checkbox inline">
                                                    <input type="checkbox" id="inlineCheckbox1" value="agree"> Acuerdo con términos y Condiciones
                                                </label>
                                            </div>
                                        </div>  -->
                                        <!-- Buttons -->
                                   <div class="form-actions">
                                            <!-- Buttons -->
                                            <button type="submit"  name="enviar" class="btn"> Registrar</button>
                                            <button type="reset" class="btn">Limpiar</button>
                                              <button  class="btn btn-danger"><a href="index.php" >Cancelar</a></button><br>
                                        </div>
                                        </form>
                                        ¿Tienes una cuenta aquí? <a href="login.php">Autenticate</a>
                                    </div> 
                                </div>
                                <!--  </div> -->
                     
';
        
    }
}
?>
