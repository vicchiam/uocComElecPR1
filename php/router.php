<?php

	include("logic.php");

	$action=null;
	if(isset($_GET["action"]))
		$action=$_GET["action"];
	if(isset($_POST["action"]))
		$action=$_POST["action"];

	if($action=="login"){
		echo Logic::login();
	}
	else if($action=="logout"){
		echo Logic::logout();
	}
	else if($action=="get-categoria"){
		echo Logic::getCategoria();
	}
	else if($action=="save-categoria"){
		echo Logic::saveCategoria();
	}
	else if($action=="delete-categoria"){
		echo Logic::deleteCategoria();
	}	
	else if($action=="get-ficha"){
		echo Logic::getProducto();
	}
	else if($action=="get-producto"){
		echo Logic::getProducto();
	}
	else if($action=="save-producto"){
		echo Logic::saveProducto();
	}
	else if($action=="delete-producto"){
		echo Logic::deleteProducto();
	}
	else if($action=="add-carrito"){
		echo Logic::addCarrito();
	}
	else if($action=="delete-carrito"){
		echo Logic::deleteCarrito();
	}
	else if($action=="erase-carrito"){
		echo Logic::eraseCarrito();
	}
	else if($action=="add-pedido"){
		echo Logic::addPedido();
	}
	else if($action=="save-pedido"){
		echo Logic::savePedido();
	}
	else{
		echo json_encode(
			array(
				"success"=>0,
				"error"=>"No action"
			)
		);
	}

?>