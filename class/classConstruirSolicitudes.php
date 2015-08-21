<?php

/////DESCOMENTAR PARA VER LOS ERRORES////
ini_set("error_reporting", "E_ALL & ~E_NOTICE");
$ObjConstruirXML = new classConstruirSolicitudes();

class classConstruirSolicitudes {

    function classConstruirSolicitud() {
        //Librerias para manejar PDFs
        require_once('../fpdf-1-6-es/fpdf.php');
        require_once('../FPDI-1.4.1/fpdi.php');
        // Librerias Comunes
        require("../class/classlibCabPie.php");
        require("../class/classDetectarNavegador.php");
        // Libreria de bd
        require("../class/bd/classbdConsultas.php");
        // Clase Other
        require("../class/javascript/classjavascript.php");
        // Clase Interfaz
        require("../class/interfaz/class_html.php");
        require("../Librerias/classlibSession.php");
        $this->ObjSesion = new classlibSession();
        $this->Objnavegador = new detectarnavegador();
        $this->ObjConsulta = new classbdConsultas();
        $navegador = $this->Objnavegador->FUNC_brouserUsr();

        //Crear el archivo XML de la solicitud
        $Retorno = true;
        global $errDoc;
        global $objDoc;
        global $strDoc;

        $this->cargarPagina($navegador);
    }

    function dameASCII($texto) { //ASCII
        $tmp = "";
        for ($i = 0; $i < strlen($texto); $i++)
            $tmp.=ord(substr($texto, $i, 1)) . "+";
        return $tmp;
    }

    function damecaracter($texto1) {
        $temporal = "";
        $data = "";
        for ($i = 0; $i <= strlen($texto1); $i++) {
            if ((substr($texto1, $i, 1)) != "+")
                $temporal.=substr($texto1, $i, 1);
            else {
                $data.=chr($temporal);
                $temporal = "";
            }
        }
        return $data;
    }

    function CompletarNroSolic($NroSolic) {
        //Completa el numero de la solicitud al formato 00000001	
        $Numero = strlen($NroSolic);
        $Retorno = substr("000000000", $Numero) . $NroSolic;
        return($Retorno);
        //echo $Retorno;
    }

    function CrearSolicitud($NroSolic, $NroEsta) {
        $NroSolic = "23432234";
        $dato1 = $this->dameASCII($NroSolic);
        $strDoc = "<?xml version='1.0' encoding='ISO-8859-1'?><DOC><ID>" . $dato1 . "</ID><CMPS></CMPS></DOC>";

        echo "<br>----------------->";
        $strDoc;
        $valor2222 = $this->CompletarNroSolic($NroSolic);
        $doc = fopen("../DOC/" . $valor2222 . ".xml", "a+"); //Abrimos el archivo
        //echo "completar-> ".$this->CompletarNroSolic($NroSolic);
        chmod("../DOC/" . $this->CompletarNroSolic($NroSolic) . ".xml", 0777);

        if (!$doc) {
            $errDoc = "DOC-00003";
            echo("Error al crear el documento de la solicitud");
            $Retorno = false;
        } else {

            fwrite($doc, $strDoc);
            fclose($doc);


            $strSQL = "'sp_sit_crear_solicitud ('$NroSolic', '0', '$NroEsta')'";
            echo "no dio error", $strSQL;

            $ObjSolic = $this->ObjConsulta->selectNumeroSolicitud($strSQL, "../DataBase/archi_conex/CX_APLI0000_SIS_V10");

            //Conectar();
            //$strSQL="SELECT sp_sit_crear_solicitud ('$NroSolic', ".$_SESSION['idusuario'].", '$NroEsta')";
            //ejecutar($strSQL);
            //Desconectar();
        }

        return($Retorno);
    }

    function AbrirSolicitud($NroSolic) {

        echo "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
        $Retorno = true;
        global $strDoc;
        global $errDoc;
        global $objDoc;

        if (!is_numeric($NroSolic) || intval($NroSolic) == 0) {
            $Retorno = false;
            $errDoc = "DOC-00001";
        } else {
            $nDoc = $this->CompletarNroSolic($NroSolic);
            if ($nDoc != "000000000") {
                $archivo = $nDoc . ".xml";
                $strDoc = realpath("DOC/" . $archivo);
                //echo $strDoc;
                $this->Traza('GENERAL', "Direccion del archivo: " . $strDoc, 'PAG');
                $objDoc = simplexml_load_file($strDoc) or die('No puedo ser abierto el archivo de la solicitud');
                $tiempoini = date(Hms);


                if (!$objDoc) {
                    /* if()
                      $errForm="DOC-00006";
                      else
                      $errForm="DOC-00002"; */

                    $Retorno = false;
                } else {
                    $tiempofin = date(Hms);
                    $resta = $tiempofin - $tiempoini;
                    $tiempo = intval($resta);

                    $this->Traza('GENERAL', "N�mero de Solicitud abierto: " . $NroSolic . "Tiempo de su apertura: " . $tiempo, 'PAG');

                    /* $strSQL="Select sp_sit_abrir_solic(".$NroSolic.")";
                      $resultado= ejecutar($strSQL);

                      if(ExistenAccCargar())
                      ProcesarAccCargar(); */

                    $Retorno = true;
                }
            } else {
                $Retorno = false;
            }
        }
        return($Retorno);
    }

