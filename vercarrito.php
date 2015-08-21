<?php
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} else if (!$rol == 5 || !$rol == 4) {
    header("Location: login.php");
} else {
    ?>


    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    include 'navbar/NavBarLogout.php';
    include 'Footer/formFooter.php';
    include 'Clearfix/formClearFix.php';
    ?>
    <!--
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Ver el pedido en el carrito
    FECHA:     2014
    DESARROLLADO:    claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
    MODIFICADO:          Nombre / Fecha / #Release
    ///******************************************************** -->

    <!DOCTYPE html>
    <!--   inicio de HTML Y HEAD-->
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <!-- Title and other stuffs  jquery-1.4.2.min -->
    <title>Carrito</title>


    <?php
    $links = new link();
    $links->linkeos();
    ?>
    <!--   Fin de HTML Y HEAD-->

    <!-- Navbar starts -->
    <?php
    $navegador = new NavBarLogout();
    $navegador->navegador($sesion->get('email'));
    ?>
    <br><br>
    <?php
    if ($sesion->get('carrito')) {
        $carro = $sesion->get('carrito');
        if (isset($carro)) {    //si la variable $carro
            ?>

            <div class="content"> 
                <div class="page-title">
                    <h2>Reserva del pedido</h2>
                    <p>Importadora Xian, C.A.</p>
                    <hr />
                </div>

                <div class="container-fluid">
                    <div class="span12">
                        <div class="box-body" >
                            <table id="contenedor" class="table table-striped table-bordered table-hover" >
                               <!--     <tr bgcolor="#333333" class="tit"> -->
                                <td width="auto">Código</td>
                                <td width="auto">Precio unitario/contado</td>
                                <td width="auto">Precio unitario/crédito</td>
                                <td width="auto" align="center">Disponibilidad</td>
                                <td width="auto" align="center">Editar cantidad</td>
                                <td width="auto" align="center">Borrar artículo</td>
                                <td width="auto">Total precio unitario/contado </td>
                                <td width="auto">Total precio unitario/crédito </td>

                                </tr>
                                <?php
                                include 'includes/ConexionPGSQL.php';


                                /* @var $result type */


                                //declaramos las variables
                                $color = array("#1ba1e2", "#2bec12"); //en la variable $color= muestrame los colores ordenados de esa forma, primero el #ffffff y luego el f0f0f0
                                $contador = 0; //la variable $contador comenzar� con el valor 0
                                $sumacon = 0; //la variable $suma comenzar� con el valor 0 number_format($number, 2, ',', '.');
                                $sumacre = 0;
                                $IVAcontado = 0;
                                $IVAcredito = 0;
                                $sumaconi = 0;
                                $sumacrei = 0;
                                $cantidad = 0;
                                foreach ($carro as $k => $v) {//foreach repite los elementos contenidos en la sentencia if, osea nos repetir� cuantas veces sea necesario las variables como: $subto que contendr� la multiplicaci�n de la cantidad por el precio, la variable $suma que ser� la  variable $suma + $subto(esto quiere decir que si existe 1 producto en el carrito se sumar� a la variable $suma (que esta declarada arriba con valor inicial de 0) el valor de la variable $subto
                                    $sql = "SELECT iva FROM tblxian_cond_vta ORDER BY id_cond_venta DESC LIMIT 1";
                                    $ivactual = @pg_query($sql);
                                    $ivavig = @pg_fetch_array($ivactual);

                                    $re = "SELECT can.cod_repuesto,
                    can.nu_disp_valery,
                    can.nu_cant_reservada,
                    resp.cod_repuesto,
                    cat.id_categoria,
                   cat.tx_descr_categoria
                   FROM tblxian_cantidad_dispon can
                        INNER JOIN tblxian_repuesto resp
                        ON can.cod_repuesto= resp.cod_repuesto
                        INNER JOIN tblxian_categoria cat
                        ON cat.id_categoria= resp.id_categoria
                      WHERE resp.cod_repuesto= '" . $v['cod_repuesto'] . "'";

                                    $result = @pg_query($re);
                                    $fila = @pg_fetch_array($result);
                                    $disponible = 0;
                                    if (isset($fila) && $v['Cantidad'] > 0) {
                                        $disponible = ($fila['nu_disp_valery'] - $fila['nu_cant_reservada']);
                                        $max = $disponible;
                                        $subtocon = $v['Cantidad'] * $v['contado'];
                                        $subtocre = $v['Cantidad'] * $v['credito'];
                                        $sumacon = $sumacon + $subtocon;
                                        $sumacre = $sumacre + $subtocre;
                                        $IVAcontado = $sumacon * $ivavig['iva'] / 100;
                                        $IVAcredito = $sumacre * $ivavig['iva'] / 100;
                                        $sumaconi = $IVAcontado + $sumacon;
                                        $sumacrei = $IVAcredito + $sumacre;
                                        $contador++;
                                        ?>
                                        <form class="form-horizontal"  onsubmit="return checkSubmit();" name="a<?php echo $v['identificador'] ?>" method="post" action="agregarcarrito.php?<?php echo SID ?>" id="a<?php echo $v['identificador'] ?>">
                                            <tbody>
                                                <tr>
                                                    <!-- -->
                                                    <td><?php echo $v['cod_repuesto'] ?></td>
                                                    <!-- -->
                                                    <td><?php echo number_format($v['contado'], 2, ',', '.') ?>  Bs.F.</td>
                                                    <!-- -->
                                                    <td><?php echo number_format($v['credito'], 2, ',', '.') ?>  Bs.F.</td>  
                                                    <?php $resta = $max - $v['Cantidad']; ?>
                                                    <td><input readonly class="input-mini" name="cantidad" type="number" min="1" max="<?php echo $resta ?>" id="cantidad" value="<?php echo $resta ?>" size="20"><br></td>                                                                                                                                                          <!--en esta columna se mostraran los precios de los productos que el usuario agrego al carrito   <td><php echo $v['Cantidad'] ?></td> -->
                                                    <td >                                              
                                                        <input class="input-mini" name="Cantidad" type="number" min="1" max="<?php echo $resta ?>"  id="Cantidad" value="<?php echo $v['Cantidad'] ?>" size="20">                       
                                                        <input name="Recalcular" type="image" <span src="dispo.png" width="13" height="13" border="0">Recalcular</span>
                                                        <input  type="reset" class="btn-mini btn-danger" Limpiar><br>

                                                    </td>
                                            <input name="cod_repuesto" type="hidden" id="cod_repuesto" value="<?php echo $v['cod_repuesto'] ?>"> 
                                            <td align="center"><a href="borracar.php?<?php echo SID ?>&cod_repuesto=<?php echo $v['cod_repuesto'] ?>"><img src="eliminar.png" width="20" height="14" border="0"></a></td>     
                                            <!--   -->
                                            <td><?php echo number_format($subtocon, 2, ',', '.') ?>  Bs.F.</td>
                                            <!-- -->
                                            <td><?php echo number_format($subtocre, 2, ',', '.') ?>  Bs.F.</td>
                                            </tr>
                                        </form>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="span10">
                                <table class="table table-striped table-bordered table-hover"> 
                                    <tr>
                                        <td> <h5>Contado</h5> </td>
                                        <td><h6>Sub-total</h6><?php echo number_format($sumacon, 2, ',', '.') ?> Bs.F.</td>
                                        <td><h6>IVA</h6><?php echo number_format($IVAcontado, 2, ',', '.') ?> Bs.F.</td>
                                        <td><h6>Total </h6><?php echo number_format($sumaconi, 2, ',', '.') ?> Bs.F.</td>

                                    </tr>
                                    <tr>
                                        <td> <h5>Crédito</h5> </td>
                                        <td><h6>Sub-total </h6><?php echo number_format($sumacre, 2, ',', '.') ?> Bs.F.</td>
                                        <td><h6>IVA</h6><?php echo number_format($IVAcredito, 2, ',', '.') ?> Bs.F.</td>
                                        <td><h6>Total</h6><?php echo number_format($sumacrei, 2, ',', '.') ?> Bs.F.</td>
                                    </tr>
                                </table> <br> <table  class="table table-hover " >

                                    <a href="listado_categoria_catalogo_final.php?id_categoria=<?php echo $fila['id_categoria'] ?>&tx_descr_categoria=<?php echo $fila['tx_descr_categoria'] ?>"> <button   class="btn-large, btn-success ">Continuar</button></a>
                                    <?php
                                    $sql = "SELECT nu_monto_minimo FROM tblxian_cond_vta ORDER BY id_cond_venta DESC LIMIT 1";
                                    $result = @pg_query($sql);
                                    $file = pg_fetch_array($result);
                                    if ($sumaconi > trim(htmlentities(strip_tags($file['nu_monto_minimo']))) || $sumacrei > trim(htmlentities(strip_tags($file['nu_monto_minimo'])))) {
                                        ?>
                                        <tr align="rigth">
                                            <?php if ($sumaconi > trim(htmlentities(strip_tags($file['nu_monto_minimo'])))) { ?>
                                                <td  class="col-1" > <a href="Registrar_pedido.php?monto=<?php echo $sumacon ?>&amp;montiva=<?php echo $IVAcontado ?>&amp;montotal=<?php echo $sumaconi ?>&amp;formpago=contado"> <button  class="btn" ><h6>Procesar pedido de contado</h6></button></a> </td>
                                            <?php } ?>

                                            <?php if ($sumacrei > trim(htmlentities(strip_tags($file['nu_monto_minimo'])))) { ?>
                                                <td  class="col-r" >  <a href="Registrar_pedido.php?monto=<?php echo $sumacre ?>&amp;montiva=<?php echo $IVAcredito ?>&amp;montotal=<?php echo $sumacrei ?>&amp;formpago=credito "> <button  class="btn" ><h6>Procesar pedido a crédito</h6></button></a></td>  
                                                <?php
                                            }
                                        }
                                        ?>
                                    <h6>Recuerde que el monto mínimo de compra es de: <?php echo number_format($file['nu_monto_minimo'], 2, ',', '.') ?> Bs.F.</h6>
                                    </tr> 
                                </table>   


                            </div>
                        </div> 
                    </div>  
                </div>  

                <?php
            }
        } else {// ini del else
//si en caso no hay ningun producto seleccionado por el usuario nos mostrar� en pantalla el siguiente mensaje: "no hay productos selecionados" 
            ?>



            <div class="form-horizontal" align="center" >
                <div class="center" class="span8">
                    <br><br><br><br> 
                  
                
           
                    <center class="hero-unit" >    <p > <h3> No hay pedidos realizados.</h3>  </center>
                </div><a href="catalogo_final.php"> <button    class="btn-large, btn-success ">Ir al catálogo</button></a>
    
            </div>
     </div>
        <?php
    }
    ?>
    <br><br><br><br>
    <br><br><br><br>


    <span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>      
    <!-- Scroll to top -->
    <div class="clearfix"></div>   
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
