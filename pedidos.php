<?php
    require "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
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
        }
        .erro-query {
            color: #cc0000;
            padding: 15px;
            background: #fff0f0;
            border: 1px solid #ffcccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php include "menu.php"; ?>
    <div class="content">
        <div class="welcome-message">
            <h2>Pedidos</h2>
        </div>
    </div>
    <div class="contentgrid">
        <?php
        $resultado = pg_query($conn, "
            SELECT p.idpedido, pr.produtonome, u.username, 
                   p.pedidodata, p.pedidoquantidade, p.pedidostatus
            FROM public.pedido p
            JOIN public.produto pr ON pr.idproduto = p.idproduto
            JOIN public.usuario u ON u.idusuario = p.idusuario
            ORDER BY p.pedidodata DESC
        ");
        if (!$resultado) {
            echo '<p class="erro-query">Erro ao consultar pedidos: ' . pg_last_error($conn) . '</p>';
        } else {
        ?>
        <table border="1" align="center" width="100%">
            <tr>
                <th bgcolor="#CCCCCC"><input type="checkbox" name="todos"></th>
                <th bgcolor="#CCCCCC">idpedido</th>
                <th bgcolor="#CCCCCC">Produto</th>
                <th bgcolor="#CCCCCC">Usuário</th>
                <th bgcolor="#CCCCCC">Data</th>
                <th bgcolor="#CCCCCC">Quantidade</th>
                <th bgcolor="#CCCCCC">Status</th>
            </tr>
            <?php while ($linha = pg_fetch_assoc($resultado)) { ?>
            <tr>
                <td><input type="checkbox" name="todos"></td>
                <td><?php echo htmlspecialchars($linha["idpedido"]); ?></td>
                <td><?php echo htmlspecialchars($linha["produtonome"]); ?></td>
                <td><?php echo htmlspecialchars($linha["username"]); ?></td>
                <td><?php echo htmlspecialchars($linha["pedidodata"]); ?></td>
                <td><?php echo htmlspecialchars($linha["pedidoquantidade"]); ?></td>
                <td><?php echo ($linha["pedidostatus"] == "t") ? "Ativo" : "Cancelado"; ?></td>
            </tr>
            <?php } ?>
        </table>
        <?php } ?>
    </div>
</body>
</html>