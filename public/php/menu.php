<?php
    include_once($_SERVER["DOCUMENT_ROOT"]."/uocComElecPR1/php/logic.php");

    @session_start();
    $login=(isset($_SESSION["login"])?1:0);

    $carrito=Logic::getCarrito();
    $num=count($carrito);

?>
<div class="container-fluid p-0">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark m-0">
        <a class="navbar-brand font-shrikhand text-white ml-2" href="/">
            La Tiendecilla
        </a>
        <ul class="navbar-nav mr-auto">                  
            <li class="nav-item">
                <a class="nav-link active" id="inicio" href="#">Categorias</a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" id="categoria" href="#">Productos</a>
            </li>
            <?php if($login) { ?>
             <li class="nav-item">
                <a class="nav-link" id="productos" href="#">Pedidos</a>
            </li> 
            <?php } ?>
        </ul>
        <div class="float-right">
            <div class="d-inline-block" id="carrito" onclick="openCarrito()">
                <img class="btn-img btn-circle bg-white" title="Carrito" src="resources/shopping_cart-24px.svg" />
                <span id="cantidad_carrito" class="badge badge-danger <?php if($num==0) echo "d-none" ?>" ><?php echo $num ?></span>
            </div>
            <?php if(!$login){ ?>
            <img class="btn-img btn-circle bg-white ml-2" title="Iniciar Sesión" src="resources/account_circle-24px.svg" onclick="openLogin()"/>
            <?php } else{ ?>
            <img class="btn-img btn-circle bg-white ml-2" title="Iniciar Sesión" src="resources/exit_to_app-24px.svg" onclick="logout()"/>
            <?php } ?>
        </div>
    </nav>    
</div>
<div class="modal" tabindex="-1" id="modal-login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Iniciar Sesión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <input type="text" id="user" class="form-control" placeholder="Usuario" />
                    <input type="password" id="pass" class="form-control mt-2" placeholder="Contraseña" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="login()">Iniciar Sesión</button>
            </div>
        </div>
    </div>
</div>
<div>
    <script type="text/javascript">

        $('.nav-link').click(function(){
            $('.active').removeClass('active');
            $(this).addClass('active');
            var id=$(this).attr('id');
            var url='public/php/'+id+'.php';
            navigateTo(url);
        })          

    </script>   
</div>