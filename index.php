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
<html>
<head>
    <title>Registro de Evento Adverso</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php include 'views/header.php'; ?>
    <h2>Registro de Evento Adverso</h2>
    <form method="post" action="">

        <label>Nome (opcional)</label><br>
        <input type="text" name="nome"><br><br>

        <label>Nome do Paciente:</label><br>
        <input type="text" name="nome_paciente" required><br><br>

        <label>Sexo:</label><br>
        <select name="sexo" required>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
        </select><br><br>

        <label>Leito:</label><br>
        <input type="text" name="leito" required><br><br>

        <label>Idade:</label><br>
        <input type="number" name="idade" required><br><br>

        <label>Tipo de Evento:</label><br>
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
        </select><br><br>

        <label></label>Data do Evento:</label><br>
        <input type="date" name="data_evento" required><br><br>

        <label>Local onde ocorreu o evento adverso:</label><br>
        <input type="text" name="local_evento" required><br><br>

        <label>Horário:</label><br>
        <input type="time" name="horario_evento" required><br><br>

        <label>Descreva o evento adverso:</label><br>
        <textarea name="descricao_evento" required></textarea><br><br>

        <label>Como o evento foi detectado:</label><br>
        <select name="como_detectado" required>
            <option value="Auditoria OPME">Auditoria OPME</option>
            <option value="Contato com paciente">Contato com paciente</option>
            <option value="Gerenciamento de entregas e demandas">Gerenciamento de entregas e demandas</option>
            <option value="Prontuário do paciente">Prontuário do paciente</option>
            <option value="Outro">Outro</option>
        </select><br><br>

        <label>Ação imediata realizada:</label><br>
        <textarea name="acao_imediata" required></textarea><br><br>

        <input type="submit" value="Enviar">
    </form>
    <?php include 'views/footer.php'; ?>
</body>
</html>
