<?php require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if(!isset($email)){
    header("Location: login.php");
    } 
else if(!$rol==5 || !$rol ==4 ){
 header("Location: login.php");
} else {
    ?>
    <!-- Inicio de includes de las Vistas -->

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
    <!-- Fin de includes de las Vistas -->

    <!--   Inicio de Includes de  Procesos -->

    <!-- Fin de Includes de  Procesos -->
    <?php
    include 'includes/ConexionPGSQL.php';
    include 'includes/Consultas.php';
    ?>
    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:      Logueo del Usuario del Sistema (Vendedores y Clientes)
    FECHA:           Diciembre, 2013
    DESARROLLADO:   claretcoromoto@hotmail.es 
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->

    <!DOCTYPE html>
    <!--   inicio de HTML Y HEAD-->
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Detalles del Pedido</title>

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

 <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> 
    <?php
    $consulta = new Consultas();
    $result = $consulta->buscarrifbd($idusr);

    $damerif = pg_fetch_array($result);
    ?>

    <div class="content">

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12"  >  
                    <!-- Logoclass="logo" -->
                    
                    <center class="hero-unit">
                        <form  class="input-append" class="form-search"  method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="control-group">
                                <input class="input-mini" type="hidden" id="id_usr" name="id_usr" value="<?php echo $idusr = $sesion->get('id_usr') ?>"  required="required" >
                                <button type="submit" class="btn btn-primary ">RIF:</button>
                                <input readonly class="input-append" type="text" id="rif" name="rif" value="<?php echo $rif = $damerif['ci_rif_cliente'] ?>"  required="required">
                              <!--  <input class="input-append" type="hidden" id="rif" name="rif" value="<php echo $rif = $damerif['ci_rif_cliente'] ?>"  required="required">
                               --> <button type="submit" class="btn btn-danger ">Id del Pedido:</button>
                                <input class="input-mini" type="text" id="rif" name="id_pedido"  required="required">
                                <button class="btn btn-danger "  type="submit" name="submit" >Consultar</button>
                            </div>
                        </form> 
                        <a  href="catalogo_final.php"> <button    class="btn btn-danger ">Ir al catálogo</button></a>
                        <a href="index.php"> <button   class="btn btn-danger ">Salir</button></a>
                    </center>   
                </div>
                <?php
                //$re = "SELECT cod_repuesto, nu_precio_contado, nu_precio_credito,  encode(img_imagen, 'base64') AS img_imagen FROM tblxian_detalle_pedido where id_pedido=" . $_GET['id'] . "";
                if (isset($_POST['rif']) && isset($_POST['id_pedido'])) {

                    $rif = $_POST['rif'];
                    $id_pedido = $_POST['id_pedido'];

                    $consulta = new Consultas();
                    $result = $consulta->consultarporfacturapedido($id_pedido, $rif);
                   
                    $html = "";
                    
                    $CONTADOR=0;
                    if ($row= pg_num_rows($result)>0) {
                        while ($fila = pg_fetch_array($result)) {
                            $codigo = $fila['cod_repuesto'];
                            $precio = $fila['nu_precio'];
                            $cantidad = $fila['in_cantidad'];
                            $direccion = $fila['tx_direccion_entrega'];
                         
                            $html.=' <tr>';
                            $html.=" <td><img src=\"display.php?id=$fila[cod_repuesto]\"  width= 70 alt=''/>  </td>";
                            $html.=' <td>' . $codigo . '</td>';
                            $html.=' <td>' . number_format($precio, 2) . '</td>';
                            $html.=' <td>' . $cantidad . '</td>';
                            $html.=' <td>' . $direccion . '</td>';
                            $html.=' </tr>';
                        $CONTADOR++;
                            }
                            
                                         
                        
                      
                                } else {
                                    pg_free_result($result);
                                }
                            
                           
                        ?>

                        <div class="span12">  
                            <div class="fwidget" align="center">

                                <hr>
                                <h2>Detalles del producto</h2>


                                <br>   
                                <!-- Inventario de los products o repuestos disponiblestable-hover-->

                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>REPUESTO</th>
                                            <th>CÓDIGO</th>
                                            <th>PRECIO </th>
                                            <th>CANTIDAD</th>
                                            <th>DIRECCIÓN</th>

                                        </tr>
                                    </thead>

                                    <?php echo $html ?>
                                </table>
                            </div>
                <?php  }?>
                        </div> 
            </div>
        </div>
    </div>    <!-- Footer -->
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


<?php }
?>
