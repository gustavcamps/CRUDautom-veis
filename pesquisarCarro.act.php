<?php

        $texto = "%".$_GET['txt']."%";


        $host   = "localhost";
        $bd     = "bd_carros";
        $user   = "root";
        $pass   = '';
        $charset= 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$bd;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES  =>  false,   
        ];

        try{
            $pdo = new PDO($dsn,$user,$pass,$options);
            $limite = 4;
            $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            if($pagina < 1){ $pagina = 1;}
            $offset = ($pagina - 1) * $limite;

            $stmtTotal = $pdo->query("Select COUNT(*) from tb_carros where modelo like '$texto'");
            $totalRegistros = $stmtTotal->fetchColumn();
            $totalPaginas = ceil($totalRegistros / $limite);

            $query = "Select * from tb_carros WHERE modelo like :texto ORDER BY codigo DESC LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':limit',$limite,PDO::PARAM_INT);
            $stmt->bindValue(':offset',$offset,PDO::PARAM_INT);
            $stmt->bindParam(':texto',$texto);
            $stmt->execute();

            echo "<div class='cards'>";
                while($linha = $stmt->fetch()){
                    echo "<div>";
                        echo "<p>$linha[montadora]</p>";
                        echo "<h1>$linha[modelo]</h1>";
                        echo "<p>$linha[ano_fabricacao]</p>";
                        echo "<p>$linha[ano_modelo]</p>";
                        echo "<p>$linha[motorizacao]</p>";
                        echo "<p>$linha[cor]</p>";
                        echo "<p><img src=$linha[foto]></p>";
                        echo "<div class='botoes'>";
                            echo "<a href=alterarCarro.php?registro=$linha[codigo]>Alterar</a>";
                            echo "<a href=javascript:excluir($linha[codigo])>Excluir</a>";
                        echo "</div>";
                    echo "</div>";
                }
            echo "</div>";

            echo "<div class=paginacao>";
            $texto = str_replace('%','',$texto);
            for($p=1;$p<=$totalPaginas;$p++){
                if($p == $pagina){
                    echo "<a href=pesquisarCarro.php?texto=$texto&pagina=$p class=ativo>$p</a>";    
                }else{
                    echo "<a href=pesquisarCarro.php?texto=$texto&pagina=$p>$p</a>";
                }
            }
                
        echo "</div>";
            
        }catch(PDOException $e){
            echo "Erro de conexão " . $e->getMessage();
        }

        
       
    ?>