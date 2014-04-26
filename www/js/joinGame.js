$( document ).ready(function() {

$("#blockPartieEnAttente tbody").find("tr").eq(0).find("td").addClass("selected");


// Choix d'une partie dan sle onclick
$("#blockPartieEnAttente tbody").on("click","tr",function(){
	$("#blockPartieEnAttente tbody").find("tr").find("td").removeClass("selected");
	$(this).find("td").addClass("selected");
	var lock = ($(this).find("td").eq(0).html().length);
	if(lock == 0){
		var mdp_game = "";
	}else {
		var mdp_game = prompt('Veuillez entrer votre mot de passe','');
	}

	var id_game = $(this).attr("data-info");
	var name_game = $(this).find("td").eq(1).text();

	$("#search_hdn").val(id_game);
	$("#search").val(name_game);
	$("#mdp_hdn").val(mdp_game);
});









});