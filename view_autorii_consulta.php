<?php
include 'includes/ConexionPGSQL.php';
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
//$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} else if (!$rol == 3) {
    header("Location: login.php");
} else {
    ?>

    <?php
    include 'meta/formMeta.php';



  
    include 'contactbox/formContactBox.php';

    include 'navbar/NavBarAutorii.php';

    include 'Footer/formFooter.php';
    ?>
    <!DOCTYPE html>
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Autorizador de pedidos</title>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet" type="text/css">

    <link href="style/bootstrap.css" rel="stylesheet">
    <!-- Font awesome icon -->

    <!-- Flex slider -->
    <link rel="stylesheet" href="style/flexslider.css">
    <!-- prettyPhoto -->

    <!-- Main stylesheet -->
    <link href="style/style.css" rel="stylesheet">
    <!-- Bootstrap responsive  <link href="style/bootstrap-responsive.css" rel="stylesheet">  -->
    <link href="style/bootstrap-responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon/favicon.ico">
   <style type="text/css" title="currentStyle">
            @import "DataTables-1.7.5/media/css/demo_page.css";
            @import "DataTables-1.7.5/media/css/demo_table_jui.css";
            @import "DataTables-1.7.5/examples/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
            @import "DataTables-1.7.5/TableTools-2.0.0/media/css/TableTools.css";
            @import "DataTables-1.7.5/extras/ColVis/media/css/ColVis.css";
        </style>

        <script type="text/javascript" charset="utf-8" src="DataTables-1.7.5/media/js/jquery.js"></script>
        <script type="text/javascript" charset="utf-8" src="DataTables-1.7.5/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8" src="DataTables-1.7.5/TableTools-2.0.0/js/ZeroClipboard.js"></script>
        <script type="text/javascript" charset="utf-8" src="DataTables-1.7.5/TableTools-2.0.0/js/TableTools.js"></script>
        <script type="text/javascript" charset="utf-8" src="DataTables-1.7.5/extras/ColVis/media/js/ColVis.js"></script>
        <script type="text/javascript" charset="utf-8">
            var asInitVals = new Array();

            $(document).ready(function () {
                $('#example').dataTable({
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "sDom": 'T C lfrtip',
                    "oTableTools": {
                        "sSwfPath": "/TableTools-2.0.0/media/swfcopy_cvs_xls_pdf.swf",
                        "aButtons": [
                            "xls",
                            "pdf",
                            {
                                "sExtends": "print",
                                "sButtonText": "Imprimir",
                                "sInfo": "<br><center><h1>PRESIONAR ESCAPE AL TERMINAR</h1></center>",
                                "sMessage": "<center><h2><b>TITULO!</b></h2></center>",
                                "sTitle": "Listado x Obra Social",
                            }
                        ],
                    },
                    "fnInitComplete": function () {
                        var
                                that = this,
                                nTrs = this.fnGetNodes();
                        $('td', nTrs).click(function () {
                            that.fnFilter(this.innerHTML);
                        });
                    },
                    "oLanguage": {
                        "oPaginate": {
                            "sPrevious": "Anterior",
                            "sNext": "Siguiente",
                            "sLast": "Ultima",
                            "sFirst": "Primera"
                        },
                        "sLengthMenu": 'Mostrar <select>' +
                                  '<option value="5">5</option>' +
                                '<option value="10">10</option>' +
                                '<option value="20">20</option>' +
                                '<option value="30">30</option>' +
                                '<option value="40">40</option>' +
                                '<option value="50">50</option>' +
                                '<option value="-1">Todos</option>' +
                                '</select> registros<br><br>',
                        "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)",
                        "sInfoFiltered": " - filtrados de _MAX_ registros",
                        "sInfoEmpty": "No hay resultados de búsqueda",
                        "sZeroRecords": "No hay registros a mostrar",
                        "sProcessing": "Espere, por favor...",
                        "sSearch": "Buscar:",
                    }
                });

                $("tfoot input").keyup(function () {
                    /* Filter on the column (the index) of this element */
                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                });


                /*
                 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in
                 * the footer
                 */
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });

                $("tfoot input").focus(function () {
                    if (this.className == "search_init")
                    {
                        this.className = "";
                        this.value = "";
                    }
                });

                $("tfoot input").blur(function (i) {
                    if (this.value == "")
                    {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });  // Termina document.ready
        </script>
       <style>
        .data_table {
            font-family: helvetica;
            font-size: 1px;
        }
        #top_of_page {
            position: absolute;
        }
        #main_table_area {
            width: 50%;
            top: 60px;
            height: 540px;
            width:80%;
            //overflow: auto;
        }
    </style>


    </head>
    <body >
        <!--   Fin de HTML Y HEAD-->

        <!-- Navbar starts -->
        <?php
        $navAdmin = new NavBarAutoii();
        $navAdmin->navegador($email);
        ?>


        <div class="content">
            <br><br>       
           
           
            <!-- Sidebar starts -->
            <div class="mainbar">
                <div class="span14" >
                    <div class="box-body" >
                        <div class="page-title" align="left">
                            <h4>Autorizador II</h4>
                            <p>Importadora Xian, C.A.</p>
                            <hr/>
                        </div>
                        <div class="container-fluid" >
                            <div class="row-fluid" >
                              




                                    <?php
