<?php

	include_once($_SERVER["DOCUMENT_ROOT"]."/uocComElecPR1/php/logic.php");

	$carrito=Logic::getProductosCarrito();

?>
<div class="container p-2">
	<h2 class="mt-3">Carrito</h2>
	<table class="table bg-white">
		<thead class="thead-dark">
			<tr>
				<th></th>
				<th>Producto</th>
				<th>Descripción</th>
				<th class="text-right">Precio</th>
				<th>Unidad</th>
				<th class="text-right">Cantidad</th>
				<th class="text-right">Total</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$total=0;
			foreach ($carrito as $c) {
				$total+=($c["precio"]*$c["cantidad"]);
		?>
			<tr class="linea-carrito" data-id="<?php echo $c["id"] ?>">
				<td>
					<img class="btn-img" title="Eliminar" src="resources/delete-24px.svg" onclick="deleteCarrito(this,'<?php echo $c["id"] ?>')" />
				</td>
				<td><?php echo $c["nombre"] ?></td>
				<td class="text-truncate"><?php echo $c["descripcion"] ?></td>
				<td class="text-right"><span class="precio"><?php echo $c["precio"] ?></span> €</td>
				<td><?php echo $c["unidad"] ?></td>
				<td>
					<input type="text" class="form-control text-right cantidad" value="<?php echo $c["cantidad"] ?>" size="6" onblur="recalcularCarrito()"/>
				</td>
				<td class="text-right"><span class="total"><?php echo $c["precio"]*$c["cantidad"] ?></span> €</td>
			</tr>	
		<?php
			}
		?>
			<tr>
				<td colspan="7" class="text-right font-weight-bold total_carrito">
					Total: <?php echo $total; ?> €
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<button class="btn btn-danger" onclick="eraseCarrito()">Descartar Carrito</button>
				</td>
				<td colspan="4" class="text-right">
					<button class="btn btn-secondary" onclick="cancelCarrito()">Cancelar</button>
					<button class="btn btn-primary" onclick="addPedido()">Realizar Pedido</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="modal" tabindex="-1" id="modal-pedido">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Realizar Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" id="body-pedido">
            	 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="">Finalizar pedido</button>
            </div>
        </div>
    </div>
</div>