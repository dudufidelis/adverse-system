<?php
// Atualizar credenciais do mysql e renomear arquivo db-template.php para db.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sys_adverse_events";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