    function GuardarValorCampo($NombreCampo, $Valor, $NroTrans, $Fila, $Col) {
        global $objDoc;
        global $strDoc;
        $nTrans = intval($NroTrans);
        //$Valor=utf8_encode($Valor);
        $hayCMP = count($objDoc->xpath("//CMPS/CMP"));
        if ($hayCMP > 0) { //no hay una etiqueta de campo a�n	
            if (count($objDoc->xpath("//CMPS/CMP[@NB='" . $NombreCampo . "']")) > 0) {//Campo existente//El campo existe y hay que agregarle el valor recibido
                //echo "si existe el campo en xml";
                if (intval($Fila) == 0) {
                    $TipoC = $this->TipoCampo($NombreCampo, 0);
                    if ($TipoC != 'LM' || $TipoC != 'CH')
                        $Valor = $this->dameASCII($Valor);
                    $this->GuardarVal($NombreCampo, $Valor, $nTrans);
                }
                else {//es de una matriz
                    if (count($objDoc->xpath("//CMPS/CMP[@NB='" . $NombreCampo . "']/FILA[@NUMERO='" . $Fila . "']")) > 0) {//Fila existente
                        if (count($objDoc->xpath("//CMPS/CMP[@NB='" . $NombreCampo . "']/FILA[@NUMERO='" . $Fila . "']/COLUMNA[@NUMERO='" . $Col . "']")) > 0) {//EXISTE EL CAMPO(COLUMNA) AGREGAR EL DATO
                            //echo "existe el campo";
                            $TipoC = $this->TipoCampo($NombreCampo, $Col);
                            if ($TipoC != 'LM' || $TipoC != 'CH')
                                $Valor = $this->dameASCII($Valor);
                            $this->GuardarValM($NombreCampo, $Fila, $Col, $Valor, $nTrans);
                        }
                        else {
                            $this->CrearColumna($NombreCampo, $Fila, $Col, $Valor, $nTrans);
                        }
                    } else {//CREAR DESDE LA FILA PORQ NO EXISTE
                        //echo "entro creacion de fila";
                        //$Valor=dameASCII($Valor);
                        $cmp = $objDoc->CMPS;
                        foreach ($cmp->CMP as $nodo) {
                            if ($nodo->attributes()->NB == $NombreCampo) {
                                $AgrFila = $nodo->addChild('FILA');
                                $AgrFila->addAttribute('NUMERO', $Fila);
                                $nuevoV = $AgrFila->addChild('COLUMNA');
                                $nuevoV->addAttribute('NUMERO', $Col);
                                $valor = $nuevoV->addChild('VAL', $this->dameASCII($Valor));
                                $valor->addAttribute('NT', $nTrans);
                                $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic
                                break;
                            }
                        }
                    }
                }
            } else {
                if (intval($Fila) == 0) {
                    $cmp = $objDoc->CMPS->addChild('CMP');
                    $cmp->addAttribute('NB', $NombreCampo);
                    $TipoC = $this->TipoCampo($NombreCampo, 0);
                    if ($TipoC != 'LM' || $TipoC != 'CH')
                        $Valor = $this->dameASCII($Valor);
                    $valor = $cmp->addChild('VAL', $Valor);
                    //$valor->createCDATASection($Valor);
                    $valor->addAttribute('NT', $NroTrans);
                    $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic
                }
                else {//es un campo matriz
                    $cmp = $objDoc->CMPS->addChild('CMP');
                    $cmp->addAttribute('NB', $NombreCampo);
                    $AgrFila = $cmp->addChild('FILA');
                    $AgrFila->addAttribute('NUMERO', $Fila);
                    $AgrColumna = $AgrFila->addChild('COLUMNA');
                    $AgrColumna->addAttribute('NUMERO', $Col);
                    $TipoC = $this->TipoCampo($NombreCampo, $Col);
                    if ($TipoC != 'LM' || $TipoC != 'CH')
                        $Valor = $this->dameASCII($Valor);
                    $AgrTrans = $AgrColumna->addChild('VAL', $Valor);
                    $AgrTrans->addAttribute('NT', $nTrans);
                    $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic
                }
            }
        }
        else {//No hay campo a�n
            if (intval($Fila) == 0) {
                $cmp = $objDoc->CMPS->addChild('CMP');
                $cmp->addAttribute('NB', $NombreCampo);
                $TipoC = $this->TipoCampo($NombreCampo, 0);
                if ($TipoC != 'LM' || $TipoC != 'CH')
                    $Valor = $this->dameASCII($Valor);
                $valor = $cmp->addChild('VAL', $Valor);
                $valor->addAttribute('NT', $NroTrans);
                $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic
            }
            else {//es un campo matriz
                $cmp = $objDoc->CMPS->addChild('CMP');
                $cmp->addAttribute('NB', $NombreCampo);
                $AgrFila = $cmp->addChild('FILA');
                $AgrFila->addAttribute('NUMERO', $Fila);
                $AgrColumna = $AgrFila->addChild('COLUMNA');
                $AgrColumna->addAttribute('NUMERO', $Col);
                $TipoC = $this->TipoCampo($NombreCampo, $Col);
                if ($TipoC != 'LM' || $TipoC != 'CH')
                    $Valor = $this->dameASCII($Valor);
                $AgrTrans = $AgrColumna->addChild('VAL', $Valor);
                $AgrTrans->addAttribute('NT', $nTrans);
                $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic
            }
        }
    }

