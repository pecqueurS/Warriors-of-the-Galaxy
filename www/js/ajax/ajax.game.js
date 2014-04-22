	teams = {};
	carte = [];


	function maj_infos () {
	var last_mess_id = $("#messages tbody").find("tr").eq(0).attr("data-info");
	$.ajax({
			type: "POST",
			dataType : "json",
			url: "ajax.php",
			
      data: {page: "game", action: "maj", d: (new Date()).getTime()},
			success:function(data){
					
					function convert_time(secondes) {
						var s = secondes;
						var h = 0;
						var m = 0;
						var result = "";
						// LES HEURES
						if(secondes >= 3600) {
							h = Math.floor(secondes/3600);
							result += h+"H";
							secondes = secondes%3600;
						}
						// LES MINUTES
						if(s >= 60) {
							m = Math.floor(secondes/60);
							m = (m<10) ? "0"+m : m;
							result += m+"m";
							secondes = secondes%60;
						}
						// LES SECONDES
						if(s<3600) {
							secondes = (secondes<10) ? "0"+secondes : secondes;
							result += Math.floor(secondes)+"s";
						}

						return result;

					}

					
					console.log(data.infos_teams);
					// Recharge la page si besoin
					if(data.recharge === true) window.location = window.location.href;
					if(data.fin === true) window.location = data.url;
						

					// Met a jour les ressources
					//console.log($("#ore > span").eq(0));
					$("#ore > span").eq(0).text(data.ressources.ore);
					$("#organic > span").eq(0).text(data.ressources.organic);
					$("#energy > span").eq(0).text(data.ressources.energy);

					$("#ongletOre .stockTotal").find("span").eq(0).text(data.ressources.ore);
					$("#ongletOrganic .stockTotal").find("span").eq(0).text(data.ressources.organic);
					$("#ongletEnergy .stockTotal").find("span").eq(0).text(data.ressources.energy);

					// Met a jour les batiments en cours d'amelioration
					$(".constructEnCours").find(".progressBar").remove();
					if(data.amelio_bat.length != 0){
						for (var i = 0; i < data.amelio_bat.length; i++) {
							var div = $(document.createElement("div"));
							div.addClass("progressBar");

							var div_prog = $(document.createElement("div"));
							div_prog.addClass("progression");
							div_prog.css("width", data.amelio_bat[i].pourcent+"%");
							div.append(div_prog);

							var div_type = $(document.createElement("div"));
							div_type.addClass("progressType");
							div_type.text(data.amelio_bat[i].bat);
							div.append(div_type);

							var span = $(document.createElement("span"));
							span.addClass("progressTime");
							span.text(data.amelio_bat[i].temps);
							div.append(span);


							

							$(".constructEnCours").append(div);

						};

					}

					//Met a jour les unites
					$("#footerGame > ul").eq(0).find("li").eq(0).find("span").text(data.total_units[1]);
					$("#footerGame > ul").eq(0).find("li").eq(1).find("span").text(data.total_units[2]);
					$("#footerGame > ul").eq(0).find("li").eq(2).find("span").text(data.total_units[3]);

					$("#ongletFighter .stockTotal").find("span").eq(0).text(data.total_units[1]);
					$("#ongletBomber .stockTotal").find("span").eq(0).text(data.total_units[2]);
					$("#ongletCruiser .stockTotal").find("span").eq(0).text(data.total_units[3]);

					var tab_units = new Array();
					tab_units.push("Fighter");
					tab_units.push("Bomber");
					tab_units.push("Cruiser");

					for (var i = 0; i < tab_units.length; i++) {

						var cout_unit = $("#onglet"+tab_units[i]).find(".costUnit > div");

							var cout_ore = cout_unit.eq(0).find("span:last-child").attr("data-cout");
							var cout_org = cout_unit.eq(1).find("span:last-child").attr("data-cout");
							var cout_ene = cout_unit.eq(2).find("span:last-child").attr("data-cout");

							var nb_max_unit = new Array();
							nb_max_unit.push(Math.floor(data.ressources.ore/cout_ore));
							nb_max_unit.push(Math.floor(data.ressources.organic/cout_org));
							nb_max_unit.push(Math.floor(data.ressources.energy/cout_ene));

							nb_max_unit.sort(function(a,b){return a - b});
						
						$("#construct"+tab_units[i]).attr("max", nb_max_unit[0]);
						$("#construct"+tab_units[i]).next("span").text(nb_max_unit[0]);

						
					};


					// Met a jour les listes des unites en construction
					
					$(".listeUnits").add(".unitsEnCours").find(".progressBar").remove();
					if(data.list_units_construct.length != 0){
						for (var i = 0; i < data.list_units_construct.length; i++) {
							var div = $(document.createElement("div"));
							div.addClass("progressBar");

							var div_prog = $(document.createElement("div"));
							div_prog.addClass("progression");
							div_prog.css("width", data.list_units_construct[i].percent+"%");
							div.append(div_prog);

							var div_type = $(document.createElement("div"));
							div_type.addClass("progressType");

							var span1 = $(document.createElement("span"));
							span1.addClass = "minB update";
							span1.css({width:"24px", height:"24px", backgroundImage:"url('../../imag…es/tileset24B.png"});
							span1.attr("title",data.list_units_construct[i].etat);
							div_type.append(span1);

							var span2 = $(document.createElement("span"));
							span2.text(data.list_units_construct[i].nbUnits);
							div_type.append(span2);

							
							div.append(div_type);

							var span = $(document.createElement("span"));
							span.addClass("progressTime");
							span.text(data.list_units_construct[i].timeLeft);
							div.append(span);


							

							$(".listeUnits").add(".unitsEnCours").append(div);

						};					
					}



					// Met a jour les actions en cours d'amelioration
					$(".amelioEnCours").find(".progressBar").remove();
					if(data.amelio_act.length != 0){
						for (var i = 0; i < data.amelio_act.length; i++) {
							var div = $(document.createElement("div"));
							div.addClass("progressBar");

							var div_prog = $(document.createElement("div"));
							div_prog.addClass("progression");
							div_prog.css("width", data.amelio_act[i].pourcent+"%");
							div.append(div_prog);

							var div_type = $(document.createElement("div"));
							div_type.addClass("progressType");
							div_type.text(data.amelio_act[i].act);
							div.append(div_type);

							var span = $(document.createElement("span"));
							span.addClass("progressTime");
							span.text(data.amelio_act[i].temps);
							div.append(span);


							

							$(".amelioEnCours").append(div);

						};					
					}



					// Met a jour les unites disponibles
					if(data.available_units.length!=0) {
						var units = $("#availableUnits > div");
						units.eq(0).find("span:last-child").text(data.available_units.units1);
						units.eq(1).find("span:last-child").text(data.available_units.units2);
						units.eq(2).find("span:last-child").text(data.available_units.units3);
					}


					// Met a jour les teams
					if(data.infos_teams.length!=0) {
						
						if(teams != data.infos_teams) {

							var k = 0;
							for (var i = 0; i < data.infos_teams.length; i++) {

								var first_letter = (data.infos_teams[i].unit1Qty+"").charAt(0);
								var first_letter2 = (typeof teams[i] == 'undefined') ? "aaa" : (teams[i].unit1Qty+"").charAt(0);

								if((typeof teams[i] == 'undefined') || ( data.infos_teams[i] != teams[i])) {

									if((typeof teams[i] == 'undefined') || ( first_letter != first_letter2)) {

										var units = $("#tabTeam tbody").find("tr").eq(i).find("td").eq(1).find("span:last-child");
										if(first_letter == "<"){
											var unites = ["<div class=\"blockInput\">"+data.infos_teams[i].unit1Qty+"<div class=\"barInput\"></div></div>", "<div class=\"blockInput\">"+data.infos_teams[i].unit2Qty+"<div class=\"barInput\"></div></div>", "<div class=\"blockInput\">"+data.infos_teams[i].unit3Qty+"<div class=\"barInput\"></div></div>"];
										
										} else {
											var unites = [data.infos_teams[i].unit1Qty, data.infos_teams[i].unit2Qty, data.infos_teams[i].unit3Qty];
										}
										
										for (var j = 0; j < units.length; j++) {
											$(units[j]).html(unites[j]);
										};

										var coords = $("#tabTeam tbody").find("tr").eq(i).find("td").eq(2).find("span");
										coords.eq(0).html(data.infos_teams[i].teamX);
										coords.eq(1).html(data.infos_teams[i].teamY);
										


									}


									$("#tabTeam tbody").find("tr").eq(i).find("td").eq(3).empty();
									var div = $(document.createElement("div"));
									div.addClass("progressBar");
									div.attr("data-type", data.infos_teams[i].teamProgress.type);
									div.attr("data-info", data.infos_teams[i].teamProgress.data);

									var prog = $(document.createElement("div"));
									prog.addClass("progression "+data.infos_teams[i].teamProgress.progression);
									prog.css("width",(data.infos_teams[i].teamProgress.width_progression)+"%");

									div.append(prog);

									if(data.infos_teams[i].teamProgress.progression == "orders") {
										var text = $(document.createElement("div"));
										text.addClass("text");
										text.text(data.infos_teams[i].teamProgress.name);
										div.append(text);
									} else {
										var progressType = $(document.createElement("div"));
										progressType.addClass("progressType");
										progressType.text(data.infos_teams[i].teamProgress.name);
										div.append(progressType);

										var progressTime = $(document.createElement("span"));
										progressTime.addClass("progressTime");
										progressTime.text(data.infos_teams[i].teamProgress.progressTime);
										div.append(progressTime);
									}

									$("#tabTeam tbody").find("tr").eq(i).find("td").eq(3).append(div);

									
								}

								if(first_letter == "<"){
										// Gestion des equipes disponibles dans le select
											var inputsAttTeam = $("#actionAtt").find(".input").eq(3);
											

											var option = $(document.createElement("option"));
											var equipe = (data.infos_teams[i].equipe+"");
											var last_letter = equipe.charAt(equipe.length-1);
											option.val(last_letter);
											option.html(equipe);
											if(k==0) {
												option.attr("selected", "selected");
												inputsAttTeam.empty();
												k++;
											}

											inputsAttTeam.append(option);



									}


							};




							teams = data.infos_teams;


						}

						
					}


				// ATTAQUES EN COURS
					$("#currentAct > div").empty();
					if(data.att_en_cours.length!=0) {
						
						for (var i = 0; i < data.att_en_cours.length; i++) {

									
									var div = $(document.createElement("div"));
									div.addClass("progressBar");
									div.attr("data-type", data.att_en_cours[i].type);
									div.attr("data-info", data.att_en_cours[i].data);

									var prog = $(document.createElement("div"));
									prog.addClass("progression "+data.att_en_cours[i].progression);
									prog.css("width",(data.att_en_cours[i].width_progression)+"%");

									div.append(prog);

									var progressType = $(document.createElement("div"));
									progressType.addClass("progressType");
									progressType.html("<span>"+data.att_en_cours[i].team+"</span> <span>"+data.att_en_cours[i].coord+"</span>");
									
									div.append(progressType);

									var progressTime = $(document.createElement("span"));
									progressTime.addClass("progressTime");
									progressTime.text(data.att_en_cours[i].progressTime);
									div.append(progressTime);
									
									$("#currentAct > div").append(div);

						};
					}


				// EVOLUTION DE LA CARTE
					var carte_array = $.map(data.carte, function(value, index) {
					    return [value];
					});

					for (var i = 0; i < (carte_array).length; i++) {
						for (var j = 1; j <= carte_array.length; j++) {
							if(carte.length == 0 || carte[i][j] != carte_array[i][j]) {
								$("#map .cellMap[data-info='"+(j)+"-"+(i+1)+"']").html(carte_array[i][j]);
								//console.log($("#map .cellMap[data-info='"+(j)+"-"+(i+1)+"']").html());
							}
						};
					};
					carte = carte_array;



/*var myObj = {
    1: [1, 2, 3],
    2: [4, 5, 6]
};

var array = $.map(myObj, function(value, index) {
    return [value];
});


console.log(array);*/





				// Temps restant de la partie
				$("#ends span").eq(1).text(data.temps_restant);







//console.log(data.infoCombat);







			},
			error:function (xhr, ajaxOptions, thrownError){
				console.log('error');
				console.log(data);
				console.log(xhr.status);
				console.log(thrownError);
			}
  		});		
}




