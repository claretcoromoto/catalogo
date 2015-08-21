<?php error_reporting(0);
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idAuto2 = $sesion->get("id_usr");
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
    <title>Solicitudes pendientes de pedidos</title>
    <script type="text/javascript" src="js/functions.js"></script>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet" type="text/css">

    <link href="style/bootstrap.css" rel="stylesheet">
    <!-- Font awesome icon -->
    <link rel="stylesheet" href="style/font-awesome.css">
    <!-- Flex slider -->
    <link rel="stylesheet" href="style/flexslider.css">
    <!-- prettyPhoto -->
    <link rel="stylesheet" href="style/prettyPhoto.css">
    <!-- Main stylesheet -->
    <link href="style/style.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="style/bootstrap-responsive.css" rel="stylesheet">
    <link href="style/tipsy.css" rel="stylesheet">
    <link href="style/tipsy-docs.css" rel="stylesheet">
    <link rel="stylesheet" href="animacion-css.css" type="text/css"> 
    <link rel="stylesheet" href="animacion-css.css" type="text/css">
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <script type="text/javascript">
        var statSend = false;
        function checkSubmit() {
            if (!statSend) {
                statSend = true;
                return true;
            } else {
                alert("El formulario ya se esta enviando...");
                return false;
            }
        }
    </script>
    <script language="javascript">

        function fn_AbrePopup(id)
        {
            var modurl = 'detallePedido.php?id=' + id;
            window.open(modurl, 'popWindow', 'scrollbars=no, width=500, height=400, top=230, left=350');

        }
        window.close();

    </script> 





    </head>
    <html oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
        <!-- Navbar starts -->

        <?php
        $navegadornav = new NavBarAdmin();
        $navegadornav->navegador($email);
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

            <div class="mainbar">

 <div class="span12" >    <div class="box-body">

                <div class="page-title" align="left">
                    <h4>Reactivación de pedidos</h4>
                    <p>Importadora Xian, C.A.</p>
                    <hr/>
              
                    <div class="container-fluid">
                        <div class="row-fluid">
<div class="span9" >
                            <!-- Buscar Rif y Razón Social<div class="well login-register-table">-->
                        
                                <?php
                                $sql = 'SELECT * FROM tblxian_pedido WHERE id_status_pedido = 3';
                                $result = @pg_query($sql);
                                function FechaESP($fecha) {
                                        if ($fecha != '') {
                                            $data = explode("-", $fecha);
                                            $retfecha = substr($data[2], 0, 2) . '/' . $data[1] . '/' . $data[0];
                                            return $retfecha;
                                        } else {
                                            $retfecha = '';
                                        }
                                    }
                                if ($num = pg_num_rows($result) > 0) {
                                    while  ($row = pg_fetch_array($result)) {
                                        $ids = $row['id_usr'];
                                        $idMotivoAnul = $row['id_motivo_anul'];
                                        $idP = $row['id_pedido'];
                                        $rif = $row['ci_rif_cliente'];

                                        $sqlc = 'SELECT * FROM tblsit_usr WHERE id_usr = ' . $ids . ' ';
                                        $resultc = @pg_query($sqlc);
                                        $rowc = pg_fetch_array($resultc);

                                        if (!$idMotivoAnul == '') {
                                            $sql3 = 'SELECT nb_motivo_anul FROM tblxian_motivo_anul WHERE id_motivo_anul=' . $idMotivoAnul . ' ';
                                            $result3 = @pg_query($sql3);
                                            $file3 = pg_fetch_array($result3);
                                            // aquí seleccionamos los motivos de reactivación
                                            $sql4 = "SELECT * FROM tblxian_motivo_anul WHERE in_activo=1 AND in_tipo=2";
                                            $result4 = @pg_query($sql4);
                                            $comboMotivoReac = '';

                                            while ($row4 = pg_fetch_array($result4)) {
                                                $comboMotivoReac .=" <option value=" . $row4['id_motivo_anul'] . "> " . $row4['nb_motivo_anul'] . "</option>";
                                            }

                                           // if ($row = pg_fetch_array($result)) {
                                                ?>
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead> 
                                                        <tr align="center">
                                                            <th auto >RIF</th>
                                                            <th auto >Razón social</th>
                                                            <th auto >Forma de pago</th>
                                                            <th auto >Fecha</th>
                                                            <th auto >Motivo de anulación</th>
                                                            <th auto >Estatus</th>
                                                            <th auto >#</th>
                                                            <th auto >Operaciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr> 
                                                            <td ><?php echo $row['ci_rif_cliente'] ?></td>
                                                            <td ><?php echo $rowc['razon_social_cliente'] ?></td> 
                                                            <td ><?php echo $row['tx_forma_pago'] ?></td> 
                                                            <td ><?php echo FechaESP($row['fe_registro']) ?></td>
                                                            <td ><?php echo $file3['nb_motivo_anul'] ?> </td>
                                                            <td ><span class="label label-inverse">Anulado</span> </td>
                                                            <td ><input type="button" value="<?php echo $row['id_pedido'] ?>" onclick="fn_AbrePopup(this.value)" /> </td> 
                                                    <form   method="post" onsubmit="return checkSubmit();"  action="includes/ActualizarReactivarPedido.php" >
                                                        <td> 
                                                            
                                                            <button type="submit"  title="Reactivar pedido" class="btn btn-mini btn-danger"><i class="icon-ok "></i></button>
                                                            <input  name="id_pedido" type="hidden" id="id_pedido" value="<?php echo $row['id_pedido'] ?>">
                                                            <input class="mayuscula" pattern="(^([VEJPG]{1})([0-9]{9}$)" name="rif" type="hidden" id="rif" value="<?php echo $row['ci_rif_cliente'] ?>">
                                                        </td>
                                                    </form>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <!--Segundo formulario-->
                                            </tr>
                                            </tbody>
                             
                                    </table>
                                <?php } else if ($num = pg_num_rows($result) == 0) { ?>
                                    <div class="form-horizontal" aligncenter >                                      

                                        <center class="hero-unit" > <h5> No hay pedidos para reactivar</h5></center>
                                    </div>

                                <?php } ?>
                            </div>  
                        </div>
                    </div>  
                </div>
            </div>

            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
            <p class="prev-indent-bot">&nbsp;</p>
        </div>
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
    <?php
}
?>
