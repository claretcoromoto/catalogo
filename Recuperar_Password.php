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
DESARROLLADO:    Equipo Sitven Punto Fijo
MODIFICADO:          Nombre / Fecha / #Release
///********************************************************
-->
<!-- visas -->
<?php
include 'meta/formMeta.php';
include 'Sidebar/formSiderBar.php';
include 'contactbox/formContactBox.php';
include 'Link/Link.php';
include 'navbar/NavBar.php';
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
?>
<!-- procesos -->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
$meta = new formMeta();
$meta->meta();
?>
<title>Recuperar Contraseña</title>
<script type="text/javascript">
    var statSend = false;
    function checkSubmit() {
        if (!statSend) {
            statSend = true;
            return true;
        } else {
            alert("El formulario ya se esta enviando...");
            return false;
        }
    }
</script>
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

<!-- Main content starts $form = new formValidarRif();
$form->formValidarRif(); -->

<?php
$contentI = new formInicioContent12();
$contentI->content12Ini();
?>




<div class="well login-register">
    <h5>Olvidé contraseña</h5>
    <hr />
    <div class="form">
        <!-- Buscar Rif y Razón Social-->
        <form class="form-horizontal" onsubmit="return checkSubmit();"  name="recuperarpassword" method="post" action="includes/RecuperarPassword.php" >
            <!-- RIF -->
            <div class="control-group">

                <label class="control-label" for="rif">RIF:</label>
                <div class="controls">
                    <input class="mayuscula" type="text" class="input-large" name="rif" id="rif"  required autofocus />
                </div>
            </div>   

            <!-- Username   -->
            <div class="control-group">
                <label class="control-label" for="email">Usuario:</label>
                <div class="controls">
                    <input type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  name="email"   pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus required/>  
                </div>   
            </div>  
            <div class="control-group">
                <label class="control-label" for="preg">Pregunta segura</label>
                <div class="controls">
                    <select name="preg" id="preguntaseg"  required>
                        <option> ¿Cuál es mi mascota preferida?</option>
                        <option> ¿Cuál es el nombre de mi mascota preferida?</option>
                        <option> ¿Cuál es el nombre de mi restaurant preferido?</option>
                        <option> ¿Dónde nació mi mamá?</option>
                        <option> ¿Dónde nació mi papá?</option>
                    </select>
                </div>
            </div> 

            <!-- Respuesta segura-->
            <div class="control-group">
                <label class="control-label" for="resp">Respuesta segura:</label>
                <div class="controls">
                    <input type="text" autocomplete class="input-large" id="respuestaseg" name="resp" required >
                </div>
            </div> 
            <!-- Buttons <div class="form-actions">-->
            <div class="form-actions">
                <!-- Buttons -->
                <button  type="submit" name="submit" class="btn btn-danger">Enviar</button>
                <button  type="reset" class="btn btn-danger">Limpiar</button>
                <a class="btn btn-danger" href="index.php">Cancelar</a>
            </div>
        </form>
    </div>

</div>

<br><br><br><br><br>
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


                    <!--   fin del contenido de la página -->
<?php
$fin = new formContent12Fin();
$fin->content12fin();
?>

                    <!--   fin del contenido de la página -->


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
