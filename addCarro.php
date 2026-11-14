<?php include('head.php'); ?>
<body>
<?php include('menu.php'); ?>

    <form action="addCarro.act.php" method="post" class=formAdd enctype="multipart/form-data">
        <h1>Adicionar Veículo</h1>
        <p>Modelo:</p>
        <p><input type="text" name="modelo" id=""></p>
        <p>Montadora:</p>
        <p><input type="text" name="montadora" id=""></p>
        <p>Ano de Fabricação</p>
        <p><input type="number" name="anoFabricacao" id=""></p>
        <p>Ano do Modelo:</p>
        <p><input type="number" name="anoModelo" id=""></p>
        <p>Cor:</p>
        <p><input type="text" name="cor" id=""></p>
        <p>Motorização:</p>
        <p><input type="text" name="motorizacao" id=""></p>
        <p>Foto:</p>
        <p><input type="file" name="foto" id=""></p>
        <p><input type="submit" value="Gravar"></p>
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