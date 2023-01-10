$(document).ready(function(){
    $('#aviso1').hide();
    $('#aviso').hide();
    $('#form-recuperar').submit(e =>{
        Mostrar_loarder('Recuperar_password');
        let dni = $('#dni-recuperar').val();
        let email = $('#email-recuperar').val();
        if(email == '' || dni == ''){ //si los campos son vacios, avise que debe llenarlos
            $('#aviso').show();
            $('#aviso').text('Debe llenar todos los campos');
            Cerrar_loader("");
        }
        else{
            $('#aviso').hide();
            let funcion ='verificar';
            $.post('../controlador/recuperarController.php',{funcion,email,dni},(response)=>{
                console.log(response);
                if(response=='encontrado'){
                    let funcion='recuperar';
                    $('#aviso').hide();
                    $.post('../controlador/recuperarController.php',{funcion,email,dni},(response2)=>{
                        console.log(response2);
                        $('#aviso').hide();
                        $('#aviso1').hide();
                        if(response2=='enviado'){
                            Cerrar_loader('exito_envio');
                            $('#aviso1').show();
                            $('#aviso1').text('Contraseña enviada correctamente, verifique su E-mail.');
                            $('#form-recuperar').trigger('reset');
                        }
                        else{
                            Cerrar_loader('error_envio');
                            $('#aviso').show();
                            $('#aviso').text('Error al restablecer contraseña');
                            $('#form-recuperar').trigger('reset');
                        }
                    })
                }
                else{
                    Cerrar_loader('error_usuario');
                    $('#aviso').hide();
                    $('#aviso1').hide();
                    $('#aviso').show();
                    $('#aviso').text('Verifique su DNI y E-mail, no coinciden con los registrados');
                }
            });
        }
        e.preventDefault();//no se actualize la pagina hasta finalizar
    })

    function Mostrar_loarder(Mensaje){
        var texto = null;
        var mostrar = false;
        switch (Mensaje) {
            case 'Recuperar_password':
                texto = 'Enviando correo de recuperación...';
                mostrar = true;
                break;
        }
        if(mostrar){
            Swal.fire({
                title: 'Enviando correo',
                text: texto,
                showConfirmButton: false
            })
        }
    }
    
    function Cerrar_loader(Mensaje){
        var tipo = null;
        var texto = null;
        var mostrar = false;
        switch (Mensaje) {
            case 'exito_envio':
                tipo ='success';
                texto = 'Correo de recuperación de Password enviado correctamente.';
                mostrar = true;
                break;

            case 'error_envio':
                tipo ='error';
                texto = 'Error al enviar correo. Intente de nuevo o comuniquese con el administrador del sistema';
                mostrar = true;
                break;

            case 'error_usuario':
                tipo ='error';
                texto = 'Los datos ingresados no son correctos. Intente de nuevo';
                mostrar = true;
                break;
        
            default:
                swal.close();
                break;
        }

        if(mostrar){
            Swal.fire({
                position: 'center',
                icon: tipo,
                text: texto,
                showConfirmButton: false
            })
        }
    }
    
})