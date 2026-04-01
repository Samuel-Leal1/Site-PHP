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
            margin-top: 60px; /* Para ajustar o conteúdo abaixo da barra superior */
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
            <h2>Bem-vindo, <?php echo $_SESSION["username"];?></h2>
            <h2>Tentativas = <?php	   echo $_SESSION["tentativa"];?></h2>
        </div>
    </div>

</body>
</html>