// Arriba está el código de lo que va en el archivo include a continuación:
                                    include 'include/ConexionPGSQL.php';

                $sql = "SELECT  
                    

                                u.id_usr                             AS iduser,
                                u.razon_social_cliente               AS razon,
                                u.ci_rif_cliente                     AS rif,
                                u.nb_usuario                         AS nb,
                                u.in_status_cliente                  AS estatusc,

                                p.id_pedido                          AS id,
                                p.id_usr                             AS idu,
                                p.fe_registro                        AS fechareg,
                                p.ci_rif_cliente                     AS rifcli,
                                p.id_usr_autor_vta                   AS autorii,
                                p.id_tpo_entrega                     AS tpoentre,
                                p.id_status_pedido                   AS estatusp,
                                p.tx_direccion_entrega               AS dir_entrega,
                                p.nu_factura                         AS factura,
                                p.id_motivo_anul                     AS motivo,
                                p.tx_forma_pago                      AS formapago,
                                p.f_procesamiento                    AS fe_procesa,
                                p.nu_sub_total                       AS subtotal,

                                e.id_status_pedido                   AS estatus,
                                e.nb_status_pedido                   AS nbstatus

                               FROM tblsit_usr u
                               
                               INNER JOIN tblxian_pedido p 
                               ON u.id_usr = p.id_usr
                               INNER JOIN tblxian_status_pedido e 
                               ON p.id_status_pedido= e.id_status_pedido";

                                    $result = pg_query($sql);

// Pasa la fecha a español llamar FechaEsp($row['campo']);
                                    function FechaESP($fecha) {
                                        if ($fecha != '') {
                                            $data = explode("-", $fecha);
                                            $retfecha = substr($data[2], 0, 2) . '/' . $data[1] . '/' . $data[0];
                                            return $retfecha;
                                        } else {
                                            $retfecha = '';
                                        }
                                    }
                                    ?>
                                    <div id="main_table_area">    
                                        <p class="prev-indent-bot">&nbsp;</p>
                                        <table class="TableTools" class="table table-bordered table-hover"  cellpadding="5" cellspacing="0" border="0" class="display" id="example" >

                                            <thead>

                                                <tr>
                                                    <th width="auto">#</th>
                                                    <th width="auto">RIF</th>
                                                    <th width="auto">Fecha</th>
                                                    
                                                    <th width="auto">Dirección</th>
                                                    <th width="auto">Forma de pago</th>
                                                    <th width="auto">Subtotal</th>
                                                    <th width="auto">Factura</th>
                                                    <th width="auto">Fecha procesamiento</th>
                                                    <th width="auto">Estatus</th>
                                                    
                                                
                                                  


                                                </tr>
                                            </thead>

                                            <tbody>
                                            <p class="prev-indent-bot">&nbsp;</p>
                                            <?php
                                            $i = 0;
                                            $total = pg_num_rows($result);
                                            while ($row = pg_fetch_array($result)) {
                                                $i++;
                                                echo "<tr class='gradeA'>
                                                     <td width='auto'>" . $row['id'] . "</td>
                                                     <td width='auto' class='center'>" . $row['rifcli'] . "</td>
                                                     <td width='auto'>" . FechaESP($row['fechareg']) . "</td>
                                                     
                                                     <td width='auto'>" . $row['dir_entrega'] . "</td>
                                                     <td width='auto'>" . $row['formapago'] . "</td>
                                                     <td width='auto'>" . $row['subtotal'] . "</td>
                                                         
                                                     <td width='auto'>" . $row['factura'] . "</td>
                                                     <td width='auto'>" .  FechaESP($row['fe_procesa']) . "</td>
                                                     <td width='auto' class='center'>" . $row['nbstatus'] . "</td>
                                                    
                                                   
                                                    
                                                     </tr>";
                                            }
                                            echo 'Total: ' . $total;
                                            ?>
                                            </tbody>
                                        </table>

                                    </div>  

                                    <div class="spacer"></div>     



                             
                            </div>  

                        </div>
                    </div>
                </div>
            </div> 
        </div><!-- fin de content-->   
        <p class="prev-indent-bot">&nbsp;</p>
        <p class="prev-indent-bot">&nbsp;</p>
        <p class="prev-indent-bot">&nbsp;</p>
        <p class="prev-indent-bot">&nbsp;</p>
        <p class="prev-indent-bot">&nbsp;</p>
        <p class="prev-indent-bot">&nbsp;</p>
        <p class="prev-indent-bot">&nbsp;</p>


        <div class="clearfix"></div>

        <!--  footer -->
        <?php
        $footer = new formFooter();
        $footer->footer();
        ?>
        <!-- Foot ends -->


    </body>
    </html>
<?php } ?>