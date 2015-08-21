<?php

class formSiderBarMenuAutor1{
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
                      <li class="has_sub"><a href="#" class="br-green"><i class="icon-user"></i>Solicitudes <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                            <ul>
                               <li><a href="view_autori_cliente.php">Solicitudes pendientes de clientes</a></li>
                               </ul>
                        </li>  
                         </ul>
                            </div>
            </div>
';
    
    
}
    
    
}
?>
