<?php

class NavBarAutoii{
    
    function _construct(){}
    

function navegador($email){
    
    
    echo '<!-- Navbar starts -->

   <div  class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-left" >
                            <li  ><a href="#"><img src="img/b-logo.png" alt=""  width="150" heigth="40"   /></a></li>
                        </ul>
                    </div>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right" >
                            <li><a href="#">'.$email.'</a></li>
                            <li><a href="view_autorii_solicitudes.php">volver atrás</a></li>
                        </ul>
                    </div>
                </div>
            </div> 
        </div>

';
}
}
?>
