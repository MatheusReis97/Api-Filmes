 <?php

include_once('conf.php');

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2TEU FILMES</title>
  <link rel="stylesheet" type="text/css" href="estilos/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-warning bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">
        <img src="imagens/logo.png" alt="Logo" style="width:25%">
        2TEU - FILMES
      </a>
      <form class="d-flex" method="post">
        <input class="form-control me-2" id="pesquisa" name="pesquisa" type="search" placeholder="Procure aqui" aria-label="Procure aqui">
        <button class="btn btn-outline-danger" style="background-color:red; color:white" type="submit">Buscar</button>
      </form>
    </div>
  </nav><br>

  <div class="container" style="text-align: center">
    <h2>Filmes</h2>
    <h4>Os grandes sucessos você encontra aqui!</h4>
    <h6>Utilize os modelos de buscar para encontrar os filmes desejados.</h6>
  </div>

  <div class="container">
    <div class="box">

      <img src="imagens/adao555.jpg" class="rounded mx-auto d-block" style="width: 450px;  height:450px ;" alt="...">


      <img src="imagens/wakanda2.jpg" class="rounded mx-auto d-block" style="width: 450px;  height:450px ;" alt="...">

      <img src="imagens/lilo.jpg" class="rounded mx-auto d-block" style="width: 450px;  height:450px ;" alt="...">
    </div>
  </div><br>


  <div class="container">
    <div>
      <form class="d-flex" method="post">
        <input class="form-control me-2" id="pesquisa" name="pesquisa" type="search" placeholder="Procure aqui" aria-label="Procure aqui">
        <button class="btn btn-outline-danger" style="background-color:yellow; color:blue" type="submit">Buscar</button><br><br>
    </div>

    <div class="container" style="align-items: center;">
      <div class="box" style=" display: flex; justify-content: center;">

        <input type="checkbox" id="28" name="Action" value="Ação">
        <label for="genero">Ação</label><br>
        <input type="checkbox" id="12" name="Adventure" value="Aventura">
        <label for="genero">Aventura</label><br>
        <input type="checkbox" id="16" name="Animation" value="Animação">
        <label for="genero">Animação</label>
        <input type="checkbox" id="35" name="Comedy" value="Comédia">
        <label for="genero">Comédia</label>
        <input type="checkbox" id="80" name="Crime" value="Crime">
        <label for="genero">Crime</label>
        <input type="checkbox" id="27" name="Horror" value="Terror">
        <label for="genero">Terror</label>
        <input type="checkbox" id="10749" name="Romance" value="Romance">
        <label for="genero">Romance</label>
        <input type="checkbox" id="878" name="Science Fiction" value="Ficção Científica">
        <label for="genero">Ficção Científica</label>
        <input type="checkbox" id="36" name="History" value="História">
        <label for="genero">História</label>
      </div>
    </div>
    </form>
  </div>




  <div class="container text-center">
    <div class='row'>

      <?php

      if (isset($_POST['pesquisa'])) {

        $APIKEY = "c7ab045a7a61bb551d1eea508a6d67c2";

        $search = $_POST['pesquisa'];

        $url = "http://api.themoviedb.org/3/search/movie?query={$search}&api_key={$APIKEY}&language=pt-BR";
        $json = file_get_contents($url);
        $obj = json_decode($json);

        $total_pages = $obj->total_pages;


        for ($x = 1; $x <= $total_pages; $x++) {

          $url_single = "http://api.themoviedb.org/3/search/movie?query={$search}&api_key={$APIKEY}&language=pt-BR&page={$x}";
          $json_single = file_get_contents($url_single);
          $obj_single = json_decode($json_single);

          foreach ($obj_single->results as $resultado) {

            echo " 
        
<div class='card' style='width: 25rem; margin:10px;'>
  <img src='https://image.tmdb.org/t/p/original/$resultado->poster_path' class='card-img-top' alt='$resultado->title'>
  <div class='card-body '>
    <h5 class='card-title'>$resultado->title</h5>
    <p class='card-text'>$resultado->overview</p>
    <a href='#' class='btn btn-primary' style='width:100%; justify-content:center;';>Verificar</a><br>
  </div>
</div>


";
          }
        }
      }

      // else {
        
      //   $_POST['Action'] = ( isset($_POST['Action']) ) ? true : null;
      //   $_POST['Adventure']  = ( isset($_POST['Adventure']) )  ? true : null;
      //   $_POST['Animation']  = ( isset($_POST['Animation']) )  ? true : null;
      //   $_POST['Comedy']  = ( isset($_POST['Comedy']) )  ? true : null;
      //   $_POST['Crime']  = ( isset($_POST['Crime']) )  ? true : null;
      //   $_POST['Horror']  = ( isset($_POST['Horror']) )  ? true : null;
      //   $_POST['Romance']  = ( isset($_POST['Romance']) )  ? true : null;
      //   $_POST['Science Fiction']  = ( isset($_POST['Science Fiction']) )  ? true : null;
      //   $_POST['History']  = ( isset($_POST['History']) )  ? true : null;

      //   var_dump($_POST);
        
      //   $genero = var_dump($_POST);

        

      // }

      ?>


    </div>
  </div>


</body>

</html>