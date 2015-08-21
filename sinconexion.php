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

include 'sliderbox/formSliderBox.php';

include 'contactbox/formContactBox.php';
include 'Footer/formFooter.php';
include 'Clearfix/formClearFix.php';

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


<div class="content">
 
 
         <div class="span10">
        <div class="matter">
        <!-- Contact box starts -->
        <?php
        $contactBox = new formContactBox();
        $contactBox->contactoBox();
        ?>                <!-- Contact box ends -->



                <div class="box-body error">
                    <div class="row-fluid">

                        <div class="span12">
                            <div class="form-horizontal" aligncenter >                                        <br><br>
                                        <center >

                                            <center class="hero-unit" >      <p > <h4>Conexión fallida</h4>   </p>   </center></center>
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
<br>
<br>

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