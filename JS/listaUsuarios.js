
function pesquisa() {
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("barraPesquisa");
filter = input.value.toUpperCase();
table = document.getElementById("myTable");
tr = table.getElementsByTagName("tr");

for (i = 0; i < tr.length; i++) {
  tdUsername = tr[i].getElementsByTagName("td")[1];
  tdEmail = tr[i].getElementsByTagName("td")[2];
  if (tdUsername) {
    txtValueUsername = tdUsername.textContent || tdUsername.innerText;
    txtValueEmail = tdEmail.textContent || tdEmail.innerText;
    if (tr[i].className == "ativo"){
      if (txtValueUsername.toUpperCase().indexOf(filter) > -1 || txtValueEmail.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
}

$(document).ready(function(){
  $('.btn-del').on('click', function(){

    $tr = $(this).closest('tr');

    var data = $tr.children('td').map(function() {
      return $(this).text()
    }).get();

    $('#idDeletar').val(data[0]);
  });
  $('.btn-editar').on('click', function(){

    $tr = $(this).closest('tr');

    var data = $tr.children('td').map(function() {
      return $(this).text()
    }).get();

    $('#editIdUsuario').val(data[0]);
    $('#editUsername').val(data[1]);
    $('#editEmail').val(data[2]);
  });
  });