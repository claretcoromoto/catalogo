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
    <title>Ciudad</title>
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
                                <h4>Editar ciudad</h4>
                                <p>Importadora Xian, C.A.</p>
                                <hr/>
                            </div>


                            <div class="span14">

<div class="container-fluid">
                    <div class="row-fluid">
                <?php
                $sql = "SELECT tblsit_ciudad.id_ciudad AS tblsit_ciudad_id_ciudad,
                tblsit_ciudad.nb_ciudad AS tblsit_ciudad_nb_ciudad,
                tblsit_municipio.nb_municipio AS tblsit_municipio_nb_municipio,
                tblsit_municipio.id_municipio AS tblsit_municipio_id_municipio,
                tblsit_estado.nb_estado AS tblsit_estado_nb_estado,
                tblsit_estado.id_estado AS tblsit_estado_id_estado

                 FROM 
                tblsit_municipio tblsit_municipio 
                INNER JOIN tblsit_ciudad tblsit_ciudad 
                ON tblsit_municipio.id_municipio = tblsit_ciudad.id_municipio 
                
                INNER JOIN tblsit_estado tblsit_estado
                ON tblsit_estado.id_estado = tblsit_municipio.id_estado 
                ORDER BY tblsit_ciudad_nb_ciudad  ASC ";
                $result = pg_query($sql);
                $comboCiudad = '';
                while ($row = pg_fetch_array($result)) {
                    $comboCiudad .=" <option value=" . $row['tblsit_ciudad_id_ciudad'] . "> " . $row['tblsit_ciudad_nb_ciudad'] . "[" . $row['tblsit_municipio_nb_municipio'] . "][" . $row['tblsit_estado_nb_estado'] . "]</option>";
                }
                ?>
                <?php $loginFormAction = $_SERVER['PHP_SELF']; ?>
                
                        <div class="span12">
                            <form action="<?php echo $loginFormAction ?>" method="get">
                                <div class="control-group">
                                    <label class="control-label" for="busqueda">Buscar  Ciudad [Municipio]</label>
                                    <div class="controls">
                                        <select name="busqueda2" id="busqueda">
                                            <?php echo $comboCiudad ?>
                                        </select>

                                        <!-- Buttons -->
                                        <button class="btn btn-danger"  type="submit" name="enviar" class="btn">Enviar</button>
                                    </div>
                                </div>
                            </form>
                     

                        <?php
                        $loginFormAction = $_SERVER['PHP_SELF'];
                        if (isset($_GET['busqueda2'])) {
                            $id_ciudad = $_GET['busqueda2'];
                            ?>

                           
                                <!--  <div class="span9" >Buscar Rif y Razón Social<div class="well login-register-table">-->

                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th auto >Ciudad</th>
                                            <th auto >Municipio</th>
                                            <th auto >Estado</th>
                                            <th auto >Operaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT tblsit_ciudad.id_ciudad AS tblsit_ciudad_id_ciudad,
                tblsit_ciudad.nb_ciudad AS tblsit_ciudad_nb_ciudad,
                tblsit_municipio.nb_municipio AS tblsit_municipio_nb_municipio,
                tblsit_municipio.id_municipio AS tblsit_municipio_id_municipio,
                tblsit_estado.nb_estado AS tblsit_estado_nb_estado,
                tblsit_estado.id_estado AS tblsit_estado_id_estado

                 FROM 
                tblsit_municipio tblsit_municipio 
                INNER JOIN tblsit_ciudad tblsit_ciudad 
                ON tblsit_municipio.id_municipio = tblsit_ciudad.id_municipio 
                
                INNER JOIN tblsit_estado tblsit_estado
                ON tblsit_estado.id_estado = tblsit_municipio.id_estado 
                WHERE id_ciudad=$id_ciudad
                ORDER BY tblsit_ciudad_nb_ciudad  ASC ";
                                        $result = pg_query($sql);
                                        while ($row = pg_fetch_array($result)) {
                                            ?>

                                            <!-- Buscar Rif y Razón Social-->
                                        <form class="form-search s-widget"   method="post" action="includes/ActualizarCiudad.php" >
                                            <!-- Categoría-->
                                            <tr> 
                                            <input readonly name="id_ciudad" type="hidden" id="id_ciudad" value="<?php echo $row['tblsit_ciudad_id_ciudad'] ?>">
                                            <td id="nbc"><input name="ciudad" type="text" id="d" value="<?php echo $row['tblsit_ciudad_nb_ciudad'] ?>"></td> 
                                            <td id="nbm"><?php echo $row['tblsit_municipio_nb_municipio'] ?></td> 
                                            <input class="input-mini" readonly name="id_municipio" type="hidden" id="id_municipio" value="<?php echo $row['tblsit_municipio_id_municipio'] ?>">
                                            <td id="nbm"><?php echo $row['tblsit_estado_nb_estado'] ?></td> 
                                            <td>   <button title="Editar"class="btn btn-mini btn-success" type="submit"  name="enviar" > <i class="icon-ok "></i></button>
                                                <button title="Cancelar" class="btn btn-mini btn-danger" type="reset" ><i class="icon-repeat "></i></button></td> 
                                            </tr> 
                                        </form>
                                    <?php } ?>

                                    </tbody>
                                </table>  

                            </div>

                            <p class="prev-indent-bot">&nbsp;</p>

                        <?php } ?>
                    </div>     </div>    
               
            </div>  
        </div>   
    </div>
    </div>   </div> 
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
