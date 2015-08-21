<?php

/*
  Caracas; 29/03/2006
  Clase Libreria Cabecera y Pie de Pagina (classlibCabPie)
  Version 2.0.
 */

class classlibCabPie {

    // Variables globales de la clase
            var $titulo = "", $nombrePagina;

    /*
      Funcin de Librera HTML Cabecera (flibHtmCab())
      Contiene todo lo referente al cdigo HTML usado al inicio al invocar la
      Funcin de Librera HTML (flibHtm()), luego se aade una cadena de caracteres que
      tiene la Union de las Imagenes de Cabeceras. Parametros enviados:
      $activarRefresh: Es para indicar si la pagina se necesita autorefrescarse.
      $ficheroJavaScript: Se debe agregar la ruta y el nombre del archivo .js que se va hacer referencia.
      $validaJavaScript: Son las validacion correspondientes a cada formulario independiente de la aplicacin.
      $menu: Es la cadena de caracteres que tiene el men correspondiente de la aplicacin
     */

    function HtmCab($activarRefresh, $ficheroJavaScript, $validaJavaScript, $menu, $css, $al_cargar = "") {
        $htmCab = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
				<html xmlns='http://www.w3.org/1999/xhtml' oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
				<head>	<meta http-equiv='X-UA-Compatible' content='IE=EmulateIE8:'/>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>";
        if ($activarRefresh) {
            $htmCab.="<meta http-equiv=\"refresh\" ;charset=utf-8; content=\"60;" . $this->$nombrePagina . "\">";
        }
        $htmCab.="<title>" . $this->titulo . "</title>
		<script type=\"text/javascript\" language=\"JavaScript1.2\" src=\"../js/validaciones.js\"></script>
		<script type=\"text/javascript\" language=\"JavaScript1.2\" src=\"../js/Calendarios.js\"></script>
		<script type='text/javascript' src='../class/calendario/calendar.js'></script>
		<script type='text/javascript' src='../class/calendario/lang/calendar-es.js'></script>
		<script type='text/javascript' src='../class/calendario/calendar-setup.js'></script>
		<link href='../css/calendario.css' rel='stylesheet' type='text/css' media='all'/>
		<link href='../css/EstiloTeclado.css' rel='stylesheet' type='text/css' media='all'/>
		<script type=\"text/javascript\" language=\"JavaScript1.2\" src=\"../js/incluir.js\"></script>
		<script src=\"../js/jquery-1.3.2.min.js\" type=\"text/javascript\"></script>  
		<script type=\"text/javascript\" language=\"JavaScript1.2\" src=\"../js/ajax.js\"></script>";

        if ($css != "") {
            $htmCab.="<link href=\"../css/" . $css . "\" rel=\"stylesheet\" type=\"text/css\" />";
        }
        //bgcolor='#666666'


        $menu = "
<div id='menuv'>
<ul>
<li><span class='Estiloletrapeq'><strong>Men&uacute; Principal</strong></span></li>
<li><a href='../paginas/classCargarSistema.php'><span class='Estiloletrapeq'>Inicio</span></a></li>
<li><span class='Estiloletrapeq'><strong>Solicitudes</strong></span></li>
<li><a href='../paginas/classOperacionesElectronicasInternet.php'><span class='Estiloletrapeq'>Autorizaci&oacute;n para pagos de consumos electr&oacute;nicos </span></a></li>
<li><a href='../paginas/classSolicitudesTarjetasCreditoViajes.php'><span class='Estiloletrapeq'>Autorizaci&oacute;n con tarjeta de cr&eacute;dito para viajes al exterior</span></a></li>
<li><a href='../paginas/classSolicitudesEfectivoMayores.php'><span class='Estiloletrapeq'>Autorizaci&oacute;n de divisas en efectivo</span></a></li>
<li><a href='../paginas/classSolicitudesEfectivoMenores.php'><span class='Estiloletrapeq'>Autorizaci&oacute;n de divisas en efectivo para menores de edad</span></a></li>
<li><span class='Estiloletrapeq'><strong>Cuenta de Usuario</strong></span></li>
<li><a href='../paginas/classCambiarClaveUsuario.php'><span class='Estiloletrapeq'>Cambiar clave de acceso</span></a></li>
<li><a href='../paginas/classRegistro.php'><span class='Estiloletrapeq'>Salir</span></a></li>
</ul>
</div>";

        /* $menu="

          <ul id='menu'>
          <li><a href='#'>Menu 1</a>
          <ul>
          <li><a href='#'>Submenu 1</a></li>
          <li><a href='#'>Submenu 2</a></li>
          <li><a href='#'>Submenu 3</a></li>
          <li><a href='#'>Submenu 4</a></li>
          </ul>
          </li>
          <li><a href='#'>Menu 2</a>
          <ul>
          <li><a href='#'>Submenu 1</a></li>
          <li><a href='#'>Submenu 2</a></li>
          <li><a href='#'>Submenu 3</a></li>
          <li><a href='#'>Submenu 4</a></li>
          </ul>
          </li>
          <li><a href='#'>Menu 3</a>
          <ul>
          <li><a href='#'>Submenu 1</a></li>
          <li><a href='#'>Submenu 2</a></li>
          <li><a href='#'>Submenu 3</a></li>
          <li><a href='#'>Submenu 4</a></li>
          </ul>
          </li>
          <li><a href='#'>Menu sin submenu</a></li>
          </ul>




          "; */


        $htmCab.="</head><body onLoad='marcadorMinuscula();' oncontextmenu='return false' onselectstart='return false'
ondragstart='return false' oncopy='return false'>
				<div id=\"contenedor\">
				<table border=\"1\" width=\"800\" rules=\"none\" bordercolor=\"black\" align=\"center\" ><tr>
				<td colspan=\"2\" >

				<div align=\"left\" >

					<img src='../imagenes/banner.jpg' width='1010px' height='70px' alt='Logo Legal' /></td>
				</div>";


        if ($_SESSION['login'] != '') {
            $htmCab.="
					<tr>
					<td width='100' valign='top'>" . $menu . "</td>
					<td>
					<table border=\"0\" width=\"800\" border=\"1\" bordercolor=\"black\" rules=\"none\" ><tr><td align=\"right\">
					<span class='Estilo4'><strong>Usuario:</strong> " . $_SESSION['login'] . "</span></td></tr></table>
					<br>
					<div id=\"bloqueinicio\">
					<div id=\"footer\"  align=\"right\">
					<span class='Estilo4'>
					";
        } else {
            $htmCab.="
					<tr>
					<td width='10' valign='top'></td>
					<td>
					<div id=\"bloqueinicio\">
					<div id=\"footer\"  align=\"right\">
					<span class='Estilo4'>
					";
        }
        return $htmCab;
    }

