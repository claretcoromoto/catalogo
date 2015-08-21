<?php error_reporting(0);
include 'includes/sesion.class.php';
$cerrar = new sesion();
$cerrar->termina_sesion();
?>
<!-- Inicio de includes de las Vistas -->

<?php
 //está desconmentar para que no salgan los errores warning
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
FINALIDAD:      Logueo del Usuario del Sistema (Vendedores y Clientes)
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
<title>Autenticación</title>

<?php
$links = new link();
$links->linkeos();
?>
<!--   Fin de HTML Y HEAD-->

<!-- Navbar starts 
<?php
$nav = new NavBar();
$nav->navegador();
?>

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



<!-- Main content starts aquí sólo el formulario de Logueo-->
<?php
 
include "formularios/formLogin.php";

$login= new formLogin();
$login->formlogin();
?>
</div>


 <div class="social" align='center'>
                  <a href="https://www.facebook.com/claretcoromoto.salazarguanipa"><i class="icon-facebook facebook"></i></a>
                  <a href="#"><i class="icon-twitter twitter"></i></a>
                  <a href="#"><i class="icon-linkedin linkedin"></i></a>
                  <a href="#"><i class="icon-google-plus google-plus"></i></a>
                  <a href="#"><i class="icon-pinterest pinterest"></i></a>
                </div>

              <p class="prev-indent-bot">&nbsp;</p>
                    <p class="prev-indent-bot">&nbsp;</p>

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