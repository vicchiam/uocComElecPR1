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

	}

	

?>