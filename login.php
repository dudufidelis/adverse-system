<?php
session_start();
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            header("Location: admin/index.php");
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
<html>
<head>
    <title>Login Administrativo</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php include 'views/header.php'; ?>
    <h2>Login Administrativo</h2>
    <form method="post" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
    <?php include 'views/footer.php'; ?>
</body>
</html>
