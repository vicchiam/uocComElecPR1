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
	else{
		echo json_encode(
			array(
				"success"=>0,
				"error"=>"No action"
			)
		);
	}

?>