function search_game (name) {
	$.ajax({
			type: "POST",
			dataType : "json",
			url: "ajax.php",
			
      data: {page: "joinGame", action: "search_game", search: name , d: (new Date()).getTime()},
			success:function(data){
				
					console.log(data);
					$("#blockPartieEnAttente tbody").empty();
					for (var i = 0; i < data.waiting_games.length; i++) {

						if(i==0) {
							var id_game = data.waiting_games[i].id;
							var mdp_game = "";
						}

						var lignegame = $(document.createElement("tr"));
						lignegame.attr("data-info",data.waiting_games[i].id);

						var pwd = $(document.createElement("td"));
						if(i==0) pwd.addClass("selected");
						pwd.html(data.waiting_games[i].pwd);
						lignegame.append(pwd);

						var name = $(document.createElement("td"));
						if(i==0) name.addClass("selected");
						name.html(data.waiting_games[i].name);
						lignegame.append(name);

						var players = $(document.createElement("td"));
						if(i==0) players.addClass("selected");
						players.html(data.waiting_games[i].players);
						lignegame.append(players);

						var creator = $(document.createElement("td"));
						if(i==0) creator.addClass("selected");
						creator.html(data.waiting_games[i].creator);
						lignegame.append(creator);

						$("#blockPartieEnAttente tbody").append(lignegame);
					};
					//$.getJSON("../../js/tileset.json", function(json){
						$("#blockPartieEnAttente tbody").find(".link").each(function(){
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

					



					$("#search_hdn").val(id_game);
					$("#mdp_hdn").val(mdp_game);


				
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




	$("#blockSearch").on("keyup", ".input", function() {
		var search = $(this).val();
		search_game (search);
	});

});