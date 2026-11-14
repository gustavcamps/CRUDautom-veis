<?php include('head.php'); ?>
<body>
    <?php include('menu.php'); ?>
    <div class="txtPesquisar">
        <label for="txtPesquisar">Digite o modelo do veículo</label>
        <input type="text" name="txtPesquisa" id="txtPesquisar" onkeyup="pesquisar(this.value,1)">
    </div>
    <div id="retorno"></div>
    <script>
        function pesquisar(texto,pagina){
            $.ajax({
                type: "get",
                url: "pesquisarCarro.act.php?txt="+texto+"&pagina="+pagina,
                success: function (response) {
                    $('#retorno').html(response);
                }
            });
        }
        function excluir(codigo){
            let resposta = confirm("Confirma excluir o registro "+codigo+"?");
            if(resposta == true){
                //executar o ajax
                $.ajax({
                    type: "post",
                    url: "excluirCarro.php?cod="+codigo,
                    data: [cod=codigo],
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    }
                });
            }
        }
    </script>

    <?php
        if(isset($_GET['pagina'])){
            echo "<script>pesquisar(\"$_GET[texto]\",$_GET[pagina]);</script>";
        }

    ?>
    <script>
        window.history.replaceState({}, document.title, window.location.pathname);
    </script>
</body>