function update_teams (id_team, nb_units1, nb_units2, nb_units3) {
	$.ajax({
			type: "POST",
			dataType : "json",
			url: "ajax.php",
			
      data: {page: "game", action: "update_teams", id: id_team, units1: nb_units1, units2: nb_units2, units3: nb_units3 , d: (new Date()).getTime()},
			success:function(data){
				
				$('p.error').remove();
					if(data.message.length!=0) {
						// Message d'erreur
						var message = $(document.createElement("p"));
						message.addClass("error");
						message.html(data.message);
						$("body > header").append(message);
						
						// Remise a l'etat des inputs concernés
						if(data.team_unites.length!=0) {
							var list_team = $("#tabTeam tbody").find("tr");
							for (var i = 0; i < list_team.length; i++) {
								if(data.team_unites.id_team == (i+1)){

									var units_dom = $("#tabTeam tbody").find("tr").eq(i).find("td").eq(1).find("span:last-child");
									var unites_team = ["<div class=\"blockInput\">"+data.team_unites.unites1+"<div class=\"barInput\"></div></div>", "<div class=\"blockInput\">"+data.team_unites.unites2+"<div class=\"barInput\"></div></div>", "<div class=\"blockInput\">"+data.team_unites.unites3+"<div class=\"barInput\"></div></div>"];

									for (var j = 0; j < units_dom.length; j++) {
										$(units_dom[j]).html(unites_team[j]);
									};


								}
								
							};
						}
					}

					if(data.available_units.length!=0) {
						var units = $("#availableUnits > div");
						units.eq(0).find("span:last-child").text(data.available_units.units1);
						units.eq(1).find("span:last-child").text(data.available_units.units2);
						units.eq(2).find("span:last-child").text(data.available_units.units3);
					}


					
					
				
			},
			error:function (xhr, ajaxOptions, thrownError){
				console.log('error');
				console.log(data);
				console.log(xhr.status);
				console.log(thrownError);
			}
  		});		
}





