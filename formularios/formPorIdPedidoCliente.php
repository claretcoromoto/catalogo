<?php
class formPorIdPedidoCliente{
    
    function __construct() {
        ;
    }
    
    function idPedidoCliente($idusr, $rif){
        
        echo '
         <form  class="input-append" class="form-search"  method="post" action=" $_SERVER["PHP_SELF"]">
                            <div class="control-group">
                                <input class="input-mini" type="hidden" id="id_usr" name="id_usr" value=value='.$idusr.' required="required" >
                                <button type="submit" class="btn btn-primary ">RIF</button>
                                <input disabled class="input-append" type="text" id="rif" name="rif" value="'.$rif.'"  required="required">
                                <input class="input-append" type="hidden" id="rif" name="rif" value="'.$rif.'" required="required">
                                <button type="submit" class="btn btn-danger ">ID del Pedido:</button>
                                <input class="input-mini" type="text" id="rif" name="id_pedido"  required="required">
                                <button class="btn btn-danger "  type="submit" name="submit" >Consultar</button>
                            </div>
                        </form> 
                                    '; 
    }
}
?>
