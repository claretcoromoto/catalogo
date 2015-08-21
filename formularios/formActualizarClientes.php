<?php

class formActualizarClientes {

    function _construct() {
        
    }

    function actualizarClientes($resultados, $rif) {
        echo '
                        <div class="well login-register">

                            <h5>Actualizar datos del cliente</h5>
                            <!-- Register form (working)-->
                                                                    
                            <div class="form">
                                <form    name="QForm" method="post" class="form-horizontal" action= "includes/ActualizarCliente.php " >

                                  <!-- Name -->
                                    <div class="control-group">
                                        <label class="control-label" for="name">Nombre :</label>
                                        <div class="controls">
                                              <input type="text" class="input-large" required="required" id="nombre"  name= "nombre" value="'. $resultados['nb_usuario'].'" >
                                        </div>
                                    </div> 
                                  
                                             <!-- Rif -->
                                    <div class="control-group">
                                        <label class="control-label" for="name">Rif :</label>
                                        <div class="controls">
                                            <input type="text"  disabled class="input-large" id="rif" required="required" name="rif" value="' . $rif . '" >
                                            <input type="hidden"   class="input-large" id="rif" required="required" name="rif" value="' . $rif . '" > 
                                       </div>
                                    </div>   
                                    
                                                                    
                                     <!-- Dirección -->
                                    <div class="control-group">
                                        <label class="control-label" for="respuestaseg">Dirección:</label>
                                        <div class="controls">
                                          <input type="text" required="required" class="input-large" name = "direccion" value="' . $resultados["tx_direccion"] . '" >
                                               
                                        </div>
                                    </div> 
                                    <!-- Nombre de Persona de Contacto-->
                                    <div class="control-group">
                                        <label class="control-label" for="contacto">Nombre de Persona de Contacto:</label>
                                        <div class="controls">
                                            <input type="text" class="input-large" required="required" id="contacto" name= "contacto"  value="' . $resultados['nb_persona_contacto'] . '" >
                                        </div>
                                    </div>   

                                    <!-- Teléfono Persona de Contacto-->
                                    <div class="control-group">
                                        <label class="control-label" for="telefono">Telefono de Persona de Contacto:</label>
                                        <div class="controls">
                                            <input type="text" required="required" class="input-large" id="telefono" name= "telefono" value="' . $resultados["tx_telf_contacto"] . '" >
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
                                    <div class="form-actions">
                                        <!-- Buttons -->
                                        <button type="submit" name="submit" class="btn">Actualizar Datos</button>
                                        <button type="reset" class="btn">Limpiar</button>
                                        <button  type="cancelar" class="btn btn-danger"><a href="index.php">Cancelar</a></button>
                                    </div>
                                </form>
                                     </div> 
                                </div>
                          ';
    }

}

?>
