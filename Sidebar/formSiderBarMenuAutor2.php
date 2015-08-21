<?php

class formSiderBarMenuAutor2{
    function _construct(){}
    
    
function formSider(){
    
    echo '        <div class="sidebar">

                <!-- Logo -->
                <div class="logo">
                    
                </div>
                <div class="sidebar-dropdown"><a href="#">Navegación</a></div>

                <!--- Sidebar navigation -->
                <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->

                <!-- Colors: Add the class "br-red" or "br-blue" or "br-green" or "br-orange" or "br-purple" or "br-yellow" to anchor tags to create colorful left border -->
                <div class="s-content">

                    <ul id="nav">
                        <!-- Main menu with font awesome icon -->
                      <li class="has_sub"><a href="#" class="br-blue"><i class="icon-user"></i>Solicitudes <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                            <ul>
                               <li><a href="AdminSolPenCliPedidos.php">Solicitudes pendientes de pedidos</a></li>
                                <li><a href="AdminAnulacionPedido.php">Anulación de pedido</a></li>
                                <li><a href="view_autorii_consulta.php">Consulta de pedido</a></li>
                            </ul>
                        </li>  

                      
                       
                    </ul>
                    


                                  </div>
            </div>
';
    
    
}
    
    
}
?>
