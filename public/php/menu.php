<?php
    @session_start();
    $login=(isset($_SESSION["login"])?1:0);
?>
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark m-0">
        <a class="navbar-brand font-shrikhand text-white ml-2" href="/">
            La Tiendecilla
        </a>
        <ul class="navbar-nav mr-auto">      
            <li class="nav-item">
                <a class="nav-link active" id="inicio" href="#">Inicio</a>
            </li>  
            <li class="nav-item">
                <a class="nav-link" id="categorias" href="#">Categorias</a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" id="productos" href="#">Productos</a>
            </li> 
        </ul>
        <div class="float-right">
            <img class="btn-img btn-circle bg-white" title="Carrito" src="resources/shopping_cart-24px.svg" />
            <?php if(!$login){ ?>
            <img class="btn-img btn-circle bg-white ml-2" title="Iniciar Sesión" src="resources/account_circle-24px.svg" onClick="openLogin()"/>
            <?php } else{ ?>
            <img class="btn-img btn-circle bg-white ml-2" title="Iniciar Sesión" src="resources/exit_to_app-24px.svg" />
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
                    <input type="text" id="username" class="form-control" placeholder="Usuario" />
                    <input type="password" id="pass" class="form-control mt-2" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Iniciar Sesión</button>
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
            $.get('public/php/'+id+'.php')
                .done(function(response){                   
                    $('#main').html(response);                                      
                })
        })  

        function openLogin(){
            $('#modal-login').modal('show');
        }

        function startSession(){
            
        }

    </script>   
</div>