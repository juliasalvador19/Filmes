<?php
session_start();
include_once("../BANCO/conexao.php");

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_STRING);
$resumo = filter_input(INPUT_POST, 'resumo', FILTER_SANITIZE_STRING);
$complementos = filter_input(INPUT_POST, 'complementos', FILTER_SANITIZE_STRING);

// echo "Código: $codigo <br>";
// echo "Nome: $nome <br>";
// echo "Ano: $ano <br>";
// echo "Resumo: $resumo <br>";
// echo "Complementos: $complementos <br>";

$result_filmes = "UPDATE filmes SET nome='$nome', ano='$ano', resumo='$resumo', complementos='$complementos' where codigo='$id'";
$resultado_filmes = mysqli_query($conn, $result_filmes);

if (mysqli_affected_rows($conn)){
    $_SESSION['msg'] = "<em style='color: green;'> &nbsp;&nbsp; Filme alterado com sucesso!</em>";
    header("Location: ../CONSULTAR/consultar_filmes.php");
} else{
    $_SESSION['msg'] = "<em style='color: red;'> &nbsp;&nbsp; Nenhum registro foi alterado!</em>";
    header("Location: alterar_filmes.php?id=$id");
}