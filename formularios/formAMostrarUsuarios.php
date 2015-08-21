<?php

class formTabMostrarUsuarios{
    
    
    function __construct() {
        ;
    }

function formActualUsuario($rif, $iduser, $empresa, $nombre, $email, $perfil, $status,$direccion, $estado, $municipio, $ciudad){
    echo '

                                            <form    name="QForm"    class="form-horizontal" method="post" action="includes/ActualizarUsuario.php" />
                                            <div align="center "><h5>Modificaciones en usuarios</h5></div>
                                            <hr>

                                            <fieldset> 
                                                <legend  class="btn btn-danger " >Datos Personales</legend> 

                                                <!-- Rif -->
                                                <div class="control-group">
                                                    <label class="control-label" for="name">RIF:</label>
                                                    <div class="controls">
                                                        <input readonly type="text" class="input-large" id="rif" name="rif" value="'.$rif.' ">
                                                       <!-- <input readonly type="hidden" class="input-large" id="idvenempre" name="idvenempre"  > -->

                                                    </div>
                                                </div>   
                                             
                                                <!-- Name -->
                                                <div class="control-group">
                                                    <label class="control-label" for="name">Nombre y apellido:</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large" id="nombre" name="nombre" placeholder="Juan Pérez" required value= '.$nombre.'>
                                                    </div>
                                                </div> 
                                                <!-- Nombre del usuario-->
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Usuario:</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                                                               name="correo" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" value= '.$email.' required>
                                                    </div>   
                                                </div>  
                                                

                                            </fieldset>  


                                            <fieldset >
                                                <legend class="btn btn-danger ">Activaciones</legend> 
                                                <!-- Username   -->
                                                                                      <!-- Rol del usuario-->
                                                <div class="control-group">
                                                    <label class="control-label" for="name">Rol de usuario:</label>
                                                    <div class="controls">
                                                        <input  type="text" class="input-small" id="perfil" name="perfil" value= '.$perfil.'>

                                                    </div>
                                                </div> 
                                                <div class="control-group">
                                                    <label class="control-label" for="name">Estatus del usuario:</label>
                                                    <div class="controls">
                                                        <input  type="text" class="input-small" id="status" name="status" value= '.$status.'>

                                                    </div>
                                                </div> 
                                            </fieldset>

                                            <fieldset>
                                                <legend class="btn btn-danger ">Localización</legend> 
                                                <!-- Dirección -->
                                                <div class="control-group">
                                                    <label class="control-label" for="direccion">Dirección fiscal:</label>
                                                    <div class="controls">
                                                        <p><textarea rows="2" cols="33" name="direccion" placeholder="Av. Boulevar Naiguatá, E/S Tanaguarena Caribe" value= '.$direccion.' required ></textarea></p>
                                                    </div>
                                                </div> 
                                                <div class="control-group">
                                                    <label class="control-label" for="lstModel">Estado: </label>
                                                    <div class="controls">
                                                          <label class="control-label" for="lstModel">'.$estado.' </label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="lstModel">Municipio: </label>
                                                    <div class="controls">
                                                         <label class="control-label" for="lstModel">'.$municipio.' </label>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="lstOptions">Ciudad: </label>
                                                    <div class="controls">
                                                         <label class="control-label" for="lstModel"> '.$ciudad.' </label>
                                                    </div>
                                                </div>
                                                <!-- Buttons -->
                                                <!-- Buttons -->  
                                                <div class="form-actions">
                                                    <!-- Buttons -->
                                                    <button class="btn btn-danger" type="submit" tabindex="-1" name="submit"> Actualizar datos</button>
                                                    <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                                    <a class="btn btn-danger" href="AdminPrincipal.php">Cancelar</a>
                                                </div>
                                                </form>

                                       ';
    
}}

?>