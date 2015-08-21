<?php

class formBuscarEmail{
    function _construct(){}
            function formBuscar() {

                            echo '  
                           
                    <div class="cslider">
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="box-body">
                                      <h4> <br>Verifique su correo eléctronico antes de registrar sus datos<h4>
                                    <div class="well login-register">
                                    <h5>Buscar</h5>
                                    <hr />
                                    <div class="form">
                                        <!-- Buscar Rif y Razón Social-->
                                        <form class="form-horizontal" name="validaremail" method="get"  action= "Actualizar_Usuarios.php" >
                                        <!-- RIF -->
                                        <div class="control-group">
                                            <label class="control-label" for="rif">Correo electrónico:</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" id="email" name="email"  placeholder="Ejemplo: email.email@mozilla.com"  autofocus required /> 
                                            </div>
                                        </div>   
                                        <!-- Buttons <div class="form-actions">-->
                                        <div class="form-actions">
                                            <!-- Buttons -->
                                            <button type="submit" class="btn">Buscar</button>
                                            <button type="reset" class="btn">Limpiar</button>
                                            <button type="cancelar" class="btn">Cancelar</button>
                                        </div>
                                        </form>
                                    </div>
                                    <hr />
                                </div>
                                    
                                      </div> 

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cslider-btn">Pulsa<i class="icon-angle-down">Buscar</i></div>
                </div>
                   ';
    
            }
            
            
            
            
               function formRegistrese($resultado) {
                            echo'      
                                  <div class="well login-register">
                                      <h5>Registro de Vendedores</h5>
                                            <!-- Register form (not working)-->
                                            <form class="form-horizontal" method="post" action="conexion/ActualizarUsuario.php" />
                                     

                                                <!-- Username -->
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Usuario:</label>
                                                    <div class="controls">
                                                        <input type="text" disabled class="input-large" id="email" name="email"   value="' . $resultado["tx_login"] . '" >
                                                    </div>
                                                </div>

                                                <!-- Name -->
                                                <div class="control-group">
                                                    <label class="control-label" for="name">Nombre :</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large" id="nombre" name="nombre" placeholder="Ejemplo: Pedro Pérez"   value="' . $resultado["nb_usuario"] . '" >
                                                    </div>
                                                </div>   

                                                <!-- Teléfono del Usuario -->
                                                <div class="control-group">
                                                    <label class="control-label" for="telefono">Telefono:</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large" id="telefono" name="telefono" placeholder="Ejemplo: 04163332211"  value="' . $resultado["tx_telf_contacto"] . '" >
                                                    </div>
                                                </div>   

                                                <!-- Password -->
                                                <div class="control-group">
                                                    <label class="control-label" for="password">Contraseña:</label>
                                                    <div class="controls">
                                                        <input type="password" class="input-large" id="password" name="password" placeholder="**********"   value="' . $resultado["tx_clave"] . '" >
                                                    </div>
                                                </div>

                                                <!-- Pregunta segura-->
                                                <div class="control-group">
                                                    <label class="control-label" for="preguntaseg">Pregunta Segura:</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large" id="preguntaseg" name="preguntaseg"  value="' . $resultado["tx_preg_segur"] . '" >
                                                    </div>
                                                </div>   

                                                <!-- Respuesta segura-->
                                                <div class="control-group">
                                                    <label class="control-label" for="respuestaseg">Respuesta Segura:</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large" id="respuestaseg" name="respuestaseg"  value="' . $resultado["tx_resp_segur"] . '" >
                                                    </div>
                                                </div> 
                                                <!-- Dirección -->
                                                <div class="control-group">
                                                    <label class="control-label" for="respuestaseg">Dirección:</label>
                                                    <div class="controls">
                                                        <p><textarea rows="2" cols="33"  name="direccion"  value="' . $resultado["tx_direccion"] . '" >
                                                            </textarea></p>
                                                    </div>
                                                </div> 

                                                <!-- Select box Estado
                                                <div class="control-group">
                                                    <label class="control-label" for="select">Estado</label>
                                                    <div class="controls" required >                               
                                                        <select id="estado" name="estado">
                                                            <option value="0" required >Selecciona Uno...</option>
                                                        </select>
                                                    </div>
                                                </div>  
                
                
                                                <!-- Select box Municipio
                                                <div class="control-group">
                                                    <label class="control-label" for="select">Municipio</label>
                                                    <div class="controls" >                               
                                                        <select id="municipio" name="municipio">
                                                            <option value="0" required >Selecciona Uno...</option>
                                                        </select>
                                                    </div>
                                                </div>  
                
                
                                                <!-- Select box Ciudad
                                                <div class="control-group">
                                                    <label class="control-label" for="select">Ciudad</label>
                                                    <div class="controls">                               
                                                        <select id="ciudad" name="ciudad">
                                                            <option value="0" required >Selecciona Uno...</option>
                                                        </select>
                                                    </div>
                                                </div>  
                                                -->
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
                                                    <button type="submit" name="actualizar"   class="btn">Actualizar tus datos</button>
                                                    <button type="reset" class="btn">Limpiar</button>
                                                </div>
                                            </form>
                                            ¿Eres vendedor registrado aquí? <a href="login.php">Logueate</a>
                                    </div>
                             ';
                                            
                            
                            
                        }
    
}
?>
