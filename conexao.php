<?php
session_start();

if(isset($_POST["username"])) $_SESSION["username"] = $_POST["username"];
if(isset($_POST["password"])) $_SESSION["password"] = $_POST["password"];
if(isset($_GET["tentativa"])) $_SESSION["tentativa"] = $_GET["tentativa"];

//print_r($_SESSION);

$conn = pg_connect("host=localhost dbname=produtos user=postgres password=123456");
if (!$conn) {
    echo "Erro na conexão com o banco de dados.";
}

$resultado = pg_query($conn, "SELECT * FROM usuario Where username='" . $_SESSION["username"] . "' and password='" . $_SESSION["password"] . "' ");
if ($linha = pg_fetch_assoc($resultado)) {
    //echo "Nome: " . $linha['username'] . "<br>";
}
else
{
    header("Location: login.php?msgerro=deu ruim!");
    exit();
}

?>
