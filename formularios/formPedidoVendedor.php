<?php

class formPedidoVendedor {

    function __construct() {
        ;
    }

    function pedidosVendedor($idsr, $status, $autorii, $combobit, $comborif, $formpago, $monto, $montiva, $montotal ) {
   $monto1=number_format($monto, 2, '.', '') ;
  $monto2=number_format($montiva, 2, '.', '') ;
$monto3=number_format($montotal, 2, '.', '') ;

 
    
 
        echo '
         <div class="well login-register">
                            <form class="form-horizontal"  name="frm" id="frm" action="" method="post">
                                <!-- id del usuario -->
                                <input  class="input-min" type="hidden" id="idusr" required="required" name="idusr" value="' . $idsr . '"  >
                                <input   class="input-mini"  type="hidden"  id="idstatus"  name="idstatus" required="required" value="' . $status . '" >
                                <input  type="hidden" class="input-mini"   id="idautorii" name="idautorii"  required="required" value="' . $autorii . '" >
 <input  type="hidden" class="input-mini"   id="formpago" name="formpago"  required="required" value="' . $formpago . '" >                                
<!-- 
                                <div class="control-group">
                                    <label class="control-label" for="rif">RIF:</label>
                                    <div class="controls">
                                        <select  id="entrega"  required="rif" name="rif">
                                        <opcion> </option>
                    
                         </select> 
                         <br>El cliente debe estar registrado con anterioridad     </div>
                                </div>
-->

                                 <div class="control-group">
                                 <label class="control-label" for="entrega">RIF:</label>
                                 <div class="controls">
                                 <input  type="text" class="input-medium"   id="rif" name="rif" value="' . $_r. '"  required="required"  > 
                                 <input type="submit" name="bt1" type="submit" value="Buscar" onclick="f_Cmb();>
                                 </div>
                                 </div> 

                                <div class="control-group">
                                    <label class="control-label" for="entrega">Tipos de entrega:</label>
                                    <div class="controls">
                                        <select  id="entrega"   name="entrega">
                                 ' . $combobit . '
                                        </select>             
                                    </div>
                                </div>            
                                <!-- Dirección de la entrega-->
                                <div class="control-group">
                                    <label class="control-label" for="entrega">Dirección:</label>
                                    <div class="controls">
                                        <textarea  id="direccion" name="direccion" rows="4" cols="20" placeholder="Ejemplo: Av. Boulevar Naiguatá, E/S Tanaguarena Caribe Caraballeda, Edo. Vargas – Venezuela" required="required"  ></textarea>
                                    </div>
                                </div>     
                                     <div class="control-group">
                                    <label class="control-label" for="entrega">Monto sin IVA:</label>
                                    <div class="controls"> 
                               
                                        <input  readonly class="input-min" type="text" id="monto" required="required" name="monto" value="' .$monto1 . '" >
                                         </div>
                                </div>
                                  
                                <div class="control-group">
                                    <label class="control-label" for="entrega">IVA:</label>
                                    <div class="controls"> 
                                        <input  readonly class="input-min" type="text" id="montiva" required="required" name="montiva" value="' . $monto2. '" >
                                         </div>
                                </div>
                                   
                                
                                <div class="control-group">
                                    <label class="control-label" for="entrega">Monto total:</label>
                                    <div class="controls"> 
                                        <input  readonly class="input-min" type="text" id="montotal" required="required" name="montotal" value="' . $monto3. '" >
                                         </div>
                                </div>

                                <!-- Buttons -->  
                                  <div class="form-actions">
                                            <!-- Buttons -->
                                            <button class="btn btn-danger" type="submit" tabindex="-1"  name="bt1" class="btn" onclick="f_Cmb1();> Registrar</button>
                                            <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                            <button       <a class="btn btn-danger" href="vercarrito.php">Cancelar</a></button>
                                        </div>
                                        </form>
         
</div>
';
    }

}

?>
