<?php
error_reporting(0);
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get("email");
$idusr = $sesion->get('id_usr');
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} if (!$rol == 4) {
    header("Location: catalogo_final.php");
} else {



    include 'includes/ConexionPGSQL.php';
    include 'includes/Consultas.php';


    $con = new Consultas();
    $DatosPedidos = $con->consultarrif($idusr, $rif);
    $row_DatosPedidos = pg_fetch_assoc($DatosPedidos);
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
        $DatosPedidos = $con->consultarfecli($idusr, $rif, $fecha1, $fecha2);
        $row_DatosPedidos = pg_fetch_assoc($DatosPedidos);
        $totalRows_DatosPedidos = pg_num_rows($DatosPedidos);
    } else if (isset($_POST['id_pedido'])) {
        $id_pedido = $_POST['id_pedido'];
        $DatosPedidos = $con->consultaridrifcli($idusr, $id_pedido, $rif);
        $row_DatosPedidos = pg_fetch_assoc($DatosPedidos);
        $totalRows_DatosPedidos = pg_num_rows($DatosPedidos);
    } else if (isset($_POST['estatus'])) {
        $status = $_POST['estatus'];
        $DatosPedidos = $con->consultarestatuscli($idusr, $status, $rif);
        $row_DatosPedidos = pg_fetch_assoc($DatosPedidos);
        $totalRows_DatosPedidos = pg_num_rows($DatosPedidos);
    }
    ?>


    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    // include 'formularios/NavBarVendedor.php';
    include 'Sidebar/formSiderBarIndex.php';
    include 'contactbox/formContactBox.php';

    include 'navbar/NavBarIndex.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';
    include 'Slider/formSliderCatalogo.php';

    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    ?>
            <!--   inicio de HTML Y HEAD<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
    <!DOCTYPE html>
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Importadora Xian, C.A.</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <!--   <link src="//code.jquery.com/ui/1.11.2/jquery-ui.js">-->
    <script language="javascript" type="text/javascript" src="./jQueryUI/ui.datepicker-es.js" ></script>  

    <?php
    $links = new link();
    $links->linkeos();
    ?>
    <!--   Fin de HTML Y HEAD-->

    <!-- Navbar starts -->
    <div  class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <div class="nav-collapse collapse">
                    <ul class="nav pull-left" >
                        <li  ><a href="catalogo_final.php"><img src="img/b-logo.png" alt=""  width="150" heigth="40"   /></a></li>

                    </ul>
                </div>
                <div class="nav-collapse collapse">
                    <ul class="nav pull-right" >
                        <li><a href="#">Gestionar perfil</a></li>
                        <li><a href="#"><?php echo $email ?></a></li>
                        <li><a href="catalogo_final.php">Atrás</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar ends -->

    <!--&nbsp; Content starts -->
    <br><br>
    <div class="content"> 

        <div class="container-fluid">
            <div class="container-fluid">
                <div class="box-body">
                    <div class="page-title2">
                        <h2>Consultas</h2>
                        <p>Importadora Xian, C.A.</p>
                        <hr />
                    </div>
                    <div class="span10">


                        <?php $loginFormAction = $_SERVER['PHP_SELF']; ?>
                        <form action="<?php echo $loginFormAction; ?>" method="post">
                            <div class="control-group">
                                <label class="control-label" for="busqueda">Criterios de búsquedas</label>
                                <div class="controls">
                                    <select name="busqueda2" id="busqueda">
                                        <option><?php echo$sesion->get('rif'); ?></option>
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
                                        <label class="control-label" for="rif">Introduzca el RIF :</label>
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
                                            <p> <input class="input-append" type="date" min="2014-06-01"  name="fecha1"   id="datepicker">  </p> 
                                            <label class="control-label" for="fecha2">hasta</label>
                                            <p>  <input class="input-append" type="date" name="fecha2"  id="datepicker"></p> 
                                            <!-- Buttons -->
                                            <input type="submit" name="button2" id="button2" value="Buscar">
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
                                            <input class="input-mini" type="number" min="1" name="id_pedido" id="id_pedido" required>
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

                                        <th>Fecha</th>
                                        <th>Tipo de entrega</th>
                                        <th>Status</th>
                                        <th>Direccion entrega</th>
                                        <th>Forma pago</th>
                                        <th >Reporte</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    do {
                                        $fecha = date("d-m-Y", strtotime($row_DatosPedidos['fe_registro']));
                                        ?>
                                        <tr>
                                            <td><?php echo $row_DatosPedidos['id_pedido'] ?></td> 

                                      <!--    <td><php echo strtoupper($row_DatosPedidos['ci_rif_cliente']) ?></td>  <td><= $pedidos['razon_social_cliente'] ?></td>  -->
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
                            <div class="form-horizontal" aligncenter >
                                <div class="center" class="span8">

                                    <center >
                                        <p > <h5> No hay pedidos realizados con este criterio de búsqueda</h5>   </p>   </center>

                                    <center  >     <a href="catalogo_final.php"> <button   class="btn-large, btn-success ">Ir al catálogo</button></a></center>
                                </div>

                            <?php } ?>
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

    </div>
    <br>
    <br>
    <br>
    <br>





    <!-- Content ends -->
    <!-- --------------------------------------------------------------------------------------------- -->

    <div class="clearfix"></div>
    <?php
    $footer = new formFooter();
    $footer->footer();
    ?>
    <!-- Foot ends -->
    <!--
    <script>
    $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(function () {
    $("#datepicker").datepicker();
    });
    </script>
    -->
    <script>
        $(function() {
            $("input > datepicker").datepicker({showOn: 'button', buttonImage: 'jQueryUI/calendar.gif', buttonImageOnly: true, firstDay: 1, dateFormat: 'mm/dd/yy'});
        });
    </script>
    <?php
    $js = new formClearFix_1();
    $js->jsPie();
    ?>


<?php }
?>
