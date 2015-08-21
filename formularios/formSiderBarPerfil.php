<?php

class formSiderBarPerfil{
    function _construct(){}
    
    
function formSider(){
    
    echo '         <div class="sidebar">

                <!-- Logo -->
                <div class="logo">
                    <a href="#"><img src="img/b-logo.png" alt="" /></a>
                </div>
                <div class="sidebar-dropdown"><a href="#">Navegación</a></div>

                <!--- Sidebar navigation -->
                <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->

                <!-- Colors: Add the class "br-red" or "br-blue" or "br-green" or "br-orange" or "br-purple" or "br-yellow" to anchor tags to create colorful left border -->
                <div class="s-content">

                    <ul id="nav">
                        <!-- Main menu with font awesome icon -->
                        <li><a href="index.php" class="open br-red"><i class="icon-home"></i> Inicio</a>  </li>

                      
                        <li class="has_sub"><a href="#" class="br-green"><i class="icon-user"></i>Ingresar al Sistema <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                            <ul>
                                <li><a href="login.php">Autenticación</a></li>
                                <li><a href="Buscar_Rif.php">Registrarse</a></li>
                            </ul>
                        </li>              
                        <li><a href="contactos.php" class="br-yellow"><i class="icon-user"></i>Contacto</a></li> 
                         <li><a href="acercade.php"class="br-purple"><i class="icon-camera"></i>Acerca de Nosotros</a></li> 
                    </ul>
                    


                                  </div>
            </div>
';
    
    
}
    
    
}
?>
