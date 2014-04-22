$( document ).ready(function() {
	$(".actionsQG").hide();
	$(".actionsSP").hide();
	$(".actionsRes").hide();


	$(".vues").hide();
	$("#ongletPlanet").show();

	$(".alliance").hide();
	$("#ongletChat").show();




	$(".batiments").hide();
	$("#ongletQG").show();

	$("input[type=range]").val(1);





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

















// Affichage des actions
	$(".menu").on("click",".act", function(){
		var attrData = ($(this).attr("data-info"));
		
		var classe = $("#onglet"+attrData).attr("class");
		$("."+classe).hide();
		$(this).parent().parent().find(".description").hide();
		$("#onglet"+attrData).fadeIn("slow");
		$("#onglet"+attrData).find(".blockInput").eq(0).find(".input").focus();
		$("#onglet"+attrData).find(".blockBtn").eq(0).find(".barBtn").css("backgroundColor","rgb(0,153,255)");
	});


// Affichage des batiments
	$(".menu").on("click",".blockLink", function(){
		var attrData = ($(this).find(".link").attr("data-info"));
		
		var classe = $("#onglet"+attrData).attr("class");
		$("."+classe).hide();

		$("#onglet"+attrData).find(".detailActions > div").hide();
		$("#onglet"+attrData).find(".description").show();

		$("#onglet"+attrData).fadeIn("slow");
		$("#onglet"+attrData).find(".blockInput").eq(0).find(".input").focus();
		$("#onglet"+attrData).find(".blockBtn").eq(0).find(".barBtn").css("backgroundColor","rgb(0,153,255)");
	});


// ProgressBar
	$(".progressBar").each(function(){
		var percent = $(this).attr("data-info");
		var progress = $(document.createElement('div'));
		progress.addClass("progression");
		progress.css("width" , percent+"%");
		// choix du type de progression
		if( typeof $(this).attr("data-type") != 'undefined' ) {
			switch ($(this).attr("data-type")) {
			  case "def":
			    progress.addClass("red");
			    break;
			  case "wait":
			    progress.css("width" , "100%");
			    progress.addClass("green");
			    break;
			  case "back":
			    progress.addClass("back");
			    break;
			  case "orders":
			    progress.css("width" , "100%");
			    progress.addClass("orders");
			    break;
			}			
		}
		$(this).prepend(progress);

	});



// Range creat units
	$(".ConstruireUnit").on("change",".rangeUnit", function(){
		$(this).parent().parent().find(".rangeUnit").val($(this).val());
		var couts = $(this).parent().parent().parent().find(".costUnit > div");
		for (var i = 0; i < couts.length; i++) {
			var res = couts.eq(i).find("span:last-child").attr("data-cout");
			console.log(res);
			if(i==couts.length-1){
				couts.eq(i).find("span:last-child").text(convert_time(res*$(this).val()));
				
			} else {
				couts.eq(i).find("span:last-child").text(res*$(this).val());
			}
		};
		
		
	});

// Mise a jour des infos









// MAP
	// Hover sur les cases de la map
			$("#map").on("mouseenter",".cellMap:not('.header')",function(){
				var coordsStr = $(this).attr("data-info");
				var coordsArr = coordsStr.split("-");

				if ($(this).find("div").length == 0){
				   var joueur = "";
				   var team = "";
				   var type = "";
				} else {
				   var joueur = $(this).find("div").attr("data-player");
				   var team = $(this).find("div").attr("data-team");
				   var type = $(this).find("div").attr("data-type");
				}


			// Modification du bloc
				// Coordonnées
				$(".infoMap").find("p").eq(0).find("span").eq(0).html(coordsArr[0]);
				$(".infoMap").find("p").eq(0).find("span").eq(1).html(coordsArr[1]);
				// Autres infos
				$(".infoMap").find("p").eq(1).find("span").last().html(joueur);
				$(".infoMap").find("p").eq(2).find("span").last().html(team);
				$(".infoMap").find("p").eq(3).find("span").last().html(type);


				$(".infoMap").show();
			});


	// Sortie
			$("#map").on("mouseleave",".cellMap:not('.header')",function(){

				$(".infoMap").hide();
			});





});



