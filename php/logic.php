<?php

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


	}

?>