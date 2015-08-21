<?php

class formConsultarRif{
    
    function __construct() {
        ;
    }
    
    
    function consultarrif($idusr){
        
            echo '  <form  class="input-append" class="form-search"  method="post" action=" $_SERVER["PHP_SELF"]">
                    <input class="input-mini" type="hidden" id="id_usr" name="id_usr" value='.$idusr.'  required="required" >
                    <button type="submit" class="btn btn-danger ">RIF</button>
                    <input class="input-append" type="text" id="rif" name="rif"   required="required">
                    <button  type="submit" name="submit"  class="btn btn-danger ">Presione para consultar sus pedidos</button>
                </form> ';
    }
}
?>