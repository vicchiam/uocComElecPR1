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

		/********Pedido*****************************/

		public static function getPedidos(){
			$sql="
				select 
					c.id,
					date_format(c.fecha,'%d-%m-%Y') as fecha,
					concat(c.nombre,' ',c.apellidos) as nombre,
					c.mail,
					c.direccion,
					c.poblacion,
					c.cp,
					c.provincia,
					c.pais,
					p.nombre as producto,
					l.id_pedido,
					l.precio,
					l.cantidad
				from
					cabecera_pedido c 
					left join
					linea_pedido l
					on
						l.id_pedido=c.id
					left join
					producto p
					on
						p.id=l.id_producto
				order by
					c.id

			";
			return BD::query($sql);
		}

		public static function insertCabeceraPedido($nombre,$apellidos,$direccion,$poblacion,$cp,$provincia,$pais,$mail){
			$sql="
				insert into cabecera_pedido 
					(fecha,nombre,apellidos,direccion,poblacion,cp,provincia,pais,mail) 
				values
					(now(),'".$nombre."','".$apellidos."','".$direccion."','".$poblacion."','".$cp."','".$provincia."','".$pais."','".$mail."')
			";
			return BD::insert($sql);
		}

		public static function insertLineaPedido($id_pedido,$id_producto,$cantidad,$precio){
			$sql="
				insert into linea_pedido
					(id_pedido, id_producto, cantidad, precio)
				values
					('".$id_pedido."','".$id_producto."','".$cantidad."','".$precio."')
			";
			return BD::insert($sql);
		}

	}

	

?>