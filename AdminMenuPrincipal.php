<?php
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} else if (!$rol == 1 ) {
    header("Location: login.php");
} else {
    ?>

    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';

   
    include 'Sidebar/formSiderBarMenu.php';
 
    include 'contactbox/formContactBox.php';

    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';


    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    include 'Slider/formSliderCatalogoAdmin.php';

    include 'includes/ConexionPGSQL.php';
    ?>
    <!DOCTYPE html>
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Administración</title>

    <?php
    $links = new link();
    $links->linkeos();
    ?>
    <!--   Fin de HTML Y HEAD-->

    <!-- Navbar starts -->
    <?php
    $navAdmin = new NavBarAdmin();
    $navAdmin->navegador($email);
    ?>

   

    <div class="content">
        <br><br>       
       <?php
    $sideBarAdmin = new formSiderBarMenu();
    $sideBarAdmin->formSider();
    ?>
        <!-- Sidebar starts -->
        <div class="mainbar" align="center">
            
            <div class="span12" >
                <div class="box-body">
                <div class="page-title" align="left">
                    <h4>Administrador</h4>
                    <p>Importadora Xian, C.A.</p>
                    <hr/>
                </div>
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span7" align="center" >
                            <?php
                            $catalogo = new formSliderCatalogoAdmin();
                            $catalogo->catalogo();
                            ?>
                            <!-- Slider ends -->
                        </div>    
                    </div>  
                </div> 
            </div></div>
        </div><!-- fin de content-->   
    </div><!-- fin de content-->
      <p class="prev-indent-bot">&nbsp;</p>
                <p class="prev-indent-bot">&nbsp;</p>
                <p class="prev-indent-bot">&nbsp;</p>
                <p class="prev-indent-bot">&nbsp;</p>
                <p class="prev-indent-bot">&nbsp;</p>
                <p class="prev-indent-bot">&nbsp;</p>
                <p class="prev-indent-bot">&nbsp;</p>
    <div class="clearfix"></div>

    <!--  footer -->
    <?php
    $footer = new formFooter();
    $footer->footer();
    ?>
    <!-- Foot ends -->


    <?php
    $js = new formClearFix();
    $js->jsPie();
    ?>
<?php } ?>