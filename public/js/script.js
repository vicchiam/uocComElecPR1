var current='public/php/categorias.php';

function navigateTo(url){
	current=url;
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
