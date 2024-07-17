$(document).ready(function() {
	var listTargetId = 'list-target';
	var listSelectId = 'list-select';
	var initialTargetHtml = '<option value="" disabled selected>Primero Seleccione un Curso...</option>';

	$('select.list-target').html(initialTargetHtml);
	$('select').material_select();
	$('#'+listSelectId).change(function(e) {
		var selectValue = $(this).val();
		console.log(selectValue);
		$('select.list-target').html('<option value="" disabled selected>Cargando...</option>');
		$('select').material_select();
		if (selectValue == '') {
			$('select.list-target').html(initialTargetHtml);
			$('select').material_select();
		}else {
			$.ajax({
				url: 'modules/get_values.php?value='+selectValue+'&opcion=1' ,
				success: function(output) {
					$('select.list-target').html(output);
					$('select').material_select();
				},
				error: function (xhr, ajaxOptions, thrownError) {
            		alert(xhr.status + " "+ thrownError);
        		}
			});
		}
	})
});