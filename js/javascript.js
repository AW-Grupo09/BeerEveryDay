/*este script actualiza lanza mediente el metodo GET el id seleccionado*/
/*function unirse(id){
    window.location = "./mostrarGrupos.php?action=unirse&id=" + id;
}*/

function unirse(){
	var unidades = document.getElementsByName("unidades");
	if (unidades[0].value > <?=$cantidaddisponible?>) {
		alert("No hay suficientes cervezas disponibles");
		return false;
	}
}

function myFunction() {
    var x = document.getElementById("procesarCesta");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

