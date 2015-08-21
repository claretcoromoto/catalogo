<?php
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
if (!isset($email)) {
    header("Location: login.php");
}
if (!$rol == 3 || (!$rol == 1)) {
    header("login.php");
} else {
    ?>
    <!--
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Ver el pedido en el carrito
    FECHA:     2014
    DESARROLLADO:    claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************

    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    include 'navbar/NavBarLogout.php';
    include 'Footer/formFooter.php';
    include 'Clearfix/formClearFix.php';
    ?>
      <!DOCTYPE html>
    <!--   inicio de HTML Y HEAD-->
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <!-- Title and other stuffs  jquery-1.4.2.min -->
    <title>Detalles del pedido</title>

    <?php
    $links = new link();
    $links->linkeos();
    ?>
    <?php
    error_reporting(0);
    ?>

    <!--   Fin de HTML Y HEAD-->




    <br><br>
    <div class="content" >

        <div class="span10">
            <!-- Title starts -->
            <div class="page-title">
                <h2>Detalles del pedido</h2>
                <p>Importadora Xian, C.A.</p>
                <hr />
            </div>

            <div class="container-fluid">
                <div class="span12">
                    <div class="box-body" >

                        <div class="span10"   >
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th  width=50>Código repuesto</th>
                                        <th  width=50>Descripción</th>
                                        <th  width=20>Cantidad</th>
                                        <th  width=50>Precio sin IVA</th>

                                    </tr>
                                </thead>
                                <?php
                                include 'includes/DaoTercerNivel.php';

                                if (isset($_GET['id'])) {
                                    $id = trim(htmlentities(strip_tags($_GET['id'])));
                                    $sql = " SELECT U.razon_social_cliente, 
                   R.id_rol_usr, 
                   P.id_pedido, P.fe_registro, P.ci_rif_cliente,  P.tx_forma_pago, P.nu_sub_total,
                   D.cod_repuesto, nu_precio, in_cantidad,
                   E.nb_tpo_entrega,
                   S.nb_status_pedido,
                   Re.tx_descripcion
                           FROM 
                                      tblxian_status_pedido S
                           INNER JOIN tblxian_pedido P
                           ON          ( S.id_status_pedido =  P.id_status_pedido )
                           INNER JOIN tblxian_tpo_entrega E
                           ON       ( P.id_tpo_entrega =  E.id_tpo_entrega)
                           INNER JOIN tblxian_detalle_pedido D
                           ON       ( P.id_pedido = D.id_pedido)
                           INNER JOIN   tblsit_usr U  
                           ON       ( P.id_usr = U.id_usr)
                           INNER JOIN   tblsit_rol_usr R
                           ON       ( U.id_rol_usr = R.id_rol_usr)
                           INNER JOIN tblxian_repuesto Re
                           ON          ( D.cod_repuesto = Re.cod_repuesto )
                   WHERE  P.id_pedido=" . $id . "                   

                       GROUP BY 
                    U.razon_social_cliente,
                   R.id_rol_usr, 
                   P.id_pedido, P.fe_registro, P.ci_rif_cliente,   P.tx_forma_pago, P.nu_sub_total,
                   D.id_detalle_pedido, D.cod_repuesto, 
                   E.nb_tpo_entrega,
                   S.id_status_pedido, S.nb_status_pedido, Re.tx_descripcion
                    ORDER BY  P.id_pedido DESC";
                                    $result = @pg_query($sql);
                                    $numrow = pg_num_rows($result);
                                    $sumacon = 0;
                                    if (isset($numrow) != 0) {
                                        while ($file = pg_fetch_array($result)) {
                                            $sumacon = $file ['in_cantidad'] * $file ['nu_precio'];
                                            ?>
                                            <tbody>       
                                                <tr>

                                                    <td><?php echo $file ['cod_repuesto'] ?></td>  
                                                    <td><?php echo $file['tx_descripcion'] ?></td>  
                                                    <td><?php echo$file ['in_cantidad'] ?></td> 
                                                    <td><?php echo number_format($file ['nu_precio'], 2, ',', '.') ?></td> 

                                                </tr>
                                                <?php
                                            }
                                            ?> 
                                        </tbody>
                                    </table> 
                                    <?php
                                } else {
                                    echo "<script language='JavaScript'> alert('Verifique el N° de Pedido') 
                          location.href = 'AdminPrincipalAutor2.php';  exit();
                            </script> ";
                                }
                                ?>
                            </div>

                            <div class="span10">
                                <?php
                                ?>
                                <table class="table table-striped table-bordered table-hover"> 
                                    <tr>

                                        <td><h6>Sub-total</h6><?php echo number_format($sumacon, 2, ',', '.') ?> Bs.F.</td>


                                    </tr>

                                </table>
                            </div>   </div> 
                    </div>  
                </div>  



    <?php }
    ?>
            <br><br>

            <div class="form-horizontal" aligncenter >
                <div class="center" class="span8">
                    <center >    <button class="btn btn-success "> <a onclick="javascript:window.close();" href="#">Cerrar la ventana</a> </button></a>
                        <button class="btn btn-danger "> <a onclick=" window.print();" href="#">Imprimir</a> </button></a></center>
                </div>
            </div>

            <span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>      
            <!-- Scroll to top -->
            <div class="clearfix"></div>   

            <!-- Foot ends -->

    <?php
    $js = new formClearFix();
    $js->jsPie();
    ?>


    <?php
}
?>