$( "#bandeauCoReduit" ).click(function() {
  $( this ).addClass("hidden");
  $("#bandeauCoBis").removeClass("hidden");
});

$( "#FlecheFermer" ).click(function() {
  $("#bandeauCoBis").addClass("hidden");
  $( "#bandeauCoReduit" ).removeClass("hidden");
});
