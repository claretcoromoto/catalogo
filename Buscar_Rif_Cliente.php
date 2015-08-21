<?php require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if(!isset($email))
{
        header('location: login.php');
}
  if(!$rol==5  ){
    header("Location: login.php");
    }else{
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
    include 'navbar/NavBarLogout.php';
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
    $navegadornav = new NavBarLogout();
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


    <?php
    ?>

    <div class="span12" align="center">
        <div class="well login-register">
            <h6>Antes de registrar el cliente debe verificar el RIF en el SENIAT</h6>
            <hr />
            <div class="form">
                <!-- Buscar Rif y Razón Social-->
                <form class="form-horizontal"  method="get" action="includes/buscarRifBd.php" >
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
                            <a class="btn btn-danger" href="catalogo_final.php">Cancelar</a>

                            <!--       <button       <a class="btn btn-danger" href="index.php">Cancelar</a></button> -->
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <br><br><br><br><br>



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
