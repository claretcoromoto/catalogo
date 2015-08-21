<?php
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
if (!isset($email)) {
    header("Location: login.php");
} else if (!$rol == 1) {
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
    ///******************************************************** -->

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
    <title>Clientes activos</title>

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on('ready', function () {

            $('#reasignar').on('click', function (event) {
                var rifcli = $('#rifcli').val();
                var idven = $('#idven').val();
                var action = $('#action').val();

                $.ajax({
                    type: 'POST',
                    url: 'includes/controladmin.php',
                    data: {accion: action, rifcli: rifcli, idven: idven},
                    
                    beforeSend: function (data) {
                      $("#resultado").html("Procesando, espere por favor...");
                    },
                    success: function (data) {
                        if (data) {

                            $('.alert-success').fadeIn('slow');
                            $('#reasignar').fadeOut('slow');
                            $("#resultado").html("Procesando, espere por favor...").fadeOut('slow');

                            setTimeout(function () {
                                window.location = "AdminReasignarTodosClientes.php";
                            }, 3000);
                        } else
                        {

                            $('.alert-error').fadeIn('slow');
                            setTimeout(function () {
                                $('.alert-error').fadeOut('fast');
                            }, 5000);
                        }
                    },
                    error: function (xhr, desc, err) {
                        console.log(xhr);
                        console.log("Details: " + desc + "\nError:" + err);
                        /*$('#error').html("Hubo un error en el jQuery").css("border", "3px solid red");*/
                    },
                    fail: function (data) {
                        console.log(data);
                        $('#fail').html("Ha fallado la aplicación").css("border", "3px solid green");
                    }
                });
                event.preventDefault();
            });
        });</script>

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
                <h2>Reasignar clientes a vendedor</h2>
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
                                $sql = "SELECT * FROM tblsit_usr WHERE in_status_cliente= 1 AND id_rol_usr=4 ORDER BY  id_usr DESC";
                            $result = @pg_query($sql);



                            if ($numrow = pg_num_rows($result) > 0) {
                                ?>

                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th auto>RIF</th>
                                            <th  auto>Razòn social</th>
                                            <th  auto>Email</th>
                                            <th  auto>Vendedor</th>
                                               <th  auto>Seleccionar</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    while ($file = pg_fetch_array($result)) {
                                   $sqlv = "SELECT nb_usuario FROM tblsit_usr WHERE id_usr= $file[id_usr_vendedor] AND id_rol_usr=5 ORDER BY  id_usr DESC";
                                        $resultv = @pg_query($sqlv);
                                        $f = pg_fetch_array($resultv);
                                        ?>
                                        <tbody>       
                                            <tr>
                                                <td style="font-size: 11"><?php echo $file ['ci_rif_cliente'] ?></td>  
                                                <td style="font-size: 11"><?php echo $file['razon_social_cliente'] ?></td>  
                                                <td style="font-size: 11"><?php echo $file ['tx_login'] ?></td> 
                                                <td style="font-size: 11"><?php echo $f['nb_usuario'] ?></td>
                                       
                                            <input type = "hidden" id = "action" name="action"   value ="1" required/>
                                            <input type = "hidden" id = "rifcli" name="rifcli"   value ="<?php echo $file['ci_rif_cliente'] ?>" required/>

                                            <td> 
                                                <input type = "checkbox"id="idven" name="idven"  value = "<?php echo $_REQUEST['id'] ?>" />
                                            </td>

                                            </tr>
                                            <?php
                                        }
                                        ?> 
                                        </tbody>
                                </table>
                                <button  id="reasignar">Reasignar clientes </button>
                               
                                <div id="resultado"></div> 
                                <div id="fail"></div>
                                <div class="alert-success" style="display: none" align="center">
                                    Reasignación Exitosa...!!!
                                </div>
                                <div class="alert-error" style="display: none"> 
                                    Reasignación  incorrecta...!!!
                                </div>
                                <div id="error"></div> 
                                <div id="fail"></div>


                                <?php
                            } /* else {

                              echo "<script language='JavaScript'> alert('Verifique el N° de Pedido')
                              location.href = 'AdminReasignarTodosClientes.php';  exit();
                              </script> ";
                              } */
                            ?>
                        </div>
                    </div> 
                </div>  
            </div>  



    <?php ?>
            <br><br>

            <div class="form-horizontal" aligncenter >
                <div class="center" class="span8" align="center">
                    <button class="btn btn-success" onclick="javascript:window.close();" >Cerrar</button>
                    <button class="btn btn-danger" onclick=" window.print();" >Imprimir </button></a>
                </div>
            </div>

            <span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>      
            <!-- Scroll to top -->
            <div class="clearfix"></div>   

            <script src="js/jquery-1.7.min.js"></script>
            <?php
            $js = new formClearFix();
            $js->jsPie();
            ?>


            <?php
        }
        ?>