    /*
      Funcin de Libreria Cerrar HTML (flibCerrarHtm())
      Contiene todo lo referente al cierre del cdigo HTML usado al inicio,
      se puede encontrar en la Funcin de Librera HTML (flibHtm()), este a
      su vez contiene la imagen que esta al pie de cada presentacion de la
      empresa.
     */

    function CerrarHtm() {

        $CerrarHtm = "
		</td></span></td></tr></table><br>
		
		<div align='center'>
		<br>
	
	<table width=\"800\" align='center' border='0'>
		<tr>
		<td align=\"center\" width=\"800\">
		<a href='http://www.sitven.com/'target=_blank''><img src='../imagenes/sitven_poweredby.jpg' width='80px' height='25px' alt='Sitven'/></a>
		</td>
		</tr>		
		<tr>
		<td align=\"center\" width=\"800\">
		<span class='Estiloletrapeq'>Todos los derechos reservados. Soluciones Integrales de Tecnolog&iacute;a Venezuela SITVEN,C.A. " . date("Y") . ".</span>
		</td>
		</tr>
	</table>
	
		</div>
		</body>
		</html>";
        return $CerrarHtm;
    }

    function CerrarHtmRegistro() {
        $CerrarHtm = "
		</td></span></td></tr></table><br>

		<div align='center'>
		<br>
	
	<table width=\"1000\" align='center' border='0'>
		<tr>
		<td align=\"center\" width=\"800\">
		<a href='http://www.sitven.com/'target=_blank''><img src='../imagenes/sitven_poweredby.jpg' width='80px' height='25px' alt='Sitven'/></a>
		</td>
		</tr>		
		<tr>
		<td align=\"center\" width=\"800\">
		<span class='Estiloletrapeq'>Todos los derechos reservados. Soluciones Integrales de Tecnolog&iacute;a Venezuela SITVEN,C.A. " . date("Y") . ".</span>
		</td>
		</tr>
	</table>
	
		</div>
		</body>
		</html>";
        return $CerrarHtm;
    }

    function CerrarHtmtags() {
        $CerrarHtm = "<p>
							<a href='http://validator.w3.org/check?uri=referer'>
								
							</a>
						</p>
						
						 </div>
					</div>
				</body>
			</html>";
        return $CerrarHtm;
    }

}

?>
