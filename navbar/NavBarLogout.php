<?php

class NavBarLogout{
    
    function _construct(){}
    
function navegador($email){
    
         
    echo '<!-- Navbar starts -->
 <div  class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container-fluid">
    <!--    <div class="nav-collapse collapse">-->
          <ul class="nav pull-left" >
          <li  ><a href="catalogo_final.php"><img src="img/b-logo.png" alt=""  width="150" heigth="40"   /></a></li>
             </ul>
        
             <div class="nav-collapse collapse">
          <ul class="nav pull-right" >
          
                
            <li><a href="#"> '.$email.'</a></li>
           
         <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones<b class="caret"></b></a>
              <ul class="dropdown-menu">
                           <li><a href="includes/gestionar_perfil.php">Gestionar perfil</a></li>
              </ul>
            </li> 
                    <li><a href="index.php"><span class="label label-important">Salir</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
';
    
       
}
    
}
?>
