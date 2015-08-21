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
DESARROLLADO:    claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
MODIFICADO:          Nombre / Fecha / #Release
///********************************************************
-->
<!-- visas -->
<?php
include 'meta/formMeta.php';
include 'Sidebar/formSiderBar.php';
include 'contactbox/formContactBox.php';
include 'Link/Link.php';

include 'sliderbox/formSliderBox.php';
include 'sheetstart/formSheetStart.php';
include 'formularios/formSliderSpan6Ini.php';
include 'formularios/formSliderSpan6Fin.php';
include 'formularios/formInicioContent12.php';
include 'formularios/formConten12Fin.php';
include 'sidebar/formSiderBarIndex.php';

include 'Clearfix/formClearFix.php';
include 'Footer/formFooter.php';
include 'Post/formPost.php';
?>
<!-- procesos -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
$meta = new formMeta();
$meta->meta();
?>
<title>Recuperar Contraseña</title>

<?php
$links = new link();
$links->linkeos();
?>



<!-- Navbar starts -->


<!-- Navbar ends -->


<!-- Sliding box starts -->
<?php
$sliderBox = new formSliderBox();
$sliderBox->sliderBox();
?>
<!-- Sliding box ends -->    

<!-- Main content starts $form = new formValidarRif();
$form->formValidarRif(); -->

<?php
$contentI = new formInicioContent12();
$contentI->content12Ini();
?>




<div class="well login-register">
    <h5>Recuperar contraseña</h5>
    <hr />
  
        <!-- Buscar Rif y Razón Social-->
        <form class="form-horizontal" name="resetearpassword" method="post" action="includes/ResetearPassword.php" >

            <!-- Username   -->
            <div class="control-group">
                <label class="control-label" for="email">Usuario:</label>
                <div class="controls">
                    <input type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                           name="email" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus required />  
                </div>   
            </div>  
 <!-- Password -->
            <div class="control-group">
                <label class="control-label" for="password">Contraseña provisional:</label>
                <div class="controls">
                    <input type="password" class="input-large" id="passpro" name="passpro" placeholder="Código provisional" required>
                </div>
            </div>
            <!-- Password -->
            <div class="control-group">
                <label class="control-label" for="password">Nueva contraseña:</label>
                <div class="controls">
                    <input type="password" class="input-large" min="6" max="12" maxlength="12" id="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <!-- Password -->
            <div class="control-group">
                <label class="control-label" for="password">Confirmar contraseña:</label>
                <div class="controls">
                    <input type="password" min="6" max="12" maxlength="12"  class="input-large" id="repassword" name="repassword" placeholder="Re-password" required>
                </div>
            </div>
            <!-- Buttons <div class="form-actions">-->
            <div class="form-actions">
                <!-- Buttons -->
                <button  type="submit" name="enviar" class="btn btn-danger">Enviar</button>
                <button  type="reset" class="btn btn-danger">Limpiar</button>
            <a class="btn btn-danger" href="index.php">Cancelar</a>
                                        
            </div>
        </form>
    </div>



<br><br><br><br><br>



                    <!--   fin del contenido de la página -->
                    <?php
                    $fin = new formContent12Fin();
                    $fin->content12fin();
                    ?>

                    <!--   fin del contenido de la página -->

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
