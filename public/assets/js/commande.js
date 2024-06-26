// Supposons que vous ayez un bouton ou un événement déclencheur avec l'ID 'passer-commande'
$(document).ready(function () {
  $("#commander").on("click", function () {
    var url = $(this).data("url");
    // Récupérer la valeur du total depuis le champ caché
    var quantite = $(".quantity");
    var totalGeneral = parseFloat(
      document
        .getElementById("total-general")
        .textContent.replace("€", "")
        .trim()
    );

    var deleteArticle;

    var commandeDatas = [];

    quantite.each(function () {
      // On récupere l'id
      var articleId = $(this).data("article");
      // on récupere la valeur de l'input pour récuperer la quantité
      var articleQuantity = $(this).val();
      deleteArticle = $(this).closest(".delete_article");

      var altText = deleteArticle.find("img").attr("alt");
      var categorie = deleteArticle.find("img").data("categorie");
      // On récupere le prix via quantite (classe de l'input quantity).parent(le noeud parent = td class="quantity-input").prev(element frere precedent = le td qui contient {{produit.prix}}).text(le text du td).remplace(on remplace € par une chaine vide).trim(on supprime les espaces avant et arriere)
      var prix = parseFloat(
        $(this).parent().prev().text().replace("€", "").trim()
      );

      var lot = parseInt($(this).data("lot"));

      var commandeData = {
        id: articleId,
        quantite: articleQuantity,
        alt: altText,
        categorie: categorie,
        prix: prix,
        lot: lot,
      };
      commandeDatas.push(commandeData);
    });
    var dataToSend = {
      commandeData: commandeDatas,
      totalGeneral: totalGeneral,
    };

    $.ajax({
      type: "POST",
      url: url,
      data: JSON.stringify(dataToSend),
      dataType: "json",
      success: function (response) {
        console.log(typeof response);
        if (response.redirect) {
          window.location.href = response.redirect;
        } else if (response.errors) {
          let erreur = $("<p>" + response.errors.erreur_stock + "</p>");
          $("#quantite-" + response.errors.id).append(erreur);
          console.log($("#quantite-" + response.errors.id));
        } else {
          deleteArticle.html(
            "<div><h2>Une Erreur s'est produite, Merci de raffraichir la page et réessayer</h2></div>"
          );
        }
      },
      error: function (error) {
        console.error("Erreur lors de la requête AJAX:", error);
      },
    });
  });
});
