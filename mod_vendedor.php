<?php
include 'includes/ConexionPGSQL.php';
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
    ?>






    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Principal del Sitio Web Importadora Xian
    FECHA:           Noviembre, 2014
    DESARROLLADO:    claretcoromoto@hotmail.es
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->

    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    include 'navbar/NavBarVendedor.php';
  
    include 'contactbox/formContactBox.php';
    include 'Sidebar/formSiderBarMod2.php';
    include 'navbar/NavBarIndex.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';
    include 'Slider/formSliderCatalogo.php';

    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    ?>
    <!DOCTYPE html>
    <!--   inicio de HTML Y HEAD-->
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Perfil</title>
 <link rel="shortcut icon" href="img/favicon/favicon.ico">

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
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        $(document).on('ready', function () {
            $('#show-hide-passwda').on('click', function (e) {
                e.preventDefault();
                var current = $(this).attr('action');
                if (current =='hide') {
                    $(this).prev().attr('type', 'text');
                    $(this).removeClass('icon-eye-open').addClass('icon-eye-close').attr('action', 'show');
                }
                if (current == 'show') {
                    $(this).prev().attr('type', 'password');
                    $(this).removeClass('icon-eye-close').addClass('icon-eye-open').attr('action', 'hide');
                }
            })
        })
    </script>
    <script>
        $(document).on('ready', function () {
            $('#show-hide-passwdn').on('click', function (e) {
                e.preventDefault();
                var current = $(this).attr('action');
                if (current =='hide') {
                    $(this).prev().attr('type', 'text');
                    $(this).removeClass('icon-eye-open').addClass('icon-eye-close').attr('action', 'show');
                }
                if (current == 'show') {
                    $(this).prev().attr('type', 'password');
                    $(this).removeClass('icon-eye-close').addClass('icon-eye-open').attr('action', 'hide');
                }
            })
        })
    </script>
    <script>
        $(document).on('ready', function () {
            $('#show-hide-passwdr').on('click', function (e) {
                e.preventDefault();
                var current = $(this).attr('action');
                if (current =='hide') {
                    $(this).prev().attr('type', 'text');
                    $(this).removeClass('icon-eye-open').addClass('icon-eye-close').attr('action', 'show');
                }
                if (current == 'show') {
                    $(this).prev().attr('type', 'password');
                    $(this).removeClass('icon-eye-close').addClass('icon-eye-open').attr('action', 'hide');
                }
            })
        })
    </script>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function () {
            $('button[type="submit"]').attr('disabled', 'disabled');
            $('input[type="text"]').attr('disabled', 'disabled');
            $('input[type="password"]').attr('disabled', 'disabled');

            $('a[name="editar"]').click(function () {
                $('input[type="text"]').removeAttr('disabled');
                $('input[type="password"]').removeAttr('disabled');
                $('button[type="submit"]').removeAttr('disabled');
                $("#edit").attr('disabled', 'disabled');
            });
        });</script>
    <style>
        .input-group {
            width: 50%;
            margin: 0 auto;
            margin-top: 50px;
        }
        span {
            cursor: pointer;
        }
    </style>
   
    </head>
    <body>

        <!--   Fin de HTML Y HEAD-->

        <!-- Navbar starts -->
        <?php
        $nav = new NavBarVendedor();
        $nav->navende($email);
        ?>
        <!-- Navbar ends -->
        <!-- Content starts -->
        <div class="content">
            <?php
            $formSlider1 = new formSiderBarMod2();
            $formSlider1->formSider();
            ?>






            <div class="mainbar">

                <div class="row-fluid">
                    <!-- Title starts -->
                    <br> 
                    <div class="span12">  
                        <div class="box-body">
                            <div class="page-title">
                                <h2>Gestiona tu contraseña</h2>
                                <p>Importadora xian, C.A.</p>
                                <hr />
                            </div>
                            
                            
                            <?php
                            $sqlre = "SELECT * FROM tblsit_usr  WHERE  tx_login ='" . $email . "' AND id_rol_usr='" . $rol . "'";
                            $result = @pg_query($sqlre);
                            $datos = pg_fetch_array($result);
                            ?>

                            <!-- Bootstrap tabs. -->

                            <div class="span10">
                                <!-- Content -->

                                <div class="well login-register">
                                    <form class="form-horizontal"  method="post" action="includes/modificar_claveVen.php" >
                                        <!-- email -->
                                        <div class="control-group">
                                            <label class="control-label" for="email">Correo electrónico:</label>
                                            <div class="controls">
                                                <input type="text" readonly title="Usuario o username" class="input-large"  name="email" id="nombre"  value="<?php echo $email ?>"autofocus />
                                                <input type="hidden" readonly title="Usuario o username" class="input-large"  name="rol"   value="<?php echo $rol ?>"autofocus />
                                            </div>
                                        </div> 
                                        <fieldset>
                                            <legend  class="btn btn-danger " >Pregunta de seguridad</legend> 
                                            <div class="control-group">
                                                <label class="control-label" for="preguntaseg">Pregunta segura</label>
                                                <div class="controls">
                                                    <select name="preguntaseg" id="preguntaseg"  required>
                                                        <option> ¿Cuál es mi mascota preferida?</option>
                                                        <option> ¿Cuál es el nombre de mi mascota preferida?</option>
                                                        <option> ¿Cuál es el nombre de mi restaurant preferido?</option>
                                                        <option> ¿Dónde nació mi mamá?</option>
                                                        <option> ¿Dónde nació mi papá?</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <!-- Respuesta segura-->
                                            <div class="control-group">
                                                <label class="control-label" for="respuestaseg">Respuesta segura:</label>
                                                <div class="controls">
                                                    <input type="text" autocomplete class="input-large" id="respuestaseg" name="respuestaseg" required >
                                                </div>
                                            </div> 
                                            <div class="control-group">
                                                <label class="control-label" for="rif">Contraseña actual</label>

                                                <div class="controls">
                                                    <input   type="password"     name="clavea"   required  />
                                                    <span id="show-hide-passwda" action="hide" class="icon-eye-open"></span>
                                                </div>
                                            </div> 
                                        </fieldset>
                                       <fieldset>
                                            <legend  class="btn btn-danger " >Actualizar contraseña</legend> 
                              
                                            <div class="control-group">
                                                <label class="control-label" >Nueva contraseña:</label>

                                                <div class="controls">
                                                    <input  type="password"   name="password"  required>
                                                    <span id="show-hide-passwdn" action="hide" class="icon-eye-open"></span>
                                                </div>    
                                            </div>
                                       
                                            <div class="control-group">
                                                <label class="control-label" for="password">Confirmar contraseña:</label>

                                                <div class="controls">
                                                    <input type="password"   name="repassword" required>
                                                    <span id="show-hide-passwdr" action="hide" class="icon-eye-open"></span>
                                                </div> 
                                            </div>
                                        </fieldset>
                                        <!-- Buttons <div class="form-actions">-->
                                        <div class="form-actions">
                                            <!-- Buttons -->
                                             <a class="btn btn-danger"  name="editar" href="#">Editar</a>
                                            <button class="btn btn-danger" type="submit"  name="enviar" class="btn"> Modificar</button>
                                            <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>  <a class="btn btn-danger" href="catalogo_final.php">Volver</a>
                                        </div>
                                    </form>
                                    <label>Nota:</label>
                                    <p>Al momento de actualizar su contraseña, por favor, responda la pregunta de seguridad y rectificque la contraseña.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
 
            </div> 

        </div>  

        <!-- FIN DE LOS TABS  -->
        <br><br><br><br><br><br>    


    <!-- Content ends -->
    <!-- --------------------------------------------------------------------------------------------- -->

    <div class="clearfix"></div>
    <?php
    $footer = new formFooter();
    $footer->footer();
    ?>
    <!-- Foot ends -->


<div class="clearfix"></div>

<!-- Main content ends -->



<!-- Scroll to top <script src="js/jquery.js"></script>-->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span> 

<!-- JS <script src="js/tipsay.js"></script>-->
<script src="js/project.js"></script>


<script src="js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="js/filter.js"></script> <!-- Filter JS -->
<script src="js/jquery.carouFredSel-6.1.0-packed.js"></script> <!-- CarouFredSel -->
<script src="js/jquery.flexslider-min.js"></script> <!-- Flexslider -->
<script src="js/jquery.isotope.js"></script> <!-- Isotope -->
<script src="js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->
<script src="js/jquery.tweet.js"></script> <!-- Tweet -->
<script src="js/custom.js"></script> <!-- Main js file -->

</body>
</html>

<?php }
?>
