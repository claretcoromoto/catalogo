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
error_reporting(0);
  ?>


    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:     Carrito del Sistema de Pedidos de Respuestos (Vendedores y Clientes)
    FECHA:           Diciembre, 2013
    DESARROLLADO:    Equipo Sitven Punto Fijo
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->
    <!-- Inicio de includes de las Vistas -->
    
    <!-- Inicio de includes de las Vistas -->
    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    include 'navbar/NavBarLogout.php';
    include 'sliderbox/formSliderBox.php';
    include 'formularios/formSiderBar2.php';
    include 'contactbox/formContactBox.php';
    include 'Footer/formFooter.php';
    include 'Clearfix/formClearFix.php';
    include 'includes/ConexionPGSQL.php';
    ?>
   



    <!-- Fin de includes de procesos -->
    <!DOCTYPE html>
    <!--   inicio de HTML Y HEAD-->
    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <!-- Title and other stuffs -->
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
    <!-- Navbar ends -->

    <?php
    $formSlider1 = new formSiderBar2();
    $formSlider1->formSider();
    ?>

    <?php  
    
$sql= "SELECT can.cod_repuesto,
                    can.nu_disp_valery,
                    can.nu_cant_reservada,
                    resp.cod_repuesto,
                    resp.tx_descripcion,   
                    resp.nu_precio_contado,
                    resp.nu_precio_credito,
                   cat.id_categoria,
                   cat.tx_descr_categoria
                   FROM tblxian_cantidad_dispon can
                        INNER JOIN tblxian_repuesto resp
                        ON can.cod_repuesto= resp.cod_repuesto
                        INNER JOIN tblxian_categoria cat
                        ON cat.id_categoria= resp.id_categoria

       WHERE resp.id_categoria= " . $_REQUEST['id_categoria'] . "";
    $result=@pg_query($sql);
    $disponibilidad=0;
    $lista = "";
    if (isset($result)) {
        while ($row = pg_fetch_array($result)) {
         
    $disponibilidad= $row['nu_disp_valery']-$row['nu_cant_reservada'];
            $lista .= '<br><tr nowrap align="left"     ';
            $lista .= "<td <hr><br> <div class='span8' > <a href=\"display.php?id=$row[cod_repuesto]\" class='prettyphoto' </a> <img src=\"display.php?id=$row[cod_repuesto]\" width= 120 alt=''/> 
                      <a href= \"repuesto.php?id=$row[cod_repuesto]\" ><span class='label label-important'>Ver Repuesto</span></a>\n <br>";
            $lista .= "<div class=ysheet tb-blue >
                              <div class=ysheet1>
                           Descripción: <br>" . $row['tx_descripcion'] . "  <br>Precio de contado: " . number_format($row['nu_precio_contado'], 2, ',', '.') .  "<br>";
            $lista .= "Precio a crédito: " .number_format( $row['nu_precio_credito'] , 2, ',', '.').  "<br> Disponibilidad: "   .  $disponibilidad.  "\n " . "</td><br>\n";
            $lista .= "<br></div><hr><br></div></div></div></tr><br>";
        }
    }
    pg_free_result($result);
    ?>
    
    
    <!-- Sliding box starts -->
    

    <!-- Inicio del Contenido  -->

 

    <div class="content">
 
<?php
    $sliderBox = new formSliderBox();
    $sliderBox->sliderBox();
    ?>
               
       <div class="mainbar">
            <div class="matter">
                <div class="container-fluid">
                    <div class="box-body">
                        <div class="row-fluid" >
                            <div class="span12">
                                <div class="well" alignrigth >
                                
                                    <h2><?php echo $_REQUEST['tx_descr_categoria'] ?></h2>
                                    <br>   
                                    <!-- Inventario de los products o repuestos disponiblestable-hover-->
                                    <form  alignrigth  class="form-horizontal" size="2" nowrap method="get" action= "'.$_SERVER['PHP_SELF'].'" >
                                        <table  class="table table-striped table-bordered table-hover">
                                                                              
                                            <?php echo $lista ?>
                                          
                                        </table>
                                    </form>                      
                                 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="clearfix"></div>
        <!-- Main content starts     </div>-->
        <!-- Footer inicio -->
        <?php
        $footer = new formFooter();
        $footer->footer();
        ?>
        <!-- Foot ends -->


        <?php
        $js = new formClearFix();
        $js->jsPie();
        ?>

    <?php }
    ?>
