<?php
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header('location: login.php');
}
if (!$rol == 1 ) {
    header("Location: login.php");
} else {
    ?>
    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Buscar el RIF para luego Registrar clientes
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
    include 'navbar/NavBarAdmin.php';
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
    <title>Buscar RIF del cliente</title>

    <?php
    $links = new link();
    $links->linkeos();
    ?>

    <!-- Navbar starts -->

    <?php
    $navegadornav = new NavBarAdmin();
    $navegadornav->navegador($email);
    ?>
    <!-- Navbar ends -->



    <?php
    $contentI = new formInicioContent12();
    $contentI->content12Ini();
    ?>

    <!-- Sliding box starts -->
    <?php
    $sliderBox = new formSliderBox();
    $sliderBox->sliderBox();
    ?>

    <!-- Sliding box ends -->    



    <div class="span4" align="center">
        <div class="well login-register">
            <!-- Buscar Rif y Razón Social-->
            <form class="form-search s-widget"   method="get" action="RegistrarCatRepuesto.php" >
                <!-- Categoría-->
                <fieldset>
                    <legend> Ingrese la nueva categoría del repuesto </legend>
                    <div class="input-append">
                        <label class="input-append" class="control-label">Categoría :</label>
                        <input class="input-append"  class="mayuscula" type="text" title="Por favor, introduzca la categoría del repuesto" class="input-medium" placeholder="ARSEN, HORSE, TX" name="categoria" id="categoria"  required autofocus />
                        <!-- Buttons -->
                        <button  class="btn btn-danger" type="submit" name="enviar" class="btn">Enviar</button>
                        <button  class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                        <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
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
<?php } ?>
