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
if (!$rol == 1) {
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


    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Establecer condiciones de ventas</title>
    <script type="text/javascript" src="js/functions.js"></script>

    <script type="text/javascript">
        //<![CDATA[
        function validar(campo) {
            var elcampo = document.getElementById(campo);

            if ((!validarNumero(elcampo.value)) || (elcampo.value == "")) {
                elcampo.value = "";
                elcampo.focus();
                document.getElementById('mensaje').innerHTML = 'Debe ingresar un número decimal';
            }
            else {
                document.getElementById('mensaje').innerHTML = '';

                // Aqui pones el resto de las condiciones usando comparadores u operadores aritméticos, ya que estás seguro de que trabajas con números 

            }
        }

        function validarNumero(input) {
            return (!isNaN(input) && parseInt(input) == input) || (!isNaN(input) && parseFloat(input) == input);
        }

    </script>
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
                        <h4>Establecer condiciones de ventas</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>


                    <div class="span9">

                        <div class="well login-register">
                            <h6>Condiciones de venta</h6>
                            <hr />
                            <!-- Buscar Rif y Razón Social-->
                            <form class="form-horizontal"  method="get" action="includes/RegistrarCondVta.php" >
                                <!--MONTO MÍNIMO-->
                                <div class="control-group">
                                    <label class="control-label" for="contado">Monto mínimo:</label>
                                    <div class="controls">
                                        <input type="hidden" name="id_user" id= "id_user" value="<?php echo $idusr ?>">
                                        <input type="text" id="montomi" name="montomin" value="" onkeyup="validar(this.id);" required>
                                    </div>
                                </div> 
                                   <?php      $fechaIni= date("d-m-Y"); ?>
                                <div class="control-group">
                                    <label class="control-label" for="fecha1">Fecha inicial de vigencia:</label>
                                    <div class="controls">
                                       <input type="date" min="<?php echo $fechaIni ?>"  name="fecha1" id="fecha1" required>
                                    </div>
                                </div>   
                                 <div class="control-group">
                                    <label class="control-label" for="fecha2">Fecha final de vigencia:</label>
                                    <div class="controls">
                                       <input  type="date"  min="<?php echo $fechaIni ?>" name="fecha2" id="fecha2" required>
                                    </div>
                                </div>   
                                
                                <div class="control-group">
                                    <label class="control-label" for="iva">IVA (Impuesto al Valor Agregado)</label>
                                    <div class="controls">
                                        <input type="text" class="input-mini" min="2" id="iva" name="iva" value="" onkeyup="validar(this.id);" required>
                                        %
                                    </div>
                                </div> 
                                <!-- Buttons <div class="form-actions">-->
                                <div class="control-group">
                                    <div class="controls">   <button  class="btn btn-danger" type="submit" name="enviar" class="btn">Registrar</button>
                                        <button  class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                       <a class="btn btn-danger" href="AdminMenuPrincipal.php">Volver al menú</a>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>







                    <p class="prev-indent-bot">&nbsp;</p>
                    <p class="prev-indent-bot">&nbsp;</p>
                </div>  
            </div>   
        </div>
    </div>  
    <p class="prev-indent-bot">&nbsp;</p>
    <p class="prev-indent-bot">&nbsp;</p>
    <p class="prev-indent-bot">&nbsp;</p>


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
