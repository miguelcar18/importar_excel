$('#uploadImportFile').on('click', function(e){
	$('#importFile').click();
});

$('#importFile').on('change', function(e){
	$.ajax({
		url:  $("form#filesForm").attr('action'),
        type: $("form#filesForm").attr('method'),
        headers: {'X-CSRF-TOKEN' : $("input[name=_token]").val()},
        data: new FormData($("form#filesForm")[0]),
        processData: false,
        contentType: false,
        success:function(response){
        	console.log(response.validations);
    	}
	})
	return false;
});