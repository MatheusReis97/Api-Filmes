<?php



function formatDate($date) {
    $dateTime = new DateTime($date);
    return $dateTime->format('d/m/Y');
}



function editImagem($string){
  $terminourl = $string ;
  
    if($terminourl){
        return 'https://image.tmdb.org/t/p/original/'. $terminourl;
    }
    else {
        return 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQocSh28wJbAIGCD0aJSonLgF0BeMlpcqu7YA&s';
    }
}

function editImagemAlt($string){
    $terminourl = $string ;
  
    if($terminourl){
        return 'https://image.tmdb.org/t/p/original/'. $terminourl;
    }
    else {
        return 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQocSh28wJbAIGCD0aJSonLgF0BeMlpcqu7YA&s';
    }
}


function PaginaPadrao(){
    unset($_SESSION['results']);
    
    // redirect (index.php);
}