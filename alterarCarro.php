<?php include('head.php'); ?>
<body>
<?php include('menu.php'); ?>
    <?php
        require_once('connect.php');
        $pdo = new PDO($dsn,$user,$pass,$options);
        $codigo = $_GET['registro'] ?? '';
        if($codigo == '' || $codigo == null){
            header("location:listarCarros.php");
        }
        $query = "Select * from tb_carros where codigo = :codigo";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':codigo' => $codigo]);
        $carro = $stmt->fetch();
    ?>
    <form action="alterarCarro.act.php" method="post" class=formAdd enctype="multipart/form-data">
        <input type="hidden" name="codigo" value="<?php echo $carro['codigo']; ?>">
        <input type="hidden" name="destino" value="<?php echo $carro['foto']; ?>">
        <h1>Alterar Veículo</h1>
        <p>Modelo:</p>
        <p><input type="text" name="modelo" value="<?php echo $carro['modelo']; ?>" id=""></p>
        <p>Montadora:</p>
        <p><input type="text" name="montadora" value="<?php echo $carro['montadora']; ?>" id=""></p>
        <p>Ano de Fabricação</p>
        <p><input type="number" name="anoFabricacao" value="<?php echo $carro['ano_fabricacao']; ?>" id=""></p>
        <p>Ano do Modelo:</p>
        <p><input type="number" name="anoModelo" value="<?php echo $carro['ano_modelo']; ?>" id=""></p>
        <p>Cor:</p>
        <p><input type="text" name="cor" value="<?php echo $carro['cor']; ?>" id=""></p>
        <p>Motorização:</p>
        <p><input type="text" name="motorizacao" value="<?php echo $carro['motorizacao']; ?>" id=""></p>
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