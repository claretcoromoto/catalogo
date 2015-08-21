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
    <title>Municipios</title>
    <script type="text/javascript" src="js/functions.js"></script>

    <script language="javascript" type="text/javascript">
        $(document).ready(function() {

            $('input[type="submit"]').attr('disabled', 'disabled');

            $('input[type="text"]').keypress(function() {

                if ($(this).val() != '') {

                    $('input[type="submit"]').removeAttr('disabled');

                }

            });

        });

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
                                <h4>Registrar municipio</h4>
                                <p>Importadora Xian, C.A.</p>
                                <hr/>
                            </div>


                            <div class="span14">
                   <?php
                            $sqlcat = "SELECT * FROM tblsit_estado ORDER BY nb_estado ASC";
                            $result = @pg_query($sqlcat);
                            $estad = '';
                            while ($row = pg_fetch_array($result)) {
                                $estad .=" <option value=" . $row['id_estado'] . "> " . $row['nb_estado'] . "</option>";
                            }
                            ?>
                     <div class="well login-register">
            <h6>Insertar datos </h6>
            <hr />
                    <!-- Buscar Rif y Razón Social-->
                    <form class="form-horizontal"  mmethod="post" action="includes/RegistrarMunicipio.php" >
                        <!-- RIF -->
                        <div class="control-group">
                            <label class="control-label" for="municipio">Municipio</label>
                            <div class="controls">
                                <input  class="input-medium"  pattern="^[a-zA-Z\-_ ]{3,20}$"  type="text" title="Por favor, introduzca el nombre del municipio"  placeholder="Caracas, Maracaibo" name="municipio" id="ciudad"  required autofocus />
                            </div>
                        </div>   

                        <div class="control-group">
                            <label class="control-label" for="id_estado">Estado:</label>
                            <div class="controls">
                                <select  class="input-medium"   name="id_estado" id="id_estado"  required>
                                    <?php echo  $estad ?>
                                </select>  
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
