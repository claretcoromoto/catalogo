<?php
#ini_set("error_reporting","E_ALL & ~E_NOTICE");
// Clase Principal.
class classbdConsultas
{
	var $ObjDb="";
	var $orderby, $groupby, $limite;

	function classbdConsultas()
	{
		// Librerias Comunes
		require("../DataBase/classdb.php");
		$this->orderby=array();
		$this->groupby=array();
		$this->limite=array();
	}



	//**********************************************************************************************************************************************//
	//**********************************************************************************************************************************************//
												// Inicio Consultas para la interfax de registro //
	//**********************************************************************************************************************************************//
	//**********************************************************************************************************************************************//




	function InsertarNuevoUsuarioSistema($cedula,$correo,$codigo,$preguntafinal,$respuesta,$fecha_registro,$estaus,$newclave,$codigoactivacion,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tbl_div_usuarios"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['cedula_usuario']=$cedula;
		$campos['correo_usuario']=$correo;
		$campos['preg_seg_usuario']=$preguntafinal;
		$campos['resp_seg_usuario']=$respuesta;
		$campos['fecha_reg_usuario']=$fecha_registro;
		$campos['status_usuario']=$estaus;
		$campos['clave_usuario']=$newclave;
		$campos['codigo_activacion']=$codigoactivacion;
		$campos['intentos_clave']=0;	
		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);		
	}


	function llamarFunccionTransaction($action,$conect="")
	{
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Insertar datos de los Roles
		return $this->ObjDb->ejecutarT($action,$conector);		
	}




	function InsertarNuevoControlClaveRecursivo($iduser,$correo,$estatus_clave,$clave,$numero,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tbl_div_hist_clave"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_usuario']=$iduser;
		$campos['correo_usuario']=$correo;
		//$campos['clave_usuario']=$clave;
		$campos['estatus_clave']=$estatus_clave;	
		$campos['numero_control']=$numero;
		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);		
	}


	function ActualizarControlClave($iduser,$correo,$estatus_clave,$clave,$numero,$conect="")
	{
		// Tabla para hacer la consulta
		$nameTabla='"tbl_div_hist_clave"';
		// Campos para seleccionar
		$campos['clave_usuario']=$clave;
		$campos['estatus_clave']=$estatus_clave;
		// Condicion 
		$condicion['id_usuario']="$iduser";	
		$condicion['correo_usuario']="$correo";
		$condicion['numero_control']="$numero";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
	
	}


		function SelectArchivoSolicitudExistente($idSolic,$conect=""){
		// Nombre de la Tabla
		$nameTablaSel['tblsit_arch_solic']='"tblsit_arch_solic"';
		// Campos para seleccionar
		$camposSel['id_solic']="id_solic";
		// Condicion de la seleccion
		$condicion['id_solic']="'$idSolic'";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
	}




	function InsertarTransSolicitud($idSolic,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_trans_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	    	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;
		$campos['id_trans']=1;
		$campos['id_est_origen']=0;
		$campos['id_est_dest']=5;
		$campos['id_usr_orig']=0;
		$campos['id_usr_dest']=0;
		$campos['fe_ini']=CURRENT_TIMESTAMP;
		$campos['id_status']=0;
		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);		
	}



	function InsertarTransSolicitudEfectivoMayores($idSolic,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_trans_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	    	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;
		$campos['id_trans']=1;
		$campos['id_est_origen']=0;
		$campos['id_est_dest']=1;
		$campos['id_usr_orig']=0;
		$campos['id_usr_dest']=0;
		$campos['fe_ini']=CURRENT_TIMESTAMP;
		$campos['id_status']=0;
		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);		
	}


	function InsertarTransSolicitudTarjetaCredito($idSolic,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_trans_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	    	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();

		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;
		$campos['id_trans']=1;
		$campos['id_est_origen']=0;
		$campos['id_est_dest']=7;
		$campos['id_usr_orig']=0;
		$campos['id_usr_dest']=0;
		$campos['fe_ini']=CURRENT_TIMESTAMP;
		$campos['id_status']=0;
		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);		
	}



	function InsertarTransSolicitudEfectivoMenores($idSolic,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_trans_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	    	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;
		$campos['id_trans']=1;
		$campos['id_est_origen']=0;
		$campos['id_est_dest']=3;
		$campos['id_usr_orig']=0;
		$campos['id_usr_dest']=0;
		$campos['fe_ini']=CURRENT_TIMESTAMP;
		$campos['id_status']=0;
		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);
	}


		function SelectCedulaUsuarioRegistro($cedula,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_usuarios']='"tbl_div_usuarios"';
		// Campos para seleccionar
		$camposSel['cedula_usuario']="cedula_usuario";
		// Condicion de la seleccion
		$condicion['cedula_usuario']="'$cedula'";
		//$condicion['status_usuario']=1;
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
		}






	function InsertarRutaExpedienteCreado($idSolic,$idusuario,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_arch_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	    	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;
		$campos['arch']=1;
		$campos['nb_arch_final']=$idSolic.".pdf";
		$campos['id_usr']=0;
		$campos['fe_hora_ing']=CURRENT_DATE;
		$campos['id_arch_adj']=1;
		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);
	}



	function InsertarSolicitud($idSolic,$monto,$codigoSolicitud,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;
		$campos['id_form']=3;
		$campos['id_tpo_solic']=3;
		$campos['id_solicitante']=$_SESSION['idusuario'];
		$campos['monto_solicitado']=$monto;
		$campos['fe_ing']=CURRENT_TIMESTAMP;
		$campos['in_status']=0;
		$campos['cod_solic']=$codigoSolicitud;
		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);
	}


	function InsertarSolicitudEfectivoMayores($idSolic,$nro_boleto_ida,$emision_boleto_ida,$empresa_transportista_ida,$medio_transporte_ida,$pais_destino,$nro_boleto_vuelta,$emision_boleto_vuelta,$empresa_transportista_vuelta,$medio_transporte_vuelta,$visa,$monto_solicitado,$fecha_ida,$fecha_vuelta,$codigoSeguridad,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;

		$campos['id_form']=1;
		$campos['id_tpo_solic']=1;
		$campos['id_solicitante']=$_SESSION['idusuario'];
		$campos['monto_solicitado']=$monto_solicitado;
		$campos['fe_ing']=CURRENT_TIMESTAMP;
		$campos['in_status']=0;

		$campos['nro_boleto_ida']=$nro_boleto_ida;
		$campos['emision_boleto_ida']=$emision_boleto_ida;
		$campos['empresa_transportista_ida']=$empresa_transportista_ida;
		$campos['medio_tranporte_ida']=$medio_transporte_ida;
		$campos['pais_destino']=$pais_destino;

		$campos['nro_boleto_vuelta']=$nro_boleto_vuelta;
		$campos['emision_boleto_vuelta']=$emision_boleto_vuelta;
		$campos['empresa_transportista_vuelta']=$empresa_transportista_vuelta;
		$campos['medio_transporte_vuelta']=$medio_transporte_vuelta;

		$campos['visa']=$visa;
		$campos['cod_solic']=$codigoSeguridad;
		$campos['fecha_ida']=$fecha_ida;
		$campos['fecha_vuelta']=$fecha_vuelta;

		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);
	}


	function InsertarSolicitudTarjetasCredito($idSolic,$nro_boleto_ida,$emision_boleto_ida,$empresa_transportista_ida,$medio_transporte_ida,$pais_destino,$nro_boleto_vuelta,$emision_boleto_vuelta,$empresa_transportista_vuelta,$medio_transporte_vuelta,$visa,$monto_solicitado,$fecha_ida,$fecha_vuelta,$codigoSeguridad,$fechaDeclara,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;

		$campos['id_form']=4;
		$campos['id_tpo_solic']=4;
		$campos['id_solicitante']=$_SESSION['idusuario'];
		$campos['monto_solicitado']=$monto_solicitado;
		$campos['fe_ing']=CURRENT_TIMESTAMP;
		$campos['in_status']=0;

		$campos['nro_boleto_ida']=$nro_boleto_ida;
		$campos['emision_boleto_ida']=$emision_boleto_ida;
		$campos['empresa_transportista_ida']=$empresa_transportista_ida;
		$campos['medio_tranporte_ida']=$medio_transporte_ida;
		$campos['pais_destino']=$pais_destino;

		$campos['nro_boleto_vuelta']=$nro_boleto_vuelta;
		$campos['emision_boleto_vuelta']=$emision_boleto_vuelta;
		$campos['empresa_transportista_vuelta']=$empresa_transportista_vuelta;
		$campos['medio_transporte_vuelta']=$medio_transporte_vuelta;
		$campos['fecha_limite_declarar']=$fechaDeclara;
		$campos['visa']=$visa;
		$campos['cod_solic']=$codigoSeguridad;
		$campos['fecha_ida']=$fecha_ida;
		$campos['fecha_vuelta']=$fecha_vuelta;

		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);		
	}



	function InsertarSolicitudEfectivoMenores($idSolic,$nro_boleto_ida,$emision_boleto_ida,$empresa_transportista_ida,$medio_transporte_ida,$pais_destino,$nro_boleto_vuelta,$emision_boleto_vuelta,$empresa_transportista_vuelta,$medio_transporte_vuelta,$visa,$monto_solicitado,$fecha_ida,$fecha_vuelta,$codigoSeguridad,$fecha_limite,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;

		$campos['id_form']=2;
		$campos['id_tpo_solic']=2;
		$campos['id_solicitante']=$_SESSION['idusuario'];
		$campos['fe_ing']=CURRENT_TIMESTAMP;
		$campos['in_status']=0;
		$campos['monto_solicitado']=$monto_solicitado;
		$campos['nro_boleto_ida']=$nro_boleto_ida;
		$campos['emision_boleto_ida']=$emision_boleto_ida;
		$campos['empresa_transportista_ida']=$empresa_transportista_ida;
		$campos['medio_tranporte_ida']=$medio_transporte_ida;
		$campos['pais_destino']=$pais_destino;

		$campos['nro_boleto_vuelta']=$nro_boleto_vuelta;
		$campos['emision_boleto_vuelta']=$emision_boleto_vuelta;
		$campos['empresa_transportista_vuelta']=$empresa_transportista_vuelta;
		$campos['medio_transporte_vuelta']=$medio_transporte_vuelta;

		$campos['visa']=$visa;
		$campos['fecha_ida']=$fecha_ida;
		$campos['fecha_vuelta']=$fecha_vuelta;
		$campos['cod_solic']=$codigoSeguridad;
		//$campos['fecha_limite_declara']=$fecha_limite;

		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);
	}


	function InsertarSolicitudEfectivoMenoresDatosMenor($idSolic,$idusuario,$primerApellidoMenor,$segundoApellidoMenor,$primerNombreMenor,$numeroFolio,$segundoNombreMenor,$fechaActa,$cedulaMenor,$numeroPartida,$numeroPasaporteMenor,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tbl_bb_menores_edad"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solic']=$idSolic;
		$campos['id_usuario']=$_SESSION['idusuario'];
		$campos['primer_apellido_adolescente']=$primerApellidoMenor;
		$campos['segundo_apellido_adolescente']=$segundoApellidoMenor;
		$campos['primer_nombre_adolescente']=$primerNombreMenor;
		$campos['segundo_nombre_adolescente']=$segundoNombreMenor;
		$campos['cedula_adolescente']=$cedulaMenor;
		$campos['nro_partida_nacimiento']=$numeroPartida;
		$campos['nro_folio']=$numeroFolio;
		$campos['fecha_acta']=$fechaActa;
		$campos['nro_pasaporte']=$numeroPasaporteMenor;

		// Insertar datos de los Roles
		return $this->ObjDb->fdbInsert($nameTabla,$campos);		
	}



		function ActivarCuentaUsuario($codigoActivacion,$status,$conect=""){
		// Tabla para hacer la consulta
		$nameTabla='"tbl_div_usuarios"';
		// Campos para seleccionar
		$campos['status_usuario']="$status";
		// Condicion 
		$condicion['codigo_activacion']="$codigoActivacion";	
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
	}


		function RecuperarClaveUsuario($correo,$codigoactivacionBD,$newclave,$conect=""){
		// Tabla para hacer la consulta
		$nameTabla='"tbl_div_usuarios"';
		// Campos para seleccionar
		$campos['clave_usuario']="$newclave";
		$campos['codigo_activacion']=2021;
		// Condicion 
		$condicion['codigo_activacion']="$codigoactivacionBD";	
		$condicion['correo_usuario']="$correo";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
		}


		function SelectLoginActivacion($codigoactivacion,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_usuarios']='"tbl_div_usuarios"';
		// Campos para seleccionar
		$camposSel['correo_usuario']="correo_usuario";
		//$camposSel['intentos_clave']="intentos_clave";
		// Condicion de la seleccion
		$condicion['codigo_activacion']="'$codigoactivacion'";
		//$condicion['status_usuario']=1;
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
		}



		function VerificarExisteSolicitud($numeroSolicitud,$conect=""){
		// Nombre de la Tabla
		$nameTablaSel['tblsit_solic']='"tblsit_solic"';
		// Campos para seleccionar
		$camposSel['in_status']="in_status";
		// Condicion de la seleccion
		$condicion['id_solic']="'$numeroSolicitud'";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
		}


		function VerificarEstadoSolicitud($idUsuario,$tpoSolic,$conect=""){
		// Nombre de la Tabla
		$nameTablaSel['tblsit_solic']='"tblsit_solic"';
		// Campos para seleccionar
		$camposSel['id_solic']="id_solic";
		// Condicion de la seleccion
		$condicion='id_solicitante='.$idUsuario.'';
		$condicion.=' AND id_tpo_solic='.$tpoSolic.'';
		$condicion.=' AND in_status not in (0,-1)';
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return  $this->ObjDb->fbdSelectLibre($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);

		}



		function VerificarExistenciaSolicitudOperacionesElectronicas($idUsuario,$tpoSolic,$numSolic,$conect=""){
		// Nombre de la Tabla
		$nameTablaSel['tblsit_solic']='"tblsit_solic"';
		// Campos para seleccionar
		$camposSel['id_solic']="id_solic";

		// Condicion de la seleccion
		$condicion='id_solicitante='.$idUsuario.'';
		$condicion.=' AND id_tpo_solic='.$tpoSolic.'';
		$condicion.=' AND in_status=0';
		//$condicion.=' AND in_status not in (-1,0)';
		$condicion.=' AND id_solic <> '.$numSolic.'';

		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return  $this->ObjDb->fbdSelectLibre($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);

		}
		
		
		function VerificarTransolic($numSolic,$conect=""){
		// Nombre de la Tabla
		$nameTablaSel['tblsit_trans_solic']='"tblsit_trans_solic"';
		// Campos para seleccionar
		$camposSel['id_solic']="id_solic";
		// Condicion de la seleccion
		$condicion.='id_solic='.$numSolic.'';

		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return  $this->ObjDb->fbdSelectLibre($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);

		}


		function SelectControl($iduser,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_usuarios']='"tbl_div_usuarios"';
		// Campos para seleccionar
		$camposSel['control_clave']="control_clave";
		// Condicion de la seleccion
		$condicion['id_usuario']="'$iduser'";
		//$condicion['status_usuario']=1;
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
		}


		function SelectLogin($login,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_usuarios']='"tbl_div_usuarios"';
		// Campos para seleccionar
		$camposSel['correo_usuario']="correo_usuario";
		$camposSel['intentos_clave']="intentos_clave";
		$camposSel['status_usuario']="status_usuario";
		// Condicion de la seleccion
		$condicion['correo_usuario']="'$login'";
		//$condicion['status_usuario']=1;
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
		}


		function SelectClave($contrasena,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_usuarios']='"tbl_div_usuarios"';
		// Campos para seleccionar
		$camposSel['clave_usuario']="clave_usuario";
		// Condicion de la seleccion
		$condicion['clave_usuario']="'$contrasena'";	
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
		}


		function SelectClaveHistorial($iduser,$contrasena,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_hist_clave']='"tbl_div_hist_clave"';
		// Campos para seleccionar
		$camposSel['estatus_clave']="estatus_clave";
		// Condicion de la seleccion
		$condicion['clave_usuario']="'$contrasena'";
		$condicion['id_usuario']="'$iduser'";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
		}



		function SelectTodosDatosUser($login,$contrasena,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_usuarios']='"tbl_div_usuarios"';
		// Campos para seleccionar
		$camposSel['id_usuario']="id_usuario";
		$camposSel['clave_usuario']="clave_usuario";
		$camposSel['correo_usuario']="correo_usuario";
		$camposSel['codigo_activacion']="codigo_activacion";
		$camposSel['cedula_usuario']="cedula_usuario";
		$camposSel['fecha_act_usuario']="fecha_act_usuario";
		// Condicion de la seleccion
		$condicion['correo_usuario']="'$login'";
		$condicion['clave_usuario']="'$contrasena'";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
	}



		function SelectTodosDatosUserObligaCambio($login,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_usuarios']='"tbl_div_usuarios"';
		// Campos para seleccionar
		$camposSel['id_usuario']="id_usuario";
		$camposSel['clave_usuario']="clave_usuario";
		$camposSel['correo_usuario']="correo_usuario";
		$camposSel['codigo_activacion']="codigo_activacion";
		//$camposSel['fecha_cambio_clave']="fecha_cambio_clave";
		// Condicion de la seleccion
		$condicion['correo_usuario']="'$login'";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
	}


		function SelectTodosDatosUserRecuperarId($login,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_usuarios']='"tbl_div_usuarios"';
		// Campos para seleccionar
		$camposSel['id_usuario']="id_usuario";
		// Condicion de la seleccion
		$condicion['correo_usuario']="'$login'";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
	}


		function SelectTodosDatosUserRecuperarContrasena($login,$conect=""){
		// Nombre de la Tabla
		//$tabla=Usuario;
		$nameTablaSel['tbl_div_usuarios']='"tbl_div_usuarios"';
		// Campos para seleccionar
		$camposSel['correo_usuario']="correo_usuario";
		$camposSel['preg_seg_usuario']="preg_seg_usuario";
		$camposSel['resp_seg_usuario']="resp_seg_usuario";
		$camposSel['cedula_usuario']="cedula_usuario";
		$camposSel['codigo_activacion']="codigo_activacion";
		$camposSel['status_usuario']="status_usuario";
		// Condicion de la seleccion
		$condicion['correo_usuario']="'$login'";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Seleccionar el mayor de los datos.
		return $this->ObjDb->fbdSelect($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
	}


		function UpdateClaveUsuario($iduser,$correo,$clave,$fecha_actual,$conect=""){
		// Tabla para hacer la consulta
		$nameTabla='"tbl_div_usuarios"';
		// Campos para seleccionar
		$campos['clave_usuario']="$clave";
		$campos['codigo_activacion']=440;
		// Condicion 
		$condicion['id_usuario']="$iduser";
		$condicion['correo_usuario']="$correo";
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
	}
	
	
		function UpdateControl($iduser,$valor,$fecha_actual,$conect=""){
		// Tabla para hacer la consulta
		$nameTabla='"tbl_div_usuarios"';
		// Campos para seleccionar
		$campos['control_clave']=$valor;
		$campos['fecha_act_usuario']=$fecha_actual;
		// Condicion 
		$condicion['id_usuario']=$iduser;
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
	}


		function UpdateObligatorio($iduser,$conect=""){
		// Tabla para hacer la consulta
		$nameTabla='"tbl_div_usuarios"';
		// Campos para seleccionar
		$campos['codigo_activacion']=0;
		// Condicion 
		$condicion['id_usuario']=$iduser;
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
	}
	


	function UpdateSolicitudEfectivoMenoresDatosMenor($idSolic,$idusuario,$primerApellidoMenor,$segundoApellidoMenor,$primerNombreMenor,$numeroFolio,$segundoNombreMenor,$fechaActa,$cedulaMenor,$numeroPartida,$numeroPasaporteMenor,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tbl_bb_menores_edad"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_usuario']=$_SESSION['idusuario'];
		$campos['primer_apellido_adolescente']=$primerApellidoMenor;
		$campos['segundo_apellido_adolescente']=$segundoApellidoMenor;
		$campos['primer_nombre_adolescente']=$primerNombreMenor;
		$campos['segundo_nombre_adolescente']=$segundoNombreMenor;
		$campos['cedula_adolescente']=$cedulaMenor;
		$campos['nro_partida_nacimiento']=$numeroPartida;
		$campos['nro_folio']=$numeroFolio;
		$campos['fecha_acta']=$fechaActa;
		$campos['nro_pasaporte']=$numeroPasaporteMenor;
		// Condicion 
		$condicion['id_solic']=$idSolic;
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);	
	}










		function UpdateDatosUsuariosSolicitudesEfectivoMayores($primerApellido,$segundoApellido,$primerNombre,$segundoNombre,$estadoCivil,$ciudad,$estado,$telefono,$correo,$pasaporte,$conect="")
		{
		// Tabla para hacer la consulta
		$nameTabla='"tbl_div_usuarios"';
		// Campos para seleccionar
		$campos['primer_apellido_usuario']="$primerApellido";
		$campos['segundo_apellido_usuario']="$segundoApellido";
		$campos['primer_nombre_usuario']="$primerNombre";
		$campos['segundo_nombre_usuario']="$segundoNombre";
		$campos['estado_civil_usuario']="$estadoCivil";
		$campos['ciudad_usuario']="$ciudad";
		$campos['estado_usuario']="$estado";
		$campos['telefono_usuario']="$telefono";
		$campos['correo_cadivi_usuario']="$correo";
		$campos['nro_pasaporte']="$pasaporte";
		// Condicion 
		//$condicion['id_usuario']="$iduser";
		$condicion['correo_usuario']=$_SESSION['login'];
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
	}


