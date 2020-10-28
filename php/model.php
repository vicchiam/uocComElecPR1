<?php

	include('bbdd.php');

	class Model{

		/***********Categorias***********************************/

		public static function getCategorias(){
			$sql="
				select
					id,
					nombre,
					img,
					descripcion
				from
					categoria
			";
			return BD::query($sql);
		}

		public static function getCategoria($id){
			$sql="
				select
					*
				from
					categoria
				where
					id=".$id."
			";
			return BD::query($sql);	
		}

		public static function insertCategoria($nombre,$img,$descripcion){
			$sql="
				insert into categoria (nombre,img,descripcion) values('".$nombre."','".$img."','".$descripcion."')
			";
			return BD::insert($sql);
		}

		public static function updateCategoria($id,$nombre,$img,$descripcion){
			$sql="
				update categoria set nombre='".$nombre."', img='".$img."', descripcion='".$descripcion."' where id='".$id."'
			";
			return BD::update($sql);
		}

		public static function deleteCategoria($id){
			$sql="delete from categoria where id='".$id."'";
			return BD::delete($sql);
		}

		/***********Productos***********************************/

		public static function getProductos($id){
			$op="";
			if(!empty($id))
				$op=" where id_categoria='".$id."'";
			$sql="
				select
					id,
					nombre,
					img,
					descripcion,
					precio,
					unidad
				from
					producto
				".$op."
			";
			return BD::query($sql);
		}

		public static function getProducto($id){
			$sql="
				select
					*
				from
					producto
				where
					id=".$id."
			";
			return BD::query($sql);	
		}

		public static function insertProducto($nombre,$img,$descripcion,$precio,$unidad,$tamanyo,$edad,$id_categoria){
			$sql="
				insert into producto (nombre,img,descripcion,precio,unidad,tamanyo,edad,id_categoria) values('".$nombre."','".$img."','".$descripcion."','".$precio."','".$unidad."','".$tamanyo."','".$edad."','".$id_categoria."')
			";
			return BD::insert($sql);
		}

		public static function updateProducto($id,$nombre,$img,$descripcion,$precio,$unidad,$tamanyo,$edad,$id_categoria){
			$sql="
				update producto set nombre='".$nombre."', img='".$img."', descripcion='".$descripcion."', precio='".$precio."', unidad='".$unidad."', tamanyo='".$tamanyo."', edad='".$edad."', id_categoria='".$id_categoria."' where id='".$id."'
			";
			return BD::update($sql);
		}

		public static function deleteProducto($id){
			$sql="delete from producto where id='".$id."'";
			return BD::delete($sql);
		}

		/*********Carrito*************************/

		public static function getProductosCarrito($ids){
			$sql="
				select 
					id,
					nombre,
					descripcion,
					precio, 
					unidad,
					0 as cantidad
				from
					producto
				where
					id in (".join(',',$ids).")
			";
			return BD::query($sql);
		}

	}

	

?>