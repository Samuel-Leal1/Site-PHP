<?php
require "conexao.php";

if (isset($_POST["idproduto"]) && isset($_FILES["foto"])) {
    $idproduto = pg_escape_string($conn, $_POST["idproduto"]);
    $arquivo = $_FILES["foto"];

    // Validações
    $extensoesPermitidas = ["jpg", "jpeg", "png", "gif", "webp"];
    $extensao = strtolower(pathinfo($arquivo["name"], PATHINFO_EXTENSION));
    $tamanhoMaximo = 2 * 1024 * 1024; // 2MB

    if (!in_array($extensao, $extensoesPermitidas)) {
        header("Location: produtos.php?msgerro=Formato inválido. Use JPG, PNG, GIF ou WEBP.");
        exit();
    }

    if ($arquivo["size"] > $tamanhoMaximo) {
        header("Location: produtos.php?msgerro=Imagem muito grande. Máximo 2MB.");
        exit();
    }

    // Gera nome único para evitar conflitos
    $nomeArquivo = "produto_" . $idproduto . "_" . time() . "." . $extensao;
    $destino = __DIR__ . "/uploads/" . $nomeArquivo;

    if (move_uploaded_file($arquivo["tmp_name"], $destino)) {
        $resultado = pg_query($conn, "UPDATE public.produto SET produtofoto = '$nomeArquivo' WHERE idproduto = '$idproduto'");
        if ($resultado) {
            header("Location: produtos.php?msgok=Foto atualizada com sucesso!");
        } else {
            header("Location: produtos.php?msgerro=Erro ao salvar no banco: " . pg_last_error($conn));
        }
    } else {
        header("Location: produtos.php?msgerro=Erro ao fazer upload da imagem.");
    }
    exit();
}

header("Location: produtos.php");
exit();
?>