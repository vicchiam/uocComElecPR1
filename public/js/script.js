var current='public/php/categorias.php';

function navigateTo(url){
	current=url;
	$.get(current).done(result =>{
        $('#main').html(result);
    })
}

function navigateLast(){
	$.get(current).done(result =>{
        $('#main').html(result);
    })
}

function reload(){
	$.get('public/php/menu.php').done(result =>{
        $('#menu').html(result);
    })

    $.get(current).done(result =>{
        $('#main').html(result);
    })
}

/*******Menu*************************/

function openLogin(){
    $('#modal-login').modal('show');
}

function login(){
    $.post('php/router.php', { 
        action: 'login',
        user: $('#user').val(),
        pass: $('#pass').val()
    })
    .done(result =>{
        var result=JSON.parse(result);
        if(result.success==1){
            reload();
            $('#modal-login').modal('hide');
        }
        else
            alert(result.error);
    })
    .fail( err =>{
        alert(err);
    })
}

function logout(){
    $.getJSON('php/router.php',{ action: 'logout' })
    .done(result =>{
        reload();
    })
}       

/**********Categorias************************/

function addCategoria(){
	$('#id_categoria').val(0);
	$('#nombre').val('');
	$('#img').val('');
	$('#descripcion').val('');
	$('#modal-categoria').modal('show');
}

function editCategoria(id){
	$('#id_categoria').val(id);
	$.getJSON('php/router.php', {
		action: 'get-categoria',
		id: id
	})
	.done(result => {
		var cat=result.data;
		$('#id_categoria').val(cat.id);
		$('#nombre').val(cat.nombre);
		$('#img').val(cat.img);
		$('#descripcion').val(cat.descripcion);
		$('#modal-categoria').modal('show');		
	})	
}

function saveCategoria(){
	let id=$('#id_categoria').val();
	let nombre=$('#nombre').val();
	let img=$('#img').val();
	let descripcion=$('#descripcion').val();

	if(nombre.length==0){
		alert("Debes indicar un nombre");
		return;
	}

	$.post('php/router.php', {
		action: 'save-categoria',
		id: id,
		nombre: nombre,
		img: img,
		descripcion: descripcion
	})
	.done(result =>{		
		if(result>0){
			alert("Guardado correctamente");
			$('#modal-categoria').modal('hide');
			reload();
		}
		else
			alert(result);
		
	})
}

function deleteCategoria(id){
	if(confirm("¿Seguro que lo deseas eliminar?")){
		$.getJSON('php/router.php', {
			action: 'delete-categoria',
			id: id
		})
		.done(result =>{
			if(result>0){
				alert('Eliminado correctamente')
				reload();
			}
			else
				alert(result);
		})
	}
}

/************Producto*************************/
function openFichaProducto(id){
	$('#id_ficha').val(id);
	$.getJSON('php/router.php', { action: 'get-ficha', id: id })
		.done( result =>{
			$('#nombre_ficha').text(result.data.nombre);
			$('#img_ficha').prop('src',result.data.img);
			$('#precio_ficha').text(result.data.precio+"€ / "+result.data.unidad);
			$('#descripcion_ficha').text(result.data.descripcion);
			$('#tamanyo_ficha').text(result.data.tamanyo);
			$('#edad_ficha').text(result.data.edad);
			$('#modal-ficha-producto').modal('show');		
		});	
}

function addProducto(){
	$('#id_producto').val(0);
	$('#nombre_producto').val('');
	$('#img_producto').val('');
	$('#descripcion_producto').val('');
	$('#precio_producto').val('');
	$('#unidad_producto').val('');
	$('#tamanyo_producto').val('');
	$('#edad_producto').val('');
	$('#id_categoria').val('');
	$('#modal-producto').modal('show');
}

function editProducto(id){
	$('#id_producto').val(id);
	$.getJSON('php/router.php', {
		action: 'get-producto',
		id: id
	})
	.done(result => {
		var prod=result.data;
		$('#id_producto').val(prod.id);
		$('#nombre_producto').val(prod.nombre);
		$('#img_producto').val(prod.img);
		$('#descripcion_producto').val(prod.descripcion);
		$('#precio_producto').val(prod.precio);
		$('#unidad_producto').val(prod.unidad);
		$('#tamanyo_producto').val(prod.tamanyo);
		$('#edad_producto').val(prod.edad);
		$('#id_categoria').val(prod.id_categoria);
		$('#modal-producto').modal('show');		
	})
}

