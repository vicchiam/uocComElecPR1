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
