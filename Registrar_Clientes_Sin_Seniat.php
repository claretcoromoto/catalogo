<?php
include 'includes/sesion.class.php';
$cerrar = new sesion();
$cerrar->termina_sesion();
require_once 'includes/ConexionPGSQL.php';
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
include 'navbar/NavBarL.php';
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

include 'formularios/formValidarRif.php';
include 'formularios/formRegistrarClientes.php';
?>
<!-- procesos -->





<!DOCTYPE html>

<?php
$meta = new formMeta();
$meta->meta();
?>
<title>Registrar Clientes</title>



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
    $navegador = new NavBarL();
    $navegador->navegador();
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
    
        <?php
        $formSlider = new formSiderBarIndex();
        $formSlider->formSider();
        ?>     
    <div class="mainbar">
        <div class="container-fluid">
            <div class="row-fluid">

                <div class="span12">  

                    <div class="well login-register">
                        <!--  
                        ***********************************************************
                     CASO DE USO: Registrar Clientes
                    Descripción: El cliente se registra para poder hacer pedidos.
                    Precondiciónes: 
                    01 Para  poder ser registrado, el cliente No debe existir en
                    la base de datos de la empresa.
                    02 Debe estar Registrado en el SENIAT como requisito Obliga-
                    torio.
                    Pasos:
                    01. El cliente introduce el rif
                    02. El sistema lo verifica en la base de datos del SENIAT
                        Sí existe, se busca en la base de datos de la empresa.
                          Sí existe se verifica por el estado del Cliente
                            Sí es 0,  está Suspendido, se le notifica por qué ??
                                        puede que sea por moros
                            Sí es 1, está Registrado Normal. Pasa al Modulo de
                              Pedidos, puede hacer pedidos
                            Sí es -1, está Eliminado de la base de datos de la empresa
                            pasa el index.php con advertencia de poner-
                             se en contacto con El Vendedor de Confianza.
                            Sí es 2, está Pendiente por aprobación, advertencia de poner-
                             se en contacto con El Vendedor de Confianza.
                            Sí es -2, hay que preguntarle a Victor
                    03. De otra forma, se sale y cae en el index.php
                    VEJPG
                    ***********************************************************  "/^([VEJPG]{1})([0-9]{9}$)/"           trim(strtoupper(str_replace("-","",$RIF)))
                        -->

                        <?php
                        include 'includes/Consultas.php';
                        include 'includes/getSetPedido.php';

                        if (isset($_GET["rif"])) {
                            $rif = strtoupper(trim(htmlentities(strip_tags($_GET['rif']))));
                            $ubicacion = new getSetPedido();
                            $estado = $ubicacion->buscarestado();
                            $municipio = $ubicacion->buscarmunicipio();
                            $ciudad = $ubicacion->buscarciudad();
                                  $selec = "SELECT id_usr FROM tblsit_usr WHERE ci_rif_cliente='J293800498' AND tx_login= 'soporte@ambientedeprueba.com'  ";
                                    $result = @pg_query($selec);
                                    $fileidven = pg_fetch_array($result);
                            ?>
                            <h5>Registrar cliente</h5>
                            <form    name="QForm"    class="form-horizontal" method="post" action="includes/RegistrarClientes.php" />
                            <div align="center "><h5>El RIF solicitado está registrado en el SENIAT  </h5></div>
                            <input readonly type="hidden" class="input-large" id="idvenempre" name="idvenempre" value="<?php echo $fileidven['id_usr'] ?>" >
                                <hr>

                            <fieldset> 
                                <legend  class="btn btn-danger " >Datos personales</legend> 

                                <!-- Rif -->
                                <div class="control-group">
                                    <label class="control-label" for="name">RIF:</label>
                                    <div class="controls">
                                        <input readonly type="text" class="input-large" id="rif" name="rif" value="<?php echo $rif ?>" >

                                    </div>
                                </div>   

                                <!-- Razón Social-->
                                <div class="control-group">
                                    <label class="control-label" for="name">Razón social:</label>
                                    <div class="controls">
                                        <input type="text" class="mayuscula"  title="Por favor, introduce la razón social tal cual aparece en el Seniat" type="text" size="100"class="input-large" id="empresa" name="empresa"  required autofocus>

                                    </div>
                                </div> 

                                <!-- Name -->
                                <div class="control-group">
                                    <label class="control-label" for="name">Nombre:</label>
                                    <div class="controls">
                                        <input type="text"  title="Por favor, introduce tu nombre y apellido" type="text" class="input-large" id="nombre" name="nombre" placeholder="Nombre y Apellido" required autofocus>
                                    </div>
                                </div> 
                            </fieldset>  
                            <fieldset> 
                                <legend class="btn btn-danger ">Contacto</legend> 
                                <!-- Nombre de Persona de Contacto-->
                                <div class="control-group">
                                    <label class="control-label" for="contacto">Nombre de persona de contacto:</label>
                                    <div class="controls">
                                        <input type="text" class="input-large"  title="Por favor, introduce el nombre y apellido de la persona de contacto" type="text" id="contacto" name="contacto" placeholder="Nombre y Apellido" required >
                                    </div>        
                                </div>   

                                <!-- Teléfono Persona de Contacto-->
                                <div class="control-group">
                                    <label class="control-label" for="telefono">Teléfono persona de contacto:</label>
                                    <div class="controls">

                                        <input type="tel" pattern="[0-9]{11,13}" class="input-large" id="telefono" name="telefono" placeholder="Eg. 582120000000,02120000000 " required >

                                    </div>
                                </div>                  
                            </fieldset>
                            <fieldset >
                                <legend class="btn btn-danger ">Seguridad</legend> 
                                <!-- Username   -->
                                <div class="control-group">
                                    <label class="control-label" for="email">Usuario:</label>
                                    <div class="controls">
                                        <input type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                                               name="correo" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus required/>  
                                    </div>   
                                </div>  
                                <!-- Password -->
                                <div class="control-group">
                                    <label class="control-label" for="password">Contraseña:</label>
                                    <div class="controls">
                                        <input type="password" class="input-large" id="password" name="password" min="6" max="12" maxlength="12"  required >
                                    </div>
                                </div>

                                <!-- Pregunta segura-->
                                <div class="control-group">
                                    <label class="control-label" for="preguntaseg">Pregunta segura:</label>
                                    <div class="controls">
                                        <select name="preguntaseg" id="preguntaseg"  required>
                                            <option>¿Cuál es mi mascota preferida?</option>
                                            <option>¿Cuál es el nombre de mi mascota preferida?</option>
                                            <option>¿Cuál es el nombre de mi restaurant preferido?</option>
                                            <option>¿Dónde nació mi mamá?</option>
                                            <option>¿Dónde nació mi papá?</option>
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
                            </fieldset>
                            <fieldset>
                                <legend class="btn btn-danger ">Localizaci�n</legend> 
                                <!-- Dirección -->
                                <div class="control-group">
                                    <label class="control-label" for="direccion">Dirección fiscal:</label>
                                    <div class="controls">
                                        <p><textarea rows="2" cols="33" name="direccion" placeholder="Av. Boulevar Naiguatá, E/S Tanaguarena Caribe"  required ></textarea></p>
                                    </div>
                                </div> 
                                <div class="control-group">
                                    <label class="control-label" for="lstModel">Estado: </label>
                                    <div class="controls">
                                        <select name="lstMake" id="lstMake" required>
                                            <option required>  -- Aún no se ha cargado -- </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="lstModel">Municipio: </label>
                                    <div class="controls">
                                        <select name="lstModel" id="lstModel" required>
                                            <option required>  -- Aún no se ha cargado -- </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="lstOptions">Ciudad: </label>
                                    <div class="controls">
                                        <select name="lstOptions" id="lstOptions" required>
                                            <option required >  -- Aún no se ha cargado -- </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Buttons -->
                                <div class="form-actions">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-danger"  name="enviar" class="btn"> Registrar</button>
                                    <button type="reset" class="btn btn-danger"  class="btn">Limpiar</button>
                                    <a class="btn btn-danger" href="index.php">Cancelar</a>
                                       </form>
                                ¿Tienes una cuenta aquí? <a href="login.php">Autenticate</a>
                        </div> 
                    </div>
                    <!--  </div> -->
                    <!--   </div> -->
               


    <?php
}
?>
            <br>

 </div>


            <!--   fin del contenido de la página -->
</div>
            </div>
            </div>
            </div>
  

            <!--   fin del contenido de la página -->
<div class="social" align='center'>
                  <a href="#"><i class="icon-facebook facebook"></i></a>
                  <a href="#"><i class="icon-twitter twitter"></i></a>
                  <a href="#"><i class="icon-linkedin linkedin"></i></a>
                  <a href="#"><i class="icon-google-plus google-plus"></i></a>
                  <a href="#"><i class="icon-pinterest pinterest"></i></a>
                </div>

              <p class="prev-indent-bot">&nbsp;</p>
                    <p class="prev-indent-bot">&nbsp;</p>



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
