<?php   

if (isset($_GET['id'])) {

    $sesion->get('carrito');
                                $id= trim(htmlentities(strip_tags($_GET['id'])));
                                $sql = " SELECT U.razon_social_cliente, U.in_status_cliente, 
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
                   WHERE  P.id_pedido=" . $id . "    AND U.in_status_cliente=1               

                       GROUP BY 
                    U.razon_social_cliente,
                   R.id_rol_usr, 
                   P.id_pedido, P.fe_registro, P.ci_rif_cliente,   P.tx_forma_pago, P.nu_sub_total,
                   D.id_detalle_pedido, D.cod_repuesto, 
                   E.nb_tpo_entrega,
                   S.id_status_pedido, S.nb_status_pedido, Re.tx_descripcion
                    ORDER BY  P.id_pedido DESC";
                                $result = @pg_query($sql);
                                $file=  pg_fetch_array($result);
                                $st=$file['in_status_cliente'];
                                switch ($st) {
                                     case 1:
                                          header("Location:detalle.php?id=$id");                                    
                                        break;
                                    case -1:
                                          header("Location:AdminSolPenClipedidos.php");                                    
                                        break;
                                    case 0:
                                         header("Location:AdminSolPenClipedidos.php");
                                                                      
                                        break;
                                    case -2:
                                         header("Location:AdminSolPenClipedidos.php");
                                                                     
                                        break;

                                    case 2:
                                        header("Location:AdminSolPenClipedidos.php");
                                       break;
                                }
}
                     ?>