 <?php
    require_once "ConexionPGSQL.php";
    require 'Consultas.php';
    include 'sesion.class.php';
    if (isset($_POST["submit"])) {
        if (isset($_POST['rif'])) {
            //$id_pedido = trim(htmlentities(strip_tags($_POST['id_pedido'])));
            $sesion= new sesion();
            $rif = trim(htmlentities(strip_tags($_POST['rif'])));
            $idusr = $sesion->get('id_usr');
            $sqlresult = new Consultas();
            $result = $sqlresult->consultarrif($idusr, $rif);
            $row = pg_num_rows($result);
            $html ='';
            if ($row != 0) {
                while ($pedidos = pg_fetch_array($result)) {
                                     $fecha=date("d-m-Y",strtotime($pedidos['fe_registro']));
                                    ?>
                                                            
                                        <td><?php echo strtoupper($pedidos['ci_rif_cliente']) ?></td> 
                                        <td><?php echo $fecha ?></td> 
                                        <td><?php echo $pedidos['nb_tpo_entrega'] ?></td> 
                                        <td><?php echo $pedidos['nb_status_pedido'] ?></td> 
                                        <td><?php echo $pedidos['tx_direccion_entrega'] ?></td> 
                                        <td><?php echo $pedidos['tx_forma_pago'] ?></td>  
                            </tr>
                                    <?php
                                }
                                ?> 
                                                             <?php
                            } else { 
                           echo "<script language='JavaScript'> alert('No existen registros asociados al RIF')                 
                                           location.href = '../mod_consulta_vendedor.php';
                                          exit();                                                          
                                        </script> ";
                            }
                        }
                    }
                    ?>    