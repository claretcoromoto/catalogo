<?php

class formLoginVendedorXian {

    function __construct() {
        ;
    }

    function formloginVendedor() {


        echo ' <div class="content">

            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">  
                        <div class="well login-register">

                            <h5>Registro del vendedor</h5>
                            <hr />

                            <!-- Login form -->
                            <form  class="form-horizontal"  method="post" action= "includes/RegistrarUsuarioXian.php " >
                                <!-- Name -->
                                <div class="control-group">
                                    <label class="control-label" for="name">Nombre :</label>
                                    <div class="controls">
                                        <input type="text" class="input-large" id="nombre" name="nombre" placeholder="Nombre y Apellido" required autofocus>
                                    </div>
                                </div>   

                                <fieldset>
                                    <legend class="btn btn-danger ">Seguridad</legend> 
                                    <!-- Email -->
                                    <div   class="control-group">
                                        <label  class="control-label" for="email" >Correo Electrónico:</label>
                                        <div class="controls">
                                            <input  title="Por favor, introduce un email válido" type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                                                    name="email" pattern="^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$" autofocus required/>
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="control-group">
                                        <label class="control-label" for="password">Contraseña:</label>
                                        <div class="controls">
                                            <input  title="Por favor, introduce tu contraseña" type="password" class="input-large" id="password" name="password" placeholder="Password" autofocus required/>
                                        </div>
                                    </div>


                                    <!-- Pregunta segura-->
                                    <div class="control-group">
                                        <label class="control-label" for="preguntaseg">Pregunta Segura</label>
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
                                        <label class="control-label" for="respuestaseg">Respuesta Segura:</label>
                                        <div class="controls">
                                            <input type="text" autocomplete class="input-large" id="respuestaseg" name="respuestaseg" required >
                                        </div>
                                    </div> 
                                </fieldset>

                                <fieldset>
                                    <legend class="btn btn-danger ">Localización</legend> 
                                    <!-- Teléfono Persona de Contacto-->
                                    <div class="control-group">
                                        <label class="control-label" for="telefono">Teléfono:</label>
                                        <div class="controls">
                                            <input type="tel" pattern="[0-9]{11,13}" class="input-large" id="telefono" name="telefono" placeholder="Eg. 582120000000,02120000000 " required >
                                        </div>
                                    </div>   
                                    <!-- Dirección -->
                                    <div class="control-group">
                                        <label class="control-label" for="direccion">Dirección fiscal:</label>
                                        <div class="controls">
                                            <p><textarea rows="2" cols="33" name="direccion" placeholder="Av. Boulevar Naiguatá, E/S Tanaguarena Caribe"  required ></textarea></p>
                                        </div>
                                    </div> </fieldset>
                                <!-- Remember me checkbox and sign in button -->
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="checkbox">
                                            <input type="checkbox"> Recuérdame
                                        </label>
                                       
                                        <button  type="submit" name="enviar" class="btn btn-danger"  >Enviar</button>
                                        <button  type="reset" class="btn btn-danger">Limpiar</button>
                                        <button  class="btn btn-danger"><a href="index.php">Cancelar</a></button>
                                   <br>     ¿Tienes una cuenta aquí? <a href="login.php">Autenticate</a>
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