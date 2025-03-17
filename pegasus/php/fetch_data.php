<?php
require 'config.php';

$filters = [];
$params = [];

// Filtros
if (!empty($_GET['cnpj'])) {
    $cnpjList = explode(',', $_GET['cnpj']);
    $placeholders = implode(',', array_fill(0, count($cnpjList), '?'));
    $filters[] = "est.cnpj IN ($placeholders)";
    $params = array_merge($params, $cnpjList);
}

if (!empty($_GET['razao_social'])) {
    $filters[] = "emp.razao_social = ?";
    $params[] = $_GET['razao_social'];
}

if (!empty($_GET['situacao_cadastral'])) {
    $filters[] = "est.situacao_cadastral = ?";
    $params[] = $_GET['situacao_cadastral'];
}

if (!empty($_GET['cnae_fiscal'])) {
    $cnaeList = explode(',', $_GET['cnae_fiscal']);
    $placeholders = implode(',', array_fill(0, count($cnaeList), '?'));
    $filters[] = "est.cnae_fiscal IN ($placeholders)";
    $params = array_merge($params, $cnaeList);
}

if (!empty($_GET['uf'])) {
    $filters[] = "est.uf = ?";
    $params[] = $_GET['uf'];
}

if (!empty($_GET['municipio'])) {
    $filters[] = "mun.descricao = ?";
    $params[] = $_GET['municipio'];
}

// querys
$query = "
    SELECT est.cnpj, emp.razao_social, est.nome_fantasia, 
           TO_CHAR(emp.capital_social, 'FM999,999,999,999.0') AS capital_social,
           CASE
               WHEN est.situacao_cadastral = '01' THEN 'Nula'
               WHEN est.situacao_cadastral = '02' THEN 'Ativa'
               WHEN est.situacao_cadastral = '03' THEN 'Suspensa'
               WHEN est.situacao_cadastral = '04' THEN 'Inapta'
               WHEN est.situacao_cadastral = '08' THEN 'Baixada'
           END AS situacao_cadastral,
           TO_CHAR(NULLIF(est.data_inicio_atividades, '0')::DATE, 'DD/MM/YYYY') AS data_inicio_atividades,
           est.cnae_fiscal, cna.descricao,
           CASE
               WHEN est.matriz_filial = '1' THEN 'Matriz'
               WHEN est.matriz_filial = '2' THEN 'Filial'
           END AS matriz_filial,
           est.tipo_logradouro, est.logradouro,
           est.numero, est.complemento, est.bairro, est.cep,
           mun.descricao AS municipio, est.uf, est.ddd1, 
           est.telefone1, est.telefone2, est.correio_eletronico,
           cli.codigo_cliente, cli.razao_social AS cliente_razao_social, cli.filial
    FROM estabelecimento est
    LEFT JOIN empresa emp ON est.cnpj_basico = emp.cnpj_basico
    LEFT JOIN clientes cli ON est.cnpj = cli.cnpj
    LEFT JOIN cnae cna ON est.cnae_fiscal = cna.codigo
    LEFT JOIN municipio mun ON est.municipio = mun.codigo
";

if (!empty($filters)) {
    $query .= " WHERE " . implode(" AND ", $filters);
}

$query .= " LIMIT 50";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Adicionando a contagem de registros
$countQuery = "
     SELECT COUNT(*) FROM estabelecimento est
     LEFT JOIN empresa emp ON est.cnpj_basico = emp.cnpj_basico
     LEFT JOIN municipio mun ON est.municipio = mun.codigo
";
if (!empty($filters)) {
    $countQuery .= " WHERE " . implode(" AND ", $filters);
}
$countStmt = $pdo->prepare($countQuery);
$countStmt->execute($params);
$count = $countStmt->fetchColumn();

echo json_encode(['data' => $results, 'count' => $count]);
?>