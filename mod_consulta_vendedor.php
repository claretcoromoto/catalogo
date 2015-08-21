<?php
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get("email");
$idusr = $sesion->get('id_usr');
$rol = $sesion->get('id_rol_usr');
if (!isset($email)) {
    header("Location: login.php");
} if (!$rol == 5) {
    header("Location: catalogo_final.php");
} else {



    include 'includes/ConexionPGSQL.php';
    include 'includes/Consultas.php';
   

    $con = new Consultas();
    $DatosPedidos = $con->consultarusr($idusr);
    $row_DatosPedidos = pg_fetch_array($DatosPedidos);
    $totalRows_DatosPedidos = pg_num_rows($DatosPedidos);

    $loginFormAction3 = $_SERVER['PHP_SELF'];

    if (isset($_POST['rif'])) {
        $rif = $_POST['rif'];
        $DatosPedidos = $con->consultarrif($idusr, $rif);
        $row_DatosPedidos = pg_fetch_assoc($DatosPedidos);
        $totalRows_DatosPedidos = pg_num_rows($DatosPedidos);
    } else if (isset($_POST['fecha1']) && isset($_POST['fecha2'])) {
        $fecha1 = $_POST['fecha1'];
        $fecha2 = $_POST['fecha2'];
        $DatosPedidos = $con->consultarfe($idusr, $fecha1, $fecha2);
        $row_DatosPedidos = pg_fetch_assoc($DatosPedidos);
        $totalRows_DatosPedidos = pg_num_rows($DatosPedidos);
    } else if (isset($_POST['id_pedido'])) {
        $id_pedido = $_POST['id_pedido'];
        $DatosPedidos = $con->consultaridrif($idusr, $id_pedido);
        $row_DatosPedidos = pg_fetch_assoc($DatosPedidos);
        $totalRows_DatosPedidos = pg_num_rows($DatosPedidos);
    } else if (isset($_POST['estatus'])) {
        $status = $_POST['estatus'];
        $DatosPedidos = $con->consultarestatus($idusr, $status);
        $row_DatosPedidos = pg_fetch_assoc($DatosPedidos);
        $totalRows_DatosPedidos = pg_num_rows($DatosPedidos);
    }
    ?>


    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    include 'contactbox/formContactBox.php';
    include 'navbar/NavBarVendedor.php';
    include 'Sidebar/formSiderBarMod.php';
    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    ?>
    <!--   inicio de HTML Y HEAD-->
    <!DOCTYPE html>
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Importadora Xian, C.A.</title>
    <script type="text/javascript" src="js/mootools.js"></script>
    <script type="text/javascript" src="js/moodalbox.js"></script> 

    <script type="text/javascript">
        function fn_AbrePopup(id)
        {
            var ancho=600;
            var alto=500;
            var url = 'detalle.php?id=' + id;
            var posicion_x;
            var posicion_y;
            posicion_x = (screen.width / 2) - (ancho / 2);
            posicion_y = (screen.height / 2) - (alto / 2);
            window.open(url,'popWindow', "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+""); 
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
    $nav = new NavBarVendedor();
    $nav->navende($email);
    ?>
    <!-- Navbar ends -->

    <!-- Content starts -->
    <br><br>
    <div class="content" >
        <?php
        $formSlider1 = new formSiderBarMod();
        $formSlider1->formSider();
        ?>
        <div class="mainbar">

            <div class="row-fluid">
                <!-- Title starts -->
                <br> 
                <div class="span12">  
                    <div class="box-body">
                        <div class="page-title">
                            <h2>Criterio de búsqueda</h2>
                            <p>Importadora xian, C.A.</p>
                            <hr />
                        </div>
                        <br>
                        <div class="span10">
                            <div class="container-fluid">   <!--  mainbar  jesus pelayo-->
                                <?php $loginFormAction = $_SERVER['PHP_SELF']; ?>
                                <form action="<?php echo $loginFormAction; ?>" method="post">
                                    <div class="control-group">
                                        <label class="control-label" for="busqueda">Búsquedas por RIF, fechas, estatus  y número de pedido</label>
                                        <div class="controls">
                                            <select name="busqueda2" id="busqueda">
                                                <option>RIF</option>
                                                <option>Fecha</option>
                                                <option>Estatus</option>
                                                <option>Pedido</option>
                                            </select>
                                            <!-- Buttons -->
                                            <button  type="submit" name="enviar" class="btn">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <br>

                                <?php
                                /* @var $loginFormAction type */
                                $loginFormAction = $_SERVER['PHP_SELF'];
                                if (isset($_POST['enviar'])) {
                                    if ($_POST['busqueda2'] == 'RIF') {
                                        $_POST['busqueda2'];
                                        ?>
                                        <form action="<?php echo $loginFormAction3; ?>" method="post">
                                            <div class="control-group">
                                                <label class="control-label" for="rif">Introduzca el RIF:</label>
                                                <div class="controls">
                                                    <input type="text" name="rif" id= "rif">
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <!-- Buttons -->
                                                <input type="submit" name="button2" id="button2" value="Buscar">
                                            </div>
                                        </form>
                                        <?php
                                    } else if ($_POST['busqueda2'] == 'Fecha') {
                                        $_POST['busqueda2'];
                                        ?>
                                        <form action="<?php echo $loginFormAction3; ?>" method="post" >
                                            <div class="control-group">
                                                <label class="control-label" for="fecha">Fecha: desde</label>
                                                <div class="controls" class="input-append" >
                                                    <input class="input-append" type="date" min="2014-06-01"  name="fecha1" id="fecha">
                                                    <label class="control-label" for="fecha2">hasta</label>
                                                    <input class="input-append" type="date" name="fecha2" id="fecha">
                                                    <!-- Buttons -->
                                                    <input type="submit" name="button2" id="button2" value="Buscar">
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                    } else if ($_POST['busqueda2'] == 'Estatus') {
                                        $_POST['busqueda2'];
                                        ?>
                                        <form action="<?php echo $loginFormAction3; ?>" method="post" >
                                            <div class="control-group">
                                                <label class="control-label" for="estatus">Introduzca el estatus</label>
                                                <div class="controls">
                                                    <select name="estatus" id="estatus">
                                                        <option>Pendiente</option>
                                                        <option>Aprobado</option>
                                                        <option>Anulado</option>
                                                        <option>Reactivado</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <!-- Buttons -->
                                                <input type="submit" name="button2" id="button2" value="Buscar">
                                            </div>
                                        </form>
                                        <?php
                                    } else if ($_POST['busqueda2'] == 'Pedido') {
                                        $_POST['busqueda2'];
                                        ?>
                                        <form action="<?php echo $loginFormAction3; ?>" method="post" >
                                            <div class="control-group">
                                                <label class="control-label" for="id_pedido">Introduzca el N°  de pedido:</label>
                                                <div class="controls">
                                                    <input  type="number" min="1" name="id_pedido" id="id_pedido" required>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <!-- Buttons -->
                                                <input type="submit" name="button2" id="button2" value="Buscar">
                                            </div>
                                        </form>
                                        <?php
                                    }
                                }
                                ?>

                                <br>


                                <?php
                                if ($totalRows_DatosPedidos > 0) {
                                    ?>  <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>RIF</th>
                                                <th>Fecha</th>
                                                <th>Tipo de entrega</th>
                                                <th>Status</th>
                                                <th>Direccion entrega</th>
                                                <th>Forma pago</th>
                                                <th>Reporte</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            do {
                                                $fecha = date("d-m-Y", strtotime($row_DatosPedidos['fe_registro']));
                                                ?>
                                                <tr>
                                                    <td><input   class ="btn btn-danger" title="Pulse para ver los detalles del pedido" type="button" value="<?php echo $row_DatosPedidos['id_pedido'] ?>" onclick="fn_AbrePopup(this.value)" placehoder="Ver detalles"/> </td>
                                                    <td><?php echo strtoupper($row_DatosPedidos['ci_rif_cliente']) ?></td> 
                                                    <td><?php echo $fecha ?></td> 
                                                    <td><?php echo $row_DatosPedidos['nb_tpo_entrega'] ?></td> 
                                                    <td><?php echo $row_DatosPedidos['nb_status_pedido'] ?></td> 
                                                    <td><?php echo $row_DatosPedidos['tx_direccion_entrega'] ?></td> 
                                                    <td><?php echo $row_DatosPedidos['tx_forma_pago'] ?></td>  
                                                    <td ><a href="ezpdf/generarpdfvendedores.php?id=<?php echo $row_DatosPedidos['id_pedido'] ?>"><img src="img/pdf1.jpg" width="30" height="14" border="0"></a></td>
                                                </tr>
                                            </tbody>
                                            <?php
                                        } while ($row_DatosPedidos = pg_fetch_assoc($DatosPedidos));
                                        ?>

                                    </table>

                                    <?php
                                } else {
                                    ?> 
                                    <b> No hay pedido que cumpla con este criterio de búsqueda <span class="glyphicon glyphicon-bell"></span></b>
                                <?php } ?>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
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
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>


 </div>


        <!-- Content ends -->
        <!-- --------------------------------------------------------------------------------------------- -->

        <div class="clearfix"></div>
        <?php
        $footer = new formFooter();
        $footer->footer();
        ?>
        <!-- Foot ends -->


        <?php
        $js = new formClearFix();
        $js->jsPie();
        ?>


    <?php }
    ?>
