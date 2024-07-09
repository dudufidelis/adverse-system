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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Eventos Adversos</title>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="container">
        <header>
            <img src="../assets/saine-logo.png" alt="Logo Saine Health Complex">
            <h1>Área Administrativa</h1>
            <a href="../operators/logout.php">Sair</a>
        </header>

        <!-- Formulário de filtro -->
        <div class="filter-box">
            <form method="GET" action="">
                <div>
                    <label for="filter_code">Código do Evento:</label>
                    <input type="text" id="filter_code" name="filter_code" value="<?php echo $filter_code; ?>">
                </div>
                <div>
                    <label for="filter_date">Data do Evento:</label>
                    <input type="date" id="filter_date" name="filter_date" value="<?php echo $filter_date; ?>">
                </div>
                <button type="submit">Filtrar</button>
            </form>
        </div>

        <div class="records">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='record'>";
                echo "<p><strong>Código do Evento:</strong> " . $row["codigo_evento"] . "</p>";
                echo "<p><strong>Nome do Paciente:</strong> " . $row["nome_paciente"] . "</p>";
                echo "<p><strong>Sexo:</strong> " . $row["sexo"] . "</p>";
                echo "<p><strong>Leito:</strong> " . $row["leito"] . "</p>";
                echo "<p><strong>Idade:</strong> " . $row["idade"] . "</p>";
                echo "<p><strong>Tipo de Incidente:</strong> " . $row["tipo_incidente"] . "</p>";
                echo "<p><strong>Tipo de Evento:</strong> " . $row["tipo_evento"] . "</p>";
                echo "<p><strong>Data do Evento:</strong> " . $row["data_evento"] . "</p>";
                echo "<p><strong>Horário:</strong> " . $row["horario_evento"] . "</p>";
                echo "<p><strong>Local do Evento:</strong> " . $row["local_evento"] . "</p>";
                echo "<p><strong>Descrição:</strong> " . $row["descricao_evento"] . "</p>";
                echo "<p><strong>Como Detectado:</strong> " . $row["como_detectado"] . "</p>";
                echo "<p><strong>Ação Imediata:</strong> " . $row["acao_imediata"] . "</p>";
                echo "<p><strong>Análise da Causa:</strong> " . $row["analise_causa"] . "</p>";
                echo "<p><strong>Plano de Ação:</strong> " . $row["plano_acao"] . "</p>";
                echo "<p><strong>Responsáveis:</strong> " . $row["responsaveis"] . "</p>";
                echo "<p><strong>Prazo:</strong> " . $row["prazo"] . "</p>";
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

    // Determina a página atual
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

    echo "<div class='pagination'>";

    // Exibe a seta para a esquerda se não estiver na primeira página
    if ($current_page > 1) {
        $prev_page = $current_page - 1;
        echo "<a href='?page=$prev_page&filter_code=$filter_code&filter_date=$filter_date'>&laquo;</a>";
    }

    // Calcula o número inicial da página
    $start_page = max(1, $current_page - 1);

    // Exibe até três páginas
    for ($i = $start_page; $i <= min($start_page + 4, $total_pages); $i++) {
        echo "<a href='?page=$i&filter_code=$filter_code&filter_date=$filter_date'";
        if ($i == $current_page) {
            echo " style='color: #035980;";
        }
        echo ">$i</a>";
    }

    // Exibe a seta para a direita se não estiver na última página
    if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        echo "<a href='?page=$next_page&filter_code=$filter_code&filter_date=$filter_date'>&raquo;</a>";
    }

    echo "</div>";

    $conn->close();
?>


</body>

</html>