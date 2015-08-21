<?php
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
if (!isset($email)) {
    header("Location: login.php");
} else if (!$rol == 5) {
    header("Location: login.php");
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
                <p>Importadora xian, C.A.</p>
                <hr />
            </div>

            <div class="container-fluid">
                <div class="span12">
                    <div class="box-body" >

                        <div class="span10"   >

                            <?php
                            include 'includes/ConexionPGSQL.php';
                            if ($_REQUEST['id'])
                    $sql = " SELECT U.razon_social_cliente, 
                   R.id_rol_usr, 
                   P.id_pedido, P.fe_registro, P.ci_rif_cliente,  P.tx_forma_pago, P.nu_sub_total,
                   D.cod_repuesto, nu_precio, in_cantidad,
                   E.nb_tpo_entrega,
                   S.nb_status_pedido,
                   Re.tx_descripcion, Re.nu_cant_disponible
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
                   WHERE  P.id_pedido= " . $_REQUEST['id'] . "                 

                       GROUP BY 
                    U.razon_social_cliente,
                   R.id_rol_usr, 
                   P.id_pedido, P.fe_registro, P.ci_rif_cliente,   P.tx_forma_pago, P.nu_sub_total,
                   D.id_detalle_pedido, D.cod_repuesto, 
                   E.nb_tpo_entrega,
                   S.id_status_pedido, S.nb_status_pedido, Re.tx_descripcion, Re.nu_cant_disponible
                    ORDER BY  P.id_pedido DESC";
                            $result = @pg_query($sql);

                            $sql = "SELECT iva FROM tblxian_cond_vta ORDER BY id_cond_venta DESC LIMIT 1";
                            $ivactual = @pg_query($sql);
                            $ivavig = @pg_fetch_array($ivactual);

                            $contador = 0; //la variable $contador comenzar� con el valor 0
                            $sumacon = 0; //la variable $suma comenzar� con el valor 0 number_format($number, 2, ',', '.');
                            $sumacre = 0;
                            $IVAcontado = 0;
                            $IVAcredito = 0;
                            $sumaconi = 0;
                            $sumacrei = 0;
                            $cantidad = 0;

                            if ($numrow = pg_num_rows($result) > 0) {
                                ?>

                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th auto>Código repuesto</th>
                                            <th  auto>Descripción</th>
                                            <th  auto>Cantidad</th>
                                            <th auto>Precio sin IVA</th>
                                          <!--  <th  width=20>Diponibilidad</th>-->

                                        </tr>
                                    </thead>
                                    <?php
                                    while ($file = pg_fetch_array($result)) {
                                        $sesion->set('carrito', $file)
                                        ?>
                                        <tbody>       
                                            <tr>

                                                <td style="font-size: 11"><?php echo $file ['cod_repuesto'] ?></td>  
                                                <td style="font-size: 11"><?php echo $file['tx_descripcion'] ?></td>  
                                                <td style="font-size: 11"><?php echo $file ['in_cantidad'] ?></td> 
                                                <td style="font-size: 11"><?php echo number_format($file ['nu_precio'], 2, ',', '.') ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?> 
                                    </tbody>
                                </table>
                              


                                

                                <?php
                            } else {
                               
                                  echo "<script language='JavaScript'> alert('Verifique el N° de Pedido')
                                  location.href = 'mod_consulta_vendedor.php';  exit();
                                  </script> "; 
                            }
                            ?>
                        </div>
                    </div> 
                </div>  
            </div>  



            <?php ?>
            <br><br>

            <div class="form-horizontal" aligncenter >
                <div class="center" class="span8" align="center">
                    <button class="btn btn-success " onclick="javascript:window.close();"  >Cerrar</button>
                    <button class="btn btn-danger " onclick=" window.print();" >Imprimir </button></a>
                </div>
            </div>

            <span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>      
            <!-- Scroll to top -->
            <div class="clearfix"></div>   
          

            <?php
            $js = new formClearFix();
            $js->jsPie();
            ?>


            <?php
        }
        ?>