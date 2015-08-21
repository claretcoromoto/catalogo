<?php
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

    include 'formularios/formARegistrarUsuario.php';
    include 'formularios/formARegistrarUsuarioSinS.php';
    ?>
    <!DOCTYPE html>
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Registro de usuarios</title>



    <script type="text/javascript" src="js/jsrsClient.js"></script>
    <script type="text/javascript" src="js/selectphp.js"></script>
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
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <link rel="stylesheet" href="animacion-css.css" type="text/css">

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

    </head>
    <?php
    $make = isset($_POST['lstMake']) ? $_POST['lstMake'] : -99;
    $model = isset($_POST['lstModel']) ? $_POST['lstModel'] : -99;
    $options = isset($_POST['lstOptions']) ? $_POST['lstOptions'] : -99;
    ?>

    <body   onload="preselect('<?php echo $make; ?>', '<?php echo $model; ?>', '<?php echo $options; ?>', 1);" >
        <!--   Fin de HTML Y HEAD-->

        <!-- Navbar starts -->
        <?php
        $navAdmin = new NavBarAdmin();
        $navAdmin->navegador($email);
        ?>

        <!-- Navbar ends -->



        <!-- Main content starts -->
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
                                <h4>Registrar usuario</h4>
                                <p>Importadora Xian, C.A.</p>
                                <hr/>
                            </div>

                            <div class="span14">
                            <?php
                            include 'includes/RifVen.php';
                            if (isset($_GET["rif"])) {

                                $rifseniat = strtoupper(trim(htmlentities(strip_tags($_GET['rif']))));
                                $rif = new RifVen($rifseniat); // aquí aplicamos la función que me busca On Line el rif en el seniat xml
                                $datosFiscales = json_decode($rif->getInfo());
                                $riff = $rif;
                                if ($datosFiscales->code_result == 1) {
                                    $empresa = "{$datosFiscales->seniat->nombre}";
                                    $ubicacion = new getSetPedido();
                                    $estado = $ubicacion->buscarestado();
                                    $municipio = $ubicacion->buscarmunicipio();
                                    $ciudad = $ubicacion->buscarciudad();
                                    if (isset($empresa) && isset($riff)) {
                                        $formU = new formARegistrarUsuario();
                                        $formU->formUsuario($_GET["rif"], $idusr, $empresa, $make, $model, $options);
                                    }
                                } else  {
                                    $formSinSeniat = new formARegistrarUsuarioSinS();
                                    $formSinSeniat->formUsuario($_GET["rif"], $idusr, $make, $model, $options);
                                }
                            } else {
                                echo "<script language='JavaScript'> alert('Introduzca un formato válido')                 
                                             location.href = 'AdminBuscarRifCliente.php';   exit();                                                       
                                        </script> ";
                            }

                            ?>
                        </div><!-- fin de span 14-->
                    </div>
                </div><!-- fin de span 14-->
            </div>
        </div><!-- fin de content-->


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