<?php

class NavBarVendedor{
    
    function _construct(){}
    
function navende($email){
    
    echo ' 
  <div  class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
             
                    <ul class="nav pull-left" >
                         <li  ><a href="catalogo_final.php"><img src="img/b-logo.png" alt=""  width="150" heigth="40"   /></a></li>
                       </ul>
                      <div class="nav-collapse collapse">
                    <ul class="nav pull-right" >
                      
                        <li><a href="#">'.$email.'</a></li>
                        <li><a href="catalogo_final.php">atrás</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>';
    
}
    
}
?>
