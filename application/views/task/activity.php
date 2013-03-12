<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3>Registro de atividade na tarefa <?=$taskID?></h3>
</div>
<div class="modal-body">
	<div class="globalModalAlert" id="modalAlert"></div>
	<form class="form-vertical">
		<label for="activityComment" class="control-label">Comente a atividade *</label>
		<textarea rows="2" taskID="<?=$taskID?>" class="input-block-level" placeholder="Comentário" id="activityComment" name="activityComment"></textarea>
		<label for="startDate" class="control-label">Início da atividade *</label>
		<input type="text" id="date1" value="<?=$date?>" data-date-format="dd-mm-yyyy" />
		<input type="text" id="time1" value="<?=$time?>" class="input-small" />
		<label for="finishDate" class="control-label">Término da atividade *</label>
		<input type="text" id="date2" value="<?=$date?>" data-date-format="dd-mm-yyyy" />
		<input type="text" id="time2" value="<?=$time?>" class="input-small" />
		<input type="hidden" id="taskID" value="<?=$taskID?>" />
	</form>
</div>
<div class="modal-footer">
	<a href="#" class="btn btn-primary" id="saveActivity">Salvar</a>
	<a href="#" class="btn" data-dismiss="modal">Fechar</a>
</div>

<script type="text/javascript">
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
</script>