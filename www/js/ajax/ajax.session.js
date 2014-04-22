function verif_session () {
	$.ajax({
			type: "POST",
			dataType : "json",
			url: "ajax.php",
			
      data: {session: "session", d: (new Date()).getTime()},
			success:function(data){
				
					
			
		
					
				console.log(data);
					
				
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
	var timer2=setInterval("verif_session()", 10000); // Toutes les 10 secondes







});