    function GuardarValM($objCmp, $FilaC, $Col, $Valor, $nTrans) {//Para modificar o agregar el valor de un campo de matriz
        global $objDoc;
        global $strDoc;
        global $NroTrans;
        //$Valor=utf8_encode($Valor);
        //$Valor=dameASCII($Valor);
        //VERIFICAR SI EXISTE LA TRANSACCION	
        if (count($objDoc->xpath("//CMPS/CMP[@NB='" . $objCmp . "']/FILA[@NUMERO='" . $FilaC . "']/COLUMNA[@NUMERO='" . $Col . "']/VAL[@NT='" . $NroTrans . "']")) > 0) {
            $cmp = $objDoc->CMPS;
            foreach ($cmp->CMP as $nodo) {
                if ($nodo->attributes()->NB == $objCmp) {
                    foreach ($nodo->FILA as $fila) {
                        //echo $tran->attributes()->NT;
                        if ($fila->attributes()->NUMERO == $FilaC) {
                            foreach ($fila->COLUMNA as $Columna) {
                                if ($Columna->attributes()->NUMERO == $Col) {
                                    foreach ($Columna->VAL as $Val) {
                                        if ($Val->attributes()->NT == $NroTrans) {
                                            $Val[0] = $Valor;
                                            $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else { //NO EXISTE EL transaccion, SE DEBE CREAR EL val DE LA TRANSACCION
            $cmp = $objDoc->CMPS;
            foreach ($cmp->CMP as $nodo) {
                if ($nodo->attributes()->NB == $objCmp) {
                    foreach ($nodo->FILA as $fila) {
                        //echo $tran->attributes()->NT;
                        if ($fila->attributes()->NUMERO == $FilaC) {
                            foreach ($fila->COLUMNA as $Columna) {
                                if ($Columna->attributes()->NUMERO == $Col) {
                                    $nuevoV = $Columna->addChild('VAL', $Valor);
                                    $nuevoV->addAttribute('NT', $nTrans);
                                    $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function GuardarVal($objCmp, $Valor, $nTrans) {
        global $objDoc;
        global $strDoc;
        //echo 	$Valor;	
        if (count($objDoc->xpath("//CMPS/CMP[@NB='" . $objCmp . "']/VAL[@NT='" . $nTrans . "']")) > 0) {
            $cmp = $objDoc->CMPS;
            foreach ($cmp->CMP as $nodo) {
                if ($nodo->attributes()->NB == $objCmp) {
                    //$trans=$cmp->VAL;
                    foreach ($nodo->VAL as $tran) {
                        //echo $tran->attributes()->NT;
                        if ($tran->attributes()->NT == $nTrans) {
                            //echo $Valor;						
                            $tran[0] = $Valor;
                            $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic          chtml_entity_decode
                            break;
                        }
                    }
                }
            }
            //echo "ya existe la transaccion";
        } else {
            $cmp = $objDoc->CMPS;
            foreach ($cmp->CMP as $nodo) {
                //echo $nodo->attributes()->NB;
                if ($nodo->attributes()->NB == $objCmp) {
                    //echo "entro";		
                    $nuevoV = $nodo->addChild('VAL', $Valor);
                    $nuevoV->addAttribute('NT', $nTrans);
                    $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic
                    break;
                }
            }
            //echo "no existe la transaccion";	
        }
    }

    function TipoCampo($NbCampo, $Col) {
        if ($NbCampo == "RECAUDO_PROMOTOR" || $NbCampo == "RECAUDO_CONTROL")
            $Tipo = "CH";
        else
            $Tipo = "T";

        return($Tipo);
    }

    function CrearColumna($objCmp, $FilaC, $Col, $Valor, $nTrans) {//CREAR UNA COLUMNA EN UN CAMPO MATRIZ DENTRO DEL XML DE LA SOLICITUD
        global $objDoc;
        global $strDoc;
        $cmp = $objDoc->CMPS;
        $Valor = $this->dameASCII($Valor);
        foreach ($cmp->CMP as $nodo) {
            if ($nodo->attributes()->NB == $objCmp) {
                foreach ($nodo->FILA as $fila) {
                    //echo $tran->attributes()->NT;
                    if ($fila->attributes()->NUMERO == $FilaC) {
                        $nuevoV = $fila->addChild('COLUMNA');
                        $nuevoV->addAttribute('NUMERO', $Col);
                        $valor = $nuevoV->addChild('VAL', $Valor);
                        $valor->addAttribute('NT', $nTrans);
                        $objDoc->asXML($strDoc); //guardar los cambios en el documento de la solic
                        break;
                    }
                }
            }
        }
    }

}
?>	


