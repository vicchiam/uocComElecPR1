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
    </nav>
</div>
<div>
    <script type="text/javascript">

        $('.nav-link').click(function(){
            $(".active").removeClass("active");
            $(this).addClass("active");
            var id=$(this).attr('id');
            $.get('php/'+id+'.php')
                .done(function(response){                   
                    $('#main').html(response);                                      
                })
        })          

    </script>   
</div>