<?php
error_reporting(0);
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idAuto1 = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header('location: login.php');
}
if (!$rol == 1) {
    header("Location: login.php");
} else {
    ?>

    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Buscar el RIF para luego anular pedido
    FECHA:           Noviembre, 2013
    DESARROLLADO:   claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->
    <!-- visas -->
    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';


    include 'Sidebar/formSiderBarMenu.php';
    include 'contactbox/formContactBox.php';

    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';


    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    include 'Slider/formSliderCatalogoAdmin.php';

    include 'includes/ConexionPGSQL.php';
    ?>
    <!-- procesos -->


    <!DOCTYPE html>

    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Motivo de anulaciones y/o aprobaciones</title>
    <script type="text/javascript">
        //<![CDATA[
        function validar(campo) {
            var elcampo = document.getElementById(campo);
            if ((!validarNumero(elcampo.value)) || (elcampo.value == "")) {
                elcampo.value = "";
                elcampo.focus();
                document.getElementById('mensaje').innerHTML = 'Debe ingresar un número entero';
            }
            else {
                document.getElementById('mensaje').innerHTML = '';
                // Aqui pones el resto de las condiciones usando comparadores u operadores aritméticos, ya que estás seguro de que trabajas con números 
            }
        }
        function validarNumero(input) {
            return (!isNaN(input) && parseInt(input) == input);
        }
    </script>
    <?php
    $links = new link();
    $links->linkeos();
    ?>

    <!-- Navbar starts -->

    <!-- Navbar starts -->
    <?php
    $navAdmin = new NavBarAdmin();
    $navAdmin->navegador($email);
    ?>
    <div class="content">
        <br>  <br>  
        <?php
        $sideBarAdmin = new formSiderBarMenu();
        $sideBarAdmin->formSider();
        ?>
        <!-- Sidebar starts -->
        <div class="mainbar" align="center">
            <div class="span14" >
                <div class="box-body" >


                    <div class="page-title" align="left">
                        <h4>Configurar motivo de anulaciones y/o aprobaciones</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>
                    <div class="span9">
                            <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th auto >#</th>
                                            <th auto >Nombre del motivo</th>
                                            <th auto >Responsable</th>
                                            <th auto >Tipo</th>
                                     
                                            <th width="3" >Activar/desactivar</th>
                                            <th width="3"  >Procesar</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                        <?php
                        $sql = "SELECT * FROM tblxian_motivo_anul ORDER BY id_motivo_anul ASC";
                        $result = @pg_query($sql);
                        if ($numrow = pg_num_rows($result) > 0) {
                            while ($row = pg_fetch_array($result)) {
                                ?>
                            
                                        <!-- Primer formulario-->
                                        <tr> 
                                            <td id="e"> <?php echo $row['id_motivo_anul'] ?></td>
                                            <td id="edit"><?php echo $row['nb_motivo_anul'] ?></td> 
                                            <td id="edit"><?php echo $row['tx_login'] ?></td> 
                                            <?php if ($row['in_tipo'] == 1) { ?>
                                                 <td align="center"><span class="label label-important">Cliente</span></td>
                                            <?php } ?>
                                            <?php if ($row['in_tipo'] == 2) { ?>
                                                 <td align="center"><span class="label label-danger">Pedido</span></td>
                                            <?php } ?>
                                            
                                            
                                            
                                            <?php if ($row['in_activo'] === '1') { ?>
                                                <td align="center"><span class="label label-important">Activo</span></td>
                                                <!--<td>  <button  type="submit" name="enviar" class="btn btn-danger" >Desactivar</button></td>-->
                                                <td align="center"><a href="includes/ActualizarMotivoAnulTipo.php?id=<?php echo $row['id_motivo_anul'] ?>&ina=0">  <button type="submit"  title="Desactivar" class="btn btn-mini btn-danger"><i class="icon-off "></i></button>   
                                                </td>
                                            <?php } else { ?>
                                               <td align="center"><span class="label label-inverse">Inactivo</span></td>
                                                <td align="center"><a href="includes/ActualizarMotivoAnulTipo.php?id=<?php echo $row['id_motivo_anul'] ?>&ina=1">  <button type="submit"  title="Activar" class="btn btn-mini btn-success"><i class="icon-ok "></i></button> 
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                <?php } ?> 
                            </table> 
                        <?php } else { ?>


                            <div class="form-horizontal" aligncenter >                                        <br><br>
                                <center >

                                    <center class="hero-unit" >      <p > <h5> No hay solicitudes pendientes</h5>   </p>   </center></center>
                            </div>
                        <?php } ?>
                    </div>
                    
                </div>  
                <br><br><br><br><br>   <br><br><br><br><br>
            </div>   
        </div>
         
    </div>
  



    <div class="clearfix"></div>
    <!--  footer -->
    <?php
    $footer = new formFooter();
    $footer->footer();
    ?>
    <!-- Foot ends -->


    <?php
    $js = new formClearFix();
    $js->jsPie();
    ?>
<?php } ?>
