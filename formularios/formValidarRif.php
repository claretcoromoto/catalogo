<?php

class formValidarRif {

    function __construct() {
        ;
    }

    function formValidarRif() {

        echo '<h4> <br>Antes de registrarse debe verificar su Rif en el Seniat <h4>
                                <div class="well login-register">
                                    <h5>Buscar</h5>
                                    <hr />
                                    <div class="form">
                                        <!-- Buscar Rif y Razón Social-->
                                        <form class="form-horizontal" name="validarRIF" method="get" action=" $_SERVER["PHP_SELF"]" >
                                        <!-- RIF -->
                                        <div class="control-group">

                                            <label class="control-label" for="rif">RIF:</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" name="rif" id="rif"  required autofocus />
                                            </div>
                                        </div>   
                                        <!-- Buttons <div class="form-actions">-->
                                        <div class="form-actions">
                                            <!-- Buttons -->
                                            <button type="submit" class="btn">Buscar</button>
                                            <button type="reset" class="btn">Limpiar</button>
                                        </div>
                                        </form>
                                    </div>

                                   </div>';
    }

}

?>
