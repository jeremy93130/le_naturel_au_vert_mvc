function changeStar(star, rating) {
  // Récupérer toutes les étoiles
  var stars = document.querySelectorAll(".fa-star");
  var nbEtoiles = 0;

  // Parcourir toutes les étoiles
  for (var i = 0; i < stars.length; i++) {
    // Si l'index de l'étoile est inférieur ou égal à l'index de l'étoile cliquée, la marquer comme pleine, sinon la marquer comme vide
    if (i < rating) {
      stars[i].classList.remove("fa-regular");
      stars[i].classList.add("fa-solid");
      nbEtoiles++;
    } else {
      stars[i].classList.remove("fa-solid");
      stars[i].classList.add("fa-regular");
    }
  }
  document.getElementById("nbEtoiles").value = nbEtoiles;
}

document.addEventListener("DOMContentLoaded", function () {
  var showAvisLink = document.getElementById("show_avis_link");
  var divAvis = document.getElementById("show_avis");

  showAvisLink.addEventListener("click", function (event) {
    event.preventDefault();
    if (divAvis.classList.contains("avis_none")) {
      divAvis.classList.remove("avis_none");
      divAvis.style.display = "block";
      setTimeout(function () {
        divAvis.classList.add("open");
      }, 2000);
      showAvisLink.textContent = "Cacher les avis";
    } else {
      divAvis.classList.add("avis_none");
      divAvis.style.display = "none";
      divAvis.classList.remove("open");
      setTimeout(function () {
        divAvis.classList.add("avis_none");
      }, 2000);
      showAvisLink.textContent = "Voir les avis";
    }
  });
});
