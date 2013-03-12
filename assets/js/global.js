function globalAlert(kind, message, alertDiv){

	$('.globalModalAlert').empty();
	$('.globalAlert').empty();

	alert = '<div class="alert hide ' + kind + '">"';
	alert += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	alert += '<strong>Mensagem! </strong>' + message;
	alert += '</div>';

	if ( ! alertDiv ) {
		if($('.globalModalAlert').length > 0) alertDiv = '.globalModalAlert';
		else {
			alertDiv = '.globalAlert';
		}
	}

	$(alertDiv).append(alert);
	$(".alert").fadeIn('slow');

	setTimeout(function() {
		$(".alert").fadeOut('slow');
	}, 5000 );
}

function globalValidateInput(kind, input, message){
	switch(kind) {
		case "time":
	        maskRE = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/;
		break;
		case "date":
			maskRE = /^(\d{1,2})-(\d{1,2})-(\d{4})$/;
		break;
		case "email":
			maskRE = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
		break;
	};

	if(maskRE.test(input)) return true;
	else {
		globalAlert('alert-error', message);
		return false;
	}
}

function globalValidateLenght( min, max, input, message ){

	var error = false;
	if( input.length<min ) error = true;
	if( input.length>max ) error = true;

	if( error ) {
		globalAlert('alert-error', message);
		return false;
	} else {
		return true;
	}
}

function globalConfirmAction(message){
   var retVal = confirm(message);
   if( retVal == true ){
	  return true;
   }else{
	  return false;
   }
}