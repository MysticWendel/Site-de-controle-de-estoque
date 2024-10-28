var modal = document.getElementById("formularioModal");

var botãoAbrir = document.getElementById("botãoAdição");

var botãoFechar = document.getElementsByClassName("fechar")[0];

botãoAbrir.onclick = function() {
  modal.style.display = "block";
}

botãoFechar.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 