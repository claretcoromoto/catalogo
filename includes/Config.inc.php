<?php
/*
<!--****************************************************************************************************************************************************
		PAGINA DE CONFIGURACIÓN DE LAS VARIABLES DE CONEXIÓN 				

FINALIDAD:	Establecer una Configuración Inicial y Básica para el Sistema, este archivo no deberia de ser modificado
FECHA:		27/10/2010
DESARROLLADO:	Paola Bello - SITVEN, C.A.
MODIFICADO:     		
FECHA MODIFICACIÒN: 11 de octubre 2014 para Xian
SISTEMA:        IMPORTADORA XIAN
***************************************************************************************************************************-->

<!-- En este archivo se Definen las variables de Conexión, tienen un switch case que para todas las posibles conexiones
 *  donde desees probar el sistema, solo cambias el número y dependiendo de donde este corriendo,
 *  la aplicación tomará las variables de conexion -->

****************************************************************************************************************************/	
/************************************************************
Descripcion: Variables de Conexion
*************************************************************/		
$servidor="1"; //1->
switch($servidor)
{
	case '1':
		case '1':
		$nombre_base_datos  ="dbsitxian";
		$servidor           ="localhost";
		$usuario_db         ="postgres";
		$passwordc          ="sitvenpfi";
		$port               ="5432";
		break;
		
	case '2':	
		$nombre_base_datos  ="dbsitxian";
		$servidor           ="localhost";
		$usuario_db         ="importadoraxian";
		$passwordc          ="sitvenpfi";
		$port               ="5432";
		break;

	case '3':	
		$nombre_base_datos  ="dbsitxian";
		$servidor           ="179.43.127.32";
		$usuario_db         ="importadoraxian";
		$passwordc          ="sitvenpfi";
		$port               ="5432";
		break;
	
}
/************************************************************
Descripcion: Variables de Paginación
*************************************************************/
$cfg['reg_x_pagina'] = 10
?>
