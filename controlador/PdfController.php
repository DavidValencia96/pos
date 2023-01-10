<?php
require_once ('../vendor/autoload.php');
require_once ('../modelo/Pdf.php');

$id_venta = $_POST['id'];
$html = getHtml($id_venta); //Llamamos todos los datos que tenemos en el archivo Pdf.php
$css = file_get_contents('../css/pdf.css'); //estilo css persalizado
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('../pdf/cod-'.$id_venta.'.pdf','F'); //"F" guardar pdf en carpeta interna






?>