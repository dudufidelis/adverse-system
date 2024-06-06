<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash da senha usando bcrypt

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Administrador</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
        <header>
            <img src="../assets/logo.svg" alt="Logo Saine Health Complex">
            <h2>Cadastro de Administrador</h2>
        </header>
        <form method="post" action="">
            <div class="input">
                <input type="text" placeholder="Usuário" name="username" required>
            </div>

            <div class="input">
                <input type="password" placeholder="Senha" name="password" required>
            </div>

            <input type="submit" value="Cadastrar">
        </form>
        </div>
</body>
</html>
