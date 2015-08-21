<?php
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
}if (!$rol == 1 || ($rol == 2) || ($rol == 3)) {
    header("Location: AdminMenuPrincipal.php");
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
    <title>Reseteo de contraseña</title>



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
   

    <body>
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
                            <h4>Resetear la contraseña</h4>
                            <p>Importadora Xian, C.A.</p>
                            <hr/>
                        </div>
                        <div class="span14">
                            <div class="well login-register">
                               
                                <form class="form-horizontal"  method="post" action="includes/ResetearContrasena.php" >
                                    <!-- RIF -->
                                    <div class="control-group">
                                        <label class="control-label" for="rif">RIF:</label>
                                        <div class="controls">
                                            <input type="text" class="mayuscula" readonly title="RIF para resetear contraseña" class="input-large" pattern="(^([VEJPG]{1})([0-9]{9}$)"  name="rif" id="nombre"  
                                                   value="<?php  echo $_REQUEST['rif'];  ?>"autofocus />
                                        </div>
                                    </div>   
                                   
          
                                    <!-- Buttons <div class="form-actions">-->
                                    <div class="form-actions">
                                        <!-- Buttons -->
                                        <button class="btn btn-danger" type="submit"  name="submit" class="btn">Resetear contraseña</button>
                          
                                         <!-- <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>  -->
                                        <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>

                                    </div>
                                </form>  
                            </div>
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