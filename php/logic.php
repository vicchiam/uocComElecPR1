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

		/***********Carrito***************************/

		public static function addCarrito(){
			@session_start();
			if(!isset($_SESSION["carrito"]))
				$_SESSION["carrito"]=array();
			$id=$_POST["id"];
			if(!isset($_SESSION["carrito"][$id]))
				$_SESSION["carrito"][$id]=0;
			$_SESSION["carrito"][$id]++;
			return count($_SESSION["carrito"]);
		}

		public static function getCarrito(){
			@session_start();
			if(isset($_SESSION["carrito"]))
				return $_SESSION["carrito"];
			return array();
		}

		public static function getProductosCarrito(){
			@session_start();
			if(isset($_SESSION["carrito"])){
				$productos=Model::getProductosCarrito(array_keys($_SESSION["carrito"]));
				$res=array();
				foreach ($productos as $p) {
					foreach ($_SESSION["carrito"] as $k => $v) {
						if($p["id"]==$k){
							$res[]=array(
								"id"=>$k,
								"nombre"=>$p["nombre"],
								"descripcion"=>$p["descripcion"],
								"precio"=>$p["precio"],
								"unidad"=>$p["unidad"],
								"cantidad"=>$v
							);
						}
					}
				}
				return $res;
			}	
			return array();		
		}

		public static function deleteCarrito(){
			@session_start();
			$id=$_POST["id"];
			unset($_SESSION["carrito"][$id]);
			return count($_SESSION["carrito"]);
		}

		public static function eraseCarrito(){
			@session_start();
			$_SESSION["carrito"]=array();
			return 0;
		}

		/*************Pedido*****************************/

		public static function loadPaises(){
			$string = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/uocComElecPR1/resources/paises.json");
			$json = json_decode($string, true);
			sort($json["paises"]);
			return $json["paises"];
		}

		public static function getPedidos(){
			$res=array();
			$data=Model::getPedidos();
			foreach($data as $d){
				if(!isset($res[$d["id"]])){
					$res[$d["id"]]=array(
						"id"=>$d["id"],
						"fecha"=>$d["fecha"],
						"nombre"=>$d["nombre"],
						"direccion"=>$d["direccion"],
						"poblacion"=>$d["poblacion"],
						"cp"=>$d["cp"],
						"provincia"=>$d["provincia"],
						"pais"=>$d["pais"],
						"mail"=>$d["mail"],
						"productos"=>array()
					);
				}
				$res[$d["id"]]["productos"][]=array(
					"producto"=>$d["producto"],
					"precio"=>$d["precio"],
					"cantidad"=>$d["cantidad"]
				);
			}
			return $res;
		}

		public static function addPedido(){
			@session_start();
			$string=$_POST["json"];
			$json=json_decode($string, true);
			$_SESSION["carrito"]=array();
			foreach ($json as $j) {
				$_SESSION["carrito"][$j["id"]]=$j["cantidad"];
			}
			return "ok";
		}

		public static function savePedido(){
			@session_start();

			$nombre=$_POST["nombre"];
			$apellidos=$_POST["apellidos"];
			$direccion=$_POST["direccion"];
			$poblacion=$_POST["poblacion"];
			$cp=$_POST["cp"];
			$provincia=$_POST["provincia"];
			$pais=$_POST["pais"];
			$mail=$_POST["mail"];

			$res=Model::insertCabeceraPedido($nombre,$apellidos,$direccion,$poblacion,$cp,$provincia,$pais,$mail);
			if(is_numeric($res)){
				foreach($_SESSION["carrito"] as $key => $value){
					$producto=Model::getProducto($key);
					$producto=$producto[0];
					Model::insertLineaPedido($res,$key,$value,$producto["precio"]);
				}
				$_SESSION["carrito"]=array();
				return "ok";
			}
			return $res;
		}

	}

?>