<?php

require_once('class.ezpdf.php');
require '../includes/ConexionPGSQL.php';
error_reporting(0);

//Validamos la conexion al servidor
if (isset($_GET['id'])) {
    $id = trim(htmlentities(strip_tags($_GET['id'])));
    //Escogemos la base de datos sobre la cual queremos trabajar
    $sql = "   SELECT U.razon_social_cliente, 
                   R.id_rol_usr, 
                   P.id_pedido, P.fe_registro, P.ci_rif_cliente,  P.tx_forma_pago, P.nu_sub_total,
                   D.cod_repuesto, nu_precio, in_cantidad,
                   E.nb_tpo_entrega,
                   S.nb_status_pedido,
                   Re.tx_descripcion
                           FROM 
                                      tblxian_status_pedido S
                           INNER JOIN tblxian_pedido P
                           ON          ( S.id_status_pedido =  P.id_status_pedido )
                           INNER JOIN tblxian_tpo_entrega E
                           ON       ( P.id_tpo_entrega =  E.id_tpo_entrega)
                           INNER JOIN tblxian_detalle_pedido D
                           ON       ( P.id_pedido = D.id_pedido)
                           INNER JOIN   tblsit_usr U  
                           ON       ( P.id_usr = U.id_usr)
                           INNER JOIN   tblsit_rol_usr R
                           ON       ( U.id_rol_usr = R.id_rol_usr)
                           INNER JOIN tblxian_repuesto Re
                           ON          ( D.cod_repuesto = Re.cod_repuesto )
                   WHERE  P.id_pedido=" . $id . "                   

                       GROUP BY 
                    U.razon_social_cliente,
                   R.id_rol_usr, 
                   P.id_pedido, P.fe_registro, P.ci_rif_cliente,   P.tx_forma_pago, P.nu_sub_total,
                   D.id_detalle_pedido, D.cod_repuesto, 
                   E.nb_tpo_entrega,
                   S.id_status_pedido, S.nb_status_pedido, Re.tx_descripcion
                    ORDER BY  P.id_pedido DESC";

////Ejecutamos la consulta que queremos
    $result = @pg_query($sql); //Validamos que la consulta tenga datos en su respuesta
    $row = pg_num_rows($result);
    if (isset($row) === 0) {
        echo "<script language='JavaScript'> alert('Comun\u00edquese con su vendedor de confianza') 
                          location.href = '../formConsultarPedidoClienteId.php';  exit();
                            </script> ";
    } else {
        //Recorremos el recordset
        $ixx = 0;
        $totalImporte = 0;
        while ($datos = pg_fetch_assoc($result)) {

           
            $ixx = $ixx + 1;
            $can= number_format($datos['nu_precio'],'2',',','.');
            $data[$ixx] = array('num' => $ixx,
                'cod_repuesto' => $datos['cod_repuesto'],
                'tx_descripcion' => $datos['tx_descripcion'],
                'in_cantidad' =>$datos['in_cantidad'],
                'nu_precio' =>$can
            );

            $totalImporte = $totalImporte + $datos['nu_precio'];
            $subtotal = $totalImporte;
            $razon = utf8_decode($datos['razon_social_cliente']);
            $rif = $datos['ci_rif_cliente'];
            $factura = $datos['id_pedido'];
            $sql = "SELECT razon_social_cliente   FROM tblsit_usr WHERE ci_rif_cliente = '" . $rif . "'";
            $rifclie = @pg_query($sql);
            $filerifclie = @pg_fetch_array($rifclie);
            $datapedido = array(array(//$fecha11 = date("Y-m-d", strtotime($fecha1));
                    'fe_registro' => date("d-m-Y", strtotime($datos['fe_registro'])),
                    'tx_forma_pago' => strtoupper(utf8_decode($datos['tx_forma_pago'])),
                    'nb_tpo_entrega' => strtoupper(utf8_decode($datos['nb_tpo_entrega'])),
                    'razon_social_cliente' => strtoupper(utf8_decode($datos['razon_social_cliente']))
            ));
        }



        $sql = "SELECT iva FROM tblxian_cond_vta ORDER BY id_cond_venta DESC LIMIT 1";
        $ivactual = @pg_query($sql);
        $ivavig = @pg_fetch_array($ivactual);


        $titles = array('fe_registro' => '<b>FECHA DEL PEDIDO</b>',
            'tx_forma_pago' => '<b>FORMA DE PAGO</b>',
            'nb_tpo_entrega' => '<b>ENTREGA</b>',
            'razon_social_cliente' => '<b>REALIZADO POR</b>');


        $datacreator = array(
            'Title' => 'Importadora Xian, C.A.',
            'Subject' => 'Documento de pedidos de repuestos',
            'Author' => 'http://www.sitven.com',
            'Producer' => 'http://www.sitven.com'
        );


        $options = array('shadeCol' => array(0.9, 0.9, 0.9),
            'xOrientation' => 'center',
            'width' => 520,
            'fontSize' => 12, //Tamaño texto: fontSize = 12;
            'shaded' => 2, //Mostrar lineas sombreadas: shaded = 1 o 0;
            'titleFontSize' => 12, //Text Cabeceras: titleFontSize = 12;
            'showHeadings' => 1, //Mostrar las cabeceras: showHeadings = 1 o 0;
            'rowGap' => 5, //Padding celdas fila/col 'rowGap' => 3; 'colGap' => 3;
            'colGap' => 3,
            'showlines' => 1, //Mostrar las lineas: 'showlines' => 1 o 0;
            'textCol' => array(0, 0, 0)); //Color del texto: 'textCol' => array(1,0,0);

        $opcions = array('shadeCol' => array(242, 242, 242),
            'yOrientation' => 'rigth',
            'width' => 700,
            'fontSize' => 12, //Tamaño texto: fontSize = 12;
            'shaded' => 2, //Mostrar lineas sombreadas: shaded = 1 o 0;
            'shadeCol' => array(139, 35, 35),
            'shadeCol2' => array(0.7, 0.7, 0.7),
            'titleFontSize' => 5, //Text Cabeceras: titleFontSize = 12;
            'showHeadings' => 1, //Mostrar las cabeceras: showHeadings = 1 o 0;
            'showlines' => 1, //Mostrar las lineas: 'showlines' => 1 o 0;
            'textCol' => array(0, 0, 128)); //Color del texto: 'textCol' => array(1,0,0);

        $op = array(
            'shadeCol' => array(3, 0.9, 0.9),
            'xOrientation' => 'center',
            'width' => 500
        );

        $titlesd = array('num' => utf8_decode('<b>ÍTEM</b>'),
            'cod_repuesto' => utf8_decode('<b>CÓDIGO</b>'),
            'tx_descripcion' => utf8_decode('<b>DESCRIPCIÓN</b>'),
            'in_cantidad' => '<b>CANTIDAD</b>',
            'nu_precio' => '<b>PRECIO</b>');


        $optotal = array(
            'shadeRow' => array(0.9, 0.9, 0.9),
            'yOrientation' => 'center',
            'width' => 280,
            'cols' => array(
                'concepto' => array('justification' => 'left', 'width' => 200),
                'total' => array('justification' => 'left', 'width' => 80)
            )
        );
        $opciones = array('shadeCol' => array(0.6, 0.4, 0.2),
            'yOrientation' => 'rigth',
            'width' => 520,
            'fontSize' => 9, //Tamaño texto: fontSize = 12;
            'shaded' => 2, //Mostrar lineas sombreadas: shaded = 1 o 0;
            'shadeCol' => array(139, 35, 35),
            'shadeCol2' => array(0.7, 0.7, 0.7),
            'titleFontSize' => 9, //Text Cabeceras: titleFontSize = 12;
            'showHeadings' => 1, //Mostrar las cabeceras: showHeadings = 1 o 0;
            'showlines' => 1, //Mostrar las lineas: 'showlines' => 1 o 0;
            'textCol' => array(0, 0, 128)); //Color del texto: 'textCol' => array(1,0,0);
        $txtrifclie = $filerifclie['razon_social_cliente'];
        $r = utf8_decode($txtrifclie);
        $txtiva = $ivavig['iva'];
        $saldoiva = ($subtotal * ($txtiva / 100));
        $total = $subtotal + $saldoiva;
        $subtotal = number_format($subtotal, 2, ',', '.');
        $table = array(
            array("SUBTOTAL" => "I.V.A.  " . $txtiva . '  %', "$subtotal" => number_format($saldoiva, 2, ',', '.')),
            array("SUBTOTAL" => "TOTAL", "$subtotal" => number_format($total, 2, ',', '.'))
        );


        $txttit = utf8_decode("<b>DESCRIPCIÓN DETALLADA DEL PEDIDO</b>\n");
        $txttit1 = "<b>IMPORTADORA XIAN, C.A.</b>"; //Av. Boulevar Naiguatá, E/S Tanaguarena Caribe Caraballeda, Edo. Vargas – Venezuela
        $txttit2 = "<b>Av. Boulevar Naiguatá, E/S Tanaguarena Caribe Caraballeda</b>\n";
        $txttit2.= "<b>Edo. Vargas. Venezuela</b>\n";
        $t = utf8_decode($txttit2);
        $txttit3 = "<b>RIF: <u>$rif</u></b>\n";
        $txttit3.= utf8_decode("<b>RAZÓN SOCIAL:   <u> $r</u></b>\n");
        $txttit4 = "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
        $txttit4.= utf8_decode("<b>N° DE PEDIDO: $factura</b>\n");
        $txttit5 = utf8_decode("<b>VENDEDOR: $razon</b>\n");
        $pdf = new Cezpdf('LETTER'); //escogemos el tipo de hoja y la ponemos horizontal
        $pdf->selectFont('../fonts/courier.afm');
        $pdf->ezSetCmMargins(1, 1, 2, 1);

        $pdf->ezimage("logoXIAN.jpg", 0, 170, 'none', 'left'); //ezImage(image,[padding],[width],[resize],[justification])



        $pdf->ezText($txttit1, 14, 'full');
        $pdf->ezText("\n\t", 12);
        $pdf->ezText("<b>FECHA:</b> " . date("d/m/Y"), 10);
        $pdf->ezText("<b>HORA:</b> " . date("H:i:s") . "\n", 10);
        $pdf->ezText($txttit4, 12);
        $pdf->ezText($txttit3, 12);
        $pdf->addInfo($datacreator);



        $pdf->selectFont('../fonts/Helvetica');

        $pdf->ezTable($datapedido, $titles, '', $opciones);


        $pdf->ezText("\n", 10, 'center');

        $pdf->ezText($txttit, 12, 'center');
        $pdf->ezTable($data, $titlesd, '', $opciones);         //aquí se construye la tabla
        $pdf->ezText("\n\n\n", 6, 'rigth');

        unset($opciones);
        $pdf->ezTable($table, 'T', '', array('showHeadings' => 1, 'xOrientation' => 'center', 'shaded' => 1, 'xPos' => 'right'
            , 'xOrientation' => 'left', 'width' => 230));        //aquí se construye la tabla
        $pdf->ezText("\n\n\n", 10, 'rigth');
        $pdf->setStrokeColor(0, 0, 0);

        //$pdf->ezTable($table);
        function puntos_cm($medida, $resolucion = 72) {
            //// 2.54 cm / pulgada
            return ($medida / (2.54)) * $resolucion;
        }

        $pdf->line(puntos_cm(2), puntos_cm(5), puntos_cm(20), puntos_cm(5));
// esto en teoría debería estar fijo, a esta altura de la página, CURSOR
        $pdf->ezText("\n\n\n\n\n\n\n\n\n\n\n", 10, 'rigth');
        $pdf->addText(puntos_cm(2), puntos_cm(4), 12, $t);
        $pdf->ezSetY(puntos_cm(3));

        //ob_end_clean();
        $pdf->ezStream();
        //$pdf->ezOutput();
    }
}
?>