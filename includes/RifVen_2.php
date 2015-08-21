<?php
/**
* Rutina para obtener los datos fiscales desde el portal del seniat
*
* @author José Ayrám <ayramj@gmail.com>
* @category Libs
* @since 06/12/2012
* @version 1.0
*
*/
class RifVen {
    /**
*[code_result] = -2: Formato de rif inválido
* -1: No hay soporte a curl
* 0: No hay conexion a internet
* 1: Consulta satisfactoria
* Otherwise:
* 450: Formato de rif invalido
* 452: Rif no existe
*
* [seniat] = nombre: [CADENA CON EL NOMBRE]
* agenteretensioniva: [SI|NO]
* contribuyenteiva: [SI|NO]
* tasa: [VACIO|ENTERO MONTO TASA]
* @var Array
*/
    private $_responseJson = array(
                'code_result' => '',
                'seniat' => array()
    );
    /**
*
* @var String
*/
    private $_url = 'http://contribuyente.seniat.gob.ve/getContribuyente/getrif?rif=';
    /**
*
* @var String
*/
    private $_rif;
    /**
*
* @param String $rif
*/
    public function __construct($rif) {
        $this->setRif($rif);
    }
    
    /**
* Dar formato inicial al RIF recibido
*
* @param String $rif
* @return String
*/
    private function setRif($rif) {
        $this->_rif =  trim(str_replace('-', '', strtoupper($rif)));
        return $this->_rif;
    }
    
    /**
* Obtener la información en formato Json
*
* @param String $rif
* @return Json
* @throws Exception
*/
    public function getInfo() {
        if ($this->validar()) {
            if(function_exists('curl_init')) {
                $this->_url .= $this->_rif;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $this->_url);
                curl_setopt($ch, CURLOPT_TIMEOUT, 50);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                $result = curl_exec ($ch);

                if ($result) {
                    try {
                        if(substr($result,0,1)!= '<' ) {
                            throw new Exception($result);
                        }

                        $xml = simplexml_load_string($result);

                        if(!is_bool($xml)) {
                            $elements = $xml->children('rif');
                            $seniat = array();
                            $this->_responseJson['code_result'] = 1;

                            foreach($elements as $key => $node) {
                                $index = strtolower($node->getName());
                                $seniat[$index] = (string)$node;
                            }
                            $this->_responseJson['seniat'] = $seniat;
                        }
                    } catch(Exception $e) {
                        $exception = explode(' ', $result, 2);
                        $this->_responseJson['code_result'] =(int) $exception[0];
                      
                     echo $email;
                        if (isset($email) && $rol == 5) {
                           echo "<script language='JavaScript'> alert('Se produjo una exception desde el Seniat' )                 
                                           location.href = './Buscar_Rif_Cliente.php';
                                          exit();                                                          
                                        </script> ";
                    }
                    if (isset($email) && $rol == 1) {

                       echo "<script language='JavaScript'> alert('Se produjo una exception desde el Seniat admin' )                 
                                           location.href = './AdminBuscarRifCliente.php';
                                          exit();                                                          
                                        </script> ";
                    }if (!$rol == 5 || !$rol== 1) {

                       echo "<script language='JavaScript'> alert('Se produjo una exception desde el Seniat' )                 
                                            location.href = './AdminBuscarRifCliente.php';
                                          exit();                                                          
                                        </script> ";
                    } 
                        
                    }
                } else {
                    // No hay conexión a internet
                    $this->_responseJson['code_result'] = 0;
                    
                
                        if (isset($email) && $rol == 5) {
                           echo "<script language='JavaScript'> alert('No hay conexión a Internet' )                 
                                           location.href = './Buscar_Rif_Cliente.php';
                                          exit();                                                          
                                        </script> ";
                    }
                    if (isset($email) && $rol == 1) {

                       echo "<script language='JavaScript'> alert('Se produjo una exception desde el Seniat' )                 
                                           location.href = './AdminBuscarRifCliente.php';
                                          exit();                                                          
                                        </script> ";
                    }if (!$rol == 5 || !$rol== 1) {

                       echo "<script language='JavaScript'> alert('Se produjo una exception desde el Seniat' )                 
                                            location.href = './AdminBuscarRifCliente.php';
                                          exit();                                                          
                                        </script> ";
                    } 
                        
                    }
                
            } else {
                // No hay soporte CURL
                $this->_responseJson['code_result'] = -1;
                 
         
                        if (isset($email) && $rol == 5) {
                           echo "<script language='JavaScript'> alert('No hay soporte CURL' )                 
                                           location.href = './Buscar_Rif_Cliente.php';
                                          exit();                                                          
                                        </script> ";
                    }
                    if (isset($email) && $rol == 1) {

                         echo "<script language='JavaScript'> alert('No hay soporte CURL' )               
                                           location.href = './AdminBuscarRifCliente.php';
                                          exit();                                                          
                                        </script> ";
                    }if (!$rol == 5 || !$rol== 1) {

                        echo "<script language='JavaScript'> alert('No hay soporte CURL' )                
                                            location.href = './AdminBuscarRifCliente.php';
                                          exit();                                                          
                                        </script> ";
                    } 
            }
        } else {
            // Formato de RIF inválido
            $this->_responseJson['code_result'] = -2;
          
       
                        if (isset($email) && $rol == 5) {
                           echo "<script language='JavaScript'> alert('Formato incorrecto' )                 
                                           location.href = './Buscar_Rif_Cliente.php';
                                          exit();                                                          
                                        </script> ";
                    }
                    if (isset($email) && $rol == 1) {

                     echo "<script language='JavaScript'> alert('Formato incorrecto' )                  
                                           location.href = './AdminBuscarRifCliente.php';
                                          exit();                                                          
                                        </script> ";
                    }
                    if (!$rol == 5 || !$rol== 1) {

                       echo "<script language='JavaScript'> alert('Formato incorrecto' )                  
                                            location.href = './AdminBuscarRifCliente.php';
                                          exit();                                                          
                                        </script> ";
                    } 
        }

