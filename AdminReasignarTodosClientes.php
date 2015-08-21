<?php
error_reporting(0);
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} if (!$rol == 1) {
    header("Location: login.php");
} else {
    ?>
    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';

    include 'Sidebar/formSiderBarMenu.php';
    include 'contactbox/formContactBox.php';

    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';
    include 'Slider/formSliderCatalogo.php';

    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';

    include 'includes/ConexionPGSQL.php';

    include 'includes/Consultas.php';
    include 'includes/getSetPedido.php';
    include 'includes/Rif.php';
    ?>
    <!DOCTYPE html>
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Vendedores disponibles</title>
 <script type="text/javascript">

        function f_CmbReasignar() {
            document.frm.action = "includes/ReasignarVendedorACliente.php";
            document.frm.submit();
        }

        function f_Cmb1() {
            document.frm.action = "includes/buscarRifVendedorReasignar.php";
            document.submit();
        }
    </script>

    <script type="text/javascript">
        function fn_AbrePopup(id)
        {
            var ancho = 600;
            var alto = 500;
            var url = 'detalleClientes.php?id=' + id;
            var posicion_x;
            var posicion_y;
            posicion_x = (screen.width / 2) - (ancho / 2);
            posicion_y = (screen.height / 2) - (alto / 2);
            window.open(url, 'popWindow', "width=" + ancho + ",height=" + alto + ",menubar=yes,toolbar=0,directories=yes,scrollbars=yes,resizable=no,left=" + posicion_x + ",top=" + posicion_y + "");
        }
        window.close();
    </script> 
    <?php
    $links = new link();
    $links->linkeos();
    ?>
    <!--   Fin de HTML Y HEAD-->

    <!-- Navbar starts -->
    <?php
    $navAdmin = new NavBarAdmin();
    $navAdmin->navegador($email);
    ?>

    <!-- Navbar ends -->


    <div class="content">
        <!-- Main content starts -->
        <br><br>

        <!-- Sidebar starts -->
        <?php
        $sideBarAdmin = new formSiderBarMenu();
        $sideBarAdmin->formSider();
        ?>   


        <!-- Title starts  id="sometabs"  <div class="mainbar"> -->
        <div class="mainbar">
            <div class="box-body">
                <div class="span12">
                    <div class="page-title" align="left">
                        <h4>Vendedores activos</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>

                    </div> 

                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span10" >



                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <td width="auto">RIF</th>
                                            <td width="auto">Razón social del cliente</th>
                                            <td width="auto">Email</th>
                                            <td width="auto">Teléfono</th>
                                            <td width="auto">Nº</th>

                                            <td width="auto">Selecciona</th>
                                        </tr>
                                    </thead> <?php
                                    /*  $ven = new Consultas();
                                      $vendemas = $ven->vendedorMas();
                                      echo  $vendemas.'<br>';
                                      $vendemenos = $ven->vendedorMenor();
                                      echo $vendemenos; */


                                    $sql = "SELECT * FROM tblsit_usr WHERE id_rol_usr =5 AND in_status_usr = 1 order by id_usr asc";
                                    $result = @pg_query($sql);
                            

                                    while ($file = pg_fetch_array($result)) {
                                        $scount = "SELECT COUNT(id_usr) AS contarusuario  FROM tblsit_usr WHERE id_usr_vendedor=$file[id_usr]";
                                        $resultc = @pg_query($scount);
                                        $rowc = pg_fetch_array($resultc);
                                        ?>  
                                        <tbody>
                                            <tr> 
                                                <td id="id"><?php echo $file['ci_rif_cliente'] ?></td> 
                                                <td id="nb"><?php echo $file['razon_social_cliente'] ?></td> 
                                                <td id="id"><?php echo $file['tx_login'] ?></td> 
                                                <td id="id"><?php echo $file['tx_telf_contacto'] ?></td>
                                                <td id="id"><?php echo $rowc['contarusuario'] ?></td>
                                               <!--  <td>  <a href="detalleClientes.php?id=<php echo $file['id_usr'] ?>" title="Asignar"  >
                                                                <img src="dispo.png" width="16" height="16">
                                                             </a></td>-->
                                               
                                                <td><input   class ="btn btn-danger" title="Pulse" type="button" value="<?php echo $file['id_usr'] ?>" onclick="fn_AbrePopup(this.value)"/> </td>

                                            </tr>
                                        </tbody>
    <?php } ?>

                                </table> 

                            </div>           

                        </div>
                    </div>
                </div>
            </div>  </div>   <p class="prev-indent-bot">&nbsp;</p>
    <p class="prev-indent-bot">&nbsp;</p>
    <p class="prev-indent-bot">&nbsp;</p></div>

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