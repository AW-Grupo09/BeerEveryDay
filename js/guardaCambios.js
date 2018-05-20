function guarda(){
	swal({
	title: "¡Cambios guardados correctamente!",
	timer: 5000,
	showConfirmButton: true,
	closeOnConfirm: true
	});

	function(){
		window.location.href = "perfil.php";
	}
};

function guard(){
	alert("¡Cambios guardados correctamente!");
}

$(document).ready(function() {
swal({ 
  title: "Error",
   text: "wrong user or password",
    type: "error" 
  },
  function(){
    window.location.href = 'perfil.php';
});