
function deleteVal(idComent, idCer) {

	$.get('includes/deleteComent.php', {q: idComent, w:idCer}, 
    function(returnedData){
         console.log(returnedData);
         location.reload();
	});

	
}
