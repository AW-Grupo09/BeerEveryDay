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

function guardar(){
	alert("¡Cambios guardados correctamente!");
}

