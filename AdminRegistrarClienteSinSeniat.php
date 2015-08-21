<?php require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get("email");
$idusr = $sesion->get('id_usr');
$rol = $sesion->get('id_rol_usr');
if (!isset($email)) {
    header("Location: login.php");
} 
if (!$rol == 1 ) {
    header("Location: login.php");
} else {
    ?>
    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Registrar clientes
    FECHA:           Noviembre, 2013
    DESARROLLADO:    Equipo Sitven Punto Fijo
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->
    <!-- visas -->
    <?php
    include 'Sidebar/formSiderBar.php';
    include 'contactbox/formContactBox.php';
    include 'meta/formMeta.php';
    include 'navbar/NavBarAdmin.php';
    include 'Sidebar/formSiderBarIndex.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';
    include 'formularios/formSliderSpan6Ini.php';
    include 'formularios/formSliderSpan6Fin.php';
    include 'formularios/formInicioContent12.php';
    include 'formularios/formConten12Fin.php';
    include 'Slider/formSliderCatalogo.php';
    include 'formularios/formBlock.php';
    include 'newletter/formNewLetter.php';
    include 'Service/formService.php';
    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    include 'Post/formPost.php';
include 'includes/ConexionPGSQL.php';
    include 'formularios/formValidarRif.php';
    include 'formularios/formRegistrarClientes.php';
    ?>
    <!-- procesos -->





    <!DOCTYPE html>

    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Registrar cliente sin SENIAT</title>



    <script type="text/javascript" src="jsOrig/jsrsClient.js"></script>
    <script type="text/javascript" src="jsOrig/selectphp.js"></script>
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





    </head>
    <?php
    $make = isset($_POST['lstMake']) ? $_POST['lstMake'] : -99;
    $model = isset($_POST['lstModel']) ? $_POST['lstModel'] : -99;
    $options = isset($_POST['lstOptions']) ? $_POST['lstOptions'] : -99;
    ?>

    <body   onload="preselect('<?php echo $make; ?>', '<?php echo $model; ?>', '<?php echo $options; ?>', 1);" >


        <!-- Navbar starts -->


        <!-- Navbar ends -->
        <?php
        $navegador = new NavBarAdmin();
        $navegador->navegador($email);
        ?>

        <!-- Sliding box starts -->
        <?php
        $sliderBox = new formSliderBox();
        $sliderBox->sliderBox();
        ?>
        <!-- Sliding box ends -->    

        <!-- Main content starts $form = new formValidarRif();
        $form->formValidarRif(); -->

        <div class="content">


            <div class="container-fluid">
                <div class="row-fluid">

                    <div class="span12">  

                        <div class="well login-register">

                            <?php
                            include 'includes/Consultas.php';
                            include 'includes/getSetPedido.php';

                            if (isset($_GET["rif"])) {
                                $rif = strtoupper(trim(htmlentities(strip_tags($_GET['rif']))));

                                $ubicacion = new getSetPedido();
                                $estado = $ubicacion->buscarestado();
                                $municipio = $ubicacion->buscarmunicipio();
                                $ciudad = $ubicacion->buscarciudad();
                                ?>
                                <h5>Registrar cliente</h5>
                               <?php
                               
                               
                               ?>

                                    </div> 
                            </div>
                            <!--  </div> -->
                            <!--   </div> -->
                        </div>


                        <?php
                    }
                    ?>
                    <br>




                    <!--   fin del contenido de la página -->
                    <?php
                    $fin = new formContent12Fin();
                    $fin->content12fin();
                    ?>

                    <!--   fin del contenido de la página -->


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