<?php

class formSiderBarCatalogos{
    function _construct(){}
    
    
function formSider(){
    
    echo '         <div class="sidebar">

                <!-- Logo   <div class="logo">
                    <a href="#"><img src="img/b-logo.png" alt="" /></a>
                </div>-->
              
                <div class="sidebar-dropdown"><a href="#">Navegación</a></div>

                <!--- Sidebar navigation -->
                <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->

                <!-- Colors: Add the class "br-red" or "br-blue" or "br-green" or "br-orange" or "br-purple" or "br-yellow" to anchor tags to create colorful left border -->
             

                    <ul id="nav">
                        <!-- Main menu with font awesome icon -->
                        <li><a href="index.php" class="open br-red"><i class="icon-home"></i> Inicio</a>
                       <li class="has_sub"><a href="#" class="br-blue"><i class="icon-list-alt"></i>Catálogo<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                <ul>
                    <li >';
                   
                    
		 include 'includes/ConexionPGSQL.php';

				 $sql = "SELECT  id_categoria,tx_descr_categoria FROM tblxian_categoria";
                    $result = pg_query($sql);
                    if ($result) {
                        while ($row = pg_fetch_array($result)) {

                            echo "<a href=listado_categoria_catalogo_final.php?id_categoria=$row[id_categoria]&tx_descr_categoria=$row[tx_descr_categoria]>$row[tx_descr_categoria]</a>";
                        }
                    }
                    pg_free_result($result);
               
                    
                   
           echo '        </li>
                </ul>
            </li>  
        </ul>
    </div>
    </div>



           
';
    
    
}
    
    
}
?>
