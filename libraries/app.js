jQuery(document).ready(function($){
    $(document).ready(function() {
    	// LIBRERIA DE SELECT2
        	$('#mi-selector').select2();
        	$('#mi-selector2').select2();

        // CUANDO SE REALICE UN CAMBIO EN EL SELECT DE POKEMON	
	        $("#mi-selector").change(function(){

	    		//EL VALOR NOMBRE SE COLOCARA EN LA URL COMO ID PARA OBTENER INFORMACION
					var valor = $(this).val();

					window.history.pushState({data:true},"Titulo", "?id="+valor);

					location.reload();
					
				
			});

			$("#mi-selector2").change(function(){

	    		//EL VALOR NOMBRE SE COLOCARA EN LA URL COMO ID PARA OBTENER INFORMACION
					var valor = $(this).val();

					window.history.pushState({data:true},"Titulo", "?id="+valor);

					location.reload();
					
				
			});


    });
});