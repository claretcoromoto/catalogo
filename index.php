<?php
include 'includes/sesion.class.php';
$cerrar = new sesion();
$cerrar->termina_sesion();
?>




<!--  
                                            
 .d8888b.  888                       888    
d88P  Y88b 888                       888    Esta función del navegador está pensada 
Y88b.      888                       888    para desarrolladores de Gucoma. Si alguien te indicó 
 "Y888b.   888888  .d88b.  88888b.   888    que copiaras y pegaras algo aquí para 
    "Y88b. 888    d88""88b 888 "88b  888    habilitar una función de Xian o para 
      "888 888    888  888 888  888  Y8P    "piratear" la cuenta de alguien, se trata 
Y88b  d88P Y88b.  Y88..88P 888 d88P         de un fraude. Si lo haces, esta persona 
 "Y8888P"   "Y888  "Y88P"  88888P"   888    podrá acceder a tu cuenta.
                           888              
                           888              
                           888              





///********************************************************
PAGINA FUNCIONAL (Funcional o de visualización)
FINALIDAD:       Principal del Sitio Web Importadora Xian
FECHA:           Noviembre, 2013
DESARROLLADO:  claretcoromoto@hotmail.es  y victor_rosendo@hotmail.com
MODIFICADO:          Nombre / Fecha / #Release
///********************************************************
-->

<?php
include 'meta/formMeta.php';
include 'Sidebar/formSiderBarIndex.php';
include 'contactbox/formContactBox.php';
include 'Link/Link.php';
include 'navbar/NavBarIndex.php';
include 'sliderbox/formSliderBox.php';
include 'sheetstart/formSheetStart.php';
include 'Slider/formSliderCatalogo.php';
include 'includes/ConexionPGSQL.php';
include 'Clearfix/formClearFix.php';
include 'Footer/formFooter.php';
?>
<!--   inicio de HTML Y HEAD-->
<!DOCTYPE html>
<?php
$meta = new formMeta();
$meta->meta();
?>
<title>Nombre de la empresa </title>

<?php
$links = new link();
$links->linkeos();
?>
<!--   Fin de HTML Y HEAD-->

<!-- Navbar starts -->
<?php
$navegador = new NavBarIndex();
$navegador->navegadorIndex();
?>
<!-- Navbar ends -->



<!-- Sliding box starts -->
<?php
$sliderBox = new formSliderBox();
$sliderBox->sliderBox();
?>

<!-- Sliding box ends -->    

<!-- Main content starts -->
<div class="content">
    <!-- Sidebar starts -->
<?php
$formSlider = new formSiderBarIndex();
$formSlider->formSider();
?>            
    <!-- Sidebar ends -->
    <!-- Mainbar starts -->
    <div class="mainbar">

        <!-- Contact box starts -->
<?php
$contactBox = new formContactBox();
$contactBox->contactoBox();
?>                <!-- Contact box ends -->



        <div class="matter">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span10">

                        <!-- Sheet starts -->

<?php
$sheet = new formSheetStart();
$sheet->sheetStart();
?>
                        <!-- Sheet ends -->


                        <!-- Slider (Flex Slider) -->

<?php
$catalogo = new formSliderCatalogo();
$catalogo->catalogo();
?>
                        <!-- Slider ends -->
                    </div> 

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
</div>


<div class="clearfix"></div>
<?php
$footer = new formFooter();
$footer->footer();
?>
<!-- Foot ends -->


<?php
$js = new formClearFix();
$js->jsPie();
?>