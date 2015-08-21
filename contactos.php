<?php
include 'includes/sesion.class.php';
$cerrar = new sesion();
$cerrar->termina_sesion();
?>
<?php
include 'meta/formMeta.php';
include 'Sidebar/formSiderBarIndex.php';
include 'contactbox/formContactBox.php';
include 'Link/Link.php';
include 'navbar/NavBar.php';
include 'sliderbox/formSliderBox.php';
include 'sheetstart/formSheetStart.php';
include 'Slider/formSliderCatalogo.php';
include 'formularios/formBlock.php';
include 'newletter/formNewLetter.php';
include 'Service/formService.php';
include 'Clearfix/formClearFix.php';
include 'Footer/formFooter.php';
include 'Post/formPost.php';
?>
<!DOCTYPE html>
<?php $meta = new formMeta();
$meta->meta();
?>
<title>Contacto</title>

<?php
$links = new link();
$links->linkeos();
?>
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
                <div class="row-fluid">
                    <div class="span12">
                        <!-- Sheet starts -->
                        <!-- Title starts -->
                        <div class="page-title">
                            <h2>Contáctanos</h2>
                            <p>Importadora Xian, C.A. </p>
                            <hr />
                        </div>
                        <!-- Title ends -->
                        <!-- Content starts -->
                        <div class="box-body contactus" aligncenter>
                            <div class="span12" aligncenter>
                                <!-- Google maps -->
                                <div class="gmap">
                                    <!-- Google Maps. Replace the below iframe with your Google Maps embed code -->
                                    <iframe width="450" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=d&amp;source=s_d&amp;saddr=Av.+Boulevar+Naiguat%C3%A1,+E%2FS+Tanaguarena+Caribe&amp;daddr=Av.+Boulevar+Naiguat%C3%A1,+E%2FS+Tanaguarena+Caribe&amp;hl=es&amp;geocode=FeP4oQAdlQ8E_Ck9xhbatloqjDHSb8MQPcBXOQ%3BFeP4oQAdlQ8E_Ck9xhbatloqjDHSb8MQPcBXOQ&amp;aq=&amp;sll=6.42375,-66.58973&amp;sspn=26.361941,43.286133&amp;mra=ls&amp;ie=UTF8&amp;ll=10.615011,-66.842731&amp;spn=0,0&amp;t=m&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=d&amp;source=embed&amp;saddr=Av.+Boulevar+Naiguat%C3%A1,+E%2FS+Tanaguarena+Caribe&amp;daddr=Av.+Boulevar+Naiguat%C3%A1,+E%2FS+Tanaguarena+Caribe&amp;hl=es&amp;geocode=FeP4oQAdlQ8E_Ck9xhbatloqjDHSb8MQPcBXOQ%3BFeP4oQAdlQ8E_Ck9xhbatloqjDHSb8MQPcBXOQ&amp;aq=&amp;sll=6.42375,-66.58973&amp;sspn=26.361941,43.286133&amp;mra=ls&amp;ie=UTF8&amp;ll=10.615011,-66.842731&amp;spn=0,0&amp;t=m" style="color:#0000FF;text-align:left">Ver mapa más grande</a></small>
                                </div>

                            </div>
                        </div>

                        <!-- Inicio de fluid -->
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="well">
                                    <!-- Address section -->
                                    <h5>Dirección</h5>
                                    <hr />
                                    <div class="address">
                                        <address>
                                            <!-- Company name -->
                                            <h6>Importadora Xian, C.A.</h6>
                                            <!-- Address – -->
                                            Av. Boulevar Naiguatá, E/S Tanaguarena Caribe<br>
                                            Caraballeda, Edo. Vargas – Venezuela<br>
                                            <!-- Phone number -->
                                            <abbr title="Phone">Teléfonos:</abbr> +58212 353.42.77 | 212 353.42.81 | 212 353.38.84
                                        </address>
                                         </div><!-- Fin de address-->
                                </div><!-- Fin de well -->
                            </div><!-- Fin de span 6 -->
                        </div>    <!-- Fin de row fluid interno  -->


                    </div><!-- Fin del cuerpo de contacto-->

                </div><!-- Fin de span12 -->
            </div><!-- Fin de row fluid externo -->
        </div>   <!-- Fin de container fluid -->
    </div> <!--  Matter ends -->


</div> <!-- Mainbar ends -->


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