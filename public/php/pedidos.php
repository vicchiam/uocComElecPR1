<?php

	include_once($_SERVER["DOCUMENT_ROOT"]."/uocComElecPR1/php/logic.php");
	@session_start();
    $login=(isset($_SESSION["login"])?1:0);

    if(empty($login)){
    	echo "<h1>No autorizado</h2>";
    	exit(0);
    }

    $pedidos=Logic::getPedidos();

?>
<div class="container p-2">
	<h2 class="mt-3">Pedidos pendientes</h2>
	<div class="bg-white">
	<?php
		$cont=0;
		foreach ($pedidos as $p){
		$cont++;	
	?>
		<div class="<?php if($cont%2==0) echo "impar" ?> pl-3 pr-3 pb-3">
			<div class="row text-white">
				<div class="col-11 bg-dark">
					Pedido
				</div>
				<div class="col-1 bg-dark text-right">
					<?php echo $p["id"]; ?>
				</div>
			</div>
			<div class="row font-weight-bold">
				<div class="col-3">
					<?php echo $p["fecha"] ?>
				</div>
				<div class="col-4">
					<?php echo $p["nombre"] ?>
				</div>
				<div class="col-4">
					<?php echo $p["mail"] ?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php echo $p["direccion"] ?>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<?php echo $p["poblacion"] ?>
				</div>
				<div class="col-2">
					<?php echo $p["cp"] ?>
				</div>
				<div class="col-3">
					<?php echo $p["provincia"] ?>
				</div>
				<div class="col-3">
					<?php echo $p["pais"] ?>
				</div>
			</div>
			<div class="row text-white">
				<div class="col-3 bg-primary">Producto</div>
				<div class="col-3 bg-primary text-right">Precio</div>
				<div class="col-3 bg-primary text-right">Cantidad</div>
				<div class="col-3 bg-primary text-right">Subtotal</div>
			</div>
			<?php
				$total=0;
				foreach ($p["productos"] as $prod){
					$total+=$prod["precio"]*$prod["cantidad"];
			?>
				<div class="row border-bottom">
					<div class="col-3">
						<?php echo $prod["producto"] ?>
					</div>
					<div class="col-3 text-right">
						<?php echo $prod["precio"] ?> €
					</div>
					<div class="col-3 text-right">
						<?php echo $prod["cantidad"] ?> 
					</div>
					<div class="col-3 text-right">
						<?php echo $prod["precio"]*$prod["cantidad"] ?> €
					</div>
				</div>
			<?php
				}
			?>
			<div class="row font-weight-bold">
				<div class="col-11 text-right">
					Total:
				</div>
				<div class="col-1 text-right">
					<?php echo $total; ?> €
				</div>
			</div>
		</div>
	<?php
		}
	?>
	</div>
</div>
