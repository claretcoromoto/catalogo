<?php

function log_registro($log, $registro) {

    //$log="jean";//enviado el login del usuario por parametro
    //$tipo="BD";//enviado por parametro
    //$registro="VALOR QUE LLEGARIA SEGUN LO EJECUTADO EN EL SISTEMA";//enviado por parametro

    $xml = '<?xml version="1.0" encoding="utf-8" ?>';
    $dato = "\n<LOG TP='BD'><![CDATA[" . date("D, j M Y G:i:s T") . " -> " . $registro . "]]></LOG>";
    $carpeta = date("Ymd"); //nombre de la carpeta A�oMesDia
    $archivo = $log . ".xml";
    //echo $archivo."\n";
    //echo $carpeta;
    $ruta = "../DOC/log/" . $carpeta;
    //verificar si la carpeta existe, sino la creamos
    if (!is_dir($ruta))
        mkdir($ruta, 0700);
    //verificamos si existe el xml, sino lo creamos e insertarmos la traza enviada
    if (!file_exists($ruta . "/" . $archivo)) {
        $creacion = fopen($ruta . "/" . $archivo, "w");
        chmod($ruta . "/" . $archivo . ".xml", 0777);
        fwrite($creacion, $xml);
        fwrite($creacion, $dato);
        fclose($creacion);
    } else { //si existe el xml solo insertamos la traza enviada
        $creacion = fopen($ruta . "/" . $archivo, "a+");
        fwrite($creacion, $dato);
        fclose($creacion);
    }
}

?>