function saveProducto(){
	let id=$('#id_producto').val();
	let nombre=$('#nombre_producto').val();
	let img=$('#img_producto').val();
	let descripcion=$('#descripcion_producto').val();
	let precio=$('#precio_producto').val();
	let unidad=$('#unidad_producto').val();
	let tamanyo=$('#tamanyo_producto').val();
	let edad=$('#edad_producto').val();
	let id_categoria=$('#id_categoria').val();

	if(nombre.length==0)
		return alert("Debes indicar un nombre");
	if(precio==='')
		return alert('Debes indicar un precio');

	$.post('php/router.php', {
		action: 'save-producto',
		id: id,
		nombre: nombre,
		img: img,
		descripcion: descripcion,
		precio: precio,
		unidad: unidad,
		tamanyo: tamanyo,
		edad: edad,
		id_categoria: id_categoria
	})
	.done(result =>{		
		if(result>0){
			alert("Guardado correctamente");
			$('#modal-producto').modal('hide');
			reload();
		}
		else
			alert(result);
		
	})
}

function deleteProducto(id){
	if(confirm("¿Seguro que lo deseas eliminar?")){
		$.getJSON('php/router.php', {
			action: 'delete-producto',
			id: id
		})
		.done(result =>{
			if(result>0){
				alert('Eliminado correctamente')
				reload();
			}
			else
				alert(result);
		})
	}
}

/*********Carrito********************/
function addCarrito(){
	var id=$('#id_ficha').val();
	$.post('php/router.php', { action: 'add-carrito', id: id })
		.done(result =>{
			if(!isNaN(result)){				
				$('#cantidad_carrito').html(result);
				if(result>0)
					$('#cantidad_carrito').removeClass('d-none');	
				alert('Producto añadido');
				$('#modal-ficha-producto').modal('hide');
			}
			else
				alert(result);
		})
}

function openCarrito(){
    $.get('public/php/carrito.php', {action: 'get-carrito'})
        .done(result => {
        	$('#main').html(result);
        })
}

function recalcularCarrito(){
	var total_carrito=0;
	$('.linea-carrito').each(function(){
		var precio = $(this).find('.precio');
		var cantidad = $(this).find('.cantidad');
		var total = $(this).find('.total');		
		var p = parseFloat(precio.html());
		var c = parseFloat(cantidad.val());		
		if(isNaN(c)) 
			return alert("Existe una cantidad errónea");
		else if(c<0)
			return alert("No puede ser cantidades menor que 0");
		var t = p*c;
		total.html(t);
		total_carrito+=t;		
	});
	$('.total_carrito').html('Total: '+total_carrito+' €');
}

function deleteCarrito(elem,id){
	if(confirm("¿Seguro que lo quiere eliminar?")){
		$.post('php/router.php', {action: 'delete-carrito', id: id})
		    .done(result => {
		    	if(!isNaN(result)){				
					$('#cantidad_carrito').html(result);
					if(result>0)
						$('#cantidad_carrito').removeClass('d-none');	
					$(elem).parent().parent().remove();
					recalcularCarrito();
				}
		    	else
		    		alert(result);
		    })
	}
}

function eraseCarrito(){
	if(confirm("¿Seguro que lo quiere eliminar?")){
		$.post('php/router.php', { action: 'erase-carrito'  })
			.done(result => {
				$('#cantidad_carrito').html(0);
				$('#cantidad_carrito').addClass('d-none');
				navigateLast();
			});
	}
}

function cancelCarrito(){
	navigateLast();
}

/*************Pedido**********************************/

function addPedido(){
	var res=[];
	$('.linea-carrito').each(function(){
		var id=$(this).data('id');
		var cantidad=$(this).find('.cantidad');		
		var obj ={
			id: id,
			cantidad: cantidad.val()
		};		
		res.push(obj);
	});
	var json=JSON.stringify(res);
	$.post('php/router.php', {action: 'add-pedido', json: json})
		.done(result =>{
			if(result=="ok")
				openPedido();
			else
				alert(result);
		})
}

function openPedido(){
	$.get('public/php/pedido.php')
		.done(result => {
			$("#body-pedido").html(result);
			$("#modal-pedido").modal('show');
		})
}

function savePedido(){
	var nombre=$('#nombre').val();
	var apellidos=$('#apellidos').val();
	var direccion=$('#direccion').val();
	var poblacion=$('#poblacion').val();
	var cp=$('#cp').val();
	var provincia=$('#provincia').val();
	var pais=$('#pais').val();
	var mail=$('#mail').val();

	if(nombre.length==0)
		return alert("Debes indicar un nombre");
	if(apellidos.length==0)
		return alert("Debes indicar unos apellidos");
	if(direccion.length==0)
		return alert("Debes indicar la direccion");
	if(poblacion.length==0)
		return alert("Debes indicar la poblacion");
	if(mail.length==0)
		return alert("Debes indicar un correo electróinico");
}
