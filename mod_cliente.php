<?php
include 'includes/ConexionPGSQL.php';
include_once "includes/sesion.class.php";
$sesion = new sesion();
$email = $sesion->get("email");
$idusr = $sesion->get('id_usr');
$rol = $sesion->get('id_rol_usr');
$rif = $sesion->get('rif');
if (!isset($email)) {
    header("Location: login.php");
}
if (!$rol == 4) {
    header("Location: catalogo_final.php");
} else {
    ?>

    <?php
    include 'meta/formMeta.php';
    include 'Link/Link.php';
    include 'navbar/NavBarVendedor.php';
    include 'sliderbox/formSliderBox.php';
    include 'Sidebar/formSiderBarMod.php';
    include 'Footer/formFooter.php';
    include 'includes/tab1.php';
    include 'includes/tab2.php';
    include 'includes/tab3.php';
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">


    <html lang="es">

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta charset=UTF-8"><script type="text/javascript">document.documentElement.className += " js";</script>

            <!-- Title and other stuffs -->
            <meta charset="encoding">
            <title>Perfil del cliente</title>
            <script src="js/jquery-1.7.min.js" type="text/javascript" charset="utf-8"></script>
            <script src="js/jquery.cookie.js" type="text/javascript" charset="utf-8"></script>
            <script src="js/jquery.syncheight.js" type="text/javascript" charset="utf-8"></script>
            <script src="js/jquery.tabs.js" type="text/javascript" charset="utf-8"></script>
  

            <?php
            $links = new link();
            $links->linkeos();
            ?>

            <?php
            $nav = new NavBarVendedor();
            $nav->navende($email);
            ?>
        <div class="content">

            <?php
            $formSlider1 = new formSiderBarMod();
            $formSlider1->formSider();
            ?>
            <!-- Title starts  id="sometabs" -->
            <div class="mainbar">
                <div class="span12">
                    <div class="box-body">
                        <br>
                        <div class="page-title">
                            <h3>Gestiona tu perfil</h3>
                            <p>Importadora xian, C.A.</p>
                            <hr/>
                        </div>
                        <?php
                        $sqlre = "SELECT * FROM tblsit_usr  WHERE  tx_login ='" . $email . "' AND ci_rif_cliente='" . $rif . "'";
                        $result = @pg_query($sqlre);
                        $datos = pg_fetch_array($result);
                        $nombreu = $datos['nb_usuario'];
                        $razon = $datos['razon_social_cliente'];
                        $persona = $datos['nb_persona_contacto'];
                        $contacto = $datos['tx_telf_contacto'];
                        $t1 = new tab1();
                        ?>


                        <div  class="span8">
                            <div class="tab-content" > 
                                <div  class="tabs"   >
                                    <div class="tabbody" align="center">
                                        <header id="tab2">Información básica</header>
                                        <div class="well login-register">
                                            <form class="form-horizontal"  method="post" action="mod_cliente.php" >
                                                <!-- RIF -->
                                                <div class="control-group">
                                                    <label class="control-label" style="font-size:12px" for="rif">RIF:</label>
                                                    <div class="controls">
                                                        <input type="text" disabled title="RIF" class="input-large" placeholder="V106128118"  value="<?php echo $rif ?>" autofocus />
                                                    </div>
                                                </div>   
                                                <!-- email -->
                                                <div class="control-group">
                                                    <label class="control-label" style="font-size:12px" for="rif">Correo electrónico:</label>
                                                    <div class="controls">
                                                        <input  disabled type="text" readonly title="username" class="input-large" placeholder="usuario"    value="<?php echo $email ?>" autofocus />
                                                    </div>
                                                </div>  
                                                <div class="control-group">

                                                    <label class="control-label" style="font-size:12px" for="nombre">Nombre:</label>
                                                    <div class="controls">
                                                        <input disabled type="text" title="Por favor, introduzca el nombre de pila" class="input-large" placeholder="Juan Pérez" name="nombre" id="nombre"  value="<?php echo $nombreu ?>" autofocus />
                                                    </div>
                                                </div>   
                                                <!-- RIF -->
                                                <div class="control-group">
                                                    <label class="control-label" style="font-size:12px" for="razon">Razón social:</label>
                                                    <div class="controls">
                                                        <input disabled type="text" title="Por favor, introduzca la razón social" class="input-large"  name="razon" id="razon"   value="<?php echo $razon ?>" autofocus />
                                                    </div>
                                                </div> 
                                                <!-- RIF -->
                                                <div class="control-group">
                                                    <label class="control-label" style="font-size:12px" for="contactof">Nombre de la persona de contacto:</label>
                                                    <div class="controls">
                                                        <input disabled type="text" title="Por favor, introduzca el nombre de contacto" class="input-large" name="contacto" id="contacto"  value="<?php echo $contacto ?>" autofocus />
                                                    </div>
                                                </div> 

                                            </form></div>
                                    </div>
                                    <div class="tabbody">
                                        <header >Datos personales</header>
                                        <?php
                                        $t1->tabs1($rif, $email, $nombreu, $razon, $persona, $contacto);
                                        ?>
                                    </div>
                                    <div class="tabbody">
                                        <header id="tab3">Direcciones</header>
                                        <?php include 'includes/t3.php'; ?>
                                    </div>
                                    <div class="tabbody">
                                        <header id="tab3">Contraseña</header>
                                        <?php include 'includes/t2.php'; ?>
                                    </div>
                                </div>

                               
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <?php
        $footer = new formFooter();
        $footer->footer();
        ?>

        <script type="text/javascript">

                $(document).ready(function() {
                    var tabs = $(".tabs").accessibleTabs({
                        tabhead: 'header',
                        fx: "fadeIn",
                        syncheights: true,
                        saveState: true
                    });
                });

        </script>    
        <script src="js/custom.js"></script> 

    </body>
    </html>
    <?php
}?>