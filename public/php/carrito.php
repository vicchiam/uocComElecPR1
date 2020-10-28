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
			<tr class="linea-carrito">
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
					<button class="btn btn-success">Realizar Pedido</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>