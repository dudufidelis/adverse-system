<?php
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_evento = md5(time());
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
        echo "Evento adverso registrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">>
    <title>Eventos Adversos | Saine</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-logo">
                <img src="assets/logo.svg" alt="Logo sistema adversos">
            </div>
            <div class="header-description">
                <div class="header-bar"></div>
                <div class="header-text">
                    <p>A Segurança está em cada detalhe <br> e depende da colaboração de todos</p>
                </div>
                <div class="header-bar"></div>
            </div>
        </div>

        <div class="register-title">
            <h2>Registro do evento:</h2>
        </div>
  
        <form method="post" action="">

            <label>Nome (opcional)</label>
            <input type="text" name="nome">

            <label>Nome do Paciente:</label>
            <input type="text" name="nome_paciente" required>

            <label>Sexo:</label>
            <select name="sexo" required>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
            </select>

            <label>Leito:</label>
            <input type="text" name="leito" required>

            <label>Idade:</label>
            <input type="number" name="idade" required>

            <label>Tipo de Evento:</label>
            <select name="tipo_incidente" required>
                <option value="Associados à produto de saúde">Associados à produto de saúde</option>
                <option value="Relacionado à cadeia medicamentosa">Relacionado à cadeia medicamentosa</option>
                <option value="Broricoaspiração">Broricoaspiração</option>
                <option value="Relacionados ao ato cirúrgico">Relacionados ao ato cirúrgico</option>
                <option value="Falha no cuidado">Falha no cuidado</option>
                <option value="TEV-Tromboembolismo venoso">TEV-Tromboembolismo venoso</option>
                <option value="Infecção do sitio cirúrgico">Infecção do sitio cirúrgico</option>
                <option value="Queda">Queda</option>
                <option value="Outro">Outro</option>
            </select>

            <label></label>Data do Evento:</label>
            <input type="date" name="data_evento" required>

            <label>Local onde ocorreu o evento adverso:</label>
            <input type="text" name="local_evento" required>

            <label>Horário:</label>
            <input type="time" name="horario_evento" required>

            <label>Descreva o evento adverso:</label>
            <textarea name="descricao_evento" required></textarea>

            <label>Como o evento foi detectado:</label>
            <select name="como_detectado" required>
                <option value="Auditoria OPME">Auditoria OPME</option>
                <option value="Contato com paciente">Contato com paciente</option>
                <option value="Gerenciamento de entregas e demandas">Gerenciamento de entregas e demandas</option>
                <option value="Prontuário do paciente">Prontuário do paciente</option>
                <option value="Outro">Outro</option>
            </select>

            <label>Ação imediata realizada:</label>
            <textarea name="acao_imediata" required></textarea>

            <input type="submit" value="Enviar">
        </form>
    </div>
</body>

</html>