$(document).ready(function(){
    Contar_productos();
    RecuperarLS_Carrito();
    RecuperarLS_Carrito_compra();
    calcularTotal();
    $(document).on('click','.agregar-carrito',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId');
        const nombre = $(elemento).attr('prodNombre');
        const concentracion=$(elemento).attr('prodConcentracion');
        const adicional=$(elemento).attr('prodAdicional');
        const precio=$(elemento).attr('prodPrecio');
        const laboratorio=$(elemento).attr('prodLaboratorio');
        const tipo=$(elemento).attr('prodTipo');
        const presentacion=$(elemento).attr('prodPresentacion');
        const avatar=$(elemento).attr('prodAvatar');
        const stock=$(elemento).attr('prodStock');
        //console.log(id+" "+nombre+" "+laboratorio);
        const producto={
            id: id,
            nombre:nombre,
            concentracion:concentracion,
            adicional:adicional,
            precio:precio,
            laboratorio:laboratorio,
            tipo: tipo,
            presentacion:presentacion,
            avatar:avatar,
            stock:stock,
            cantidad:1
        }
        let id_producto;
        let productos;
        productos = RecuperarLS();
        productos.forEach(prod => {
            if(prod.id===producto.id){
                id_producto=prod.id; 
            }
        });
        if(id_producto === producto.id){
            Swal.fire({
                icon: 'error',
                title: 'El producto ya esta agregado',
                text: 'Si requere más de 1 cantidad del mismo producto, ingrese a solicitud de compra y modifique la cantidad',
            })
        }
        else{
            template=`
            <tr prodId="${producto.id}">
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>${producto.concentracion}</td>
                <td>${producto.adicional}</td>
                <td>$${producto.precio}</td>
                <td>
                    <button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button>
                </td>
            </tr>
        `;
        $('#lista').append(template);
        AgregarLS(producto);
        let contador;
        Contar_productos();
        //console.log(contador);
        }
    })
    $(document).on('click','.borrar-producto',(e)=>{
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        //console.log(elemento);
        const id = $(elemento).attr('prodId');
        elemento.remove();
        Eliminar_producto_LS(id);
        Contar_productos();
        calcularTotal();
    })
    $(document).on('click','#vaciar-carrito',(e)=>{
        $('#lista').empty();
        EliminarLS();
        Contar_productos();
    })
    $(document).on('click','#procesar-pedido',(e)=>{
        Procesar_pedido();
    })
    $(document).on('click','#procesar-compra',(e)=>{
        Procesar_compra();
    })

    function RecuperarLS(){
        let productos;
        if(localStorage.getItem('productos')===null){
            productos=[];
        }
        else{
            productos= JSON.parse(localStorage.getItem('productos'))
        }
        return productos;
    }
    function AgregarLS(producto){
        let productos;
        productos = RecuperarLS();
        productos.push(producto);
        localStorage.setItem('productos',JSON.stringify(productos));
    }
    function RecuperarLS_Carrito(){
        let productos, id_producto;
        productos = RecuperarLS();
        funcion = "buscar_id";
        productos.forEach(producto => {
            id_producto=producto.id;
            $.post('../controlador/ProductoController.php',{funcion,id_producto},(response)=>{
                //console.log(response);
                let template_carrito='';
                let json = JSON.parse(response);
                template_carrito=`
                    <tr prodId="${json.id}">
                        <td>${json.id}</td>
                        <td>${json.nombre}</td>
                        <td>${json.concentracion}</td>
                        <td>${json.adicional}</td>
                        <td>$${json.precio}</td>
                        <td>
                            <button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button>
                        </td>
                    </tr>
                `;
                $('#lista').append(template_carrito);
            })
        });
    }
    function Eliminar_producto_LS(id){
        let productos;
        productos = RecuperarLS();
        productos.forEach(function(producto,indice) {
            if(producto.id===id){
                productos.splice(indice,1);
            }
        });
        localStorage.setItem('productos',JSON.stringify(productos));
    }
    function EliminarLS(){
        localStorage.clear();
    }
    function Contar_productos() {
        let productos;
        let contador=0;
        productos=RecuperarLS();
        productos.forEach(producto => {
            contador++;
        });
        $('#contador').html(contador);
    }
    function Procesar_pedido(){
        let productos;
        productos = RecuperarLS();
        if(productos.length === 0){
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'El carrito esta vacio, agregue productos para continuar con la compra.',
            })
        }
        else{
            location.href = '../vista/adm_compra.php';
        }
    }
    //esta funcion se reempleaza por la que sigue despues de esta, por motivo de que no mostraba los elementos organizados alfabeticamente y cada vez que se actualizaba, generaba desorden
    // function RecuperarLS_Carrito_compra1(){
    //     let productos, id_producto;
    //     productos = RecuperarLS();
    //     //console.log(producto);
    //     funcion = "buscar_id";
    //     productos.forEach(producto => {
    //         id_producto=producto.id;
    //         //console.log(id_producto);
    //         $.post('../controlador/ProductoController.php',{funcion,id_producto},(response)=>{
    //             console.log(response);
    //             let template_compra='';
    //             let json = JSON.parse(response);
    //             //console.log(json.id);
    //             template_compra=`
    //                 <tr prodId="${producto.id}" prodPrecio="${json.precio}">
    //                     <td>${json.nombre}</td>
    //                     <td>${json.stock}</td>
    //                     <td class="precio">$${json.precio}</td>
    //                     <td>${json.concentracion}</td>
    //                     <td>${json.adicional}</td>
    //                     <td>${json.laboratorio}</td>
    //                     <td>${json.presentacion}</td>
    //                     <td>
    //                         <input type="number" min="1" class="form-control cantidad_producto" value="${producto.cantidad}"></input>
    //                     </td>
    //                     <td class="subtotales">
    //                         <h5>$${json.precio*producto.cantidad}</h5>
    //                     </td>
    //                     <td>
    //                         <button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button>
    //                     </td>
    //                 </tr>
    //             `;
    //             $('#lista-compra').append(template_compra);
    //         })
    //     });
    // }

    async function RecuperarLS_Carrito_compra(){
        let productos;
        productos = RecuperarLS();
        funcion = "traer_productos";

        const response = await fetch('../controlador/ProductoController.php',{
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'funcion='+funcion+'&&productos='+JSON.stringify(productos)
        })
        let resultado = await response.text();
        console.log(resultado);
        $('#lista-compra').append(resultado);
        //return error;
    }

    $(document).on('click','#actualizar',(e)=>{
        let productos,precios;
        precios=document.querySelectorAll('.precio');
        productos=RecuperarLS();
        productos.forEach(function(producto,indice) {
            producto.precio=precios[indice].textContent;
        });
        localStorage.setItem('productos',JSON.stringify(productos));
        calcularTotal();
    })
    $('#cp').keyup((e)=>{
        let id, cantidad, producto, productos, montos, precio;
        producto = $(this)[0].activeElement.parentElement.parentElement;
        id = $(producto).attr('prodId');
        precio = $(producto).attr('prodPrecio');
        cantidad = producto.querySelector('input').value;
        montos = document.querySelectorAll('.subtotales');
        productos = RecuperarLS();
        productos.forEach(function(prod,indice){
            if(prod.id === id){
                prod.cantidad = cantidad;
                prod.precio = precio;
                montos[indice].innerHTML =`<H5>${cantidad*productos[indice].precio}</H5>`;
            }
        });
        localStorage.setItem('productos',JSON.stringify(productos));
        calcularTotal();
    })
    function calcularTotal(){
        let productos;
        let subtotal;
        let con_iva;
        let total=0;
        let iva=0.19;
        let total_sin_descuento;
        productos= RecuperarLS();
        productos.forEach(producto => {
            let subtotal_producto= Number(producto.precio*producto.cantidad);
            total=total+subtotal_producto;
        });
        pago=$('#pago').val();
        descuento=$('#descuento').val();

        //console.log(total);
        total_sin_descuento=total.toFixed(2);
        con_iva=parseFloat(total*iva).toFixed(2);
        subtotal=parseFloat(total-con_iva).toFixed(2);
        total=total-descuento;
        vuelto=pago-total;

        $('#subtotal').html(subtotal);
        $('#con_iva').html(con_iva);
        $('#total_sin_descuento').html(total_sin_descuento);
        $('#total').html(total.toFixed(2));
        $('#vuelto').html(vuelto.toFixed(2));
    }
    function Procesar_compra(){
        let nombre, dni;
        nombre=$('#cliente').val();
        dni=$('#dni').val();
        if(RecuperarLS().length == 0){
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'No hay productos para facturar',
            }).then(function () {
                location.href ='../vista/adm_catalogo.php';
            })
        }
        else if(nombre==''){
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'El campo "CLIENTE" esta vacio',
            })
        }
        else{
            verificar_stock().then(error=>{
                if(error==0){
                    Registrar_compra(nombre,dni);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Venta realizada',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        EliminarLS();
                        location.href ='../vista/adm_catalogo.php';
                    })
                }
                else{
                    Swal.fire({
                        icon: 'question',
                        title: '¡Verificar Stock!',
                        text: 'Al parecer no hay la cantidad requerida de algún producto!',
                    })
                }
            });
            
        }
    }
    async function verificar_stock() {
        let productos;
        funcion='verificar_stock';
        productos=RecuperarLS();
        const response = await fetch('../controlador/ProductoController.php',{
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'funcion='+funcion+'&&productos='+JSON.stringify(productos)
        })
        let error = await response.text();
        return error;
    }
    
    function Registrar_compra(nombre,dni) {
        funcion='registrar_compra';
        let total=$('#total').get(0).textContent;
        let productos=RecuperarLS();
        let json = JSON.stringify(productos);
        $.post('../controlador/CompraController.php',{funcion,total,nombre,dni,json},(response)=>{
            //console.log(response);
        })
    }
})