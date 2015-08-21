<?php

class formSiderBar {

    function _construct() {
        
    }

    function formSider() {

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
                      
                        <li class="has_sub" class="br-yellow"><a href="#" class="br-blue"><i class="icon-list-alt"></i>Nuestros Catálogos <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                        <ul>
                        <li ><a href="#" >              Por categoría </li>
<li>                                
';

        // $link = pg_connect("user=postgres password=sitvenpfi dbname=dbsitxian host=localhost") or die(pg_last_error($link));
        $sql = "SELECT  id_categoria,tx_descr_categoria FROM tblxian_categoria";
        $result = @pg_query($sql);
        if (isset($result)) {
            while ($row = pg_fetch_array($result)) {
            $cat=$row['tx_descr_categoria'];
                echo "<a href=listado_categoria_catalogo_final.php?id_categoria=$row[id_categoria]&tx_descr_categoria=$row[tx_descr_categoria]>$row[tx_descr_categoria]</a>";
            }
        }
        pg_free_result($result);

        echo '  </li>
               </ul>
                                   
             <li><a href="vercarrito.php" class="open br-purple"><i class="icon-list-alt"></i>Ver pedido actual</a> </li>
             <li><a href="index.php" class="open br-red"><i class="icon-home"></i> Inicio</a> </li>
                 
             
    
 </ul>
</ul>        
                </div>
                  <form class="form-search s-widget"  method="post"  action="repuesto_1.php">
              <div class="input-append">
              <button type="submit" name="enviar" class="btn btn-danger">Buscar por descripción</button><br>
  <input type="text" title="Por favor, busque por descripción del repuesto"
      class="input-small search-query" name="descripcion" >
              </div>
            </form>
            
<form class="form-search s-widget"  method="post"  action="repuesto_2.php">
              <div class="input-append">
              <button type="submit" name="submit" class="btn btn-danger">Buscar por código</button><br>
            <input type="text" title="Por favor, busque por descripción del repuesto"
            class="input-small search-query" name="cod_repuesto"  >
              </div>
            </form>  
     
              <form class="form-search s-widget"  method="post"  action="repuesto_3.php">
             
              </div>
              ';
        
}
            }
?>
