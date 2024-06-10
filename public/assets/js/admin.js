document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener("click", function (event) {
    var target = event.target;
    if (target.classList.contains("modif_produit")) {
      var div = target.querySelector("div");
      var url = target.closest("ul").getAttribute("data-url");
      div.style.display = "block";
      var buttons = target.querySelectorAll("button[type='submit']");
      buttons.forEach(function (button) {
        button.addEventListener("click", function (event) {
          var currentDiv = this.parentElement;
          var input = currentDiv.querySelector("input, textarea, select");
          var formData = new FormData();
          formData.append(input.name, input.value);
          var xhr = new XMLHttpRequest();
          xhr.open("POST", url, true);
          xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
              console.log(xhr.responseText);
              div.style.display = "none";
            }
          };
          xhr.send(formData);
        });
      });
    }
  });
});
