<?php error_reporting(0);
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get("email");
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');

if (!isset($email)) {
    header("Location: login.php");
} else {
    ?>
    <!--  01340035130353075661 
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Actualizar datos del cliente
    FECHA:           Noviembre, 2013
    DESARROLLADO:   claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->
    <!-- visas -->
    <?php
    include 'sidebar/formSiderBar.php';
    include 'contactbox/formContactBox.php';
    include 'meta/formMeta.php';
    include 'navbar/NavBarLogout.php';

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
    include 'Sidebar/formSiderBarIndex.php';
    include 'formularios/formValidarRif.php';
    include 'formularios/formRegistrarClientes.php';

    ?>
    <!-- procesos -->





    <?php
    error_reporting(E_ALL);
    @ini_set("display_errors", "1");
    ?>
    <!DOCTYPE html>

    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Actualizar Clientes</title>



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

 <?php
    $navegador = new NavBarLogout();
    $navegador->navegador($email);
    ?>
        <!-- Navbar ends -->


        <!-- Sliding box starts -->
        <?php
        $sliderBox = new formSliderBox();
        $sliderBox->sliderBox();
        ?>
        <!-- Sliding box ends -->    

        <!-- Main content starts -->

        <?php
        $contentI = new formInicioContent12();
        $contentI->content12Ini();
        ?>
           <!-- Contact box starts -->
        
        
        <?php
    $formSlider = new formSiderBarIndex();
    $formSlider->formSider();
    ?>  
           <div class="mainbar">
               <?php
        $contactBox = new formContactBox();
        $contactBox->contactoBox();
        ?> 
        
       
    <!--  
    ************************************************************
    Aquí traemos el Rif del Cliente del formulario Buscar Rif,
    lo validamos en la base de datos de la empresa para saber
    si existe. 
    Sí no está, se puede registrar. Pero antes, debería estar
    inscrito en el SENIAT.
    Por lo que se hace otra validación, lo buscamos en el Seniat.
    Sí exite en el Seniat, se registra en la base de datos de
    la empresa.
    Sino, no se puede Registrar en la base de datos de la empresa
    *************************************************************
    -->

    <?php
    
    include 'formularios/formActualizarClientes.php';
    include 'includes/DaoSegNivel.php';
    $dao_bus= new DaoSegNivel();
    $numrow= $dao_bus->selectNumRow($email, $rif);
    if ($numrow < 0) {
        echo "<script language='JavaScript'> alert('No hay registros asociados ') 
                         location.href = 'login.php';  exit();
                          exit();
                          </script> ";
    } else
    if ($numrow  > 0) {
        $file=$dao_bus->selectUsr($email, $rif);
        $actualizar = new formActualizarClientes();
        $actualizar->actualizarClientes($file, $rif);
    } // fin de while
    ?>
    <!--   fin del contenido de la página -->
           </div>
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

    <?php
}
?>