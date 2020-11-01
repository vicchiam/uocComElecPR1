<?php 

	include_once($_SERVER["DOCUMENT_ROOT"]."/uocComElecPR1/php/logic.php");

	$pedido=Logic::getProductosCarrito();

	$total=0;
	foreach ($pedido as $p){
		$total+=($p["precio"]*$p["cantidad"]);
	}

	$paises=Logic::loadPaises();

?>
<div class="container p-3">	
	<div class="bg-white">
		<div class="form-row">
			<div class="form-group col-4">
				<label>Nombre:</label>
				<input type="text" class="form-control" id="nombre"/>
			</div>
			<div class="form-group col-8">
				<label>Apellidos:</label>
				<input type="text" class="form-control" id="apellidos"/>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-12">
				<label>Dirección:</label>
				<input type="text" class="form-control" id="direccion"/>
			</div>			
		</div>
		<div class="form-row">
			<div class="form-group col-4">
				<label>Población:</label>
				<input type="text" class="form-control" id="poblacion" />
			</div>
			<div class="form-group col-2">
				<label>CP:</label>
				<input type="text" class="form-control text-right" id="cp" />
			</div>
			<div class="form-group col-3">
				<label>Provincia:</label>
				<input type="text" class="form-control" id="provincia" />
			</div>
			<div class="form-group col-3">
				<label>Pais:</label>
				<select class="custom-select" id="pais"> 
				<?php 
					foreach ($paises as $pais) {
				?>
					<option value="<?php echo $pais ?>"><?php echo $pais ?></option>
				<?php
					}
				?>
				</select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-12">
				<label>Correo electrónico:</label>
				<input type="text" class="form-control" id="mail" />
			</div>			
		</div>		
		<div class="mt-2 font-weight-bold text-right pr-1">			
			<h4>Total pedido: <?php echo $total ?> €</h4>
		</div>
	</div>
</div>