        return json_encode($this->_responseJson);
    }
    
    /**
* Validar formato del RIF
*
* Basado en el método módulo 11 para el cálculo del dígito verificador
* y aplicando las modificaciones propias ejecutadas por el seniat
* @link http://es.wikipedia.org/wiki/C%C3%B3digo_de_control#C.C3.A1lculo_del_d.C3.ADgito_verificador
*
* @return boolean
*/
    public function validar() {
        $retorno = preg_match("/^([VEJPG]{1})([0-9]{9}$)/", $this->_rif);
        
        if ($retorno) {
            $digitos = str_split($this->_rif);
           
            $digitos[8] *= 2;
            $digitos[7] *= 3;
            $digitos[6] *= 4;
            $digitos[5] *= 5;
            $digitos[4] *= 6;
            $digitos[3] *= 7;
            $digitos[2] *= 2;
            $digitos[1] *= 3;
            
            // Determinar dígito especial según la inicial del RIF
            // Regla introducida por el SENIAT
            switch ($digitos[0]) {
                case 'V':
                    $digitoEspecial = 1;
                    break;
                case 'E':
                    $digitoEspecial = 2;
                    break;
                case 'J':
                    $digitoEspecial = 3;
                    break;
                case 'P':
                    $digitoEspecial = 4;
                    break;
                case 'G':
                    $digitoEspecial = 5;
                    break;
            }
            
            $suma = (array_sum($digitos) - $digitos[9]) + ($digitoEspecial*4);
            $residuo = $suma % 11;
            $resta = 11 - $residuo;
            
            $digitoVerificador = ($resta >= 10) ? 0 : $resta;
            
            if ($digitoVerificador != $digitos[9]) {
                $retorno = false;
            }
        }
        
        
        
        return $retorno;
    }
}