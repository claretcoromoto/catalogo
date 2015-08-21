<?php
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} else if (!$rol == 5 || !$rol == 4) {
    header("Location: login.php");
} else {
    $c = $sesion->get('carrito');
    if (isset($c)) {
        ?>

        <!--
        ///********************************************************
        PAGINA FUNCIONAL (Funcional o de visualización)
        FINALIDAD:       Muestra los repuestos desde la base de datos
        FECHA:          2014
        DESARROLLADO:    claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
        MODIFICADO:          Nombre / Fecha / #Release
        ///********************************************************
        */

        <!-- Inicio de includes de las Vistas -->
        <?php
        include 'meta/formMeta.php';
        include 'Link/Link.php';
        include 'navbar/NavBarLogout.php';
        include 'formularios/formSiderBar2.php';
        include 'Footer/formFooter.php';
        include 'Clearfix/formClearFix.php';
        include 'Slider/formSliderCatalogo.php';
        include 'includes/ConexionPGSQL.php';
        ?>

        <!DOCTYPE html>

        <!--   inicio de HTML Y HEAD-->
        <?php
        $meta = new formMeta();
        $meta->meta();
        ?>
        <!-- Title and other stuffs  jquery-1.4.2.min -->
        <title>Catálogo de productos </title>

        <?php
        $links = new link();
        $links->linkeos();
        ?>

        <!--   Fin de HTML Y HEAD-->

        <!-- Navbar starts -->
        <?php
        $navegador = new NavBarLogout();
        $navegador->navegador($sesion->get('email'));
        ?>
        <!-- Navbar ends -->

       
        <!-- Sliding box starts -->
 
        <div class="content">
            <?php
        $formSlider1 = new formSiderBar2();
        $formSlider1->formSider();
        ?>

            <div class="mainbar"> 
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span8">

                                <?php
                                if (isset($_POST['enviar'])) {
                                    $code = $_POST['cod_repuesto'];
                                    $sql = "SELECT  id_categoria, tx_descr_categoria FROM tblxian_categoria WHERE cod_repuesto=LIKE '%$code%' ";
                                    $result = @pg_query($sql);
                                    if (isset($result)) {
                                        while ($row = pg_fetch_array($result)) {

                                            echo "<a href=listado_categoria_catalogo_final.php?id_categoria=$row[id_categoria]&tx_descr_categoria=$row[tx_descr_categoria]>$row[tx_descr_categoria]</a>";
                                        }
                                    }
                                    pg_free_result($result);
                                }
                                ?>    
                                <?php
                                $catalogo = new formSliderCatalogo();
                                $catalogo->catalogo();
                                ?>
                            </div>




                            <a href="javascript:enlaces('Registrar_pedidos.php')"></a>
                        </div> 

                    </div>
                </div>

            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- Main content starts -->
        <!-- Footer inicio -->


        <div class="clearfix"></div>

        <!-- Main content ends -->



        <!-- Scroll to top -->
        <span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 
                <?php
                $footer = new formFooter();
                $footer->footer();
                ?>
        <!-- Foot ends -->

        <?php
        $js = new formClearFix();
        $js->jsPie();
        ?>

        <?php
    }
}
?>
