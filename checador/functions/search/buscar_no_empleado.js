//Función para recuperar el número de empleado en base al colaborador que se seleccione
    $(document).ready(function(){
	$("#colaborador").change(function () {

		$('#no_empleado').find('option').remove().end().append('<input type="text" class="form-control" readonly name="no_empleado" placeholder="Ejemplo: S012" value="whatever">').val('whatever');

		$("#colaborador option:selected").each(function () {
			id = $(this).val();
			$.post("../../vecolat/checador/functions/search/no_empleado.php", { id: id }, function(data){
				$("#no_empleado").html(data);
			});            
		});
	})
});

/*$(document).ready(function(){
    $("#colaborador").change(function(){
        $("no_empleado").find("option").remove().end().append('<input type="text" class="form-control" readonly name="no_empleado" placeholder="Ejemplo: S012" value="whatever">').val("whatever");

        $("colaborador option:selected").each(function(){
            id = $(this).val();
            $.post("../../vecolat/checador/functions/search/no_empleado.php", {id:id}, function(data){
                $("no_empleado").html(data);
            });
        });
    })
});*/