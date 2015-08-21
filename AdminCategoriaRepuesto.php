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
if (!$rol == 1 || ($rol == 2) || ($rol == 3)) {
    header("Location: AdminMenuPrincipal.php");
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


                    <div class="span14">
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="span12" >
                                    <!-- Buscar Rif y Razón Social-->
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="10">#</th>
                                                <th width="10">Categoría</th>
                                                <th width="10">Activo/Inactivo</th>
                                                <th width="10">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tblxian_categoria ORDER BY id_categoria ASC ";
                                            $result = pg_query($sql);
                                            while ($row = pg_fetch_array($result)) {
                                                ?>
                                                <tr> 
                                                    <td id="id"><?php echo $row['id_categoria'] ?></td> 
                                                    <td id="nb"><?php echo $row['tx_descr_categoria'] ?></td> 
                                                    <?php if ($row['in_activo'] === '1') { ?>
                                                        <td id="ina"><?php echo 'Activo' ?></td>
                                                        <!--<td>  <button  type="submit" name="enviar" class="btn btn-danger" >Desactivar</button></td>-->
                                                        <td align="center"><a href="includes/ActualizaCategoria.php?ids=<?php echo $row['id_categoria'] ?>&ina=0"> <button  title="Desactivar" class="btn btn-mini btn-danger" ><i class="icon-off"></i></button></a></td>     
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td id="ina"><?php echo 'Inactivo' ?></td>
                                                        <td align="center"><a href="includes/ActualizaCategoria.php?ids=<?php echo $row['id_categoria'] ?>&ina=1"> <button  title="Activar" class="btn btn-mini btn-success" ><i class="icon-ok"></i></button></a></td>  
                                                    <?php } ?>
                                                </tr> 
                                            <?php } ?>



                                        </tbody>
                                    </table>  
                                  
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
