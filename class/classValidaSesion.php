<?php

//C�digo para ocultar los errores
//ini_set("error_reporting","E_ALL & ~E_NOTICE");
//Conexi�n global a la base de datos
//$ValidaSesion = new classValidaSesion();
class classValidaSesion {

    function validarSesionActualIniciada() {


        if ($_SESSION['login'] == '') {

            $this->ObjCabPie = new classlibCabPie("NOMBRE DEL SISTEMA", "classRegistro");
            $this->ObjMensaje = new classMensaje("", "mostrar");
            //Armar la pagina
            $htm = $this->ObjCabPie->HtmCab(0, $fichero_js, '', "menu_cerrar.js", "estilos.css", $al_cargar);
            $htm.=$this->ObjCabPie->CerrarHtmRegistro();
            echo $htm;
            $ObjScrip = new classjavascript();
            echo $ObjScrip->mensajeRedirecciona("La P\u00E1gina a Caducado Porque ha Sobrepasado el Tiempo de Inactividad. Por Favor Vuelva a Iniciar Sesi\u00F3n.", "../paginas/classRegistro.php");
            exit(0);
        }

        return;
    }

}

?>
