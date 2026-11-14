<?php include('head.php'); ?>
<body>
<?php include('menu.php'); ?>

    <form action="addUsuario.act.php" method="post" class=formAdd enctype="multipart/form-data">
        <h1>Adicionar Usuário</h1>
        <p>Nome:</p>
        <p><input type="text" name="nome" id=""></p>
        <p>Email:</p>
        <p><input type="email" name="email" id=""></p>
        <p>Senha:</p>
        <p><input type="password" name="senha1" id=""></p>
        <p>Repita a senha:</p>
        <p><input type="password" name="senha2" id=""></p>
        <p>Foto:</p>
        <p><input type="file" name="foto" id=""></p>
        <p><input type="submit" value="Registrar"></p>
    </form>
    <?php
        @session_start();
        if(isset($_SESSION['mensagem'])){
            echo $_SESSION['mensagem'];
            unset($_SESSION['mensagem']);
        }
    ?>

    <script>
        $('.sucesso,.erro').click(function (e) { 
            e.preventDefault();
            $(this).fadeOut(800);
        });
    </script>
</body>
</html>