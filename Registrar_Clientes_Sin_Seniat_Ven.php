<?php require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get("email");
$idusr = $sesion->get('id_usr');
$rol = $sesion->get('id_rol_usr');
if (!isset($email)) {
    header("Location: login.php");
} 
if (!$rol== 5  ) {
    header("Location: index.php");
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
   include 'navbar/NavBarVendedor.php';

    include 'Sidebar/formSiderBarMod.php';
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
        <!-- Navbar starts -->
    <?php
    $nav = new NavBarVendedor();
    $nav->navende($email);
    ?>
    <!-- Navbar ends -->  <div class="content" >
  <?php
    $formSlider1 = new formSiderBarMod();
    $formSlider1->formSider();
    ?>
        <!-- Sliding box ends -->    

        <!-- Main content starts $form = new formValidarRif();
        $form->formValidarRif(); -->

        <div class="mainbar">
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
                                <form    name="QForm"    class="form-horizontal" method="post" action="includes/RegistrarClientes.php" />
                                <div align="center "><h5>El RIF solicitado está registrado en el SENIAT  </h5></div>
                                                <hr>

                                <fieldset> 
                                    <legend  class="btn btn-danger " >Datos personales</legend> 
                                    <!-- Rif -->
                                    <div class="control-group">
                                        <label class="control-label" for="name">RIF:</label>
                                        <div class="controls">
                                            <input readonly class="mayuscula" type="text" class="input-large" id="rif" name="rif" value="<?php echo $rif ?>" >
                                            <input readonly type="hidden" class="input-large" id="idvenempre" name="idvenempre" value="<?php    echo $idusr=$sesion->get('id_usr') ?>" >

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
                                            <input type="text" class="input-large" id="correo" placeholder="ejemplo@dominio.com"  
                                                   name="correo" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus required/>  
                                        </div>   
                                    </div>  
                                    <!-- Password -->
                                    <div class="control-group">
                                        <label class="control-label" for="password">Contraseña:</label>
                                        <div class="controls">
                                            <input type="password" min="6" max="12" maxlength="12"  class="input-large" id="password" name="password" required >
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
                                    <legend class="btn btn-danger ">Localización</legend> 
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
                                        <button class="btn btn-danger" type="submit"  name="enviar" class="btn"> Registrar</button>
                                        <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                        <a class="btn btn-danger" href="catalogo_final.php">Cancelar</a>
                                        </form>

                                    </div> 
                            </div>
                            <!--  </div> -->
                            <!--   </div> -->
                     


                        <?php
                    }
                    ?>
                    <br>
   </div>
 </div>


            <!--   fin del contenido de la página -->
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
                <?php } ?>