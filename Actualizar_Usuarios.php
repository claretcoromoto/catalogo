<?php error_reporting(0);
require_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get('email');
$idusr = $sesion->get('id_usr');
$rol= $sesion->get('id_rol_usr');
if (!isset($email)) {
    header("Location: login.php");
} else {
  @ini_set('display_errors', '1'); 

    ?>

<!--  
///********************************************************
PAGINA FUNCIONAL (Funcional o de visualización)
FINALIDAD:       Registro de Usuarios de la Importadora Xian
FECHA:           Diciembre, 2013
DESARROLLADO:     claretcoromoto@hotmail.ES  victor_rosendo@hotmail.com
MODIFICADO:      Claret Coromoto Salazar Guanipa / 4-12-2013 / #Release
///********************************************************
-->
<?php
// vistas
include 'meta/formMeta.php';
include 'Sidebar/formSiderBar.php';
include 'contactbox/formContactBox.php';
include 'Link/Link.php';
include 'navbar/NavBarLogout.php';
include 'sliderbox/formSliderBox.php';
include 'sheetstart/formSheetStart.php';
include 'formularios/formInicioContent12.php';
include 'formularios/formConten12Fin.php';
include 'Slider/formSliderCatalogo.php';
include 'formularios/formBlock.php';
include 'newletter/formNewLetter.php';
include 'Service/formService.php';
include 'Clearfix/formClearFix.php';
include 'Footer/formFooter.php';
include 'Post/formPost.php';
// procesos
include'formularios/formActualizarClientes.php';
include 'include/rif/Rif.php';
require_once 'conexion/ConexionPGSQL.php';
include 'formularios/formBuscarEmail.php';
?>
<!DOCTYPE html>

<!--   inicio de HTML Y HEAD-->
<?php
$meta = new formMeta();
$meta->meta();
?>
<title>Login</title>

<?php
$links = new link();
$links->linkeos();
?>
<!--   Fin de HTML Y HEAD-->

        <!-- Navbar starts -->

        <?php
        $navegador = new NavBarLogout();
        $navegador->navegador();
        ?>
        <!-- Navbar ends -->


        <!-- Sliding box starts -->
        <?php
        $sliderBox = new formSliderBox();
        $sliderBox->sliderBox();
        ?>
        <!-- Sliding box ends -->    

        <!-- Main content starts -->
        <!--   inicio del contenido de la página -->
        <?php
        $contentI = new formInicioContent12();
        $contentI->content12Ini();
        ?>
        <!--   inicio del contenido de la página -->

 <!--  
************************************************************
CASO DE USO: Actualizar Usuario (vendedor)
Descripción: El vendedor actualiza o termina de registrar sus
 datos si su email (username) está autorizado por Importadora
 Xian.
 Precondición: El Vendedor debe estar autorizado por la empresa
 pasos: 
 01 El usuario introduce el username (email)
 02 El sistema valida el Email y verifica Rol que sea de Vendedor.
     Sí es verdadero 
         Entra al Módulo de Vendedores.
     Sí es falso
         Entra al index.php
 Módulo de vendedores:
 
 
 NOTA: ESTE PROCEDIMIENTO LO HACE EL VENDDEDOR POR PRIMERA VEZ
 LUEGO, ÉL CUANDO SE LOGUEA PUEDE IR A SU PERFIL Y MODIFICAR 
 SUS DATOS EN EL MOMENTO QUE LO NECESITE.???
*************************************************************
-->

        <?php
         

        $formBuscar = new formBuscarEmail();
        $formBuscar->formBuscar();
        
        if (isset( $_GET['email'])) {

            $correo =htmlentities(strip_tags( $_GET['email']));
           
            $sql = "SELECT * FROM tblsit_usr WHERE id_rol_usr = 5 AND tx_login = '" . $correo. "'";
            $q = @pg_query($sql);
            $rows = pg_num_rows($q);
             if ($rows > 0) {
                     while ($resultado = pg_fetch_array($q)) {
                    $formBuscar->formRegistrese($resultado);
                }
            }
        }
        ?>




        <!--    fin del contenido de la página -->

        <?php
        $fin = new formContent12Fin();
        $fin->content12fin();
        ?>
        <!--    fin del contenido de la página -->
        <br>
        <br> 
        <br>
        <br>

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

        <?php
    }?>