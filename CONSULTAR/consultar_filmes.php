<?php
    session_start();
    include_once("../BANCO/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Julia Salvador">
    <title>Consultar filmes</title>

    <!-- Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_consultar.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="btn btn-outline-dark btn-sm" href="consultar_filmes.php">
            Consultar
        </a>
        <a class="btn btn-outline-dark btn-sm" href="../CADASTRAR/cadastrar_filmes.php">
            Cadastrar
        </a>
    </nav>
    
    <table class="table table-striped table-bordered table-condensed table-hover">
        <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }

            echo
            "<h4>Filmes</h4>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Ano</th>
                    <th>Resumo</th>
                    <th>Complementos</th>
                    <th colspan='2'>Opções</th>
                </tr>
            </thead>
            <tbody>";

                //Receber o número da página
                $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
                $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

                //Setar a quantidade de itens por página
                $qnt_result_pg = 2;

                //Calcular inicio da visualização
                $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

                $result_filmes = "SELECT * FROM filmes LIMIT $inicio, $qnt_result_pg";
                $resultado_filmes = mysqli_query($conn, $result_filmes);
                
                while($row_filme = mysqli_fetch_assoc($resultado_filmes)){
                    extract($row_filme);
                    echo 
                    "<tr>
                        <td>
                            $codigo
                        </td>
                        <td>
                            $nome
                        </td>
                        <td>
                            $ano
                        </td>
                        <td>
                            $resumo
                        </td>
                        <td>
                            $complementos
                        </td>
                        <td>
                            <a class='btn btn-outline-dark btn-sm' href='../ALTERAR/alterar_filmes.php?id=" . $row_filme['codigo'] . "'>Alterar</a>    
                        </td>
                        <td>
                                <a class='btn btn-outline-dark btn-sm' href='../DELETAR/processar_deletar.php?id=" . $row_filme['codigo'] . "' data-confirm='Tem certeza de que deseja deletar o registro?'>Deletar</a>    
                        </td>
                    </tr>";
                }

            "</tbody>"
        ?>
    </table>
    <div>
        <?php
        
            //Paginação
            $result_paginacao = "SELECT COUNT(codigo) AS num_result FROM filmes";
            $resultado_paginacao = mysqli_query($conn, $result_paginacao);
            $row_paginacao = mysqli_fetch_assoc($resultado_paginacao);
            $quantidade_pagina = ceil($row_paginacao['num_result'] / $qnt_result_pg);
            $max_links = 2;
            
            echo "<a class='btn btn-outline-dark btn-sm' href='consultar_filmes.php?pagina=1'>Primeira</a>";

            for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
                if($pag_ant >= 1 ){
                    echo "<a class='btn btn-outline-dark btn-sm' href='consultar_filmes.php?pagina=$pag_ant'>$pag_ant</a>";
                }
            }

            echo "<a class='btn btn-outline-dark btn-sm' href='consultar_filmes.php?pagina=$pagina'>$pagina</a>";

            for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
                if($pag_dep <= $quantidade_pagina){
                    echo "<a class='btn btn-outline-dark btn-sm' href='consultar_filmes.php?pagina=$pag_dep'>$pag_dep</a>";
                }
            }            

            echo "<a class='btn btn-outline-dark btn-sm' href='consultar_filmes.php?pagina=$quantidade_pagina'>Última</a>";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
        <script src="../JS/personalizado.js"></script>
    </div>
</body>
</html>