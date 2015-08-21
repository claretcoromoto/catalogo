<?php
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get("id_usr");
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header('location: login.php');
}
if (!$rol == 1) {
    header("Location:  login.php");
} else {
    ?>
    <!--  
    ///********************************************************
    PAGINA FUNCIONAL (Funcional o de visualización)
    FINALIDAD:       Buscar el RIF para luego Registrar clientes
    FECHA:           Noviembre, 2013
    DESARROLLADO:   claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
    MODIFICADO:          Nombre / Fecha / #Release
    ///********************************************************
    -->
    <!-- visas -->
    <?php
    include 'meta/formMeta.php';
    include 'Sidebar/formSiderBarMenu.php';
    include 'contactbox/formContactBox.php';
    include 'Link/Link.php';
    include 'navbar/NavBarAdmin.php';
    include 'sliderbox/formSliderBox.php';
    include 'sheetstart/formSheetStart.php';
    include 'formularios/formSliderSpan6Ini.php';
    include 'formularios/formSliderSpan6Fin.php';
    include 'formularios/formInicioContent12.php';
    include 'formularios/formConten12Fin.php';
    include 'Sidebar/formSiderBarIndex.php';

    include 'Clearfix/formClearFix.php';
    include 'Footer/formFooter.php';
    include 'Post/formPost.php';

    include 'formularios/formValidarRif.php';
    include 'formularios/formRegistrarClientes.php';
    include 'includes/ConexionPGSQL.php';
    ?>
    <!-- procesos -->


    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

    <?php
    $meta = new formMeta();
    $meta->meta();
    ?>
    <title>Estado</title>
    <script type="text/javascript" src="js/functions.js"></script>

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script language="javascript" type="text/javascript">
        $(document).ready(function() {
            $('button[type="submit"]').attr('disabled', 'disabled');
            $('input[type="text"]').attr('disabled', 'disabled');


            $('a[name="editar"]').click(function() {
                $('input[type="text"]').removeAttr('disabled');

                $('button[type="submit"]').removeAttr('disabled');
                $("#edit").attr('disabled', 'disabled');
            });
        });</script>

    <?php
    $links = new link();
    $links->linkeos();
    ?>

    <!-- Navbar starts -->

    <?php
    $navegadornav = new NavBarAdmin();
    $navegadornav->navegador($email);
    ?>
    <!-- Navbar ends -->


    <div class="content">
        <br><br>

        <!-- Sidebar starts -->
        <?php
        $sideBarAdmin = new formSiderBarMenu();
        $sideBarAdmin->formSider();
        ?>   
        <div class="mainbar">
            <!-- Title starts  id="sometabs"  <div class="mainbar"> -->
            <div class="span14">
                <div class="box-body">

                    <div class="page-title" align="left">
                        <h4>Editar estados</h4>
                        <p>Importadora Xian, C.A.</p>
                        <hr/>
                    </div>


                    <div class="span14">
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="span12" >
                                    <!-- Buscar Rif y Razón Social<div class="well login-register-table">-->
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th auto >Estado</th>
                                                <th auto >Municipio</th>
                                                <th auto >Operaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tblsit_municipio ORDER BY nb_municipio ASC";
                                            $result = @pg_query($sql);
                                            while ($row = pg_fetch_array($result)) {
                                                ?>
                                                <!-- Buscar Rif y Razón Social-->
                                            <form class="form-horizontal"   method="post" action="includes/ActualizarMunicipios.php" >
                                                <!-- Categoría-->
                                                <tr> 

                                                  
                                                    <td>  
                                                        <div class="control-group">
                                                            <div class="controls">
                                                                <select  class="input-medium"   name="id_estado" id="id_estado"  required>
                                                                    
                                                                      <?php
                                                    $sqlcat = "SELECT * FROM tblsit_estado ORDER BY nb_estado ASC";
                                                    $result = @pg_query($sqlcat);
                                                    $estad = '';
                                                    $rowe = pg_fetch_array($result);
                                                    $idestado = $rowe['id_estado'];
                                                    while ($rowe = pg_fetch_array($result)) {
                                                        $estad .=" <option value=" . $rowe['id_estado'] . "> " . $rowe['nb_estado'] . "</option>";
                                                    }
                                              $sqlmuni = ("select id_municipio, nb_municipio from tblsit_municipio where id_estado=" . $idestado . " order by nb_municipio");
                                                    $result = @pg_query($sqlmuni);
                                                    $row = pg_fetch_array($result); 
                                                  
                                                    $munici = '';
                                                    
                                                    if($idestado ==$rowe['id_municipio']){
                                                    while ($rowe = pg_fetch_array($result)) {
                                                        $munici.=" <option value=" . $rowe['id_municipio'] . "> " . $rowe['nb_municipio'] . "</option>";
}}
                                                    echo $estad ?>
                                                                </select>  
                                                            </div>
                                                        </div>   
                                                    </td>  
                                                    <td>  
                                                    <div class="control-group">
                                                            <div class="controls">
                                                               
                                                                <select  class="input-medium"   name="id_municipio" id="id_municipio"  required>
                                                                    <option>   no ha seleccionado nada </option>
                                                                   <?php 
                                                                echo $munici ?>
                                                           </select>  
                                                            </div>
                                                        </div>   
                                                    </td>  
                                                    <td>
                                                        <a  class="btn btn-mini btn-reveal" name="editar" href="#"><i class="icon-edit "></i></a>
                                                        <button class="btn btn-mini btn-danger" type="submit" title="Actualizar"  name="enviar" class="btn"> <i class="icon-ok"></i></button>
                                                        <button class="btn btn-mini btn-danger" type="reset" title="Cancelar"class="btn"><i class="icon-repeat"></i></button></td> 
                                                </tr> 
                                            </form>
    <?php }
    ?>

                                        </tbody>
                                    </table>  

                                </div>
                            </div>
                        </div>
                    </div>
                </div> </div>
        </div>
        <!--   fin del contenido de la página -->

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
