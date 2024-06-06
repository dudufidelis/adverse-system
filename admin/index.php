<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../auth/login.php");
    exit;
}

include '../config/db.php';

// Definições de paginação
$records_per_page = 1;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;

// Definições de filtro
$filter_code = isset($_GET['filter_code']) ? $_GET['filter_code'] : '';
$filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';

// Query base
$sql = "SELECT * FROM adverse_events";

// Aplicar filtros
if (!empty($filter_code)) {
    $sql .= " WHERE codigo_evento LIKE '%$filter_code%'";
}

if (!empty($filter_date)) {
    $sql .= empty($filter_code) ? " WHERE" : " AND";
    $sql .= " data_evento = '$filter_date'";
}

$sql .= " ORDER BY data_evento DESC LIMIT $start_from, $records_per_page";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Área Administrativa</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        .record {
            border: 1px solid #000;
            margin-bottom: 10px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h2>Registros de Eventos Adversos</h2>

    <!-- Formulário de filtro -->
    <form method="GET" action="">
        <label for="filter_code">Código do Evento:</label>
        <input type="text" id="filter_code" name="filter_code" value="<?php echo $filter_code; ?>">
        <label for="filter_date">Data do Evento:</label>
        <input type="date" id="filter_date" name="filter_date" value="<?php echo $filter_date; ?>">
        <button type="submit">Filtrar</button>
    </form>

    <div class="records">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='record'>";
                echo "<p><strong>Código do Evento:</strong> " . $row["codigo_evento"] . "</p>";
                echo "<p><strong>Nome:</strong> " . $row["nome"] . "</p>";
                echo "<p><strong>Nome do Paciente:</strong> " . $row["nome_paciente"] . "</p>";
                echo "<p><strong>Sexo:</strong> " . $row["sexo"] . "</p>";
                echo "<p><strong>Leito:</strong> " . $row["leito"] . "</p>";
                echo "<p><strong>Idade:</strong> " . $row["idade"] . "</p>";
                echo "<p><strong>Tipo de Incidente:</strong> " . $row["tipo_incidente"] . "</p>";
                echo "<p><strong>Data do Evento:</strong> " . $row["data_evento"] . "</p>";
                echo "<p><strong>Local do Evento:</strong> " . $row["local_evento"] . "</p>";
                echo "<p><strong>Horário:</strong> " . $row["horario_evento"] . "</p>";
                echo "<p><strong>Descrição:</strong> " . $row["descricao_evento"] . "</p>";
                echo "<p><strong>Como Detectado:</strong> " . $row["como_detectado"] . "</p>";
                echo "<p><strong>Ação Imediata:</strong> " . $row["acao_imediata"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhum registro encontrado</p>";
        }
        ?>
    </div>

    <!-- Paginação -->
    <?php
    
    $sql = "SELECT COUNT(*) AS total_records FROM adverse_events";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_records = $row['total_records'];
    $total_pages = ceil($total_records / $records_per_page);

    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=$i&filter_code=$filter_code&filter_date=$filter_date'>$i</a>";
    }
    echo "</div>";

    $conn->close();
    ?>

    <br>
    <a href="../operators/logout.php">Logout</a>
</body>
</html>
