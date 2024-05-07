function changeStar(star, rating) {
    // Récupérer toutes les étoiles
    var stars = document.querySelectorAll('.fa-star');
    var nbEtoiles = 0;
    
    // Parcourir toutes les étoiles
    for (var i = 0; i < stars.length; i++) {
        // Si l'index de l'étoile est inférieur ou égal à l'index de l'étoile cliquée, la marquer comme pleine, sinon la marquer comme vide
        if (i < rating) {
            stars[i].classList.remove('fa-regular');
            stars[i].classList.add('fa-solid');
            nbEtoiles++;
        } else {
            stars[i].classList.remove('fa-solid');
            stars[i].classList.add('fa-regular');
            nbEtoiles--;
        }
    }
    document.getElementById('nbEtoiles').value = nbEtoiles;
}