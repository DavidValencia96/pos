$(document).ready(function(){
    mostrar_consultas();
    function mostrar_consultas(){
        let funcion='mostrar_consultas';
        $.post('../controlador/VentaController.php',{funcion},(response)=>{
            //console.log(response);
            const vistas = JSON.parse(response);
            $('#venta_dia_vendedor').html(vistas.venta_dia_vendedor);
            $('#venta_diaria').html(vistas.venta_diaria);
            $('#venta_mensual').html(vistas.venta_mensual);
            $('#venta_anual').html(vistas.venta_anual);
        })
    }
    let funcion="listar";
    let datatable = $('#tabla_venta').DataTable({
        "ajax":{
            "url": "../controlador/VentaController.php",
            "method": "POST",
            "data": {funcion:funcion}
        },
        "columns": [
            { "data": "id_venta" },
            { "data": "fecha" },
            { "data": "cliente" },
            { "data": "dni" },
            { "data": "total" },
            { "data": "vendedor" },
            { "defaultContent":`<button class="imprimir btn btn-secondary"><i class="fas fa-print"> </i>  </button>
                                <button class="ver btn btn-success" type="button" data-toggle="modal" data-target="#vista_venta"><i class="fas fa-search"> </i></button>
                                <button class="borrar btn btn-danger"><i class="fas fa-window-close"> </i>  </button>` }
        ],
        "language": espanol
    });
    $('#tabla_venta tbody').on('click','.imprimir',function(){
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        $.post('../controlador/PdfController.php',{id},(response)=>{
            console.log(response);
            window.open('../pdf/cod-'+id+'.pdf','blank');
        })
    })
    $('#tabla_venta tbody').on('click','.borrar',function(){
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        funcion = "borrar_venta";
        
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success m-1',
                cancelButton: 'btn btn-danger m-1'
                },
                buttonsStyling: false
            })
            
            swalWithBootstrapButtons.fire({
                title: '??Esta seguro que desea eliminar la venta: '+ id +'?',
                text: "No podras revertir este cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, borrar!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('../controlador/DetalleVentaController.php',{funcion,id},(response)=>{
                        console.log(response);
                        if(response=='delete'){
                            swalWithBootstrapButtons.fire(
                                'Venta borrada',
                                'La venta '+ id +' ha sido eliminada.',
                                'success'
                            )
                        }
                        else if(response=='nodelete'){
                            swalWithBootstrapButtons.fire(
                                'Venta no borrada',
                                'No tienes permiso para eliminar esta venta, comun??cate con el Administrador.',
                                'error'
                            )
                        }
                    });
                
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Venta no borrada',
                    'La venta no ha sido eliminada.',
                    'error'
                )
                }
            })
    })
    $('#tabla_venta tbody').on('click','.ver',function(){
        let datos = datatable.row($(this).parents()).data();
        let id = datos.id_venta;
        funcion = "ver";
        $('#codigo_venta').html(datos.id_venta);
        $('#codigo_fecha').html(datos.fecha);
        $('#codigo_cliente').html(datos.cliente);
        $('#dni').html(datos.dni);
        $('#vendedor').html(datos.vendedor);
        $('#total').html(datos.total);
        $.post('../controlador/VentaProductoController.php',{funcion,id},(response)=>{
            //console.log(response);
            let registros = JSON.parse(response);
            let template="";
            $('#registros').html(template);
            registros.forEach(registro => {
                template+=`
                    <tr>
                        <td>${registro.cantidad}</td>
                        <td>${registro.precio}</td>
                        <td>${registro.producto}</td>
                        <td>${registro.concentracion}</td>
                        <td>${registro.adicional}</td>
                        <td>${registro.laboratorio}</td>
                        <td>${registro.presentacion}</td>
                        <td>${registro.tipo}</td>
                        <td>${registro.subtotal}</td>
                    </tr>
                `;
                $('#registros').html(template);
            });
        })
    })
})

let espanol= {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ning??n dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "??ltimo",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
    }
};