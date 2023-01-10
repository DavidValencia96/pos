<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
</footer>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="../js/sweetalert2.js"></script>
<!-- select2 -->
<script src="../js/select2.js"></script>
</body>
<script>
    let funcion = 'devolver_avatar';
    $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
        // console.log(response);
        const avatar = JSON.parse(response);
        $('#avatar3').attr('src', '../img/' + avatar.avatar);
    });

    funcion='tipo_usuario';
    $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
        // console.log(response);
        if(response==1){ //Permisos para ver contenido o acceder a paginas
            
        }
        else if(response==3){
            $('#almacen').hide();
            $('#compras').hide();
            $('#gestion_usuario').hide();
            $('#gestion_producto').hide();
            $('#gestion_atributo').hide();
            $('#gestion_lote').hide();
            $('#gestion_proveedor').hide();
        }
    });
</script>
</html>