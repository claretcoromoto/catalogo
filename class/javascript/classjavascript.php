<?php
/*
   Tienes como función crear codigo java script general para ser utilizado en cualquier pagina
*/
class classjavascript 
{
   function classjavascript()
   {
   }
   	function ValidarEnvioSugerencia()
	{
		$js="function confirmarEnvio()
			{
				if(document.PaginaSiguiente.SUGERENCIA.value == \"\")
				{
					alert('ERROR: Para enviar la sugerencia debe escribir en el area de escritura.');
				}
				else
				{
					if (confirm(\"¿Esta seguro de enviar la Sugerencia escrita?\")) 
					{
						document.PaginaSiguiente.submit();
						
					}
				}
			}
		";
		return $js;
	}
   function ValidarEncuesta()
   {
   		$js="
   		function Validar()
   		{
   			if(document.PaginaSiguiente.DESDE.value == \"\")
   			{
   				alert('Debe colocar el incio de la encuesta');
   			}
   			else if(document.PaginaSiguiente.HASTA.value == \"\")
   			{
   				alert('Debe colocar el fin de la encuesta');
   			}
   			else if(document.PaginaSiguiente.PREGUNTA.value == \"\")
   			{
   				alert('Debe colocar la pregunta de la encuesta');
   			}
   			else
   			{
	            document.PaginaSiguiente.submit();
	        }
   		}
   		";
   		return $js;
   } 
   function ValidarModulo()
   {
   		$js="
   		function Validar()
   		{
   			if(document.PaginaSiguiente.NOMBRE.value == \"\")
   			{
   				alert('Debe colocar el nombre del modulo');
   			}
   			else
   			{
	            document.PaginaSiguiente.submit();
	         }
   		}
   		";
   		return $js;
   }
   function ValidarTextoSecreto()
   {
   		$js="
   		function ValidarSecreto()
   		{
   			if(document.PaginaSecreta.RESPUESTA.value == \"\")
   			{
   				alert('Debe colocar la respuesta secreta.');
   			}
   			else
   			{
	            document.PaginaSecreta.submit();
	         }
   		}
   		";
   		return $js;
   }
   function ValidarRol()
   {
   		$js="
   		function Validar()
   		{
   			if(document.PaginaSiguiente.NOMBRE.value == \"\")
   			{
   				alert('Debe colocar el nombre del ROL');
   			}
   			else
   			{
	            document.PaginaSiguiente.submit();
	         }
   		}
   		";
   		return $js;
   }
   function ValidarAplicacion()
   {
   		$js="
   		function Validar()
   		{
   			if(document.PaginaSiguiente.NOMBRE.value == \"\")
   			{
   				alert('Debe colocar el nombre de la aplicacion');
   			}
   			else if(document.PaginaSiguiente.VERSION.value == \"\")
   			{
   				alert('Debe colocar la version');
   			}
   			else
   			{
	            document.PaginaSiguiente.submit();
	         }
   		}
   		";
   		return $js;
   }
   function ValidarCampoRespuesta($cedula="")
   {
      $js="
      function ValidarRes(formulario)
      {
         if(formulario.CONTRASENA1.value == \"\")
         {
            alert('Debe colocar una contraseña');
         }
         else if(formulario.CONTRASENA1.value == ".$cedula.")
         {
            alert('La contraseña no puede ser la cédula');
         }
         else if(formulario.CONTRASENA2.value == \"\")
         {
            alert('Debe confirmar la contraseña');
         }
         else if(formulario.CONTRASENA1.value != formulario.CONTRASENA2.value)
         {
            alert('Las contraseñas debes de ser iguales.');
         }
         else if(formulario.RESPUESTA.value == \"\")
         {
            alert('Debe colocar una respuesta a la pregunta secreta.');
         }
         else
         {
            formulario.submit();
         }
      }
      ";
      return $js;
   }
   function Ventana()
   {
      $js="function Ventana() 
      {
         msg=window.open(\"\",\"msg\",\"height=200,width=200,left=80,top=80\");
         msg.document.write(\"<html><title>Windows!</title></html>\");
         //msg.document.write(\"<body bgcolor='white'>\");
         //msg.document.write(\"<center>Contenido de la página</center>\");
         //msg.document.write(\"</body></html><p>\");
      }";
		return $js;
	}
	function fecha()
	{
	   $js="
		function fecha()
		{
			if(( event.keyCode >= 97 && event.keyCode <= 122) || (event.keyCode >=65 && event.keyCode <=90)||(event.keyCode==150))
			{
				event.keyCode=0;
			}
		}";
		return $js;
	}
/*
   FUNCIÓN JAVASCRIPT QUE VERIFICA QUE EL CAMPO DE LA CEDULA ESTE LLENO
   $nom_comp= nombre del campo
   $msm= mensaje de alerta
   $form=nombre del formulario
*/
   function javascrit($form="",$nom_comp="",$msm="")
   {
      $js="function verifica_ced()
      {
         if(document.".$form.".".$nom_comp.".value == \"\")
			{
				alert('".$msm."');
			}
			else
			{
				document.".$form.".submit();
			}
		}";
		return $js;
	}
/*
   FUNCION QUE ADMITE NUMEROS
*/
	function noletrasLabel()
		{
			$js="
				function CheckKeys()
				{
					if(( event.keyCode >= 97 && event.keyCode <= 122) || (event.keyCode >=65 && event.keyCode <=90))
					{
						event.keyCode=0;
					}
			}";
			return $js;
		}
        /*
		FUNCION REDIRECCIONA DESDE PHP
		$pag= es la pagina a donde quiero ir
		*/
		function red($pag="")
		{
			$script=
			" 
				<script language=\"javascript\">
				location.href ='".$pag."'
				</script>

			";
			return $script;
		}
		/*
		FUNCION CIERRA VENTANA
		*/
		function Cerrar($msm=""){
			$script="";
			$script="
			<script language=\"javascript\">
					alert('".$msm."')
					window.close()
				</script>";
			return $script;
		}
		/*
		FUNCION QUE REDIRECIONA 
		$pag= es la pagina a donde quiero ir
		*/
		function redirecciona($pag="")
		{
			$script=
			" 
				location.href ='".$pag."'
			
			";
			return $script;
		}
		/*MUESTRA UN MENSAJE Y SE REDIRECCIONA A OTRA PAGINA
		  $msm=mensaje
		  $pag=pagina para donde se redireccionara
		  RETORNA EL SCRIPT */
		function mensajeRedirecciona($msm="", $pag="")
		{
			$script=
			"<script language=\"javascript\">
				alert('".$msm."')
				location.href ='".$pag."'
			</script>
			";
			return $script;
		}
		/*MUESTRA UN MENSAJE 
		  $msm=mensaje
		  RETORNA EL SCRIPT*/
		function mensaje($msm="")
		{
			$script=
			"<script language=\"javascript\">
				alert('".$msm."')
			</script>
			";
			return $script;
		}
		/*
		MUESTRA UN MENSAJE Y CIERRA LA PAGINA
		$msm=mensaje
		*/
		function mensajeCierra($msm="")
		{
			$script=
			"<script language=\"javascript\">
				alert('".$msm."')
				window.close();
			</script>
			";
			return $script;
		}
        /*
		FUNCIÓN JAVASCRIPT QUE VERIFICA QUE LOS CAMPOS DEL FORMULARIO ESTE LLENO
		*/
		function verificPrioridad()
		{
			$js="function verificar1()
				{
					if((document.servicios.sel_serv.selectedIndex==0)||(document.servicios.prioridad.selectedIndex==0))
					{
							alert('Debes llenar los campos de Servicio y prioridad.')
							return false
					}
					else
					{
						return true
						
					}
				}
			";
			return $js;
		}
        /*
		FUNCIÓN JAVASCRIPT QUE VERIFICA QUE LOS CAMPOS DEL FORMULARIO ESTE LLENO
		*/
		function verificarUbicacion()
		{
			$js="function verificar_ubi()
				{
					if((document.previsualizar_sol.sede.selectedIndex==0)||(document.previsualizar_sol.piso.selectedIndex==0)||(document.previsualizar_sol.dependencia.selectedIndex==0))
					{
							alert('Debes llenar los campos de sede, piso y dependencia.')
							return false
					}
					else
					{
						return true
						
					}
				}
			";
			return $js;
		}
        function eliminar()
		{
			$js="function  verifica_botom(valor)
				{
					document.servicios.validar_botones.value=valor;
					document.servicios.submit()
				}
			";
			return $js;
		}
        function otros()
		{
			$js="function otros()
				{
					var x = document.servicios.sel_serv.options[document.servicios.sel_serv.selectedIndex].value;
					if(x=='SOLICITUD DE CARTUCHO'||x=='SOLICITUD DE CINTA'||x=='SOLICITUD DE TONER')
					{			
							location.href ='http://laboratorio/control_consumible/frm_controlconsumible_medio.php'
					}
					else if(x=='ACTIVACIÓN DE ABREVIADO DE DISCADO'||x=='ACTIVACIÓN DE CLAVE TELEFONICA'||x=='ACTIVACIÓN DE LINEA'||x=='ACTIVACIÓN DE ABREVIADO DE DISCADO'||x=='DESACTIVACIÓN DE LINEA'||x=='DESACTIVACIÓN DE ABREVIADO DE DISCADO'||x=='DESACTIVACIÓN DE CLAVE TELEFONICA'||x=='TRASLADO DE TELÉFONO'||x=='MANTENIMIENTO DE TELÉFONO')
					{
						alert('Recuerde que debe incluir el número telefónico.')
					}
					else if(x=='OTROS')
					{
						document.servicios.txt_otro.disabled = false
					}
                    else if(x=='SOLICITUD DE VIDEO BEAM')
					{
						alert('Recuerde que debe realizar la solicitud con 3 horas de anticipación.')
					}
					else
					{
						document.servicios.txt_otro.disabled = true
					}

				}
			";
			return $js;
		}
		function confirmacion()
		{
			$js="function confirma(msm)
				{
					if (confirm(\"¿Seguro que quieres enviar el formulario ?\")) 
					{
						
						//alert('La solicitud '+msm+' se ha enviado exitosamente.')
						return true;
					}
					else
					{
						return false
					}
				}
			";
			return $js;
		}
		function checkeTecnico()
		{
			$js="function  checke()
				{
					if(document.resumen.vip.checked==false)
					{
					    document.resumen.tecnicos.disabled=true
					}
					else
					{
					    document.resumen.tecnicos.disabled=false
					}
				}
			";
			return $js;
		}
        function verifica_evaluacion()
		{
			$js="function  verifica_evaluacion()
				{
					if(!((document.resumen.boton1[0].checked)||(document.resumen.boton1[1].checked)||(document.resumen.boton1[2].checked)||(document.resumen.boton1[3].checked)))
					{
						alert('Debes ingresar la conformidad de servicio')
						return false
					}
					else if(((document.resumen.boton1[2].checked)||(document.resumen.boton1[3].checked))&&(document.resumen.sugerencias_reclamos.value==''))
					{
						alert('Debes llenar las sugerencias y reclamos')
						return false
					}
                    else
					{
						return true
					}
				}";
			return $js;
		}
        /*
		FUNCIÓN JAVASCRIPT QUE VERIFICA QUE LOS CAMPOS DEL FORMULARIO ESTE LLENOÇ
		CUANDO SE VA A GUARDAR
		*/
		function javascritVerificaGuardar()
		{
			$js="function  verifica_guardar()
				{
					if(document.busqueda.txt_tipo_equipo.value==\"\")
					{
						alert('Debes ingresar el tipo de equipo')
						return false
					}
					if(document.busqueda.txt_Marca.value==\"\")
					{
						alert('Debes ingresar la marca del equipo')
						return false
					}
					if(document.busqueda.txt_Nombre.value==\"\")
					{
						alert('Debes ingresar el nombre del equipo')
						return false
					}
					if(document.busqueda.txt_Serial.value==\"\")
					{
						alert('Debes ingresar el serial del equipo')
						return false
					}
					if(document.busqueda.diagnostico.value==\"\")
					{
						alert('Debes ingresar el diagnostico de la solicitud')
						return false
					}
					if(document.busqueda.acciones.value==\"\")
					{
						alert('Debes ingresar las acciones realizadas en la solicitud')
						return false
					}
					else
					{
						return true
					}
				}
				
				
			";
			return $js;
		}
		function javascriptSolEspera()
		{
		    $js="function  sol_espera()
				{
				    if(document.resumen.raz_sol_espera.value==\"\")
					{ 	
						alert('Debes Llenar las razones por el cual se coloca la solicitud en espera')
						return false
					}
					else
					{
						return true
					}
				}";
			return $js;
		}
		/*
		FUNCIÓN JAVASCRIPT QUE VERIFICA QUE LOS CAMPOS DEL FORMULARIO ESTE LLENOÇ
		CUANDO SE VA A REASIGNAR
		*/
		function javascritVerificaReasignar()
		{
			$js="function  verifica_reasignar()
				{
					if(document.busqueda.txt_tipo_equipo.value==\"\")
					{
						alert('Debes ingresar el tipo de equipo')
						return false
					}
					if(document.busqueda.txt_Marca.value==\"\")
					{
						alert('Debes ingresar la marca del equipo')
						return false
					}
					if(document.busqueda.txt_Nombre.value==\"\")
					{
						alert('Debes ingresar el nombre del equipo')
						return false
					}
					if(document.busqueda.txt_Serial.value==\"\")
					{
						alert('Debes ingresar el serial del equipo')
						return false
					}
					if(document.busqueda.diagnostico.value==\"\")
					{
						alert('Debes ingresar el diagnostico de la solicitud')
						return false
					}
					if(document.busqueda.acciones.value==\"\")
					{
						alert('Debes ingresar las acciones realizadas en la solicitud')
						return false
					}
					if(document.busqueda.area.selectedIndex==0)
					{
						alert('Debes seleccionar el área a reasignar')
						return false
					}
					else
					{
						return true
					}
				}
			";
			return $js;
		}
		function verifica_Reporte()
		{
			$js="function  verifica_Reporte(valor)
				{
					if((document.busqueda.tipoResporte.selectedIndex==0))
					{
						alert('Debes seleccionar el tipo de Reporte')
					}
					else if(((document.busqueda.fechaI.value!=\"\")) && ((document.busqueda.fechaF.value!=\"\")))
					{
					   if((document.busqueda.fechaI.value)>(document.busqueda.fechaF.value))
					   {
					   	alert('La fecha de Inicio debe ser Menor que la Fecha Fin')
					   	document.busqueda.fechaI.value=\"\";
					   	document.busqueda.fechaF.value=\"\";
					   }
					   else
					   {
					      if(valor==1)
      					{
      					   document.busqueda.aux.value=1;
      					}
      					else
      					{
      					   document.busqueda.aux.value=2;
      					}
					      document.busqueda.submit();
					   }
					}
					else
					{
					   if(valor==1)
   					{
   					   document.busqueda.aux.value=1;
   					}
   					else
   					{
   					   document.busqueda.aux.value=2;
   					}
					   document.busqueda.submit();
					}
				}	
				";
				return$js;
		}			
function javascrit_verifica_frm()
		{
			$js="function  verifica_frm()
				{
					if(document.busqueda.cedula.value==\"\")
					{
						alert('Debes ingresar la cédula')
						return false
					}
					if(document.busqueda.nivel.selectedIndex==0)
					{
						alert('Debes seleccionar el nivel del usuario')
						return false
					}
					if((document.busqueda.area.selectedIndex==0)&&(document.busqueda.nivel[0].selectedIndex!=3))
					{
						alert('Debes seleccionar el área del usuario')
						return false
					}
					else
					{
						return true
					}
				}
			";
			return $js;
		}
		function javascrit_desabilitar()
		{
			$js="
		        function desabilitar()
		        {		            
                      if(document.busqueda.nivel[0].selectedIndex==3)
                      {
                        
                            document.busqueda.area.disabled=true
                      }
                      else
                      {
                        document.busqueda.area.disabled=false
                      }
		        }
		        ";
		    return $js;
		}



		function javascrit_validaciones()
		{

			$validaciones="function fanio(anio)  //Funci?n para validar el ingreso del a?o
			{	
				//var resultado = true;
				if (anio.selectedIndex==0){
					alert('Es necesario que introduzca el año');
					anio.focus();
					return false;		
				}
				else{
					return true;
				}
			}
			
			function fmes(mes)  //Funci?n para validar el ingreso del mes
			{	
				if (mes.selectedIndex==0) 
				{
					alert('Es necesario que introduzca el mes');
					mes.focus();
					//return false;		
				}
				else
				{
					return true;
				}
			}
			
			function fquincena(quincena)  //Funci?n para validar el ingreso de la quincena
			{	
				if (quincena.selectedIndex==0) 
				{
					alert('Es necesario que introduzca la quincena');
					quincena.focus();
					return false;		
				}
				else
				{
					return true;
				}
			}
			
			function fsemana(semana)  //Funci?n para validar el ingreso de la semana
			{	
				if (semana.selectedIndex==0) 
				{
					alert('Es necesario que introduzca la semana');
					semana.cboSemana.focus();
					return false;		
				}
				else
				{
					return true;
				}
			
			}
			
			function validarQuincena(formulario) //Funci?n para validar entrada de todos los datos obligatorios cuando el pago es quincenal
			{		
				var anio = fanio(formulario.txtAnio);
				var mess;
				var quincenaa;
				if(anio)
				{
					mess= fmes(formulario.cboMes);
					if(mess)
					{
						quincenaa= fquincena(formulario.cboQuincena);
						if(quincenaa)
						{
							formulario.submit();
						}
					}
				}	
			}
			
			function validarSemana(formulario) //Funci?n para validar entrada de todos los datos obligatorios cuando el pago es semanal
			{	
				var anio = fanio(formulario.txtAnio);
				var mess;
				var semanaa;
				if(anio)
				{
					mess= fmes(formulario.cboMes);
					if(mess)
					{
						semanaa= fsemana(formulario.cboSemana);
						if(semanaa)
						{
							formulario.submit();
						}
					}
				}	
			}
			
			function validarMes(formulario) //Funci?n para validar entrada de todos los datos obligatorios cuando el pago es mensual
			{	
				var anio = fanio(formulario.txtAnio);
				var mess;
				if(anio)
				{
					mess= fmes(formulario.cboMes);
					if(mess)
					{
						formulario.submit();
					}
				}	
			}";
			
			return $validaciones;
		}
			
			
					
}
?>