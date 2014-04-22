$( document ).ready(function() {
	$("input[name=checkPwd]").on("change",function(){
	  if($(this).is(':checked')){
	    $("#pwd").prop('disabled', false);
	  } else {
	    $("#pwd").prop('disabled', true);
	  }
	});

});