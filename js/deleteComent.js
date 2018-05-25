
function deleteVal(idComent) {

	$.get('includes/deleteComent.php', {q: idComent}, 
    function(returnedData){
         console.log(returnedData);
         location.reload();
	});

	
}
