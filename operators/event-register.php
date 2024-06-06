<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_evento = bin2hex(random_bytes(2)) . '-' . bin2hex(random_bytes(2));
    $nome = $_POST['nome'];
    $nome_paciente = $_POST['nome_paciente'];
    $sexo = $_POST['sexo'];
    $leito = $_POST['leito'];
    $idade = $_POST['idade'];
    $tipo_incidente = $_POST['tipo_incidente'];
    $data_evento = $_POST['data_evento'];
    $local_evento = $_POST['local_evento'];
    $horario_evento = $_POST['horario_evento'];
    $descricao_evento = $_POST['descricao_evento'];
    $como_detectado = $_POST['como_detectado'];
    $acao_imediata = $_POST['acao_imediata'];

    $sql = "INSERT INTO adverse_events (
        codigo_evento, nome, nome_paciente, sexo, leito, idade, tipo_incidente, 
        data_evento, local_evento, horario_evento, descricao_evento, como_detectado, 
        acao_imediata
    ) VALUES (
        '$codigo_evento', '$nome', '$nome_paciente', '$sexo', '$leito', '$idade', '$tipo_incidente', 
        '$data_evento', '$local_evento', '$horario_evento', '$descricao_evento', '$como_detectado', 
        '$acao_imediata'
    )";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../redirect/success.html");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();