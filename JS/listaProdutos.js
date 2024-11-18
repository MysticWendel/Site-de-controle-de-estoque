
function pesquisa() {
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("barraPesquisa");
filter = input.value.toUpperCase();
table = document.getElementById("myTable");
tr = table.getElementsByTagName("tr");

for (i = 0; i < tr.length; i++) {
  td = tr[i].getElementsByTagName("td")[1];
  if (td) {
    txtValue = td.textContent || td.innerText;
    if (tr[i].className == "ativo"){
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
}

$("#pesquisaSetor").change(function () {
var table, tr, td, i;
table = document.getElementById("myTable");
tr = table.getElementsByTagName("tr");
for (i = 0; i < tr.length; i++){
  td = tr[i].getElementsByTagName("td")[7];
  if(td){
    if ($(this).val() == 0) {
      tr[i].style.display = "";
      tr[i].classList.add("ativo");
    }else if ($(this).val() == td.innerText) {
      tr[i].style.display = "";
      tr[i].classList.add("ativo");
    } else {
      tr[i].style.display = "none";
      tr[i].classList.remove("ativo");
    }
}
}
});

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

    $('#editIdProduto').val(data[0]);
    $('#editNome').val(data[1]);
    $('#editPreçoCompra').val(data[2]);
    $('#editPreçoVenda').val(data[3]);
    $('#editEstoque').val(data[4]);
    $('#editDistribuidora').val(data[5]);
    $('#editarSetor').val(data[7]);
  });
  });