<?php include('head.php'); ?>
<body>
<?php include('menu.php'); ?>

    <form action="login.act.php" method="post" class=formAdd enctype="multipart/form-data">
        <h1>Entrar</h1>
        <p>Email:</p>
        <p><input type="email" name="email" id=""></p>
        <p>Senha:</p>
        <p><input type="password" name="senha1" id=""></p>
        <p><input type="submit" value="Entrar"></p>
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