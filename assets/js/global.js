function globalAlert(kind, message){
	alert = '<div class="alert hide ' + kind + '">"';
	alert += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	alert += '<strong>Ops! </strong>' + message;
	alert += '</div>';

	if($('.globalModalAlert').length > 0) alertDiv = '.globalModalAlert';
	else {
		alertDiv = '.globalAlert';
		setTimeout(function() {
			$(".alert").fadeOut('slow');
		}, 5000 );
	}

	$(alertDiv).empty();
	$(alertDiv).append(alert);
	$(".alert").fadeIn('slow');
}