function maj_infos () {
	var last_mess_id = $("#messages tbody").find("tr").eq(0).attr("data-info");
	$.ajax({
			type: "POST",
			dataType : "json",
			url: "ajax.php",
			
      data: {page: "waitGame", action: "maj", last_id: last_mess_id , d: (new Date()).getTime()},
			success:function(data){
					
					if(data.ready) {
						var url = ($(location).attr("href")).replace("waitGame", "game");
						$(location).attr("href", url);
					}
					//Joueurs
					$("#ongletCurrentGames tbody").find("tr").not(".selected").remove();
					for (var i = 0; i < data.joueurs.length; i++) {
						var lignejoueur = $(document.createElement("tr"));
						
						if(data.joueurs[i]["selected"]=="") {


							var ready = $(document.createElement("td"));
							ready.html(data.joueurs[i]["ready"]);
							lignejoueur.append(ready);
							
							var joueur = $(document.createElement("td"));
							joueur.html(data.joueurs[i]["player"]);
							lignejoueur.append(joueur);
							
							var race = $(document.createElement("td"));
							race.html(data.joueurs[i]["race"]);
							lignejoueur.append(race);
							
							var team = $(document.createElement("td"));
							team.html(data.joueurs[i]["team"]);
							lignejoueur.append(team);

						

							$("#ongletCurrentGames tbody").append(lignejoueur);
						}

					};
					//$.getJSON("../../js/tileset.json", function(json){
						$("#ongletCurrentGames tbody").find(".link").each(function(){
						//div
							var div=document.createElement('div');
							$(div).addClass('blockLink');
							$(div).css("display","block");
							var ico = $(document.createElement('div'));
							ico.css("display","inline-block");
						//image
							if($(this).attr("class")!="link"){
								var typeico = $(this).attr("class").replace(/link /g, '');
								eval("var coord = (json."+typeico+");");
								var bgPos = (-coord[1]*32)+"px "+(-coord[0]*32)+"px";
								ico.css({ 	position : "absolute", 
											top: "0",
											left: "0",
											width : "32px", 
											height: "32px", 
											marginRight: "5px",
											backgroundImage: "url(../../images/tileset32.png)", 
											backgroundPosition : bgPos
										});
								
							}
							$(div).append(ico);
						// btn
							var input = $(this).clone();
							$(div).append(input);

							$(this).replaceWith($(div));
						
						});	
					//});



					
					//chat
					for (var i = (data.chat.length)-1; i >= 0; i--) {
						var lignechat = $(document.createElement("tr"));
						lignechat.attr("data-info", data.chat[i]["id"]);

						var joueur = $(document.createElement("td"));
						joueur.html(data.chat[i]["joueur"]);
						lignechat.append(joueur);
						
						var message = $(document.createElement("td"));
						message.html(data.chat[i]["message"]);
						lignechat.append(message);

						$("#messages tbody").prepend(lignechat);

					};
					

			},
			error:function (xhr, ajaxOptions, thrownError){
				console.log('error');
				console.log(data);
				console.log(xhr.status);
				console.log(thrownError);
			}
  		});		
}



function sendMess (mess) {
	$.ajax({
			type: "POST",
			dataType : "json",
			url: "ajax.php",
			
      data: {page: "waitGame", action: "sendMess", message: mess , d: (new Date()).getTime()},
			success:function(data){
				
					if(data.sendMess.length!=0) {
						var message = $(document.createElement("p"));
						message.addClass("error");
						message.html(data.sendMess);
						$("body > header").append(message);


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



function changeTeam (val) {
	$.ajax({
			type: "POST",
			dataType : "json",
			url: "ajax.php",
			
      data: {page: "waitGame", action: "changeTeam", team: val , d: (new Date()).getTime()},
			success:function(data){
				
					if(data.team.length!=0) {
						var message = $(document.createElement("p"));
						message.addClass("error");
						message.html(data.team);
						$("body > header").append(message);


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




function changeRace (val) {
	$.ajax({
			type: "POST",
			dataType : "json",
			url: "ajax.php",
			
      data: {page: "waitGame", action: "changeRace", race: val , d: (new Date()).getTime()},
			success:function(data){
				
					if(data.race.length!=0) {
						var message = $(document.createElement("p"));
						message.addClass("error");
						message.html(data.race);
						$("body > header").append(message);


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




$(document).ready(function(){
	// MISE A JOUR DES INFOS
	var timer=setInterval("maj_infos()", 1000);


	// ENVOI MESSAGE
	$("#ongletChat").find(".btn").attr("type","button");
	$("#ongletChat").on("click",".blockBtn", function(){
		/*$("#form1").on("submit", function(){
			return false;
		});*/


		if($("#ongletChat textarea").val() != ""){
			sendMess (($("#ongletChat textarea").val()));
			$("#ongletChat textarea").val("");

		}
	});





	// CHANGE EQUIPE
	$("#ongletCurrentGames").find("select").on("change", function(){
		var val = $(this).find("option:selected").val();
		changeTeam(val);
	});



	$("#choixRace").on("click", ".blockBtn", function(){
		var race = $(this).find(".btn").attr("data-info");

		$('.raceWaitGame').find(".race").prop("checked", false);
		$('#onglet'+race).find(".race").prop("checked", true);
		var val = $('#onglet'+race).find(".race").val();
		changeRace(val);
	});




	// BOUTON PRET
/*	$("input[name=ready]").on("click", function(){
		$("#form1").on("submit", function(){
			return false;
		});


		alert("bouton");
	});*/

	




});