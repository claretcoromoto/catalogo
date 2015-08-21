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
    include 'Sidebar/formSiderBarMenu.php';
    include 'contactbox/formContactBox.php';
    include 'Link/Link.php';
    include 'navbar/NavBarAdmin.php';
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


    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Categorización de repuestos</title>
    <script type="text/javascript" src="js/functions.js"></script>
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


    <div class="content">
        <br><br>

        <!-- Sidebar starts -->
        <?php
        $sideBarAdmin = new formSiderBarMenu();
        $sideBarAdmin->formSider();
        ?>   
        <div class="mainbar">
            <!-- Title starts  id="sometabs"  <div class="mainbar"> -->
            <div class="span14">
                <div class="box-body">

                    <div class="page-title" align="left">
                        <h4>Categorías de repuestos</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>

                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span12" >

                                <div class="well login-register">
                                    <!-- Buscar Rif y Razón Social-->
                                    <form class="form-horizontal"   method="post" action="includes/RegistrarCatRepuesto.php" >
                                        <!-- Categoría-->
                                        <fieldset>
                                            <legend  class="btn btn-danger " > Ingrese la nueva categoría del repuesto </legend>
                                            <div class="control-group">
                                                <label  class="control-label" for="categoria">Categoría :</label>
                                                <div class="controls">
                                                 <input   pattern="^[a-zA-Z0-9\-_]{3,20}$" class="mayuscula" type="text" title="Por favor, introduzca la categoría del repuesto"  placeholder="ARSEN, HORSE, TX" name="cat" id="cat"  required autofocus />
                                                  </div>
                                            </div>   
                                             <button  class="btn btn-danger" type="submit" name="enviar" class="btn">Registrar</button>
                                            <button  class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                            <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>
                                       </fieldset>
                                    </form> 
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div> </div> </div>
    <!--   fin del contenido de la página -->

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
<?php } ?>
