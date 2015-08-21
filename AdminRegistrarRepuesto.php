<?php
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} if (!$rol == 1 ) {
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
        <title>Registrar repuestos</title>



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
        //<![CDATA[
            function validar(campo) {
                var elcampo = document.getElementById(campo);

                if ((!validarNumero(elcampo.value)) || (elcampo.value == "")) {
                    elcampo.value = "";
                    elcampo.focus();
                    document.getElementById('mensaje').innerHTML = 'Debe ingresar un número decimal';
                } 
           else{
document.getElementById('mensaje').innerHTML = '';
 
// Aqui pones el resto de las condiciones usando comparadores u operadores aritméticos, ya que estás seguro de que trabajas con números 
 
}
}
 
function validarNumero(input){
return (!isNaN(input)&&parseInt(input)==input)||(!isNaN(input)&&parseFloat(input)==input);
}

        </script>


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


        <body >
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
                                <h4>Registrar repuestos</h4>
                                <p>Importadora Xian, C.A.</p>
                                <hr/>
                            </div>


                            <div class="span14">
                                <div class="well login-register">
                                                     
                                    <form class="form-horizontal"  method="POST" action="includes/registrarRepues.php" enctype="multipart/form-data">
                                            <fieldset>
                                                <legend  class="btn btn-danger">Ingresar datos del repuesto a subir</legend>
                                            <!-- Código producto -->
                                            <div class="control-group">
                                                <label class="control-label" for="cod_repuesto">Código del repuesto:</label>
                                                <div class="controls">
                                                    <input type="txt" class="mayuscula" name="cod_repuesto" id="cod_repuesto" required>    
                                                </div>
                                            </div> 
                                            <!-- Código producto -->
                                            <div class="control-group">
                                                <label class="control-label" for="descripcion">Descripción:</label>
                                                <div class="controls">
                                                    <input type="txt" name="descripcion" id="edit" required>      </div>
                                            </div>
                                                   </fieldset>
                                           <fieldset>
                                                <legend  class="btn btn-danger">Precios </legend>
                                              
                                            <!-- Precio contado -->
                                            <div class="control-group">
                                                <label class="control-label" for="contado">Precio de contado:</label>
                                                <div class="controls">
                                                    <input type="text" id="edit" name="contado" value="" onkeyup="validar(this.id);">
                                                </div>
                                            </div> 
                                            <div id="mensaje" class="b-orange" align="center"></div>
                                            <!-- Precio credito -->
                                            <div class="control-group">
                                                <label class="control-label" for="credito">Precio a crédito:</label>
                                                  <div class="controls">
                                                    <input type="text" id="edit" name="credito" value="" onkeyup="validar(this.id);">   </div>
                                            </div> 
                                            </fieldset>
                                               <fieldset>
                                                <legend  class="btn btn-danger">Existencia</legend>
                                            <!-- Cantidad disponible-->
                                            <div class="control-group">
                                                <label class="control-label" for="cantidad">Cantidad disponible:</label>
                                                <div class="controls">
                                                    <input type="number" min="1" name="cantidad" id="edit" required>   
                                                </div>
                                            </div> 
                                           </fieldset>
                                            <?php
                                            $sqlcat = "SELECT id_categoria, tx_descr_categoria FROM tblxian_categoria";
                                            $result = @pg_query($sqlcat);
                                            $cat = '';
                                            while ($row = pg_fetch_array($result)) {
                                                $cat .=" <option value=" . $row['id_categoria'] . "> " . $row['tx_descr_categoria'] . "</option>";
                                            }
                                            ?>
                                            
                                            <!-- Categoria-->
                                            <div class="control-group">
                                                <label class="control-label" for="categoria">Categoría:</label>
                                                <div class="controls">
                                                    <select name="categoria" id="edit" required>
                                                        <?php echo $cat ?>
                                                    </select>
                                                </div>
                                            </div> 
<?php
 $max_upload = (int)(ini_get('upload_max_filesize'));
 $max_post = (int)(ini_get('post_max_size'));
$memory_limit = (int)(ini_get('memory_limit'));
$upload_mb = min($max_upload, $max_post, $memory_limit);

                                           echo "Tamaño maximo permitido <strong>$upload_mb Mb</strong><br>";
?>
                                            <!-- imagen-->
                                            <div class="control-group">
                                                <label class="control-label" for="img">Imagen del repuesto:</label>
                                                <div class="controls">
                                                    <input type="file" name="up"  id="edit" required  >
                                                </div>
                                            </div>   
                                            <!-- Buttons <div class="form-actions">-->
                                            <div class="form-actions">
                                                <!-- Buttons -->
                                                                <button class="btn btn-danger" type="submit" name="enviar" class="btn">Enviar</button>
                                                <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
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
            <?php      }   ?>