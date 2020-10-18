<?php

	include_once($_SERVER["DOCUMENT_ROOT"]."/uocComElecPR1/php/logic.php");
	@session_start();
    $login=(isset($_SESSION["login"])?1:0);

	$categorias=Logic::getCategorias();

?>
<div class="container p-2">
	<?php if($login){ ?>
	<img class="btn-img float-right mt-3 bg-white" title="Agregar" src="resources/add-24px.svg" onclick="addCategoria()" />
	<?php } ?>
	<h2 class="mt-3">Nuestras Categorias</h2>	
	<div class="mt-3">
		<?php
			foreach ($categorias as $cat) {
				$title="";
				if(strlen($cat["descripcion"])>100) $title=$cat["descripcion"];
		?>	
		<div class="categoria">
			<div onclick="navigateTo('public/php/productos.php?id=<?php echo $cat["id"] ?>&nombre=<?php echo $cat["nombre"] ?>')">
				<h3><?php echo $cat["nombre"] ?></h3>
				<img class="cat-img" src="<?php echo $cat["img"] ?>" />				
				<p class="p-1" title="<?php echo $title ?>"><?php echo $cat["descripcion"] ?></p>			
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
<div class="modal" tabindex="-1" id="modal-categoria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<input type="hidden" id="id_categoria" value="" />
                <div class="p-2">
                    <input type="text" id="nombre" class="form-control mt-1" placeholder="Nombre" />
                    <input type="text" id="img" class="form-control mt-1" placeholder="Enlace a imagen" />
                    <textarea id="descripcion" class="form-control mt-1" placeholder="Descripción"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveCategoria()">Guardar</button>
            </div>
        </div>
    </div>
</div>