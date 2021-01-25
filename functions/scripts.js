$("#addRow").click(function () {
    var html = '';
    html += '<div id="inputFormRow" >';
    html += '<div class="mb-3 btn col-lg-2 float-left">';
    html += '<select name="typ[]" required>';
    html += '<option value="Pozytywne">Pozytywne</option>';
    html += '<option value="Negatywne">Negatywne</option>';
    html += '</select>';
    html += '</div>';
    html += '<div class="input-group mb-3 col-lg-6 float-left">';
    html += '<input type="text" name="pytanie[]" class="form-control m-input" placeholder="Treść pytania" autocomplete="off" required>';
    html += '</div>'
    html += '<div class="input-group mb-3 col-lg-4 float-right">';
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



$("#editbtn").click(function(){
    $("#edit").slideToggle();
});

$("button").click(function(){
  $("#results").table2excel({
    name:"Wyniki formularza",
    filename:"Wyniki_Formularza",
    fileext:".csv"
  });
});
