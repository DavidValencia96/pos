$(document).ready(function(){
    var funcion;
    buscar_lote();
    function buscar_lote(consulta) {
        funcion="buscar";
        $.post('../controlador/LoteController.php',{consulta,funcion},(response)=>{
            const lotes = JSON.parse(response);
            //console.log(response);
            let template='';
            lotes.forEach(lote => {
                template+=`
                <div loteId="${lote.id}" loteStock="${lote.stock}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">`;
                if(lote.estado=='light'){
                    template+=`<div class="card bg-light">`;
                }
                if(lote.estado=='warning'){
                    template+=`<div class="card bg-warning">`;
                }
                if(lote.estado=='danger'){
                    template+=`<div class="card bg-danger">`;
                }
                template+=`<div class="card-header  border-bottom-0">
                <h6>Codigo: ${lote.id}</h6>
                            <i class="fas fa-lg fa-cubes mr-1"></i>${lote.stock}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>${lote.nombre}</b></h2>
                                    <ul class="ml-4 mb-0 fa-ul ">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentracion: ${lote.concentracion}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional: ${lote.adicional}
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${lote.laboratorio}
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${lote.tipo}
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentacion: ${lote.presentacion}
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-times"></i></span> Vencimiento: ${lote.vencimiento}
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-truck"></i></span> Proveedor: ${lote.proveedor}
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-alt"></i></span> Mes: ${lote.mes}
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-day"></i></span> Dia: ${lote.dia}
                                        </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="${lote.avatar}" alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                
                                <button class="editar btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#editarlote">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                
                                <button class="borrar btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            });
            $('#lotes').html(template);
        });
    }
    $(document).on('keyup','#buscar-lote',function(){
        let valor = $(this).val();
        if(valor!=""){
            buscar_lote(valor);
        }
        else{
            buscar_lote();
        }
    });
    $(document).on('click','.editar',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('loteID');
        const stock = $(elemento).attr('loteStock');
        
        $('#id_lote_prod').val(id);
        $('#stock').val(stock);
        $('#codigo_lote').html(id);
    });
    $('#form-editar-lote').submit(e=>{
        let id = $('#id_lote_prod').val();
        let stock = $('#stock').val();
        funcion='editar';
        $.post('../controlador/LoteController.php',{id,stock,funcion},(response)=>{
            console.log(response);
            if(response=='edit'){
                $('#edit-lote').hide('slow');
                $('#edit-lote').show(1000);
                $('#edit-lote').hide(5000);
                $('#form-logo').trigger('reset');
            }
            buscar_lote();
        })
        e.preventDefault();
    });
    $(document).on('click','.borrar',(e)=>{
        funcion="borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('loteId');
        //console.log(id+nombre);
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: '¿Desea eliminar lote '+id+'?',
            text: "No podrar revertir este cambio!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.post('../controlador/LoteController.php',{id,funcion},(response)=>{
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El lote ' +id+ ' fue borrado correctamente',
                            'success'
                        )
                        buscar_lote();
                    }
                    else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'El lote ' +id+ ' no fue borrado por que esta siendo usado.',
                            'error'
                        )
                    }
                })  
            } else if (
                result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                'Cancelado',
                'El lote ' +id+ ' no fue borrado',
                'error'
                )
            }
        })
    })
})