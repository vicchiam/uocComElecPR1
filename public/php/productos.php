<?php
	
	include_once($_SERVER["DOCUMENT_ROOT"]."/uocComElecPR1/php/logic.php");
	@session_start();
    $login=(isset($_SESSION["login"])?1:0);

    $id=0;
    $nombre="";
    if(isset($_GET["id"])){
    	$id=$_GET["id"];
    	$nombre=" de ".$_GET["nombre"];	
    }    

    $productos= Logic::getProductos($id);

?>
<div class="container p-2">	
	<?php if($login){ ?>
	<img class="btn-img float-right mt-3 bg-white" title="Agregar" src="resources/add-24px.svg" onclick="addCategoria()" />
	<?php } ?>
	<h2 class="mt-3">Productos<?php echo $nombre ?></h2>
	<div class="mt-3">
		<?php
			foreach ($productos as $prod) {
		?>	
		<div class="producto">
			<div>
				<h3><?php echo $prod["nombre"] ?></h3>
				<img class="cat-img" src="<?php echo $prod["img"] ?>" />				
				<p class="p-1"><?php echo $prod["descripcion"] ?></p>			
				<div class="row">
					<div class="col-8 font-weight-bold">
						Precio: <?php echo $prod["precio"]."€ / ".$prod["unidad"] ?>
					</div>
					<div class="col-4 text-right">
						<button class="btn btn-success">Añadir al carrito</button>
					</div>					
				</div>
			</div>
			<?php if($login){ ?>
			<div>
				<img class="btn-img" title="Editar" src="resources/edit-24px.svg" onclick="editCategoria('<?php echo $cat["id"] ?>')" />
				<img class="btn-img" title="Eliminar" src="resources/delete-24px.svg" onclick="deleteCategoria('<?php echo $cat["id"] ?>')" />
			</div>
			<?php } ?>
		</div>
		<?php
			}
		?>
	</div>
</div>