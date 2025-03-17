<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegasus</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="images/pegasus_ico.png">
</head>

<body>
    <header>
        <img id="header-image" src="images/pegasus.png" alt="Pegasus">
        <h1></h1>
    </header>
    <form id="filterForm">
        <input type="text" name="cnpj" placeholder="CNPJ (separado por vírgula)">
        <input type="text" name="razao_social" placeholder="Razão Social">
        <select name="situacao_cadastral">
            <option value="">Selecione a Situação Cadastral</option>
            <option value="01">Nula</option>
            <option value="02">Ativa</option>
            <option value="03">Suspensa</option>
            <option value="04">Inapta</option>
            <option value="08">Baixada</option>
        </select>
        <input type="text" name="cnae_fiscal" placeholder="CNAE (separado por vírgula)">
        <select name="uf">
            <option value="">Selecione o Estado - UF</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
        </select>
        <input type="text" name="municipio" placeholder="Cidade">
        <button type="submit">Realizar Consulta</button>
        <button type="button" id="clearFilters">Limpar Filtros</button>
        <!--<a id="exportExcel" href="#">Baixar Resultados em Excel</a>-->
    </form>
    <br>
    <a id="header-link" href="https://arquivos.receitafederal.gov.br/dados/cnpj/dados_abertos_cnpj/"
        target="_blank"><b>Fonte dos Dados Originais</b> - receitafederal.gov.br | Última atualização da Receita
        Federal: <b>2025-02-08 22:41</b></a><br>
    <br>
    <div id="statusMessage"></div>
    <br>
    <div id="recordCount"></div>
    <table id="resultsTable"></table>

    <footer>
        © 2025 - Grupo Gagliardi - Todos os direitos reservados.
    </footer>

    <script src="js/script.js"></script>
</body>

</html>