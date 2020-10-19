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
    $categorias=Logic::getCategorias();

?>
<div class="container p-2">	
	<?php if($login){ ?>
	<img class="btn-img float-right mt-3 bg-white" title="Agregar" src="resources/add-24px.svg" onclick="addProducto()" />
	<?php } ?>
	<h2 class="mt-3">Productos<?php echo $nombre ?></h2>
	<div class="mt-3">
		<?php
			foreach ($productos as $prod) {
		?>	
		<div class="producto">
			<div onclick="openFichaProducto('<?php echo $prod["id"] ?>')">
				<h3><?php echo $prod["nombre"] ?></h3>
				<img class="cat-img" src="<?php echo $prod["img"] ?>" />				
				<p class="p-1"><?php echo $prod["descripcion"] ?></p>			
				<div class="text-right font-weight-bold">
					Precio: <?php echo $prod["precio"]."€ / ".$prod["unidad"] ?>
				</div>					
			</div>
			<?php if($login){ ?>
			<div>
				<img class="btn-img" title="Editar" src="resources/edit-24px.svg" onclick="editProducto('<?php echo $prod["id"] ?>')" />
				<img class="btn-img" title="Eliminar" src="resources/delete-24px.svg" onclick="deleteProducto('<?php echo $prod["id"] ?>')" />
			</div>
			<?php } ?>
		</div>
		<?php
			}
		?>
	</div>
</div>
<div class="modal" tabindex="-1" id="modal-ficha-producto">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold" id="nombre_ficha"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
            	<div class="pr-2 pb-2" id="ficha">
	            	<input type="hidden" id="id_ficha" value="" />
	            	<img id="img_ficha" src="" />
	            	<div class="p-2">
		            	<h3 id="precio_ficha" class="font-weight-bold text-right"></h3>
		                <span class="d-block font-weight-bold mt-3">Descripción:</span>
		                <p id="descripcion_ficha"></p>
		                <span class="d-block font-weight-bold mt-3">Tamaño</span>
		                <p id="tamanyo_ficha"></p>
		                <span class="d-block font-weight-bold mt-3">Edad recomendada</span>
		                <p id="edad_ficha"></p>
		            </div>
	            </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="">Añadir al carrito</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="modal-producto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<input type="hidden" id="id_producto" value="" />
                <div class="p-2">
                	<div class="form-group">
                		<label>Categoria</label>
	                    <select id="id_categoria" class="custom-select pl-1">
	                    <?php
	                    	foreach ($categorias as $cat) {
	                    ?>
	                    	<option value="<?php echo $cat["id"] ?>"><?php echo $cat["nombre"] ?></option>
	                    <?php
	                    	}
	                    ?>
	                    </select>
                	</div>
                	<div class="form-group">
                		<label>Nombre</label>
                		<input type="text" id="nombre_producto" class="form-control" />
                	</div>
                    <div class="form-group">
                    	<label>Enlace a imagen</label>
                    	<input type="text" id="img_producto" class="form-control" />
                    </div>
                    <div class="form-row">
	                    <div class="form-group col-6">
	                    	<label>Precio</label>
	                    	<input type="text" id="precio_producto" class="form-control" />
	                    </div>
	                    <div class="form-group col-6">
	                    	<label>Unidad</label>
	                    	<input type="text" id="unidad_producto" class="form-control" />
	                    </div>
	                </div>
                    <div class="form-group">
                    	<label>Descripción</label>
                    	<textarea id="descripcion_producto" class="form-control"></textarea>
                    </div>
                    <div class="form-row">
	                    <div class="form-group col-6">
	                    	<label>Tamaño</label>
	                    	<input type="text" id="tamanyo_producto" class="form-control" />
	                    </div>
	                    <div class="form-group col-6">
	                    	<label>Edad recomendada</label>
	                    	<input type="text" id="edad_producto" class="form-control" />
	                    </div>
	                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="saveProducto()">Guardar</button>
            </div>
        </div>
    </div>
</div>