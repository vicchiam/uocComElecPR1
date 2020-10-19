<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include("model.php");

	class Logic{

		public static function login(){
			@session_start();

			$user=$_POST["user"];
			$pass=$_POST["pass"];

			if($user=="admin" && $pass="admin"){				
				$_SESSION["login"]=1;
				return json_encode(array(
					"success"=>1
				));
			}

			return json_encode(array(
				"success"=>0,
				"error"=>"El usuario no existe"
			));

		}

		public static function logout(){
			@session_start();
			session_destroy();
			return json_encode(array(
				"success"=>1
			));
		}

		/***********Categorias**************************/
		public static function getCategorias(){
			return Model::getCategorias();
		}

		public static function getCategoria(){
			$id=$_GET["id"];
			$res = Model::getCategoria($id);
			return json_encode(array(
				"data"=>$res[0]
			));
		}

		public static function saveCategoria(){
			$id=$_POST["id"];
			$nombre=$_POST["nombre"];
			$img=$_POST["img"];
			$descripcion=$_POST["descripcion"];
			if($id==0)
				return Model::insertCategoria($nombre,$img,$descripcion);
			else
				return Model::updateCategoria($id,$nombre,$img,$descripcion);
		}

		public static function deleteCategoria(){
			$id=$_GET["id"];
			return Model::deleteCategoria($id);
		}

		/*****Productos*********************************/
		public static function getProductos($id){			
			return Model::getProductos($id);			
		}		

		public static function getProducto(){
			$id=$_GET["id"];
			$res=Model::getProducto($id);
			return json_encode(array(
				"data"=>$res[0]
			));
		}

		public static function saveProducto(){
			$id=$_POST["id"];
			$nombre=$_POST["nombre"];
			$img=$_POST["img"];
			$descripcion=$_POST["descripcion"];
			$precio=$_POST["precio"];
			$unidad=$_POST["unidad"];
			$tamanyo=$_POST["tamanyo"];
			$edad=$_POST["edad"];
			$id_categoria=$_POST["id_categoria"];
			if($id==0)
				return Model::insertProducto($nombre,$img,$descripcion,$precio,$unidad,$tamanyo,$edad,$id_categoria);
			else
				return Model::updateProducto($id,$nombre,$img,$descripcion,$precio,$unidad,$tamanyo,$edad,$id_categoria);
		}

		public static function deleteProducto(){
			$id=$_GET["id"];
			return Model::deleteProducto($id);
		}


	}

?>