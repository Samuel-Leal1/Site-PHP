<?php
    require "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        /* Resetando margens e padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilo geral do corpo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-top: 60px; /* Para deixar espaço para a barra superior */
        }

        /* Barra superior */
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

        /* Container principal da página */
        .content {
            padding: 30px;
            margin-top: 10px; /* Para ajustar o conteúdo abaixo da barra superior */
        }

        /* Container principal da página */
        .contentgrid {
            padding: 30px;
            margin-top: 5px; /* Para ajustar o conteúdo abaixo da barra superior */
        }

        /* Mensagem de boas-vindas */
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

        .welcome-message p {
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>

    <!-- Barra de navegação -->
     <?php include "menu.php";?>   

    <!-- Conteúdo principal -->
    <div class="content">
        <div class="welcome-message">
        <h2>Produtos</h2>
        </div>
    </div>
    <div class="contentgrid">
        <table border="1" align="center" width="100%">
            <tr>
                <th bgcolor="#CCCCCC"><input type="checkbox" name="todos"></th>
                <th bgcolor="#CCCCCC">idproduto</th>
                <th bgcolor="#CCCCCC">Nome</th>
                <th bgcolor="#CCCCCC">Preço</th>
                <th bgcolor="#CCCCCC">Status</th>
            </tr>
            <?php
            $resultado = pg_query($conn, "SELECT * FROM produto");
            while ($linha = pg_fetch_assoc($resultado)) {

                //print_r($linha);
            ?>
            <tr>
                <td><input type="checkbox" name="todos"></td>
                <td><?php echo $linha["idproduto"] ;?></td>
                <td><?php echo $linha["produtonome"] ;?></td>
                <td><?php echo $linha["produtopreco"] ;?></td>
                <td><?php
                if($linha["produtostatus"] == "t") echo "Ativo";
                else echo "Desativado"
                ?>
                </td>
            </tr>    
            <?php
            }
            ?>
        </table>
    </div>

</body>
</html>
