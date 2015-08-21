var inicio=function () {
	$(".eliminar").click(function(e){
		e.preventDefault();
		var id=$(this).attr('data-id');
		$(this).parentsUntil('.producto').remove();
		$.post('./eliminar.php',{
			id:id
		},function(a){
			
			if(a=='0'){
				location.href="./carritopedido.php";
			}
		});

	});
}	
$(document).on('ready',inicio);

