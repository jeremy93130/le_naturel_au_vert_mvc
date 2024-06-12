document.addEventListener("DOMContentLoaded", function () {
  var currentEditingElement = null;
  document.addEventListener("click", function (event) {
    var target = event.target;
    if (target.classList.contains("modif_produit")) {

      if (currentEditingElement) {
        currentEditingElement.querySelector("div").style.display = "none";
      }

      var div = target.querySelector("div");
      var url = target.closest("ul").getAttribute("data-url");
      var id = target.closest("ul").getAttribute("data-id");

      currentEditingElement = target;

      div.style.display = "block";
      var buttons = target.querySelectorAll("button[type='submit']");

      buttons.forEach(function (button) {
        event.preventDefault();
        button.addEventListener("click", function (event) {
          var currentDiv = this.parentElement;
          var input = currentDiv.querySelector("input, textarea, select");
          var formData = new FormData();
          formData.append(input.name, input.value);
          formData.append("id", id);
          var xhr = new XMLHttpRequest();
          xhr.open("POST", url, true);
          xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
              var parsed = JSON.parse(xhr.responseText);
              var reponse = document.getElementById("reponse");
              reponse.innerHTML =
                '<p class="text-success" style="font-size : 44px;">' +
                parsed.modifs +
                " a bien été modifié </p>";
              div.style.display = "none";
            }
          };
          xhr.send(formData);
        });
      });
    }
  });
});
