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
<script src="<?=base_url()?>assets/js/task/activity.js"></script>

