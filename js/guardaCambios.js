function guarda(){
	swal({
	title: "¡Cambios guardados correctamente!",
	timer: 5000,
	showConfirmButton: true,
	closeOnConfirm: true
	});
};

function guardar(){
	alert("¡Cambios guardados correctamente!");
};


/*$(document).ready(function(){
  $('#formModifica').on('submit',function(e) {  //Don't foget to change the id form
  $.ajax({
      url:'./perfil.php', //===PHP file name====
      data:$(this).serialize(),
      type:'POST',
      success:function(data){
        console.log(data);
        //Success Message == 'Title', 'Message body', Last one leave as it is
	    	swal({
				title: "¡Cambios guardados correctamente!",
				timer: 5000,
				showConfirmButton: true,
				closeOnConfirm: true
			});
      },
      error:function(data){
       	   	swal({
				title: "nte!",
				timer: 5000,
				showConfirmButton: true,
				closeOnConfirm: true
			});
      }
    });
    //e.preventDefault(); //This is to Avoid Page Refresh and Fire the Event "Click"
  });
});*/

/*$(document).ready(function(){
  $('#guardaCambios').click(function(e) {  //Don't foget to change the id form
    	swal({
			title: "¡Cambios guardados correctamente!",
			timer: 5000,
			showConfirmButton: true,
			closeOnConfirm: true
		});
  });
});*/
