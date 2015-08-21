<?php error_reporting(0);
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} if (!$rol == 1 ) {
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
    <title>reasiganción de clientes a vendedores</title>
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
                    <h4>Reasignar varios clientes</h4>
                    <p>Importadora Xian, C.A.</p>
                    <hr/>

                </div> 

                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span10" >



                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td width="auto">RIF del cliente</th>
                                        <td width="auto">Razón social del cliente</th>
                                        <td width="auto">RIF del vendedor asociado</th>
                                        <td width="auto">Email del vendedor</th>
                                        <td width="300">Reasignar otro  vendedor</th>  
                                    </tr>
                                </thead> <?php
                                $sql = "SELECT * FROM tblsit_usr WHERE id_rol_usr = 4  AND  in_status_cliente = 1 ";
                                $result = @pg_query($sql);
                                $sesion->set('rifCliente', $rifCliente);
                                while ($file = pg_fetch_array($result)) {
                                    $idv = $file['id_usr_vendedor'];
                                    $sql2 = "SELECT  ci_rif_cliente, tx_login FROM tblsit_usr  WHERE id_usr =$idv  AND id_rol_usr = 5   AND in_status_usr = 1 ";
                                    $result2 = @pg_query($sql2);
                                    $file2 = pg_fetch_array($result2);
                                    ?>  
                                    <tbody>

                                        <tr> 
                                            <td id="id"><?php echo $file['ci_rif_cliente'] ?></td> 
                                            <td id="nb"><?php echo $file['razon_social_cliente'] ?></td> 
                                            <td id="id"><?php echo $file2['ci_rif_cliente'] ?></td> 
                                            <td id="id"><?php echo $file2['tx_login'] ?></td>
                                            <td align="center">  
                                                <form    name="QForm"    class="form-horizontal" method="post" action="includes/ReasignarVendedorAClientes.php" />
                                                <input  title="Por favor, introduce un email válido" type="text"  id="emailv"  placeholder="ejemplo@dominio.com"  
                                                        name="emailv" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus required/>
                                                <input  claas="mayuscula"   type="hidden" id="rifc" name="rifc" value="<?php echo $file['ci_rif_cliente'] ?>" required >
                                                <input   class="input-medium" class="mayuscula" pattern="(^([VEJPG]{1})([0-9]{9}$)"  placeholder="V106128118" type="text"  id="rifv" name="rifv" required > 
                                                <button title="Asignar vendedor" class="btn btn-mini btn-success"><i class="icon-ok"></i></button>
                                                <button title="Limpiar" type="reset" class="btn btn-mini btn-danger" ><i class="icon-repeat "></i></button>
                                                </form>    
                                            </td>  
                                        </tr></tbody>
                                <?php } ?>

                            </table> 
                        </div>           

                    </div>
                </div>
            </div>
        </div>  </div>  </div>
    <br><br><br>
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