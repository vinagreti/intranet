$(document).ready(function(){
	if (typeof bruno !== 'function') {
		bruno = function activity(){

			$("#saveActivity").live('click', function( e ){
				var valid = true;

				valid = valid && globalValidateLenght(1, 65535, $('#activityComment').val(), 'O comentário deve ter entre 1 e 65535 caracteres');
				valid = valid && globalValidateInput("date", $('#date1').val(), 'As data de início deve possuir o formato d-m-Y');
				valid = valid && globalValidateInput("mail", $('#date2').val(), 'As data de término deve possuir o formato d-m-Y');
				valid = valid && globalValidateInput("time", $('#time1').val(), 'As hora de início deve possuir o formato hh:mm');
				valid = valid && globalValidateInput("time", $('#time2').val(), 'As hora de término devem possuir o formato hh:mm');

				if ( valid ) {
					taskID = $('#taskID').val();
					activityComment = $('#activityComment').val();
					date1 = $('#date1').val();
					time1 = $('#time1').val();
					date2 = $('#date2').val();
					time2 = $('#time2').val();
					activityStart = date1+" "+ time1;
					activityEnd = date2+" "+time2;

					$.post(base_url + "task/activity", {
						activityComment: activityComment,
						activityTask: taskID,
						activityStart: activityStart,
						activityEnd: activityEnd
					});

					$('#tzadiDialogs').modal('hide');
					globalAlert('alert-success', 'Atividade registrada com sucesso!', '.globalAlert');
				}
			});
		};
		
		bruno();
	}
});