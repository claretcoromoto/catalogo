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
} else { ?>
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
        <title>Estatus </title>
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
                                <h4>Estatus del pedido</h4>
                                <p>Importadora Xian, C.A.</p>
                                <hr/>
                            </div>


                            <div class="span14">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <!-- Sliding box ends -->    
                            <?php
                            include 'includes/Consultas.php';
                            $rolNb = new Consultas();
                            $table = $rolNb->rolNb();
                            ?>
                            <div class="span8" align="center">
                                <!-- Buscar Rif y Razón Social-->
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Perfil</th>
                                            <th>Activo/Inactivo</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM tblxian_status_pedido ORDER BY id_status_pedido ASC ";
                                        $result = pg_query($sql);
                                        while ($row = pg_fetch_array($result)) {
                                            ?>
                                            <tr> 
                                                <td id="id"><?php echo $row['id_status_pedido'] ?></td> 
                                                <td id="nb"><?php echo $row['nb_status_pedido'] ?></td> 
                                                <?php if ($row['in_activo'] === '1') { ?>
                                                    <td id="ina"><?php echo 'Activo' ?></td>
                                                    <!--<td>  <button  type="submit" name="enviar" class="btn btn-danger" >Desactivar</button></td>-->
                                                    <td align="center"><a href="includes/ActualizarEstatusP.php?ids=<?php echo $row['id_status_pedido'] ?>&ina=0">  <button type="submit"  title="Desactivar" class="btn btn-mini btn-danger"><i class="icon-off "></i></button>   
                                                    <?php       } else { ?>
                                                    <td id="ina"><?php echo 'Inactivo' ?></td>
                                                    <td align="center"><a href="includes/ActualizarEstatusP.php?ids=<?php echo $row['id_status_pedido'] ?>&ina=1">  <button type="submit"  title="Activar" class="btn btn-mini btn-success"><i class="icon-ok "></i></button> 
                                                <?php } ?>
                                            </tr> 
                                        <?php } ?>
                                    </tbody>
                                </table>  
                                
                                <br><br><br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div></div>
        </div>
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
<?php  } ?>