function info_prepa_att() {
		var inputsAtt = $("#actionAtt").find(".input");

		var inputsVal = {
			page: "game",
			action: "info_prepa_att",
			x: inputsAtt.eq(0).val(),
			y: inputsAtt.eq(1).val(),
			deplacement: inputsAtt.eq(2).val(),
			team: inputsAtt.eq(3).val(),
			d: (new Date()).getTime()
		};

		$.ajax({
			type: "POST",
			dataType : "json",
			url: "ajax.php",
			
      data: inputsVal,
			success:function(data){
				// Message
				$('p.error').remove();
					if(data.message.length!=0) {
						var message = $(document.createElement("p"));
						message.addClass("error");
						message.html(data.message);
						$("body > header").append(message);
					}

				// Modification des elements pour indiquer le temps du deplacement et la charge maximale
				$("#actionAtt > div").eq(1).children("div").eq(0).find("div").text(data.temps);
				$("#actionAtt > div").eq(1).children("div").eq(1).find("div").text(data.capacite);

			
			},
			error:function (xhr, ajaxOptions, thrownError){
				console.log('error');
				console.log(data);
				console.log(xhr.status);
				console.log(thrownError);
			}
  		});		

}





$(document).ready(function(){

	// MISE A JOUR DES INFOS
	var timer=setInterval("maj_infos()", 1000);


	// Modification des teams (map)
	$("#tabTeam tbody").find("tr").each(function(){
		$(this).find("td").eq(1).on("keyup", ".input", function(){
			var team = $(this).parent().parent().parent().parent().parent().find("td:first-child").text();
			var id_team = team.substr(team.length - 1);

			var units = $(this).parent().parent().parent().parent().parent().find("td").eq(1).find("input");
			var nb_units1 = units.eq(0).val();
			var nb_units2 = units.eq(1).val();
			var nb_units3 = units.eq(2).val();


			update_teams (id_team, nb_units1, nb_units2, nb_units3);

		});
	});

	// click sur les cases map
	$("#map").on("click",".cellMap:not('.header')",function(){
		var coordsStr = $(this).attr("data-info");
		var coordsArr = coordsStr.split("-");

		$("input[name=actionMapX]").val(coordsArr[0]);
		$("input[name=actionMapY]").val(coordsArr[1]);

		info_prepa_att();

	});

	// Lancer une attaque (map)
	$("#actionAtt").on("change", ".input", function(){
		
		info_prepa_att();
	});



});