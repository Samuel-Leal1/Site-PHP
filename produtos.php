<?php
    require "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 60px;
        }
        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar .logo {
            margin-left: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .navbar nav {
            margin-right: 20px;
        }
        .navbar nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 16px;
            transition: color 0.3s;
        }
        .navbar nav a:hover {
            color: #4CAF50;
        }
        .content {
            padding: 30px;
            margin-top: 10px;
        }
        .contentgrid {
            padding: 30px;
            margin-top: 5px;
        }
        .welcome-message {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .welcome-message h2 {
            font-size: 24px;
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table th, table td {
            padding: 8px 12px;
            text-align: left;
            vertical-align: middle;
        }
        .erro-query {
            color: #cc0000;
            padding: 15px;
            background: #fff0f0;
            border: 1px solid #ffcccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .msg-ok {
            color: #006600;
            padding: 15px;
            background: #f0fff0;
            border: 1px solid #ccffcc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .foto-produto {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .sem-foto {
            width: 60px;
            height: 60px;
            background-color: #ddd;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            font-size: 11px;
            color: #888;
            text-align: center;
        }
        .form-upload {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .form-upload input[type="file"] {
            font-size: 12px;
            max-width: 160px;
        }
        .btn-upload {
            padding: 4px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        .btn-upload:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include "menu.php"; ?>

    <div class="content">
        <div class="welcome-message">
            <h2>Produtos</h2>
        </div>
    </div>

    <div class="contentgrid">

        <?php if (isset($_GET["msgerro"])): ?>
            <p class="erro-query"><?php echo htmlspecialchars($_GET["msgerro"]); ?></p>
        <?php endif; ?>

        <?php if (isset($_GET["msgok"])): ?>
            <p class="msg-ok"><?php echo htmlspecialchars($_GET["msgok"]); ?></p>
        <?php endif; ?>

        <?php
        $resultado = pg_query($conn, "SELECT * FROM public.produto ORDER BY idproduto");
        if (!$resultado) {
            echo '<p class="erro-query">Erro ao consultar produtos: ' . pg_last_error($conn) . '</p>';
        } else {
        ?>
        <table border="1" align="center" width="100%">
            <tr>
                <th bgcolor="#CCCCCC"><input type="checkbox" name="todos"></th>
                <th bgcolor="#CCCCCC">idproduto</th>
                <th bgcolor="#CCCCCC">Foto</th>
                <th bgcolor="#CCCCCC">Nome</th>
                <th bgcolor="#CCCCCC">Preço</th>
                <th bgcolor="#CCCCCC">Status</th>
                <th bgcolor="#CCCCCC">Atualizar Foto</th>
            </tr>
            <?php while ($linha = pg_fetch_assoc($resultado)) { ?>
            <tr>
                <td><input type="checkbox" name="todos"></td>
                <td><?php echo htmlspecialchars($linha["idproduto"]); ?></td>
                <td>
                    <?php if (!empty($linha["produtofoto"])): ?>
                        <img class="foto-produto"
                             src="uploads/<?php echo htmlspecialchars($linha["produtofoto"]); ?>"
                             alt="<?php echo htmlspecialchars($linha["produtonome"]); ?>">
                    <?php else: ?>
                        <span class="sem-foto">Sem foto</span>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($linha["produtonome"]); ?></td>
                <td>R$ <?php echo number_format($linha["produtopreco"], 2, ',', '.'); ?></td>
                <td><?php echo ($linha["produtostatus"] == "t") ? "Ativo" : "Desativado"; ?></td>
                <td>
                    <form class="form-upload" action="upload_produto.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idproduto" value="<?php echo $linha["idproduto"]; ?>">
                        <input type="file" name="foto" accept="image/*" required>
                        <button type="submit" class="btn-upload">Enviar</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
        <?php } ?>
    </div>
</body>
</html>
