<?php
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} else if (!$rol == 1) {
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
    ?>
    <!DOCTYPE html>
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Actualización de repuesto</title>



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
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>

    <script language="javascript" type="text/javascript">
                $(document).ready(function(){
        $('button[name="enviar"]').attr('disabled', 'disabled');
                $('input[type="text"]').attr('disabled', 'disabled');
                $('select[name="categoria"]').attr('disabled', 'disabled');
                $('a[name="editar"]').click(function(){
        $('input[type="text"]').removeAttr('disabled');
         $('select[name="categoria"]').removeAttr('disabled');
                $('button[name="enviar"]').removeAttr('disabled');
        });
        });</script>

    <script type="text/javascript">
                //<![CDATA[
                        function validar(campo) {
                        var elcampo = document.getElementById(campo);
                                if ((!validarNumero(elcampo.value)) || (elcampo.value == "")) {
                        elcampo.value = "";
                                elcampo.focus();
                                document.getElementById('mensaje').innerHTML = 'Debe ingresar un número decimal';
                        }
                        else {
                        document.getElementById('mensaje').innerHTML = '';
                        }
                        }
                function validarNumero(input) {
                return (!isNaN(input) && parseInt(input) == input) || (!isNaN(input) && parseFloat(input) == input);
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
    <script language="javascript" type="text/javascript">
                $(document).ready(function() {
                $('#catego').attr('disabled', 'disabled');
                        $('select[name="categoria"]').on('change', function() {
                var catego = $(this).val();
                        var categoria = $(this).val();
                        if catego === categoria) {
                categoria = "En la tienda";
                        $('#catego').removeAttr('disabled');
                } else {
                $('#catego').attr('disabled', 'disabled');
                }

                });
                });</script>      
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
                <?php
                extract($_REQUEST);
               
                $sesion->set('cod_repuesto', strtoupper($cod_repuesto));
   
                $re = "SELECT 
                    resp.cod_repuesto,
                    resp.tx_descripcion,   
                    resp.nu_precio_contado,
                    resp.nu_precio_credito,
                    resp.nu_cant_disponible,
                     resp.id_categoria,
                     resp.nb_imagen,
                   cat.id_categoria,
                   cat.tx_descr_categoria
                   FROM  tblxian_repuesto resp
                        INNER JOIN tblxian_categoria cat
                        ON cat.id_categoria= resp.id_categoria

       WHERE resp.cod_repuesto= '" . strtoupper($cod_repuesto) . "'";
                $result = @pg_query($re);
 
                $n = pg_num_rows($result);
                if ($n > 0) {
                    $f = pg_fetch_object($result);
                    $categ = $f->id_categoria;
                    ?><div class="span14">
                        <div class="box-body"> 
                            <br>  
                            <div class="page-title" align="left">
                                <h4>Actualización  de  repuestos</h4>
                                <p>Importadora Xian, C.A.</p>
                                <hr/>
                            </div>
                            <div class="span6">            
                                <div class="well login-register">

                                    <form class="form-horizontal"  method="POST" action="includes/ActualizarRepuesto.php" enctype="multipart/form-data">
                                        <fieldset>
                                            <legend  class="btn btn-danger">Modificar datos del repuesto </legend>
                                            <!-- Código producto -->
                                            <div class="control-group">
                                                <label class="control-label" for="descripcion">Código del repuesto:</label>
                                                <div class="controls">
                                                    <input readonly class="uneditable-input" type="text" class="mayuscula" name="cod_repuesto"  value="<?php echo $f->cod_repuesto ?>"  required>    
                                                </div>
                                            </div> 

                                            <!-- Código producto -->
                                            <div class="control-group">
                                                <label class="control-label" for="descripcion">Descripción:</label>
                                                <div class="controls">
                                                    <input type="text"  name="descripcion" id="edit" value="<?php echo $f->tx_descripcion ?>" required>  
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="img">Imagen del repuesto:</label>
                                                <div class="controls">
                                                    <img disabled src="display.php?id=<?php echo $f->cod_repuesto ?>"  width= 70 alt=''/><?php echo $f->nb_imagen ?> 
                                                </div>
                                            </div>    
                                        </fieldset>
                                        <fieldset>
                                            <legend  class="btn btn-danger">Precios </legend>

                                            <!-- Precio contado -->
                                            <div class="control-group">
                                                <label class="control-label" for="contado">Precio de contado:</label>
                                                <div class="controls">
                                                    <input type="text" id="edit" disabled="disabled" name="contado" value="<?php echo $f->nu_precio_contado ?>"  onkeyup="validar(this.id);" required>  
                                                </div>
                                            </div> 
                                            <div id="mensaje" class="b-orange" align="center"></div>
                                            <!-- Precio credito -->
                                            <div class="control-group">
                                                <label class="control-label" for="credito">Precio a crédito:</label>
                                                <div class="controls">
                                                    <input type="text" disabled="disabled" id="edit" name="credito" value="<?php echo $f->nu_precio_credito ?>"  onkeyup="validar(this.id);" required>     </div>
                                            </div> 
                                        </fieldset>
                                        <fieldset>
                                            <legend  class="btn btn-danger">Existencia</legend>
                                            <!-- Cantidad disponible-->
                                            <div class="control-group">
                                                <label class="control-label" for="cantidad">Cantidad disponible:</label>
                                                <div class="controls">
                                                    <input type="text" disabled="disabled" class='input-mini'  pattern="^[0-9]+$"  min="1" name="cantidad" id="edit" value="<?php echo $f->nu_cant_disponible ?>"  required>   
                                                </div> 
                                            </div> 
                                        </fieldset>
                                        <fieldset>
                                            <legend  class="btn btn-danger">Categorización</legend>




                                            <div class="control-group">
                                                <label class="control-label" for="nbcategoria">Categoría:</label>
                                                <div class="controls" >
                                                    <?php
                                                    $sqlcat = "SELECT id_categoria, tx_descr_categoria FROM tblxian_categoria WHERE id_categoria=$categ ";
                                                    $result = @pg_query($sqlcat);
                                                    $file = pg_fetch_array($result);
                                                    $catego = $file['tx_descr_categoria'];
                                                    ?>
                                                    <input type="hidden"   name="icategoria" value="<?php echo $file['id_categoria'] ?>"  > 
                                                    <input class="input-medium" readonly class="uneditable-input" type="text" disabled="disabled" class="uneditable-input "  name="categoria" id="edit" value="<?php echo $file['tx_descr_categoria'] ?>"  required> 

                                                </div>
                                            </div><?php
                                            $sqlcat = "SELECT id_categoria, tx_descr_categoria FROM tblxian_categoria";
                                            $result = @pg_query($sqlcat);
                                            $cat = '';
                                            while ($row = pg_fetch_array($result)) {
                                                $cat .=" <option value=" . $row['id_categoria'] . "> " . $row['tx_descr_categoria'] . "</option>";
                                            }
                                            ?>


                                            <div class="control-group">
                                                <label class="control-label" for="categoria">¿Desea cambiar la categoría?</label>
                                                <div class="controls">
                                                    <select class="input-mini " disabled="disabled" name="categoria" id="edit">
                                                        <option></option>
                                                        <?php echo $cat ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!-- imagen-->
                                        <div class="form-actions">
                                            <!-- Buttons -->
                                            <a class="btn btn-danger"  name="editar" href="#">Editar</a>
                                            <button type="submit" class="btn btn-danger" name="enviar" class="btn">Enviar</button>
                                            <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>
                                            <a class="btn btn-danger" href="AdminBuscarRepuesto.php">Volver a buscar código de repuesto</a>

                                        </div>
                                    </form>
                                </div>     

                            </div><!-- fin de span 7-->


                            <div class="span4" >
                                <div class="page-title" align="left">
                                    <h4>Registrar nueva  imagen del repuesto</h4>
                                    <p>Importadora Xian, C.A.</p>
                                    <hr/>
                                </div>
                                <div class="well login-register">
                                    <!-- Buscar Rif y Razón Social-->
                                    <form class="form-search s-widget"   method="post" action="includes/ActualizarRepuestoImagen.php" enctype="multipart/form-data">
                                        <!-- Categoría-->


                                        <div class="control-group" class="input-append">
                                            <input type="hidden" class="mayuscula" name="cod_repuesto" id="cod_repuesto" value="<?php echo $f->cod_repuesto ?>"  required>    
                                            <div class="controls">
                                                <br>
                                                <input class="inputfile" size="10" type="file" name="up" id="up" required  > <br>
                                            </div>
                                        </div>   

                                        <!-- Buttons <div class="form-actions">-->
                                        <div class="control-group" align="center">
                                            <div class="controls">
                                                <button  class="btn btn-danger" type="submit" name="cambiar" class="btn">Cambiar imagen</button>
                                                <a class="btn btn-danger" href="AdminBuscarRepuesto.php">Cancelar</a>
                                            </div>  
                                        </div>
                                    </form>
                                </div>
                            </div>







                        </div>



                    </div><!-- fin de span 14-->
                </div>
            </div><!-- fin de content-->
            <?php
        } else {


            echo "<script language='JavaScript'> alert('El repuesto no existe, verifique') 
                     location.href = 'AdminBuscarRepuesto.php';   
                          exit();
                          </script> ";
        }
        ?>

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
        <?php
    }
    ?>