<?php require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idAuto2 = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
//$rif = $sesion->get('rif');
if (!isset($email)) {
    header('location: login.php');
}
if (!$rol == 3) {
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
    include 'Link/Link.php';
    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'Sidebar/formSiderBarMenuAutor2.php';
    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
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
    <!-- <link href="style/tipsy.css" rel="stylesheet">
    <link href="style/tipsy-docs.css" rel="stylesheet"><link rel="stylesheet" href="animacion-css.css" type="text/css"> Favicon <link rel="stylesheet" href="animacion-css.css" type="text/css">-->
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <script type="text/javascript">
        //<![CDATA[
        function validar(campo) {
            var elcampo = document.getElementById(campo);

            if ((!validarNumero(elcampo.value)) || (elcampo.value == "")) {
                elcampo.value = "";
                elcampo.focus();
                document.getElementById('mensaje').innerHTML = 'Ingrese un número entero';
            }
            else {
                document.getElementById('mensaje').innerHTML = '';
                // Aqui pones el resto de las condiciones usando comparadores u operadores aritméticos, ya que estás seguro de que trabajas con números 

            }
        }

        function validarNumero(input) {
            return (!isNaN(input) && parseInt(input) == input);
        }
    </script>
    
    
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

    <!--
      <!-- Navbar starts -->

    <?php
    $navegadornav = new NavBarAdmin();
    $navegadornav->navegador($email);
    ?>
    <!-- Navbar ends -->


    <div class="content">
        <br><br>       
        <?php
        $sideBarAdmin = new formSiderBarMenuAutor2();
        $sideBarAdmin->formSider();
        ?>
        <div class="mainbar" align="center">
            <div class="box-body">

                <div class="span12" >
                    <div class="page-title" align="left">
                        <h4>Solicitudes pendientes de pedidos</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span10" >
                                
                                <!-- Buscar Rif y Razón Social<div class="well login-register-table">-->
                                
                             
 
    
                                       <?php
                                   $idAuto2 = $sesion->get("id_usr");
                                 $sql = "SELECT tblxian_pedido.ci_rif_cliente AS tblxian_pedido_ci_rif_cliente,
                tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
                tblsit_usr.in_status_cliente AS tblsit_usr_in_status_cliente,
                tblxian_tpo_entrega.nb_tpo_entrega AS tblxian_tpo_entrega_nb_tpo_entrega,
                tblxian_status_pedido.nb_status_pedido AS tblxian_status_pedido_nb_status_pedido,
                tblxian_pedido.fe_registro AS tblxian_pedido_fe_registro,
                tblxian_pedido.tx_forma_pago AS tblxian_pedido_tx_forma_pago,
                tblxian_pedido.tx_direccion_entrega AS tblxian_pedido_tx_direccion_entrega,
                tblxian_pedido.id_pedido AS tblxian_pedido_id_pedido,
                tblxian_pedido.id_status_pedido AS tblxian_pedido_id_status_pedido,
                tblxian_pedido.id_usr_autor_vta AS tblxian_pedido_id_usr_autor_vta
                 FROM 
                tblsit_usr tblsit_usr INNER JOIN tblxian_pedido tblxian_pedido 
                ON tblsit_usr.ci_rif_cliente = tblxian_pedido.ci_rif_cliente 
                INNER JOIN tblxian_status_pedido tblxian_status_pedido 
                ON tblxian_pedido.id_status_pedido = tblxian_status_pedido.id_status_pedido 
                INNER JOIN tblxian_tpo_entrega tblxian_tpo_entrega 
                ON tblxian_pedido.id_tpo_entrega = tblxian_tpo_entrega.id_tpo_entrega
                 WHERE 
                tblxian_pedido.id_usr_autor_vta=$idAuto2 AND 
                    (tblxian_status_pedido.nb_status_pedido='Pendiente'
                    OR tblxian_status_pedido.nb_status_pedido='Reactivado') 
                    AND tblsit_usr.in_status_cliente=1 ";
                                    $result = @pg_query($sql);
                                    
                                    
                                    if ($nu = pg_num_rows($result) > 0) {
                                        ?>
                                
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr align="center">
                                            <th auto >RIF</th>
                                            <th   auto  >Razón social</th>
                                            <th  auto>Forma de pago</th>
                                            <th auto  >Fecha</th>
                                            <th auto >Ver</th>
                                            <th auto >Estatus</th>
                                            <th auto >Operaciones</th>

                                        </tr>
                                    </thead>
                                
                                
                                <?php 
                                
                                 function FechaESP($fecha) {
                                        if ($fecha != '') {
                                            $data = explode("-", $fecha);
                                            $retfecha = substr($data[2], 0, 2) . '/' . $data[1] . '/' . $data[0];
                                            return $retfecha;
                                        } else {
                                            $retfecha = '';
                                        }
                                    }
                                        while ($row = pg_fetch_array($result)) {
                                            ?>
                                            <tbody>
                                                <tr> 
                                                    <td ><?php echo $row['tblxian_pedido_ci_rif_cliente'] ?></td>
                                                    <td ><?php echo $row['tblsit_usr_razon_social_cliente'] ?></td> 
                                                    <td ><?php echo $row['tblxian_pedido_tx_forma_pago'] ?></td> 
                                                    <td ><?php echo FechaESP($row['tblxian_pedido_fe_registro']) ?></td> 
                                                    <td ><input type="button" class="btn btn-mini btn-danger" value="<?php echo $row['tblxian_pedido_id_pedido'] ?>" onclick="fn_AbrePopup(this.value)" /> </td> 
                                                    <td><?php echo $row['tblxian_status_pedido_nb_status_pedido'] ?></td>
                                                    <?php if ($row['tblxian_pedido_id_status_pedido'] == 1 && $row['tblsit_usr_in_status_cliente'] == 1) { ?>
                                                        <td>   
                                                            <form   method="post" onsubmit="return checkSubmit();" action="includes/ActualizarAprobacionPedido.php" >  
                                                                <input  name="rif" type="hidden" id="rif" value="<?php echo $row['tblxian_pedido_ci_rif_cliente'] ?>">
                                                                <input  name="id_pedido" type="hidden" id="id_pedido" value="<?php echo $row['tblxian_pedido_id_pedido'] ?>">
                                                                N° Factura:    <input  pattern="[0-9]{1,5}" title="Poner número de factura" name="factura" class="input-mini"  type="text" id="factura" required>
                                                                <div id="mensaje" class="b-orange" align="center"></div>
                                                                <button type="submit"  title="Aprobar pedido" class="btn btn-mini btn-danger"><i class="icon-ok "></i></button>   
                                                                <a class="btn btn-mini btn-danger" type="reset" title="Cancelar" href="AdminSolPenCliPedidos.php"><i class="icon-repeat"></i></a>
                                                                
                                                            </form>  
                                                        </td>      
                                                    <?php } if ($row['tblxian_pedido_id_status_pedido'] == 4) {
                                                        ?>
                                                        <td>
                                                            <form   method="post" onsubmit="return checkSubmit();"  action="includes/ActualizarPendientePedido.php" > <input  name="id_pedido" type="hidden" id="id_pedido" value="<?php echo $row['tblxian_pedido_id_pedido'] ?>">
                                                                <input  name="rif" type="hidden" id="rif" value="<?php echo $row['tblxian_pedido_ci_rif_cliente'] ?>">
                                                                <button type="submit"  title="Pendiente pedido" class="btn btn-mini btn-danger"><i class="icon-ok "></i></button>
                                                                <button class="btn btn-mini btn-danger" type="reset" title="Cancelar"class="btn"><i class="icon-repeat"></i></button>
                                                            </form>
                                                        </td>
                                                    <?php } ?>

                                                    <!--Segundo formulario-->
                                                </tr>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                <?php } else { ?>


                                    <div class="form-horizontal" aligncenter >                                        <br><br>
                                        <center >

                                            <center class="hero-unit" >      <p > <h4> No hay solicitudes pendientes</h4>   </p>   </center></center>
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
