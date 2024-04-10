$(document).on("load", function () {
  let stripe = Stripe("KEY_PUBLIC");
  let elements = stripe.elements();

  let card = elements.create("card");
  card.mount("#card-element");

  card.on("change", function (event) {
    let displayError = $("#card-errors");

    if (event.error) {
      displayError.text(event.error.message);
    } else {
      displayError.text("");
    }
  });
});
