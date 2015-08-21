<?php
error_reporting(0);
require_once "includes/sesion.class.php";
require_once 'includes/ConexionPGSQL.php';
require_once 'includes/getSetPedido.php';
$sesion = new sesion();
$email = $sesion->get("email");
$id = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
if (!isset($email)) {
    header("Location: login.php");
} else if (!$rol == 5 || !$rol == 4) {
    header("Location: login.php");
} else {
    ?>
    <?php
//establecemos un valor para los errores presentados y si es que existen colocaremos en lugar de estos el valor 1.
    if (!$sesion->get('carrito'))
//si no existe la variable de sesión carro 
        echo "<script language='JavaScript'> alert('Carrito false') 
     location.href = 'catalogo_final.php';
    </script> ";
    else
    // $carro = false;
        $carro = $sesion->get('carrito');
    // if (isset($_GET['formpago']) && isset($_GET['monto']) && isset($_GET['montiva']) && isset($_GET['montotal'])) {
    $formpago = trim(htmlentities(strip_tags($_GET['formpago'])));
    $monto = trim(htmlentities(strip_tags($_GET['monto'])));
    $montiva = trim(htmlentities(strip_tags($_GET['montiva'])));
    $montotal = trim(htmlentities(strip_tags($_GET['montotal'])));

    $form = $sesion->set('formpago', $formpago);
    $mon = $sesion->set('monto', $monto);
    $moni = $sesion->set('montiva', $montiva);
    $montal = $sesion->set('montotal', $montotal);
    ?>





    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    include 'navbar/NavBarLogout.php';
    include 'sliderbox/formSliderBox.php';
    include 'Sidebar/formSiderBarCatalogos.php';
    include 'Slider/formSliderCatalogo.php';
    include 'Footer/formFooter.php';
    include 'Clearfix/formClearFix.php';
    ?>

    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:      Logueo del Usuario del Sistema (Vendedores y Clientes)
    FECHA:           Diciembre, 2013
    DESARROLLADO:    Equipo Sitven Punto Fijo
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->
    <!DOCTYPE html>

    <!--   inicio de HTML Y HEAD-->
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Detalles del pedido</title>   <script src="js/project.js"></script> <script src="js/jquery.js"></script>



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
            $('#direccion').attr('disabled', 'disabled');
            $('#nueva').attr('disabled', 'disabled');
            $('select[name="entrega"]').on('change', function() {
                var domicilio = $(this).val();
                var dos = $(this).val();
                //alert(dos );
                if (dos === "1") {
                    domicilio = "En la tienda";
                    $('#direccion').attr('disabled', 'disabled');
                    $('#nueva').attr('disabled', 'disabled');

                } else if (dos === "2") {
                    $('#direccion').removeAttr('disabled');
                    $('#nueva').attr('disabled', 'disabled');
                } else if (dos === "3") {
                    $('#nueva').removeAttr('disabled');
                    $('#direccion').attr('disabled', 'disabled');
                }
            });
        });
    </script>      




    <?php
    $links = new link();
    $links->linkeos();
    ?>
    <!--   Fin de HTML Y HEAD-->


    <!-- Navbar starts -->
    <?php
    $navegador = new NavBarLogout();
    $navegador->navegador($sesion->get("email"));
    ?>
    <!-- Navbar ends width= 70-->


    <?php
    include 'formularios/formPedidoVendedor.php';
    include 'formularios/formPedidoCliente.php';


    $formpedidocliente = new formPedidoCliente();
    $formpedidovendedor = new formPedidoVendedor();
    $obteniendodatos = new getSetPedido();


    $status = $obteniendodatos->getStatus();  // obtenemos el id del estatus
    $combobit = $obteniendodatos->buscarentrega();

    $sesion->set('entrega', $combobit);
    $comborif = $obteniendodatos->mostrarRifClientesaVendedores($id);
    $rif = $obteniendodatos->getIdCliente($email, $id);
    $comboDir = $obteniendodatos->buscarentregaRegistrada($rif);
    $idsr = $obteniendodatos->getIdSolo($email);


    if ($obteniendodatos->asignarautorizadorvta() !== 0) {
        $autorii = $obteniendodatos->asignarautorizadorvta();
    } else {
        header('Location:catalogo_final.php');
        /*
          echo "<script language='JavaScript'> alert('Por los momentos no hay autorizadores de venta disponible ')
          location.href = 'catalogo_final.php';  exit();
          </script> "; */
    }
    ?>

    <div class="container">
        <div class="span14">   
            <div class="container-fluid">
                <div class="box-body">
                    <br>  <br>  <br>  <br>
                    <div class="page-title">
                        <h2>Detalles del pedido</h2>
                        <p>Importadora Xian, C.A.</p>
                        <hr />
                    </div>

                    <div class="span6">  
    <?php
                        if ($rol == 5) {
                            $r = $_REQUEST['rif'];
                            if(isset($r)){
                            $sesion->get('carrito');
                            $formpago = $sesion->get('formpago');
                            $mon = $sesion->get('monto');
                            $moni = $sesion->get('montiva');
                            $montal = $sesion->get('montotal');
                            $combobit = $sesion->get('entrega');
                            $monto = number_format($mon, 2, ',', '.');
                            // $montos = number_format($mon, 2, ',', '.'); //number_format($v['credito'], 2, ',', '.')
                            $monto2 = number_format($moni, 2, ',', '.');
                            $monto3 = number_format($montal, 2, ',', '.');  // $formpedidovendedor->pedidosVendedor($idsr, $status, $autorii, $combobit, $comborif, $form, $monto, $moni, $montal); 
                            ?>
                      
                            <div class="well login-register">
                                <form class="form-horizontal" action="includes/buscarRifBdPedi.php" method="post">
                                    <div class="control-group">
                                        <label class="control-label" for="rif">RIF:</label>
                                        <div class="controls">
                                            <input   class="input-medium" id="0" class="mayuscula" pattern="^([VEG]{1})([0-9]{8})([0-9]{1})$" type="text" id="rifi" name="rifi"  required >  
                                            <button class="btn btn-danger" type="submit" class="btn">Buscar</button> 
                                        </div>

                                    </div>
                                </form>
                                              
            
                                <form class="form-horizontal" action="includes/Pedidos.php" method="post">
                                    <!-- id del usuario -->
                                    <input  class="input-min"  type="hidden" id="idusr"     name="idusr"     required="required" value="<?php echo $idsr ?>"  >
                                    <input  class="input-mini" type="hidden" id="idstatus"  name="idstatus"  required="required" value=" <?php echo $status ?>" >
                                    <input  class="input-mini" type="hidden" id="idautorii" name="idautorii" required="required" value=" <?php echo $autorii ?>" >
                                    <input  class="input-mini" type="hidden" id="formpago"  name="f"  required="required" value=" <?php echo $formpago ?>" >                             


                                    <div class="control-group">
                                        <label class="control-label" for="entrega">Disponible:</label>
                                        <div class="controls">
                                            <input  type="text" readonly class="input-medium"  pattern="^([VEG]{1})([0-9]{8})([0-9]{1})$" id="rif" name="rif" value=" <?php echo $r ?>" required> 
                                        </div> 
                                    </div> 
                                    <div class ="control-group">
                                        <label class="control-label" for="entrega">Tipos de entrega:</label>
                                        <div class="controls">
                                            <select  id="entrega"   name="entrega">
                                                <option value="1" >Dirección Xian</option>
                                                <option value="2" >Dirección de despacho</option>
                                                <option value="3" >Registrada</option>
                                            </select>             
                                        </div>
                                    </div>
                                    <div class ="control-group">
                                        <label class="control-label" for="direcciondes">Dirección de despacho registrada:</label>
                                        <div class="controls">
                                            <select class="input-block-level" id="nueva"   name="direcciondes">
                                                <?php echo $comboDir ?>
                                            </select>             
                                        </div>
                                    </div>
                                    <div id="mensaje"></div>
                                    <!-- Dirección de la entrega-->
                                    <div class="control-group">
                                        <label class="control-label" for="direccion">Dirección:</label>
                                        <div class="controls">
                                            <textarea  id="direccion" name="direccion" rows="4" cols="20" placeholder="Ejemplo: Av. Boulevar Naiguatá, E/S Tanaguarena Caribe Caraballeda, Edo. Vargas – Venezuela" required="required"  ></textarea>
                                        </div>
                                    </div>     
                                    <div class="control-group">
                                        <label class="control-label" for="monto">Monto sin IVA:</label>
                                        <div class="controls"> 

                                            <input  disabled class="input-min" type="text" id="monto" required="required" name="monto" value=" <?php echo $monto ?>" >
                                            <input  readonly class="input-min" type="hidden" id="monto" required="required" name="montos" value=" <?php echo $sesion->get('monto') ?>" >
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="montiva">IVA:</label>
                                        <div class="controls"> 
                                            <input  disabled class="input-min" type="text" id="montiva" required="required" name="montiva" value=" <?php echo $monto2 ?>" >
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="montotal">Monto total:</label>
                                        <div class="controls"> 
                                            <input  disabled class="input-min" type="text" id="montotal" required="required" name="montotal" value=" <?php echo $monto3 ?>" >
                                        </div>
                                    </div>
                                    <!-- Buttons -->  
                                    <div class="form-actions">
                                        <!-- Buttons -->
                                        <button class="btn btn-danger" type="submit" name="submit" class="btn">Registrar</button> 
                                        <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                        <a class="btn btn-danger" href="vercarrito.php">Cancelar</a>
                                    </div>
                                </form>
                            </div>
                                   <?php
                            }else {echo '<h6>Introduzca el RIF del cliente asígnado</h6>';}
                                   
                                   ?>
                            <?php
                        } else if ($rol == 4) {
                            $form = $sesion->get('formpago');
                            $mon = $sesion->get('monto');
                            $moni = $sesion->get('montiva');
                            $montal = $sesion->get('montotal');
                            $combobit = $sesion->get('entrega');
                            $formpedidocliente->pedidosUnRif($idsr, $status, $autorii, $comboDir, $rif, $form, $mon, $moni, $montal);
                       
                            
                            ?>
                        
                        </div>
                        <div class="span5">


                        <div class="page-title">
                            <h4>Registrar una nueva dirección de despacho</h4>
                            <p>Importadora xian, C.A.</p>
                            <hr />
                        </div>
                        <div class="well login-register">

                            <form class="form-horizontal"  name="frm" id="frm" action="includes/RegistrarDirecciones.php" method="post">
                                <!-- id del usuario -->
                                <input  class="input-min"  type="hidden" id="rif"     name="rif"     required="required" value="<?php echo $rif ?>"  >

                                <!-- Dirección de la entrega-->
                                <div class="control-group">
                                    <label class="control-label" for="nuevadir">Dirección de despacho:</label>
                                    <div class="controls">
                                        <textarea  id="nuevadir" name="nuevadir" rows="4" cols="20" placeholder="Ejemplo: Av. Boulevar Naiguatá, E/S Tanaguarena Caribe Caraballeda, Edo. Vargas – Venezuela" required="required"  ></textarea>
                                    </div>
                                </div> 

                                <div class="form-actions">
                                    <!-- Buttons -->
                                    <button class="btn btn-danger" type="submit" tabindex="-1" name="submit"> Registrar</button>
                                    <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                    <a class="btn btn-danger" href="vercarrito.php">Cancelar</a>

                                </div>
                            </form>
                            <label>Sugerencia: </label>Si desea registrar una nueva dirección de despacho, por favor, introduzcala en el campo.
                        </div>
  

                    </div>
                        
                        
                        <?php
                            
                            
                            
                        }
                        ?>
                    </div>


                    
                </div>
            </div>
        </div> 


    <div class="social" align='center'>
        <a href="#"><i class="icon-facebook facebook"></i></a>
        <a href="#"><i class="icon-twitter twitter"></i></a>
        <a href="#"><i class="icon-linkedin linkedin"></i></a>
        <a href="#"><i class="icon-google-plus google-plus"></i></a>
        <a href="#"><i class="icon-pinterest pinterest"></i></a>
    </div>

    <p class="prev-indent-bot">&nbsp;</p>
    <p class="prev-indent-bot">&nbsp;</p>

    </div>

    <div class="clearfix"></div>
    <div class="clearfix"></div>

    <!-- Footer -->
    <?php
    $footer = new formFooter();
    $footer->footer();
    ?>
    <!-- Footer fin -->
    <!-- Scroll to top -->

    <?php
    $js = new formClearFix();
    $js->jsPie();
    ?>
    <?php
    /* // } else {
      echo "<script language='JavaScript'> alert('Algo anda mal' )
      location.href = 'vercarrito.php';
      exit();
      </script> ";
      } */
}
?>
