<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_evento = uniqid();
    $nome_paciente = $_POST['nome_paciente'];
    $sexo = $_POST['sexo'];
    $leito = $_POST['leito'];
    $idade = $_POST['idade'];
    $tipo_incidente = $_POST['tipo_incidente'];
    $tipo_evento = $_POST['tipo_evento'];
    $data_evento = $_POST['data_evento'];
    $horario_evento = $_POST['horario_evento'];
    $local_evento = $_POST['local_evento'];
    $descricao_evento = $_POST['descricao_evento'];
    $como_detectado = $_POST['como_detectado'];
    $acao_imediata = $_POST['acao_imediata'];
    $analise_causa = $_POST['analise_causa'];
    $plano_acao = $_POST['plano_acao'];
    $responsaveis = $_POST['responsaveis'];
    $prazo = $_POST['prazo'];

    $sql = "INSERT INTO adverse_events (
        codigo_evento, nome_paciente, sexo, leito, idade, tipo_incidente, tipo_evento, 
        data_evento, horario_evento, local_evento, descricao_evento, como_detectado, 
        acao_imediata, analise_causa, plano_acao, responsaveis, prazo
    ) VALUES (
        '$codigo_evento', '$nome_paciente', '$sexo', '$leito', '$idade', '$tipo_incidente', '$tipo_evento', 
        '$data_evento', '$horario_evento', '$local_evento', '$descricao_evento', '$como_detectado', 
        '$acao_imediata', '$analise_causa', '$plano_acao', '$responsaveis', '$prazo'
    )";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../redirect/success.html");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
