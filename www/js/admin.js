$( document ).ready(function() {

	$(".auth.btn").on("click",function(){
		var onglet = $(this).attr("data-info");
		$(".messagesTab").fadeOut("slow");
		$("#"+onglet).fadeIn("slow");
		$(".auth.btn").css("border","3px solid transparent");
		$(this).css("border","3px solid white");
	});


	$(".messagesTab .tableau").on("click","tr", function(){
		var message = $(this).find("td").eq(4).text();

		var div = $(document.createElement("div"));
		div.css({position:"fixed", top:"0", left:"0", width:"100%", height:"100%", backgroundColor:"rgba(0,0,0,.9)"});
		div.addClass("message");

		var text_mess = $(document.createElement("div"));
		text_mess.css({width:"60%", height:"80%", overflowY:"auto", backgroundColor:"white", padding:"10px", margin:"10px auto", color:"#333333"});
		text_mess.text(message);

		div.append(text_mess);

		$("body").append(div);
	});



	$("body").on("click",".message",function(){
		$(this).remove();
	});





});

