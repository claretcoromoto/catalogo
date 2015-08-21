<?php require('fpdf.php');

class otraMas extends FPDF {   
    
    function Footer(){ // Pie de página  { 
    //      $this--->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Este es el pie de página creado con el método Footer() de la clase creada PDF que hereda de FPDF','T',0,'C');
    
    }
    
    function Header() //Encabezado
    {
        $this->SetFont('Arial','B',9);
 
        $this->Line(10,10,206,10);
        $this->Line(10,35.5,206,35.5);
 
        $this->Cell(30,25,'',0,0,'C',$this->Image('logoXIAN.jpg', 152,12, 19));
        $this->Cell(111,25,'ALGÚN TÍTULO DE ALGÚN LUGAR <span class="wp-smiley emoji emoji-bigsmile" title=":D">:D</span>',0,0,'C', $this->Image('images/logoIzquierda.png',20,12,20));
        $this->Cell(40,25,'',0,0,'C',$this->Image('images/logoDerecha.png', 175, 12, 19));
 
        $this->Ln(25);
    }
 
    function ImprimirTexto($file)
    {
        // Leemos el archivo de texto
        $txt = file_get_contents($file);
        /*
         * Arial - Fuente
         * '' - cadena vacía significa imrpimir el texto normal o
         *      se puede poner en Negrita 'B', Italico 'I' o Subrayado 'U'
         *      o una combinación de éstos.
         * 12 - tamaño de fuente
         * */
        $this->SetFont('Arial','',12);
        /*
         * 0 - el ancho se ajusta al margen de la hoja
         * 5 - alto de la celda
         * $txt - Texto a imrpimir.
         * NOTA: Los valores para justificar el texto y celda sin borde
         *       no los pasé, porque son valores por defecto del mismo método
         *
         * Pero quedaría así: MutiCell(0, 5, $txt, 0, 'J')
         * No olviden ver y 'jugar' con los parámetros
         **/
        $this->MultiCell(0,5,$txt);
 
    }
 
}//fin clase PDF
 
       // $fecha="México D.F. a ".$_POST['dia']." de ". $_POST['mes']. " de ".$_POST['anio'];
 
        $pdf = new FPDF();             //Crea objeto PDF
        $pdf->AddPage('P', 'Letter'); //Vertical, Carta
 
         $pdf->selectFont('../fonts/courier.afm'); //Arial, negrita, 12 puntos
    //    $pdf->Cell(0,10,$fecha,0,1,'R'); //Agrega la cadena $fecha
 
        /* Se hace un salto de línea
         * y se manda llamar el método de imprimir texto,
         * envíando como parámetro el nombre del archivo
         * que contiene el texto.
        * */
        $pdf->Ln();
        $pdf->ImprimirTexto('textoFijo.txt');
 
        $pdf->Output();               //Salida al navegador
 
?>
