<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formBuscarRifBd
 *
 * @author csalazar
 */
class formBuscarRifBd {
    //put your code here
    
    function __construct() {
        ;
    }
    
    
    
    function buscarifbd($rif){
        
        echo '<div class="well login-register">
    <h5>Verificar RIF al SENIAT</h5>
    <hr />
    <div class="form">
        <!-- Buscar Rif y Razón Social-->
        <form class="form-horizontal" name="validarRIF" method="get" action="Registrar_Clientes.php" >
            <!-- RIF -->
            <div class="control-group">

                <label class="control-label" for="rif">RIF:</label>
                <div class="controls">
                    <input type="text" class="input-large" name="rif" id="rif" values=value="' . $rif. '" required autofocus />
                </div>
            </div>   
            <!-- Buttons <div class="form-actions">-->
            <div class="form-actions">
                <!-- Buttons -->
                <button  type="submit" name="enviar" class="btn btn-primary">Enviar</button>
                <button  type="reset" class="btn">Limpiar</button>
                <button  type="cancelar" class="btn btn-danger"><a href="index.php">Cancelar</a></button>
            </div>
        </form>
    </div>

</div>';
        
        
        
    }
}

?>
