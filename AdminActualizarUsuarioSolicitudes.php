<?php error_reporting(0);
include "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
} else if (!$rol == 1 || !$rol == 2) {
    header("Location: login.php");
} else {
    ?>

    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';

    include 'Sidebar/formSiderBarMenu.php';
    include 'contactbox/formContactBox.php';

    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';
    include 'Slider/formSliderCatalogo.php';

    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';

    include 'includes/ConexionPGSQL.php';
 
    include 'includes/Consultas.php';
    include 'includes/getSetPedido.php';
    include 'includes/Rif.php';
    ?>
   <!DOCTYPE html>
<?php
$meta = new formMeta();
$meta->meta();
?>
<title>Administración</title>

<?php
$links = new link();
$links->linkeos();
?>
<!--   Fin de HTML Y HEAD-->

<!-- Navbar starts -->
<?php
        $navAdmin = new NavBarAdmin();
        $navAdmin->navegador($email);
        ?>

<!-- Navbar ends -->



<!-- Main content starts -->
<div class="content">
    <br><br>
    <!-- Sidebar starts -->
         <!-- Sidebar starts -->
        <?php
        $sideBarAdmin = new formSiderBarMenu();
        $sideBarAdmin->formSider();
        ?>   
    <div class="mainbar">
                <!-- Title starts  id="sometabs"  <div class="mainbar"> -->
                <div class="span14">
                    <div class="box-body">
                        <br>  <br>  <br>
                        <div class="page-title" align="left">
                            <article>Administración de usuarios</article>
                            <p>Importadora Xian, C.A.</p>
                            <hr/>
                        </div>
<?php   

       if(isset($_GET['rif']))
           $rif=$_GET['rif'];
$sql="SELECT tblsit_usr.razon_social_cliente AS tblsit_usr_razon_social_cliente,
               tblsit_usr.ci_rif_cliente AS tblsit_usr_ci_rif_cliente,
                  tblsit_usr.nb_usuario AS tblsit_usr_nb_usuario,
               tblsit_usr.tx_direccion AS tblsit_usr_tx_direccion,
               tblsit_usr.nb_persona_contacto AS tblsit_usr_nb_persona_contacto,
               tblsit_usr.tx_telf_contacto AS tblsit_usr_tx_telf_contacto,
               tblsit_usr.tx_login AS tblsit_usr_tx_login,
               tblsit_ciudad.nb_ciudad AS tblsit_ciudad_nb_ciudad,
               tblsit_municipio.nb_municipio AS tblsit_municipio_nb_municipio,
               tblsit_estado.nb_estado AS tblsit_estado_nb_estado,
               tblsit_usr.in_status_cliente AS tblsit_usr_in_estatus_cliente
                FROM tblsit_ciudad tblsit_ciudad 
                INNER JOIN tblsit_usr tblsit_usr ON tblsit_ciudad.id_ciudad = tblsit_usr.id_ciudad
                INNER JOIN tblsit_municipio tblsit_municipio 
                ON tblsit_ciudad.id_municipio = tblsit_municipio.id_municipio
                INNER JOIN tblsit_estado tblsit_estado ON tblsit_municipio.id_estado = tblsit_estado.id_estado
                 WHERE tblsit_usr.id_rol_usr = 4 
                 AND (tblsit_usr.in_status_cliente = 2 OR tblsit_usr.in_status_cliente = -2 OR tblsit_usr.in_status_cliente = -1) 
                 AND id_usr_autor_clte='78' AND tblsit_usr.ci_rif_cliente='".$rif."'  ";
        $query= @pg_query($sql);
        $file=pg_fetch_array($query);
    echo ''.$file['tx_login'];
?>

                        <div class="span12">
                            <div class="well login-register">
                                <form    name="QForm"   id="QForm" class="form-horizontal" method="post" action="includes/ActualizarUsuario.php" />


                                        <fieldset> 
                                            <legend  class="btn btn-danger " >Datos Personales</legend> 

                                            <!-- Rif -->
                                            <div class="control-group">
                                                <label class="control-label" for="name">RIF:</label>
                                                <div class="controls">
                                                    <input readonly type="text" class="input-large" id="rif" name="rif" value="<?php echo $file['tblsit_usr_ci_rif_cliente']?>">
                                                    <input readonly type="hidden" class="input-large" id="idvenempre" name="idvenempre" value="<?php echo $file['tblsit_usr_razon_social_cliente']?>">
                                                </div>
                                            </div>   

                                            <!-- Razón Social-->
                                            <div class="control-group">
                                                <label class="control-label" for="empresa">Razón social:</label>
                                                <div class="controls">
                                                    <input readonly type="text"  size="100"class="input-large" id="empresa" name="empresa" value="<?php echo $file['tblsit_usr_razon_social_cliente']?>">
                                                </div>
                                            </div> 
                                            
                                            <!-- Nombre del usuario-->
                                            <div class="control-group">
                                                <label class="control-label" for="email">Usuario:</label>
                                                <div class="controls">
                                                    <input readonly type="text" class="input-large" id="email" placeholder="ejemplo@dominio.com"  
                                                           name="email" pattern="[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}" autofocus required  value="<?php echo $file['tblsit_usr_tx_login']?>" />  
                                                </div>   
                                            </div>  
                                            <!-- Rol del usuario-->
                                        </fieldset>  
                                    <fieldset> 
                                        <legend class="btn btn-danger ">Contacto</legend> 
                                        <!-- Nombre de Persona de Contacto-->
                                        <div class="control-group">
                                            <label class="control-label" for="contacto">Nombre de persona de contacto:</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" id="contacto" name="contacto" placeholder="Nombre y Apellido" required value="<?php echo $file['tblsit_usr_nb_persona_contacto']?>" />  
                                            </div>        
                                        </div>   
                                        <!-- Teléfono Persona de Contacto-->
                                        <div class="control-group">
                                            <label class="control-label" for="telefono">Teléfono persona de contacto:</label>
                                            <div class="controls">

                                                <input type="tel" pattern="[0-9]{11,13}" class="input-large" id="telefono" name="telefono" placeholder="Eg. 582120000000,02120000000 " required value="<?php echo $file['tblsit_usr_tx_telf_contacto']?>" />  

                                            </div>
                                        </div>                  
                                    </fieldset>
                                      <fieldset>
                                            <legend class="btn btn-danger ">Localización</legend> 
                                            <!-- Dirección -->
                                            <div class="control-group">
                                                <label class="control-label" for="direccion">Dirección fiscal:</label>
                                                <div class="controls">
                                                    <input class="input-large" name="direccion" placeholder="Av. Boulevar Naiguatá, E/S Tanaguarena Caribe"  required value="<?php echo $file['tblsit_usr_tx_direccion']?>" />
                                                </div>
                                            </div> 
                                            <div class="control-group">
                                                <label class="control-label" for="lstModel">Estado: </label>
                                                <div class="controls">
                                                     <input class="input-large" name="estado" placeholder="Falcón"  required value="<?php echo $file['tblsit_estado_nb_estado']?>" />
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lstModel">Municipio: </label>
                                                <div class="controls">
                                                   <input class="input-large" name="estado" placeholder="Carirubana"  required value="<?php echo $file['tblsit_municipio_nb_municipio']?>" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="lstOptions">Ciudad: </label>
                                                <div class="controls">
                                                   <input class="input-large" name="estado" placeholder="Punto Fijo"  required value="<?php echo $file['tblsit_ciudad_nb_ciudad']?>" />
                                                </div>
                                            </div>
                                             <fieldset> 
                                        <legend class="btn btn-danger ">Activaciones</legend> 
                                       
                                            <!-- Estatus -->
                                            <div class="control-group">
                                                <label class="control-label" for="name">Estatus:</label>
                                                <div class="controls">
                                                   
                                                    <input  type="text" class="input-large" id="status" name="status" value="<?php echo $file['tblsit_usr_in_estatus_cliente']?>">
                                                </div>
                                            </div>   
                                            
                                            <!-- Estatus 
                                            <div class="control-group">
                                                <label class="control-label" for="name">Motivo de anulación:</label>
                                                <div class="controls">
                                                   
                                                    <input  type="text" class="input-large" id="anula" name="anula" value="<?php echo $file['tblsit_usr_in_estatus_cliente']?>">
                                                </div>
                                            </div>   -->
                                    </fieldset>
                                            <!-- Buttons -->
                                            <!-- Buttons -->  
                                            <div class="form-actions">
                                                <!-- Buttons -->
                                                  <button class="btn btn-danger" type="submit"  name="enviar"> Registrar</button>
                                                  <button class="btn btn-danger" type="reset" class="btn">Limpiar</button>
                                                <a class="btn btn-danger" href="AdminMenuPrincipal.php">Cancelar</a>
                                            </div>
                                      </form>    </div>  

                        </div><!-- fin de span 14-->
                    </div>
                </div><!-- fin de span 14-->
            </div>
        </div><!-- fin de content-->


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