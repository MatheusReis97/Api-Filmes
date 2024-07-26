<?php
session_start(); // Inicie a sessão para armazenar resultados

if (isset($_POST['pesquisa'])) {

    
    $_SESSION['pesquisado'] = $_POST['pesquisa'];

    $APIKEY = "bb00c0fa93d63563a61b1eb6a4a1df7d";
    $search = urlencode($_POST['pesquisa']);

    $url = "http://api.themoviedb.org/3/search/movie?query={$search}&api_key={$APIKEY}&language=pt-BR";
    $json = file_get_contents($url);
    $obj = json_decode($json);

    $total_pages = $obj->total_pages;
    $results = [];

    for ($x = 1; $x <= $total_pages; $x++) {
        $url_single = "http://api.themoviedb.org/3/search/movie?query={$search}&api_key={$APIKEY}&language=pt-BR&page={$x}";
        $json_single = file_get_contents($url_single);
        $obj_single = json_decode($json_single);

        foreach ($obj_single->results as $resultado) {
            $results[] = $resultado;
        }
    }

    // Armazena os resultados na sessão
    $_SESSION['results'] = $results;

    // Redireciona de volta para a página principal
    header("Location: /index.php");
    exit();
}
