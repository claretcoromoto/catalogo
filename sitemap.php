<?php
include 'includes/sesion.class.php';
$cerrar = new sesion();
$cerrar->termina_sesion();
?>
<!-- Inicio de includes de las Vistas -->

<?php
ini_set("error_reporting", "E_ALL & ~E_NOTICE"); //está desconmentar para que no salgan los errores warning
include 'meta/formMeta.php';

include 'contactbox/formContactBox.php';
include 'Link/Link.php';
include 'navbar/NavBar.php';
include 'navbar/NavBarIndex.php';
include 'Sidebar/formSiderBarIndex.php';
include 'sliderbox/formSliderBox.php';
include 'sheetstart/formSheetStart.php';
include 'slider/formSliderCatalogo.php';

include 'Clearfix/formClearFix.php';
include 'Footer/formFooter.php';
include 'Post/formPost.php';
include 'includes/ConexionPGSQL.php';
//
?>
<!-- Fin de includes de las Vistas -->

<!-- Fin de Includes de  Procesos -->
<!--  
///********************************************************
PAGINA FUNCIONAL (Funcional o de visualización)
FINALIDAD:      SITEMAP (Vendedores y Clientes)
FECHA:           Diciembre, 2013
DESARROLLADO:  claretcoromoto@hotmail.es
MODIFICADO:          Nombre / Fecha / #Release
///********************************************************
-->

<!DOCTYPE html>
<!--   inicio de HTML Y HEAD-->
<?php
$meta = new formMeta();
$meta->meta();
?>
<title>Login</title>

<?php
$links = new link();
$links->linkeos();
?>
<!--   Fin de HTML Y HEAD-->

<!-- Navbar starts $nav = new NavBar();
$nav->navegador();-->
<?php
$nav = new NavBar();
$nav->navegador();
?>
<div class="slide-box">
    <div class="bor"></div>
    <div class="padd">
        <div class="slide-box-button">
            <i class="icon-chevron-left"></i>
        </div>
        <h5>Welcome</h5>
        Lorem ipsum dolor sit amet, constur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.

        <hr />

        <div class="social">
            <a href="#"><i class="icon-facebook facebook"></i></a>
            <a href="#"><i class="icon-twitter twitter"></i></a>
            <a href="#"><i class="icon-linkedin linkedin"></i></a>
            <a href="#"><i class="icon-google-plus google-plus"></i></a>
            <a href="#"><i class="icon-pinterest pinterest"></i></a>
        </div>

    </div>
</div>
<!-- Main content starts -->
<div class="content">
    <!-- Sidebar starts -->
    <?php
    $navegador = new formSiderBarIndex();
    $navegador->formSider();
    ?>
    <!-- Sliding box starts -->
    <div class="mainbar">
        <?php
        $sliderBox = new formSliderBox();
        $sliderBox->sliderBox();
        ?>
        <!-- Sliding box ends  --> 
        <div class="span12">
            <br>
            <div class="box-body">



                <h3><i class="icon-sitemap"></i>Mapa del Sitio</h3>

                <ul class="breadcrumb">
                    <li><a href="#">Inicio</a> <span class="divider">/</span></li>
                    <li  class="active"><a href="#">Mapa del Sitio</a> <span class="divider">/</span></li>

                </ul>  

                <table class="tab-content table-striped table-hover tab-content-segment">

                    <tr><td class="lpage"><a href="http://localhost:8080/20141001-xian-02/" title="Importadora Xian, C.A.">Importadora Xian, C.A.</a></td></tr>
                    <tr><td class="lpage"><a href="http://localhost:8080/20141001-xian-02/login.php" title="Login">Login</a></td></tr>
                    <tr><td class="lpage"><a href="http://localhost:8080/20141001-xian-02/Buscar_Rif.php" title="Registrarse">Registrarse</a></td></tr>
                    <tr><td class="lpage"><a href="http://localhost:8080/20141001-xian-02/contactos.php" title="Contacto">Contacto</a></td></tr>
                    <tr><td class="lpage"><a href="http://localhost:8080/20141001-xian-02/acercade.php" title="Acerca de"</a>Acerca de</td></tr>
                    <tr><td class="lpage"><a href="http://localhost:8080/20141001-xian-02/Recuperar_Password.php" title="Recuperar Contraseña">Recuperar Contraseña</a></td></tr>
                </table>




            </div>  
         
 <div class="social" align='center'>
                  <a href="#"><i class="icon-facebook facebook"></i></a>
                  <a href="#"><i class="icon-twitter twitter"></i></a>
                  <a href="#"><i class="icon-linkedin linkedin"></i></a>
                  <a href="#"><i class="icon-google-plus google-plus"></i></a>
                  <a href="#"><i class="icon-pinterest pinterest"></i></a>
                </div>

              <p class="prev-indent-bot">&nbsp;</p>
                    <p class="prev-indent-bot">&nbsp;</p>
        </div>
      
    </div>
</div>
<div class="clearfix"></div>
<!-- Main content ends -->
<!-- Footer -->
<?php
$footer = new formFooter();
$footer->footer();
?>
<!-- Footer fin -->
<!-- Scroll to top -->

<?php
$js = new formClearFix();
$js->jsPie();
?>