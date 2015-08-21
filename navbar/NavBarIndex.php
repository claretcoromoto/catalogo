<?php

class NavBarIndex{
    
    function _construct(){}
    
function navegadorIndex(){
    
    echo ' <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                    
                            <li><a href="login.php">Autenticación</a></li>
                            <li><a href="Buscar_Rif.php">Registrarse</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>';
    
}
    
}
?>
