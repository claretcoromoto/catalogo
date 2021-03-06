<?php require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif=$sesion->get('rif');
if(!isset($email)){
    header("Location: login.php");
    } 
else if(!$rol==5 || !$rol ==4 ){
 header("Location: login.php");
}

  else{
    ?>
    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Muestra repuesto por búsqueda de descripción
    FECHA:          2014
    DESARROLLADO:    claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->

    <!-- Inicio de includes de las Vistas -->

    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    include 'navbar/NavBarLogout.php';
    include 'sliderbox/formSliderBox.php';
    include 'Sidebar/formSiderBarMod2.php';
    include 'Slider/formSliderCatalogo.php';
    include 'Footer/formFooter.php';
    include 'Clearfix/formClearFix.php';
    ?>
    <!-- Fin de includes de las Vistas -->

    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:     Ver descripción de los repuestos
    FECHA:       Nov, 2014.
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

   <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700' rel='stylesheet' type='text/css'>

    <!-- Stylesheets -->
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
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    </head>

    <body>
    <!--   Fin de HTML Y HEAD-->


    <!-- Navbar starts -->
    <?php
    $navegador = new NavBarLogout();
    $navegador->navegador($sesion->get("email"));
    ?>
        <br><br><br><br>
    <!-- Navbar ends width= 70-->
<?php
    include 'includes/ConexionPGSQL.php';

    if (isset($_POST['enviar'])) {
        if (isset($_POST['descripcion']) && $_POST['descripcion'] != '') {
            $descripcion = htmlentities(strip_tags(strtoupper(trim($_POST['descripcion']))));    //     
          $re = "SELECT can.cod_repuesto,
                    can.nu_disp_valery,
                    can.nu_cant_reservada,
                    rep.cod_repuesto,
                    rep.tx_descripcion,   
                    rep.nu_precio_contado,
                    rep.nu_precio_credito,
                   cat.id_categoria,
                   cat.tx_descr_categoria
                   FROM tblxian_cantidad_dispon can
                        INNER JOIN tblxian_repuesto rep
                        ON can.cod_repuesto= rep.cod_repuesto
                        INNER JOIN tblxian_categoria cat
                        ON cat.id_categoria= rep.id_categoria

       WHERE rep.tx_descripcion LIKE '$descripcion%' ";
            $result = @pg_query($re);
            $disponibilidad = 0;
          
            $html = "";
            if (pg_num_rows($result)>0) {
                  $encabe='';
            $encabe.='<th>Repuesto</th>
                                        <th>C&oacutedigo</th>
                                        <th>Descripci&oacuten</th>
                                        <th>Disponibilidad</th>
                                        <th>Precio de contado</th>
                                        <th>Precio a cr&eacutedito</th>
                                        <th>Agregar al carrito</th>';
                
                
                while ($fila = pg_fetch_array($result)) {
                    $disponibilidad = $fila['nu_disp_valery'] - $fila['nu_cant_reservada'];
                    $codigo = $fila['cod_repuesto'];
                    $descripcion = $fila['tx_descripcion'];
                    $preciocon = $fila['nu_precio_contado'];
                    $preciocre = $fila['nu_precio_credito'];

                    //  $html .= '<div class="producto">';
                    $html.=' <tr>';
                    $html.=" <td><img src=\"display.php?id=$fila[cod_repuesto]\"  width= 70 alt=''/>  </td>";
                    $html.=' <td>' . $codigo . '</td>';
                    $html.=' <td>' . $descripcion . '</td>';
                    $html.=' <td>' . $disponibilidad . '</td>';
                    $html.=' <td>' . number_format($preciocon, 2, ',', '.') . '</td>';
                    $html.=' <td>' . number_format($preciocre, 2, ',', '.') . '</td>';
                    if ($disponibilidad === 0) {
                        $html.="<td ><button  disabled class='btn btn-mini btn-danger'><a href= \"agregarcarrito.php?cod_repuesto=$fila[cod_repuesto]&SID=$fila[cod_repuesto]\" ></a><i  class='icon-ban-circle'> No hay disponibilidad</button></td> ";
                    } else {
                        $html.="<td><a href= \"agregarcarrito.php?cod_repuesto=$fila[cod_repuesto]&SID=$fila[cod_repuesto]\" ><span class='btn btn-mini btn-success'><i class='icon-ok'></span></a></td> ";
                    } $html.='</td>';
                    $html.=' </tr>';
              
                }
            } else
            if (!isset($result)) {
                echo "<script language='JavaScript'> alert('No existe el repuesto') 
                          location.href = 'catalogo_final.php';  exit();
                            </script> ";
            }
            pg_free_result($result);
        } else {
            echo "<script language='JavaScript'> alert('Por favor, introduzca una descripci\u00f3n del repuesto') 
                          location.href = 'catalogo_final.php';  exit();
                            </script> ";
        }
    }
    ?>
      
     <div class="content">
            <?php
            $formSlider1 = new formSiderBarMod2();
            $formSlider1->formSider();
            ?>

            <div class="mainbar">

                <div class="row-fluid">
                    <!-- Title starts -->
                    <br> 
                    <div class="span12">  
                        <div class="box-body">
                            <div class="page-title">
                                <h2>Detalles del repuesto</h2>
                                <p>Importadora xian, C.A.</p>
                                <hr />
                            </div>

                        <div class="span10">
 
                      <table class="table table-striped table-bordered table-hover">       <!-- <tr>Inicio primera fila de Arsen    -->
                          

                                <thead>
                                    <tr>
                                        <?php echo utf8_decode($encabe) ?>
                                   </tr>
                                </thead>
                                <tbody>
                                    <?php echo utf8_decode($html) ?> 
                                </tbody>
                            </table>   
                            <a align="center" href="catalogo_final.php">Ir al catálogo</a></li>
                                                   </div>
       

            


                    </div>

                </div>
            </div>
                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                                <p class="prev-indent-bot">&nbsp;</p>
                
        </div>

        <!-- Paginación sencilla -->
        
    </div>    <!-- Footer -->
     <div class="clearfix"></div>
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
