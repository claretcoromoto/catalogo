<?php


include 'includes/ConexionPGSQL.php';
class formSliderBoxPedido{
    
    function __construct() {
        ;
    }
            
    function BoxPedido($id_pedido){
        
        
        echo '  
 <div class="slide-box">
            <div class="bor"></div>
            <div class="padd">
                <div class="slide-box-button">
                    <i class="icon-chevron-left"></i>
                </div>
                <h5>Bienvenidos</h5>
                Hola detalle pedido
                <hr />
                <div class="social">';
         $sqldetalle = "SELECT cod_repuesto, nu_precio, in_cantidad 
                                                FROM tblxian_detalle_pedido 
                                                WHERE id_pedido=  " . $id_pedido. " ";
                                               $detalle = pg_query($sqldetalle);
                                                while ($file = @pg_fetch_array($detalle)) { 
               echo '                                  <label>Código:</label>
                                                       <span>'.$file["cod_repuesto"].'</span>
                                                       <label>Precio:</label>
                                                    <span>'.$file["nu_precio"].'</span>
                                                    <label>Cantidad:</label>
                                                    <span>'.$file["in_cantidad"].'</span><br><hr>
                                                 
             </div>

                      </div>     </div>     

';
    }
}}

?>
