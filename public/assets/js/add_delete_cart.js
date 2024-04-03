// Fonction ajout panier
var nbArticles = $("#nb_articles");
function ajouterAuPanier(url, id, nom, prix, image, clickedIcon) {
  var ajoutPanier = $("#ajout-panier");
  var produitData = {
    id: id,
    nom: nom,
    image: image,
    prix: prix,
  };
  $.ajax({
    url: url,
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify(produitData),
    dataType: "json",
    success: function (response) {
      $("#ajout-panier").empty();
      if (response.message) {
        console.log(nbArticles);
        ajoutPanier.addClass("alert alert-success");
        ajoutPanier.append("<p>" + response.message + "</p>");
        nbArticles.text(response.totalQuantite);
        $(clickedIcon).addClass("selected_cart");
      } else if (response.doublon) {
        ajoutPanier.addClass("alert alert-warning");
        ajoutPanier.append("<p>" + response.doublon + "</p>");
      } else {
        ajoutPanier.addClass("alert alert-danger");
        ajoutPanier.append(
          "<p> Il y a eu un problème lors de l' ajout de votre produit dans le panier</p>"
        );
      }
    },
    error: function (error) {
      console.log("Erreur lors de la requête AJAX :", error.responseText);
    },
  });
}

function supprimerArticleDuPanier(url, id) {
  $.ajax({
    url: url,
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify({ id: id }),
    success: function (response) {
      if (response && response.success) {
        location.reload();
      } else {
        console.log("Erreur lors de la suppression de l'article du panier");
        console.log(response);
      }
    },
    error: function () {
      console.log("Une erreur s'est produite lors de la requête AJAX");
    },
  });
}

$(document).ready(function () {
  $("#ajouter_panier_link").click(function (e) {
    e.preventDefault();
    var url = $(this).attr("href");
    var id = $(this).data("id");
    var nom = $(this).data("nom");
    var prix = $(this).data("prix");
    var image = $(this).data("image");
    ajouterAuPanier(url, id, nom, prix, image, null);
  });
  $(".ajouter_panier_icon").click(function (e) {
    e.preventDefault();
    var clickedIcon = $(this).find("i")[0];
    $(this).each(function () {
      var url = $(this).data("url");
      var id = $(this).data("id");
      var nom = $(this).data("nom");
      var prix = $(this).data("prix");
      var image = $(this).data("image");
      ajouterAuPanier(url, id, nom, prix, image, clickedIcon);
    });
  });
});
