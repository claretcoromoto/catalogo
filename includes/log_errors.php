<?php

class log_errors{
    
    function __construct() {
        ;
    }
    
    
            function Traza($log,$registro,$tipo)
{
/***************************************************************************************************
PAGINA FUNCIONALIDAD.
FINALIDAD:			funcion que guarda datos de lo que ha echo el usuario en el sistema
				
FECHA:			    30 de Julio 2011
DESARROLLADO:	    Ferreiro Jean /ferreirojean@gmail.com/04125487793
****************************************************************************************************/
$xml='<?xml version="1.0" encoding="utf-8" ?>';
$dato="\n<LOG TP='".$tipo."'><![CDATA[".date("D, j M Y G:i:s T")." -> ".$registro."]]></LOG>";
$carpeta=date("Ymd");//nombre de la carpeta AñoMesDia
$archivo=$log.".xml";
//echo $archivo."\n";
//echo $carpeta;
$ruta="DOC/LOG/".$carpeta;
	//verificar si la carpeta existe, sino la creamos
	if(!is_dir($ruta)) 
	{
		mkdir($ruta,0777,true);
		
	}
	//verificamos si existe el xml, sino lo creamos e insertarmos la traza enviada
	if(!file_exists($ruta."/".$archivo))
	{	
		$rutaArchivo=$ruta."/".$archivo;
		$creacion= fopen($rutaArchivo, "w");
		
		//	echo "creo el archivo con permiso 777";		
		fwrite($creacion, $xml);
		fwrite($creacion, $dato);
		fclose($creacion);
	}
	else //si existe el xml solo insertamos la traza enviada
	{
		$creacion= fopen($ruta."/".$archivo, "a+");
		fwrite($creacion, $dato);
		fclose($creacion);
	}
}
}
?>