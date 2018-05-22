$(document).ready(function(){

	function correoValido(email){
		var texto = email;
		if(email.indexOf('@')  > 0 && texto.indexOf('.') > email.indexOf('@') && (email.indexOf('@') + 1) < texto.indexOf('.') && (email.length - 1) > texto.indexOf('.'))
			return true;
		else
			return false;
	}
				
	$("#campoEmail").change(function(){
		if(correoValido($("#campoEmail").val())){
			$("#correoNo").hide(); 
			$("#correoOk").show();
		}else{
			$("#correoOk").hide();
			$("#correoNo").show();
		}
	});
			
});