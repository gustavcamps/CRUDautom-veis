<div class="topo">
    <p>Carros</p>
    <ul class="menu">
        <a href="addCarro.php"><li>+Veículo</li></a>
        <a href="addUsuario.php"><li>+Usuário</li></a>
        <a href="listarCarros.php"><li>Listar</li></a>
        <a href="pesquisarCarro.php"><li>Pesquisar</li></a>
        <?php
            @session_start();
            if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                echo "<a href=logoff.php><li>Sair</li></a>";
            }else{
                echo "<a href=login.php><li>Entrar</li></a>";
            }

        ?>
        
    </ul>
</div>