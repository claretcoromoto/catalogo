<?php
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idAuto1 = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header('location: login.php');
}
if (!$rol == 2) {
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
    include 'Sidebar/formSiderBar.php';
    include 'contactbox/formContactBox.php';
    include 'Link/Link.php';
    include 'navbar/NavBarAdmin.php';
    include 'Sidebar/formSiderBarMenuAutor1.php';
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
    <title>Solicitudes pendientes del cliente</title>
    <script type="text/javascript" src="js/functions.js"></script>
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
        <?php
        $sideBarAdmin = new formSiderBarMenuAutor1();
        $sideBarAdmin->formSider();
        ?>
        <div class="mainbar" align="center">
            <div class="box-body">

                <div class="span12" >
                    <div class="page-title" align="left">
                        <h4>Solicitudes pendientes de clientes</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span9" >



                                <!-- Buscar Rif y Razón Social<div class="well login-register-table">-->

                                <?php
                                $sql = "SELECT tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
                tblsit_usr.ci_rif_cliente AS tblsit_usr_ci_rif_cliente,
                tblsit_usr.tx_direccion AS tblsit_usr_tx_direccion,
                tblsit_usr.nb_persona_contacto AS tblsit_usr_nb_persona_contacto,
                tblsit_usr.tx_telf_contacto AS tblsit_usr_tx_telf_contacto,
                tblsit_usr.tx_login AS tblsit_usr_tx_login,
                tblsit_ciudad.nb_ciudad AS tblsit_ciudad_nb_ciudad,
                tblsit_municipio.nb_municipio AS tblsit_municipio_nb_municipio,
                tblsit_estado.nb_estado AS tblsit_estado_nb_estado,
                tblsit_usr.in_status_cliente AS tblsit_usr_in_estatus_cliente
                FROM tblsit_ciudad tblsit_ciudad 
                INNER JOIN tblsit_usr tblsit_usr ON tblsit_ciudad.id_ciudad = tblsit_usr.id_ciudad
                INNER JOIN tblsit_municipio tblsit_municipio 
                ON tblsit_ciudad.id_municipio = tblsit_municipio.id_municipio
                INNER JOIN tblsit_estado tblsit_estado ON tblsit_municipio.id_estado = tblsit_estado.id_estado
                 WHERE tblsit_usr.id_rol_usr = 4 AND (tblsit_usr.in_status_cliente = 2 OR tblsit_usr.in_status_cliente = -2) AND id_usr_autor_clte=$idAuto1";
                                $result = @pg_query($sql);
                                if ($numrow = pg_num_rows($result) > 0) {
                                    ?>
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th auto >RIF</th>
                                                <th auto >Razón social</th>
                                                <th auto>Email</th>
                                                <th auto >Estatus</th>
                                                <th auto >Procesar</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <?php
                                            while ($row = pg_fetch_array($result)) {
                                                ?>
                                                <!-- Primer formulario-->   <tr> 
                                        <form class="form-horizontal"  onsubmit="return checkSubmit();"  method="post" action="controlador/controller_autori.php" >

                                                <td id="e"> <?php echo $row['tblsit_usr_ci_rif_cliente'] ?></td>
                                                <td id="edit"><?php echo $row['tblsit_usr_razon_social_cliente'] ?></td> 
                                                <td id="edit"><?php echo $row['tblsit_usr_tx_login'] ?></td> 
                                                <?php if ($row['tblsit_usr_in_estatus_cliente'] == 2) { ?>
                                                    <td id="edit"><span class="label label-warning">Pendiente</span></td> 
                                                <?php } else if ($row['tblsit_usr_in_estatus_cliente'] == -2) { ?>
                                                    <td id="edit"><span class="label label-info">Reactivado</span></td> 
                                                <?php } ?>
                                                <form class="form-horizontal"  onsubmit="return checkSubmit();"  method="post" action="includes/ActualizarEstatusCliente.php" >
                                                    <input type = "hidden" name="accion" id = "accion"    value ='0' required/>
                                                    <input  name="rifcli" type="hidden" id="rif" value="<?php echo $row['tblsit_usr_ci_rif_cliente'] ?>">
                                                    <td><button title="Procesar" class="btn btn-mini btn-success"><i class="icon-ok"></i></button>         
                                                     </td> 
                                                </form>
                                                </tr>
                                                <!--Segundo formulario-->

                                                </tbody>
                                            <?php } ?> 
                                    </table> 
                                <?php } else {
                                    ?>
                                    <div class="form-horizontal" aligncenter >                                        <br><br>
                                        <center >
                                            <center class="hero-unit" >      <p > <h4> No hay solicitudes pendientes</h4>   </p>   </center></center>
                                    </div>
                                <?php } ?>
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
