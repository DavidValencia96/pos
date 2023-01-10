<?php
include_once '../modelo/Producto.php';
require_once ('../vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\style\Fill;
use PhpOffice\PhpSpreadsheet\style\Border;

$producto=new Producto();
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $concentracion = $_POST['concentracion'];
    $adicional = $_POST['adicional'];
    $precio = $_POST['precio'];
    $laboratorio = $_POST['laboratorio'];
    $tipo = $_POST['tipo'];
    $presentacion = $_POST['presentacion'];
    $avatar='prod_default.jpg';
    $producto->crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar);
}
if($_POST['funcion']=='editar'){
    $id=$_POST['id'];
    $nombre = $_POST['nombre'];
    $concentracion = $_POST['concentracion'];
    $adicional = $_POST['adicional'];
    $precio = $_POST['precio'];
    $laboratorio = $_POST['laboratorio'];
    $tipo = $_POST['tipo'];
    $presentacion = $_POST['presentacion'];
    $producto->editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion);
}
if($_POST['funcion']=='buscar'){
    $producto->buscar();
    $json=array();
    foreach ($producto->objetos as $objeto) {
        $producto->obtener_stock($objeto->id_producto);
        foreach ($producto->objetos as $obje) {
            $total = $obje->total;
        }
        $json[]=array(
            'id'=>$objeto->id_producto,
            'nombre'=>$objeto->nombre,
            'concentracion'=>$objeto->concentracion,
            'adicional'=>$objeto->adicional,
            'precio'=>$objeto->precio,
            'stock'=>$total,
            'laboratorio'=>$objeto->laboratorio,
            'tipo'=>$objeto->tipo,
            'presentacion'=>$objeto->presentacion,
            'laboratorio_id'=>$objeto->prod_lab,
            'tipo_id'=>$objeto->prod_tip_prod,
            'presentacion_id'=>$objeto->prod_present,
            'avatar'=>'../img/prod/'.$objeto->avatar,
            
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='cambiar_avatar'){
    $id=$_POST['id_logo_prod'];
    $avatar=$_POST['avatar'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/prod/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $producto->cambiar_logo($id,$nombre);
            if($avatar!='../img/prod/prod_default.jpg'){
                unlink($avatar);
            }
        $json= array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
        }
    else{
        $json= array();
        $json[]=array(
            'alert'=>'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}
if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $producto->borrar($id);
}
if($_POST['funcion']=='buscar_id'){
    $id=$_POST['id_producto'];
    $producto->buscar_id($id);
    $json=array();
    foreach ($producto->objetos as $objeto) {
        $producto->obtener_stock($objeto->id_producto);
        foreach ($producto->objetos as $obje) {
            $total = $obje->total;
        }
        $json[]=array(
            'id'=>$objeto->id_producto,
            'nombre'=>$objeto->nombre,
            'concentracion'=>$objeto->concentracion,
            'adicional'=>$objeto->adicional,
            'precio'=>$objeto->precio,
            'stock'=>$total,
            'laboratorio'=>$objeto->laboratorio,
            'tipo'=>$objeto->tipo,
            'presentacion'=>$objeto->presentacion,
            'laboratorio_id'=>$objeto->prod_lab,
            'tipo_id'=>$objeto->prod_tip_prod,
            'presentacion_id'=>$objeto->prod_present,
            'avatar'=>'../img/prod/'.$objeto->avatar,
            
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='verificar_stock'){
    $error=0;
    $productos=json_decode($_POST['productos']);
    foreach ($productos as $objeto) {
        $producto->obtener_stock($objeto->id);
        foreach ($producto->objetos as $obj) {
            $total=$obj->total;
        }
        if($total>=$objeto->cantidad && $objeto->cantidad>0){
            $error=$error+0;
        }
        else{
            $error=$error+1;
        }
    }
    echo $error;    
}
if($_POST['funcion']=='traer_productos'){
    $html = "";
    $productos=json_decode($_POST['productos']);
    foreach($producto as $resultado){
        $producto->buscar_id($resultado->id);
        var_dump($producto);
        foreach ($producto->objetos as $objeto) {
            $subtotal=$objeto->precio*$resultado->cantidad;
            $producto->obtener_stock($objeto->id_producto);
            foreach ($producto->objetos as $obj) {
                $stock=$obj->total;
            }
            $html.="
                <tr prodId='$objeto->id_producto''prodPrecio='$objeto->precio'>
                    <td>$objeto->nombre</td>
                    <td>$stock</td>
                    <td class='precio'>$$objeto->precio</td>
                    <td>$objeto->concentracion</td>
                    <td>$objeto->adicional</td>
                    <td>$objeto->laboratorio</td>
                    <td>$objeto->presentacion</td>
                    <td>
                        <input type='number' min='1' class='form-control cantidad_producto' value='$resultado->cantidad'></input>
                    </td>
                    <td class='subtotales'>
                        <h5>$subtotal</h5>
                    </td>
                    <td>
                        <button class='borrar-producto btn btn-danger'><i class='fas fa-times-circle'></i></button>
                    </td>
                </tr>
            ";
        }
        // var_dump($producto);
    }
}
if($_POST['funcion']=='reporte_productos_pdf'){
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d H:i:s');
    $html='
        <header>
            <div>
                <img src="../img/logo.png" width="60px" height="60px">
            <div>
            <h1>Reporte de productos</h1>
            <div id="project">
                <div>
                    <span>Fecha de reporte: </span>'.$fecha.'
                </div>
            </div>
        </header>
        <table>
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Concentración</th>
                    <th>Adicional</th>
                    <th>Laboratorio</th>
                    <th>Presentación</th>
                    <th>Tipo</th>
                    <th>Stock</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                    
            
    '; 
    $producto->reporte_productos();
    $contador=0;
    foreach ($producto->objetos as $objeto) {
        $contador++;
        $producto->obtener_stock($objeto->id_producto);
            foreach ($producto->objetos as $obj) {
                $stock=$obj->total;
            }
    $html.='
                <tr>
                    <td class="servic">'.$contador.'</td>
                    <td class="servic">'.$objeto->id_producto.'</td>
                    <td class="servic">'.$objeto->nombre.'</td>
                    <td class="servic">'.$objeto->concentracion.'</td>
                    <td class="servic">'.$objeto->adicional.'</td>
                    <td class="servic">'.$objeto->laboratorio.'</td>
                    <td class="servic">'.$objeto->presentacion.'</td>
                    <td class="servic">'.$objeto->tipo.'</td>
                    <td class="servic">'.$stock.'</td>
                    <td class="servic">'.$objeto->precio.'</td>
                </tr>
        ';
    }
    $html.='
            </tbody>
        </table>
    ';
    $css = file_get_contents('../css/pdf.css'); //estilo css persalizado
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output('../pdf/prod-'.$_POST['funcion'].'.pdf','F'); //"F" guardar pdf en carpeta interna
}
if($_POST['funcion']=='reporte_productos_excel'){
    $nomber_archivo = 'reporte_productos.xlsx';
    $producto->reporte_productos();
    $contador=0;
    foreach ($producto->objetos as $objeto) {
        $contador++;
        $producto->obtener_stock($objeto->id_producto);
        foreach ($producto->objetos as $obj) {
            $stock=$obj->total;
        }
        $json[]=array(
            'N°'=>$contador,
            'Codigo'=>$objeto->id_producto,
            'Nombre'=>$objeto->nombre,
            'Concentracion'=>$objeto->concentracion,
            'Adicional'=>$objeto->adicional,
            'Laboratorio'=>$objeto->laboratorio,
            'Presentacion'=>$objeto->presentacion,
            'Tipo'=>$objeto->tipo,
            'Stock'=>$stock,
            'Precio'=>$objeto->precio,
        );
    }
    // var_dump($json);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('reporte de productos');
    $sheet->setCellValue('A1','Reporte de productos farmacia (nombre)');
    $sheet->setCellValue('A3','Si las celdas salen en rojo, es por que no hay un stock disponible para ese producto.');
    $sheet->getStyle('A1')->getFont()->setSize(16);
    $sheet->fromArray(array_keys($json[0]),NULL,'A4');
    $sheet->getStyle('A4:J4')->
            getFill()->
            setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->
            getStartColor()->
            setARGB('2D9F39');
    $sheet->getStyle('A4:J4')->
            getFont()->
            getColor()->
            setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
    foreach ($json as $key => $producto) {
        $celda = (int)$key+5;
        if($producto['Stock']==''){
            $sheet->getStyle('A'.$celda.':J'.$celda)->
            getFont()->
            getColor()->
            setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
        }
        $sheet->setCellValue('A'.$celda,$producto['N°']);
        $sheet->setCellValue('B'.$celda,$producto['Codigo']);
        $sheet->setCellValue('C'.$celda,$producto['Nombre']);
        $sheet->setCellValue('D'.$celda,$producto['Concentracion']);
        $sheet->setCellValue('E'.$celda,$producto['Adicional']);
        $sheet->setCellValue('F'.$celda,$producto['Laboratorio']);
        $sheet->setCellValue('G'.$celda,$producto['Presentacion']);
        $sheet->setCellValue('H'.$celda,$producto['Tipo']);
        $sheet->setCellValue('I'.$celda,$producto['Stock']);
        $sheet->setCellValue('J'.$celda,$producto['Precio']);
    }
    foreach (range('B','J') as $col){
        $sheet->getColumnDimension($col)->
                setAutoSize(true);
    }
    $writer = IOFactory::createWriter($spreadsheet,'Xlsx');
    $writer->save('../excel/'.$nomber_archivo);
}

?>