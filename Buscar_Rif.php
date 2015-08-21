<?php
include 'includes/sesion.class.php';
$cerrar = new sesion();
$cerrar->termina_sesion();
?>
<!--  
///********************************************************
PAGINA FUNCIONAL (Funcional o de visualización)
FINALIDAD:       Registrar clientes
FECHA:           Noviembre, 2013
DESARROLLADO:   claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
MODIFICADO:          Nombre / Fecha / #Release
///********************************************************
-->
<!-- visas -->
<?php
include 'meta/formMeta.php';
include 'Sidebar/formSiderBar.php';
include 'contactbox/formContactBox.php';
include 'Link/Link.php';
include 'navbar/NavBarL.php';
include 'sliderbox/formSliderBox.php';
include 'sheetstart/formSheetStart.php';
include 'formularios/formSliderSpan6Ini.php';
include 'formularios/formSliderSpan6Fin.php';
include 'formularios/formInicioContent12.php';
include 'formularios/formConten12Fin.php';
include 'Sidebar/formSiderBarIndex.php';

include 'Clearfix/formClearFix.php';
include 'Footer/formFooter.php';
include 'Post/formPost.php';

include 'formularios/formValidarRif.php';
include 'formularios/formRegistrarClientes.php';
include 'includes/ConexionPGSQL.php';
?>
<!-- procesos -->



<!DOCTYPE html>

<?php
$meta = new formMeta();
$meta->meta();
?>
<title>Buscar Rif en el Seniat</title>

<?php
$links = new link();
$links->linkeos();
?>

<!-- Navbar starts -->

<?php
$navegadornav = new NavBarL();
$navegadornav->navegador();
?>
<!-- Navbar ends 
?>
-->
<?php
$links = new link();
$links->linkeos();
?>
<!--   Fin de HTML Y HEAD-->


<!-- Sliding box starts -->
<?php
$sliderBox = new formSliderBox();
$sliderBox->sliderBox();
?>

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


<div class="span12" align="center">
    <div class="well login-register">
        <h6>Antes de registrarse debe verificar el RIF en el SENIAT</h6>
        <hr />
     
            <!-- Buscar Rif y Razón Social-->
            <form class="form-horizontal"  method="get" action="includes/buscarRifSeniatRe.php" >
                <!-- RIF -->
                <div class="control-group">
                    <label class="control-label" for="rif">RIF:</label>
                    <div class="controls">
                        <input type="text" class="mayuscula" pattern="(^([VEJPG]{1})([0-9]{9}$)" title="Por favor, introduzca el rif" class="input-large" placeholder="V106128118" name="rif" id="rif"  required autofocus />
                    </div>
                </div>   
                <!-- Buttons <div class="form-actions">-->
                <div class="control-group">
                    <div class="controls">
                        <button  type="submit" name="enviar" class="btn btn-danger"  >Enviar</button>
                        <button  type="reset" class="btn btn-danger">Limpiar</button>
                        <a class="btn btn-danger" href="index.php">Cancelar</a>

                        <!--       <button       <a class="btn btn-danger" href="index.php">Cancelar</a></button> -->
                    </div>
                </div>
            </form>
      

    </div>
</div></div></div> </div>
</div></div>
</div>

<br><br><br><br><br>



<!--   fin del contenido de la página -->
<?php
$fin = new formContent12Fin();
$fin->content12fin();
?>

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
