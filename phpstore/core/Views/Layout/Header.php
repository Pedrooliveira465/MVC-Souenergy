<?php

use core\Classes\Store;

?>
<div class="container-fluid navegacao">
    <div class="row">
        <div class="col-6 p-3">
            <a href="?a=inicio">
                <h1> <i class="fab fa-php"></i> </h1>
            </a>
        </div>
        <div class="col-6 text-end p-3">
            <a href="?a=inicio" class="nav-item">Home</a>
            <a href="?a=loja" class="nav-item">Loja</a>

            <!--Verifica se existe cliente na sessão-->
            <?php if (Store::Clientelog()) :  ?>
                <a href="?a=Perfil" class="nav-item">Minha conta</a>
                <a href="?a=Logout" class="nav-item">Logout</a>

            <?php else : ?>

                <a href="?a=Login" class="nav-item">Login</a>
                <a href="?a=novo_cliente" class="nav-item">Criar conta</a>

            <?php endif; ?>
            <a href="?a=carrinho"> <i class="fas fa-shopping-cart"> </i> </a>
            <span class="badge bg-warning"></span>
        </div>
    </div>

</div>