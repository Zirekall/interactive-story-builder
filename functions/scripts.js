$("#addRow").click(function () {
    var html = '';
    html += '<div id="inputFormRow" >';
    html += '<div class="input-group mb-3 col-lg-7 float-left">';
    html += '<input type="text" name="pytanie[]" class="form-control m-input" placeholder="Treść pytania" autocomplete="off" required>';
    html += '</div>'
    html += '<div class="input-group mb-3 col-lg-5 float-right">';
    html += '<input type="text" name="etykieta[]" class="form-control m-input" placeholder="Etykieta" autocomplete="off">';
    html += '<div class="input-group-append">';
    html += '<button id="removeRow" type="button" class="btn btn-danger">Usuń pytanie</button>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    $('#newRow').append(html);
});

$(document).on('click', '#removeRow', function () {
    $(this).closest('#inputFormRow').remove();
});

function ShowLink() {
    document.getElementById("directlink").innerHTML = "<a href='../fill-up-form.php?id=<?php echo ";  
  };