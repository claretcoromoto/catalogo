<?php

class formPedidoCliente {

    function __construct() {
        ;
    }

    function pedidosUnRif($idsr, $status, $autorii, $comboDir, $rif, $formpago,$monto, $montiva, $montotal ) {
     $monto1=number_format($monto, 2, ',', '.') ;
  $monto2=number_format($montiva, 2, ',', '.') ;
$monto3=number_format($montotal, 2, ',', '.') ;
$montos= number_format($monto, 2, '.', '');

        echo '
           <div class="well login-register">
                            <form class="form-horizontal" method="POST" action="includes/Pedidos.php" >
                                <!-- id del usuario -->
                                <input  class="input-min" type="hidden" id="idusr" required="required" name="idusr" value="' . $idsr . '"  >
                                <input   class="input-mini"  type="hidden"  id="idstatus"  name="idstatus" required="required" value="' . $status . '" >
                                <input  type="hidden" class="input-mini"   id="idautorii" name="idautorii"  required="required" value="' . $autorii . '" >
                                    <input  type="hidden" class="input-mini"   id="f" name="f"  required="required" value="' . $formpago . '" >
                                  <!--  -->
                                <div class="control-group">
                                    <label class="control-label" for="rif">RIF:</label>
                                    <div class="controls">
                                        <input readonly   class="input-medium"  type="text"  id="rif" name="rif" required="required" value="' . $rif . '"> 
                                    </div>
                                </div>
                               <div class ="control-group">
                                        <label class="control-label" for="entrega">Tipos de entrega:</label>
                                        <div class="controls">
                                            <select  id="entrega"   name="entrega">
                                                <option value="1" >Dirección Xian</option>
                                                <option value="2" >Dirección de despacho</option>
                                                <option value="3" >Registrada</option>
                                        </select>             
                                        </div>
                                    </div>
                                   <div class ="control-group">
                                        <label class="control-label" for="direcciondes">Dirección de despacho registrada:</label>
                                        <div class="controls">
                                            <select class="input-block-level" id="nueva"   name="direcciondes">
                                                ' . $comboDir . '
                                            </select>             
                                        </div>
                                    </div>
                                <!-- Dirección de la entrega-->
                                <div class="control-group">
                                    <label class="control-label" for="entrega">Tipos de entrega:</label>
                                    <div class="controls">
                                        <textarea  id="direccion" name="direccion" rows="4" cols="20" placeholder="Ejemplo: Av. Boulevar Naiguatá, E/S Tanaguarena Caribe Caraballeda, Edo. Vargas – Venezuela" required="required"  ></textarea>
                                    </div>
                                </div>         
                               <div class="control-group">
                                    <label class="control-label" for="entrega">Monto sin IVA:</label>
                                    <div class="controls">                                                                     
                                        <input  readonly class="input-min" type="text" id="monto" required="required" name="monto" value="' . $monto1 . '" >
                                            <input class="input-min" type="hidden" id="montos" required="required" name="montos" value="' . $montos . '" >
                                        
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
                                        <input  readonly class="input-min" type="text" id="montotal" required="required" name="montotal" value="' .$monto3. '" >
                                         </div>
                                </div>

                                <!-- Buttons -->  
                                  <div class="form-actions">
                                            <!-- Buttons -->
                                            <button class="btn btn-danger" type="submit"  name="submit" class="btn"> Registrar</button>
                                            <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                            <button       <a class="btn btn-danger" href="vercarrito.php">Cancelar</a></button>
                                        </div>
                                        </form>
         
</div>


';
    }

}

?>
