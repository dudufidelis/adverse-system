<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            header("Location: ../admin/index.php");
            exit;
        } else {
            echo "Senha inválida";
        }
    } else {
        echo "Usuário não encontrado";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
</head>
<body>
<div class="container">
        <header>
            <img src="../assets/logo.svg" alt="Logo Saine Health Complex">
            <h2>Area Administrativa</h2>
        </header>

        <form action="" method="post">
            <div class="input">
                <input placeholder="Usuario" type="text" id="nome_usuario" name="username" required>
            </div>
            <div class="input">
                <input placeholder="Senha" type="password" id="senha" name="password" required>
            </div>
            
        <?php if (isset($erro_login)): ?>
            <p style="color: red; padding: 1rem;"><?php echo $erro_login; ?></p>
        <?php endif; ?>

            <input type="submit">
        </form>
    </div>
</body>
</html>
