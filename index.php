<?php
session_start(); // Inicie a sessão para acessar os resultados  

include 'php/formatar.php';

if (isset($_GET['reset']) && $_GET['reset'] === 'true') {
    unset($_SESSION['results']);
    unset($_SESSION['pesquisado']); 
    header("Location: index.php");
    exit();
}

 $verificador = 0;  
// Verifica se há resultados armazenados na sessão
if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];
    // unset($_SESSION['results']);
    $verificador = 1;
} else {
    $results = [];
   
}

$results_por_page = 12;

// Pega a página atual da URL ou define como 1 se não estiver definida
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calcula o índice inicial e final dos resultados a serem exibidos
$start_index = ($page - 1) * $results_por_page;
$end_index = min($start_index + $results_por_page, count($results));

// Pega apenas os resultados da página atual
$current_results = array_slice($results, $start_index, $results_por_page);

// Calcula o número total de páginas
$total_pages = ceil(count($results) / $results_por_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movieteca</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="index.php?reset=true">Movieteca</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="ms-auto">
        <form class="d-flex custom-margin" method="post" action="php/config.php">
          <input class="form-control me-2" id="pesquisa" name="pesquisa" type="search" placeholder="Procure aqui" aria-label="Search" value="<?php echo isset($_SESSION['pesquisado']) ? htmlspecialchars($_SESSION['pesquisado']) : ''; ?>">

          
          <button class="btn btn-outline-light" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </div>
</nav>

<div class="container chamadinha" style="text-align: center">
    <h1>Movieteca</h1>
    <p>Os grandes sucessos encontram-se aqui!</p>
    
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
      <form class="d-flex" method="post" Action="php/config.php">
        <input class="form-control me-2" id="pesquisa" name="pesquisa" type="search" placeholder="Procure aqui" aria-label="Procure aqui" value="<?php echo isset($_SESSION['pesquisado']) ? htmlspecialchars($_SESSION['pesquisado']) : ''; ?>">
        <button class="btn btn-outline-light" type="submit">Buscar</button>
        </form>
        <br><br>
    </div>
    <div class="container">
        <div class="row box">
            <?php if (!empty($current_results)): ?>
                <?php foreach ($current_results as $resultado): ?>
                    <div class="col-4">
                    <div class="card">
                        <div class="pflex">                 
                                 <img  src="<?php echo editImagem($resultado->poster_path)?>" alt="<?php echo $resultado->title; ?>" class="card-img-top" >  
                                 </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><strong><?php echo htmlspecialchars($resultado->title); ?> </strong></h5>
                            <p class="card-text">Classificação: <?php echo round($resultado->vote_average, 2); ?></p>
                            <p class="card-text flex-grow-1"><?php  $numeroDeCaracteres=251; echo substr($resultado->overview, 0, $numeroDeCaracteres) ?>...</p>
                            <div class="mt-auto pflex">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $resultado->id; ?>">Verificar</button><br>
                            </div>
                        </div>
                    </div>
                    </div>   
                    <!-- Modal -->
                    <div class="modal fade" id="modal-<?php echo $resultado->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">  
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><strong><?php echo $resultado->title; ?></strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <img src="<?php echo editImagem($resultado->poster_path)?>" alt="<?php echo $resultado->title; ?>" class="col-md-6 float-md-end mb-3 ms-md-3 imgmodal" >
                                    <p class="card-text flex-grow-1">Lançamento: <?php echo formatDate($resultado->release_date); ?></p>
                                    <p class="card-text flex-grow-1">Classificação popular: <?php  echo  round($resultado->vote_average, 2);?></p> 
                                    <p class="card-text flex-grow-1"><?php  echo $resultado->overview?></p>    
                                    <img src="<?php echo editImagemAlt($resultado->backdrop_path)?>" alt="<?php echo $resultado->title; ?>" class="card img-alternativa" >
                                   
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php if ($verificador == 1): ?>
                <p class="erro-busca">Infelizmente não foi possível encontrar nenhum filme em nosso catálogo! :(</p>
            <?php endif; ?>
        <?php endif; ?>
        </div>
    </div>
</div>

<!-- Navegação de páginas -->   
<div class="container">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
</body>
</html>