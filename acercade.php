<?php
include 'includes/sesion.class.php';
$cerrar = new sesion();
$cerrar->termina_sesion();
?>

<!--  
///********************************************************
PAGINA FUNCIONAL (Funcional o de visualización)
FINALIDAD:       Visualización Contactos del  Sitio Web Importadora Xian
FECHA:           Noviembre, 2013
DESARROLLADO:    Equipo Sitven Punto Fijo
MODIFICADO:          Nombre / Fecha / #Release
///********************************************************
-->
<?php
include 'meta/formMeta.php';
include 'Link/Link.php';
include 'navbar/NavBar.php';
include 'sliderbox/formSliderBox.php';
include 'Sidebar/formSiderBarIndex.php';
include 'contactbox/formContactBox.php';
include 'Footer/formFooter.php';
include 'Clearfix/formClearFix.php';
include 'includes/ConexionPGSQL.php';
?>
<!-- Fin de includes de las Vistas -->
<!DOCTYPE html>

<!--  Inicio html - head - link - inicio body -->
<?php
$meta = new formMeta();
$meta->meta();
?>

<?php
$links = new link();
$links->linkeos();
?>
<!--  Final html - head - link - fin body -->

<!-- Navbar starts -->

<?php
$navegador = new NavBar();
$navegador->navegador();
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


        <!-- Inicio de matter -->
        <div class="matter">
            <div class="container-fluid">

                <!-- Content starts -->
                <div class="box-body error">
                    <div class="row-fluid">
                        <div class="span12">
                            <h3>Importadora Xian</h3>
                            <p>Es una empresa dedicada a la importación de repuestos fundada en el año 2006, su sede principal está ubicada en la Urbanización Caribe. Edo. Vargas. En sus inicios se dedicó a la importación de motos, posteriormente en el año 2007 incursionaron en el rubro de repuestos, principalmente de motocicletas y en el año 2010 se convierte en el representante autorizado para la distribución y comercialización de la marca “Moss” en Venezuela y Latinoamérica. En la actualidad están dedicados a la comercialización de repuestos en el territorio venezolano con posibilidades de incursión en otros países.
                            </p>
                            <h4>Misión</h4>
                            <p>Ser una empresa líder en el mercado nacional e internacional de la importación y comercialización de repuestos, reconocida por su capacidad de prestar un servicio altamente confiable, con calidad, efectividad y eficiencia.
                            </p>
                            <h4>Visión</h4>
                            <p>Somos la empresa importadora y comercializadora de repuestos, corresponsables con el desarrollo de la nación, capaz de prestar un servicio excelente y competitivo a nuestros clientes a nivel nacional e internacional.
                            </p>



                        </div>

                    </div>
                </div>


            </div>
        </div>


    </div>

</div>
<!-- Content ends -->

<br>
<br>
<br>
<div class="social" align='center'>
    <a href="https://www.facebook.com/pages/Importadora-Xian-CA/236092683104292?sk=timeline"><i class="icon-facebook facebook"></i></a>
    <a href="#"><i class="icon-twitter twitter"></i></a>
    <a href="#"><i class="icon-linkedin linkedin"></i></a>
    <a href="#"><i class="icon-google-plus google-plus"></i></a>
    <a href="#"><i class="icon-pinterest pinterest"></i></a>
</div>

<p class="prev-indent-bot">&nbsp;</p>
<p class="prev-indent-bot">&nbsp;</p>

</div>

<div class="clearfix"></div>
<!-- Footer inicio -->
<?php
$footer = new formFooter();
$footer->footer();
?>
<!-- Foot ends -->


<?php
$js = new formClearFix();
$js->jsPie();
?>