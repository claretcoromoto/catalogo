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
    FINALIDAD:       Editar municipio (Administrador)
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
    <title>Editar motivos</title>
    <script type="text/javascript" src="js/functions.js"></script>

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            $('button[type="enviar"]').attr('disabled', 'disabled');
            $('input[type="text"]').attr('disabled', 'disabled');
            $('input[type="number"]').attr('disabled', 'disabled');

            $('a[name="editar"]').click(function() {
                $('input[type="text"]').removeAttr('disabled');
                $('input[type="number"]').removeAttr('disabled');
                $('button[type="enviar"]').removeAttr('disabled');
                $("#edit").attr('disabled', 'disabled');
            });
        });</script>

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
                        <h4>Editar motivos</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>



                        <div class="span10">

                            <?php
                            $sql = "SELECT * FROM tblxian_motivo_anul ORDER BY id_motivo_anul ASC";
                            $result = pg_query($sql);
                            $comboMunicipio = '';
                            while ($row = pg_fetch_array($result)) {
                                $comboMunicipio .=" <option value=" . $row['id_motivo_anul'] . "> " . $row['nb_motivo_anul'] . "</option>";
                            }
                            ?>
                            <?php $loginFormAction = $_SERVER['PHP_SELF']; ?>
                            <div class="container-fluid">
                                <div class="row-fluid">
                                    <div class="span9" >
                                        <div class="box-body">
                                            <form action="<?php echo $loginFormAction ?>" method="get">
                                                <div class="control-group">
                                                    <label class="control-label" for="busqueda">Tipo de motivo</label>
                                                    <div class="controls">
                                                        <select name="busqueda2" id="busqueda">
                                                            <?php echo $comboMunicipio ?>
                                                        </select>


                                                        <!-- Buttons -->
                                                        <button class="btn btn btn-danger"  type="submit" name="enviar" class="btn">Enviar</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                    $loginFormAction = $_SERVER['PHP_SELF'];
                                    if (isset($_GET['busqueda2'])) {
                                        $id = $_GET['busqueda2'];
                                        ?>

                                        <div class="span9" >
                                            <div class="box-body">
                                                <!-- Buscar Rif y Razón Social<div class="well login-register-table">-->

                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>

                                                            <th auto >Nombre</th>
                                                            <th auto >Tipo</th>
                                                            <th auto >Estatus</th>
                                                            <th auto >Operaciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql = "SELECT * FROM tblxian_motivo_anul WHERE id_motivo_anul = '$id'  ORDER BY id_motivo_anul ASC";

                                                        $result = pg_query($sql);
                                                        while ($row = pg_fetch_array($result)) {
                                                            ?>
                                                            <tr> 
                                                                <!--
                                                                -->  <form class="form-search s-widget"   method="post" action="includes/ActualizarMotivoAnulacion.php" >
                                                            <input class="input-mini" readonly name="id" type="hidden" id="id_municipio" value="<?php echo $row['id_motivo_anul'] ?>">
                                                            <td id="nbc"><input class="input-large" name="nombre" type="text" id="campo" disabled="disabled" value="<?php echo $row['nb_motivo_anul'] ?>" ></td> 
                                                            <td id="nbc"><input class="input-mini" name="tipo" type="number" min="1" max="2" maxlength="1" id="campo" disabled="disabled" value="<?php echo $row['in_tipo'] ?>" ></td> 
                                                            <td id="nbm" disabled><?php echo $row['in_activo'] ?></td> 
                                                            <input  readonly name="email" type="hidden"  value="<?php echo $email ?>">
                                                            <td>
                                                                <a  class="btn btn-mini btn-reveal" name="editar" href="#"><i class="icon-edit "></i></a>

                                                                <button type="enviar"  title="Actualizar" class="btn btn-mini btn-success"><i class="icon-ok "></i></button>
                                                                <button class="btn-mini btn-danger" type="reset" class="btn btn-mini btn-danger"><i class="icon-repeat "></i></button>
                                                            </td> 

                                                            </tr> 
                                                        </form>
                                                    <?php } ?>
                                                    <br>     Los tipos de anulación y/o aprobación:
                                                    Clientes (1) y 
                                                    Pedido   (2)
                                                    </tbody>
                                                </table>  

                                            </div>       </div>

                                        <p class="prev-indent-bot">&nbsp;</p>

                                    <?php } ?>
                                </div>     </div>    



                        </div>   
                    </div>
                </div>    </div>      </div>     </div>  
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