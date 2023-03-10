$(document).ready(function(){
    buscar_pre();
    var funcion;
    var edit=false;
    $('#form-crear-presentacion').submit(e=>{
        let nombre_presentacion = $('#nombre-presentacion').val();
        let id_editado = $('#id_editar_pre').val();
        if(edit==false){
            funcion='crear';
        }
        else{
            funcion='editar';
        }
        $.post('../controlador/PresentacionController.php',{nombre_presentacion,id_editado,funcion},(response)=>{
            console.log(response);
            if(response=='add'){
                $('#add-pre').hide('slow');
                $('#add-pre').show(1000);
                $('#add-pre').hide(4000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_pre();
            }
            if(response=='noadd'){
                $('#noadd-pre').hide('slow');
                $('#noadd-pre').show(1000);
                $('#noadd-pre').hide(4000);
                $('#form-crear-presentacion').trigger('reset');
            }
            if(response=='edit'){
                $('#edit-pre').hide('slow');
                $('#edit-pre').show(1000);
                $('#edit-pre').hide(4000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_pre();
            }
            edit=false;
        })
        e.preventDefault();
    });
    function buscar_pre(consulta){
        funcion='buscar';
        $.post('../controlador/PresentacionController.php',{consulta,funcion},(response)=>{
            const presentaciones = JSON.parse(response);
            let template='';
            presentaciones.forEach(presentacion => {
                template+=`
                <tr preId="${presentacion.id}" preNombre="${presentacion.nombre}">
                    <td>                    
                        </button>
                        <button class="editar-pre btn btn-success" title="Editar presentacion" type="button" data-toggle="modal" data-target="#crearpresentacion">
                            <i class="fas fa-pencil-alt"></i>                        
                        </button>
                        <button class="borrar-pre btn btn-danger" title="Eliminar presentacion" >
                            <i class="fas fa-trash-alt"></i>                        
                        </button>
                    </td>
                    <td>
                        ${presentacion.nombre}
                    </td>
                </tr>
                `;
            });
            $('#presentaciones').html(template);
        })
    }
    $(document).on('keyup','#buscar-presentacion',function(){
        let valor = $(this).val();
        if(valor!=''){
            buscar_pre(valor);
        }
        else{
            buscar_pre();
        }
    })
    
    $(document).on('click','.borrar-pre',(e)=>{
        funcion="borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('preId');
        const nombre = $(elemento).attr('preNombre');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: '??Desea eliminar a '+nombre+'?',
            text: "No podrar revertir este cambio!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.post('../controlador/PresentacionController.php',{id,funcion},(response)=>{
                    edit==false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'La presentacion ' +nombre+ ' fue borrado.',
                            'success'
                        )
                        buscar_pre();
                    }
                    else{
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!',
                            'La presentacion ' +nombre+ ' no fue borrado por que esta siendo usado en un producto.',
                            'error'
                        )
                    }
                })  
            } else if (
                result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                'Cancelado',
                'La presentacion ' +nombre+ ' no fue borrado',
                'error'
                )
                buscar_pre();
            }
        })
    })

    $(document).on('click','.editar-pre',(e)=>{
        funcion="cambiar_logo";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('preId');
        const nombre = $(elemento).attr('preNombre');
        $('#id_editar_pre').val(id);
        $('#nombre-presentacion').val(nombre);
        edit=true;        
    })
});