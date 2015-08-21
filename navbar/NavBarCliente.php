<?php

class NavBarCliente{
    
    function _construct(){}
    
function navende($email){
    
    echo ' 
   <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container-fluid">
      
         <div class="nav-collapse collapse">
          <ul class="nav pull-right" align= "left">
         <li  ><a href="catalogo_final.php"><img src="img/b-logo.png" alt=""  width="150" heigth="40"   /></a></li>
         
            <li><a href="#"> '.$email.'</a></li>
            <li><a href="index.php">Salir</a></li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones<b class="caret"></b></a>
              <ul class="dropdown-menu">
                          <li><a href="carritopedido.php"><span class="label label-danger">Ver Pedidos</a></li>
                          <li><a href="ver_carrito.php"><span class="label label-success">Modificar</a></li>
                          <li><a href="ver_carrito.php"><span  <button class="btn btn-mini"><i class="icon-ok"></i> </button>Eliminar</a></li>
                  
             </ul>
            </li> 

             
          </ul>
        </div>
      </div>
    </div>
  </div>';
    
}
    
}
?>
