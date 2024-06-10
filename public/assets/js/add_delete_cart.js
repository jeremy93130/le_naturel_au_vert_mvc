// Fonction ajout panier
function ajouterAuPanier(url, id, nom, prix, image, clickedIcon) {
  let nbArticles = $("#nb_articles");
  var ajoutPanier = $("#ajout-panier");

  // produitData est un Objet javascript qui sera converti en chaîne de caractère JSON grâce à la méthode stringify,
  // Stringify est utilisé car sans ça, Javascript ne sait pas comment nativement il peut convertir l'objet produitData au bon format pour php 
  var produitData = {
    id: id,
    nom: nom,
    image: image,
    prix: prix,
  };

  $.ajax({
    url: url, // l'url sera http://localhost/panier/addToCart
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify(produitData),
    dataType: "json",
    success: function (response) {
      $("#ajout-panier").empty();
      if (response.message) {
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
  let nbArticles = $("#nb_articles");
  $.ajax({
    url: url,
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify({ id: id }),
    dataType: "json",
    success: function (response) {
      if (response && response.success) {
        nbArticles.text(response.nb);
        window.location.reload();
      } else {
        console.log("Erreur lors de la suppression de l'article du panier");
        console.log(response);
      }
    },
    error: function (error) {
      console.log("Une erreur s'est produite lors de la requête AJAX");
      console.log(error.responseText);
    },
  });
}

function viderPanier(url) {
  $.ajax({
    url: url,
    type: "POST",
    dataType: "json",
    success: function (response) {
      if (response.success) {
        window.location.reload();
      }
    },
  });
}

$(document).ready(function () {
  $("#ajouter_panier_link").click(function (e) {
    e.preventDefault();
    var url = $(this).data("url");
    var id = $(this).data("id");
    var nom = $(this).data("nom");
    var prix = $(this).data("prix");
    var image = $(this).data("image");
    ajouterAuPanier(url, id, nom, prix, image, null);
  });

  $(".ajouter_panier_icon").click(function (e) {
    e.preventDefault();
    var clickedIcon = $(this).find("i");
    $(this).each(function () {
      var url;
      var id = $(this).data("id");
      var nom = $(this).data("nom");
      var prix = $(this).data("prix");
      var image = $(this).data("image");
      var estDansPanier = clickedIcon.hasClass("selected_cart");
      if (estDansPanier) {
        url = "panier/delete";
        clickedIcon.removeClass("selected_cart");
        // Si l'article est déjà dans le panier, le retirer
        supprimerArticleDuPanier(url, id);
      } else {
        url = $(this).data("url");
        // Sinon, l'ajouter au panier
        ajouterAuPanier(url, id, nom, prix, image, clickedIcon);
      }
    });
  });
});