function UpdateDatosUsuariosSolicitudesElectronico($primerApellido,$segundoApellido,$primerNombre,$segundoNombre,$estadoCivil,$ciudad,$estado,$telefono,$correo,$conect=""){
		// Tabla para hacer la consulta
		$nameTabla='"tbl_div_usuarios"';
		// Campos para seleccionar
		$campos['primer_apellido_usuario']="$primerApellido";
		$campos['segundo_apellido_usuario']="$segundoApellido";
		$campos['primer_nombre_usuario']="$primerNombre";
		$campos['segundo_nombre_usuario']="$segundoNombre";
		$campos['estado_civil_usuario']="$estadoCivil";
		$campos['ciudad_usuario']="$ciudad";
		$campos['estado_usuario']="$estado";
		$campos['telefono_usuario']="$telefono";
		$campos['correo_cadivi_usuario']="$correo";
		// Condicion 
		//$condicion['id_usuario']="$iduser";
		$condicion['correo_usuario']=$_SESSION['login'];
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
	}

		function UpdateDatosUsuariosSolicitudes($primerApellido,$segundoApellido,$primerNombre,$segundoNombre,$estadoCivil,$ciudad,$estado,$telefono,$correo,$pasaporte,$conect=""){
		// Tabla para hacer la consulta
		$nameTabla='"tbl_div_usuarios"';
		// Campos para seleccionar
		$campos['primer_apellido_usuario']="$primerApellido";
		$campos['segundo_apellido_usuario']="$segundoApellido";
		$campos['primer_nombre_usuario']="$primerNombre";
		$campos['segundo_nombre_usuario']="$segundoNombre";
		$campos['estado_civil_usuario']="$estadoCivil";
		$campos['ciudad_usuario']="$ciudad";
		$campos['estado_usuario']="$estado";
		$campos['telefono_usuario']="$telefono";
		$campos['correo_cadivi_usuario']="$correo";
		$campos['nro_pasaporte']="$pasaporte";
		// Condicion 
		//$condicion['id_usuario']="$iduser";
		$condicion['correo_usuario']=$_SESSION['login'];
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
	}



		function UpdateSolicitudesOperacionesElectronicas($idSolic,$monto,$codigoSolicitud,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['monto_solicitado']=$monto;
		$campos['cod_solic']=$codigoSolicitud;
		//condicion
		$condicion['id_solic']=$idSolic;
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
		}



		function UpdateSolicitudesEfectivoMayores($idSolic,$nro_boleto_ida,$emision_boleto_ida,$empresa_transportista_ida,$medio_transporte_ida,$pais_destino,$nro_boleto_vuelta,$emision_boleto_vuelta,$empresa_transportista_vuelta,$medio_transporte_vuelta,$visa,$monto_solicitado,$fecha_ida,$fecha_vuelta,$codigoSeguridad,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);

		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_form']=1;
		$campos['id_tpo_solic']=1;
		$campos['id_solicitante']=$_SESSION['idusuario'];
		$campos['monto_solicitado']=$monto_solicitado;
		$campos['nro_boleto_ida']=$nro_boleto_ida;
		$campos['emision_boleto_ida']=$emision_boleto_ida;
		$campos['empresa_transportista_ida']=$empresa_transportista_ida;
		$campos['medio_tranporte_ida']=$medio_transporte_ida;
		$campos['pais_destino']=$pais_destino;
		$campos['nro_boleto_vuelta']=$nro_boleto_vuelta;
		$campos['emision_boleto_vuelta']=$emision_boleto_vuelta;
		$campos['empresa_transportista_vuelta']=$empresa_transportista_vuelta;
		$campos['medio_transporte_vuelta']=$medio_transporte_vuelta;
		$campos['visa']=$visa;
		$campos['cod_solic']=$codigoSeguridad;
		$campos['fecha_ida']=$fecha_ida;
		$campos['fecha_vuelta']=$fecha_vuelta;
		//condicion
		$condicion['id_solic']=$idSolic;
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
		}


		function UpdateSolicitudesEfectivoMenores($idSolic,$nro_boleto_ida,$emision_boleto_ida,$empresa_transportista_ida,$medio_transporte_ida,$pais_destino,$nro_boleto_vuelta,$emision_boleto_vuelta,$empresa_transportista_vuelta,$medio_transporte_vuelta,$visa,$monto_solicitado,$fecha_ida,$fecha_vuelta,$codigoSeguridad,$fecha_limite,$conect)
		{

		// Nombre de la Tabla
		$nameTabla='"tblsit_solic"';
		// Llamamos a la funcion de id_maximo
		// Campos para hacer el insert
		$campos['monto_solicitado']=$monto_solicitado;
		$campos['nro_boleto_ida']=$nro_boleto_ida;
		$campos['emision_boleto_ida']=$emision_boleto_ida;
		$campos['empresa_transportista_ida']=$empresa_transportista_ida;
		$campos['medio_tranporte_ida']=$medio_transporte_ida;
		$campos['pais_destino']=$pais_destino;
		$campos['nro_boleto_vuelta']=$nro_boleto_vuelta;
		$campos['emision_boleto_vuelta']=$emision_boleto_vuelta;
		$campos['empresa_transportista_vuelta']=$empresa_transportista_vuelta;
		$campos['medio_transporte_vuelta']=$medio_transporte_vuelta;
		$campos['visa']=$visa;
		$campos['fecha_ida']=$fecha_ida;
		$campos['fecha_vuelta']=$fecha_vuelta;
		$campos['cod_solic']=$codigoSeguridad;
		//condicion
		$condicion['id_solic']=$idSolic;
		// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
		}


		function UpdateSolicitudesTarjetasCreditoViajes($idSolic,$nro_boleto_ida,$emision_boleto_ida,$empresa_transportista_ida,$medio_transporte_ida,$pais_destino,$nro_boleto_vuelta,$emision_boleto_vuelta,$empresa_transportista_vuelta,$medio_transporte_vuelta,$visa,$monto_solicitado,$fecha_ida,$fecha_vuelta,$codigoSeguridad,$fechaDeclara,$conect="")
	{
		// Nombre de la Tabla
		$nameTabla='"tblsit_solic"';
		// Llamamos a la funcion de id_maximo
        	//$id_usuario=$this->fcbcBuscarMaxiUs($conect);
  	   	// Creando el objeto de la base de datos
		$this->ObjDb = new classdb($conect);
		$conector=$this->ObjDb->fdbConectar();
		// Campos para hacer el insert
		$campos['id_solicitante']=$_SESSION['idusuario'];
		$campos['monto_solicitado']=$monto_solicitado;
		$campos['nro_boleto_ida']=$nro_boleto_ida;
		$campos['emision_boleto_ida']=$emision_boleto_ida;
		$campos['empresa_transportista_ida']=$empresa_transportista_ida;
		$campos['medio_tranporte_ida']=$medio_transporte_ida;
		$campos['pais_destino']=$pais_destino;
		$campos['nro_boleto_vuelta']=$nro_boleto_vuelta;
		$campos['emision_boleto_vuelta']=$emision_boleto_vuelta;
		$campos['empresa_transportista_vuelta']=$empresa_transportista_vuelta;
		$campos['medio_transporte_vuelta']=$medio_transporte_vuelta;
		$campos['fecha_limite_declarar']=$fechaDeclara;
		$campos['visa']=$visa;
		$campos['cod_solic']=$codigoSeguridad;
		$campos['fecha_ida']=$fecha_ida;
		$campos['fecha_vuelta']=$fecha_vuelta;
		$condicion['id_solic']=$idSolic;
		// Creando el objeto de la base de datos
		return $this->ObjDb->fdbdUpdate($nameTabla,$campos, $condicion);
		}


		function SelectValidaBinesTarjetasCredito($numero,$conect=""){
        	// Campos para seleccionar
		//$camposSel["* FROM tbl_bb_bines"]="* FROM tbl_bb_bines";
             	$camposSel["numero_bine FROM tbl_bb_bines WHERE numero_bine=".$numero.""]="numero_bine FROM tbl_bb_bines WHERE numero_bine=".$numero."";   	
        	// Condicion de la seleccion
        	// Seleccionar el mayor de los datos.
        	$this->ObjDb = new classdb($conect);
        	$this->ObjDb->fdbConectar();
        	return  $this->ObjDb->fbdSelectFunciones($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite); 
	}



		function selectNumeroSolicitudManejoArchivos($conect=""){
        	// Campos para seleccionar
		$camposSel["nextval ('id_solicitud')"]="nextval ('id_solicitud')";
        	// Condicion de la seleccion
        	// Seleccionar el mayor de los datos.
        	$this->ObjDb = new classdb($conect);
        	$this->ObjDb->fdbConectar();
        	return  $this->ObjDb->fbdSelectFunciones($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite); 
	}




		function selectDiasHabilesViaje($fechaActual,$fechaIda,$conect=""){
        	// Campos para seleccionar
		$camposSel["dias_habiles ('".$fechaIda."','".$fechaActual."')"]="dias_habiles ('".$fechaIda."','".$fechaActual."')";
        	// Condicion de la seleccion
        	// Seleccionar el mayor de los datos.
        	$this->ObjDb = new classdb($conect);
        	$this->ObjDb->fdbConectar();
        	return  $this->ObjDb->fbdSelectFunciones($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite); 
	}



		function selectNumeroSolicitud($Query,$conect=""){
		// Campos para seleccionar
		$camposSel[$Query]=$Query;
		// Condicion de la seleccion
		// Seleccionar el mayor de los datos.
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return  $this->ObjDb->fbdSelectFunciones($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
	}


		function ConsultaListaSolicitudesUsuarios($Query,$conect=""){
		// Campos para seleccionar
		$camposSel[$Query]=$Query;
		// Condicion de la seleccion
		// Seleccionar el mayor de los datos.
		$this->ObjDb = new classdb($conect);
		$this->ObjDb->fdbConectar();
		return  $this->ObjDb->fbdSelectFunciones($nameTablaSel,$camposSel,$condicion,$this->orderby,$this->groupby,$this->limite);
		}



	//**********************************************************************************************************************************************//
	//**********************************************************************************************************************************************//
												// Fin Consultas para la interfax de registro //
	//**********************************************************************************************************************************************//
	//**********************************************************************************************************************************************//	

}
?>