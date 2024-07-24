<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2TEU FILMES</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="home.php">
        <img src="imagens/logo.png" alt="Logo" style="width:25%">
        FILMOTECA
      </a>
      <form class="d-flex" method="post">
        <input class="form-control me-2" id="pesquisa" name="pesquisa" type="search" placeholder="Procure aqui" aria-label="Procure aqui">
        <button class="btn btn-outline-danger" style="background-color:red; color:white" type="submit">Buscar</button>
      </form>
    </div>
  </nav>
  <br>

  <div class="container chamadinha" style="text-align: center">
    <h1>FILMOTECA</h1>
    <h4>Os grandes sucessos encontram-se aqui!</h4>
    <h6>Utilize os modelos de buscar para encontrar os filmes desejados.</h6>
  </div>

  <div class="container">
  <div class="row imagem-chamada">
    <div class="col">
      <img src="https://s2-g1.glbimg.com/k6J0DsMl3_w3evhEsSfoP4348Tg=/0x0:1080x1350/1008x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2024/4/m/NsJJlvTLCRvEs8KBowrw/deadpool-e-wolverine-cartaz.jpg" alt="">
    </div>
    <div class="col">
      <img src="https://www.cinesercla.com.br/Uploads/upload/f7693880-e662-4d13-85c1-7a5fef1d42f9.jpeg" alt="">
    </div>
    <div class="col">
     <img src="https://www.claquete.com.br/fotos/filmes/poster/15920_medio.jpg" alt="">
    </div>
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
      

       include_once('conf/conf.php');
       
       

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

            return " 
        
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

     
      ?>


    </div>
  </div>


</body>

</html>