<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>Filtrar tarefas</h3>
</div>

<div class="modal-body">

	<form method="post" action="#" class="form-horizontal filterForm">

		<fieldset>

			<label>Task number: </label>
			<input class="span12" type="text" id="filterTaskID" placeholder="Task number" name="filterTaskID">


			<label>Task father: </label>
			<input class="span12" type="text" id="filterFatherID" placeholder="Task father" name="filterFatherID">

			<label>Responsável: </label>
			<select class="span12" id="filterResponsableID">
				<option></option>
				<?php foreach ($users as $user) { ?>
				<option value="<?=$user->userID?>"><?=$user->userName?></option>
				<?php } ?>
			</select>

			<label>Vínculo: </label>
			<label class="radio inline">
			<input type="radio" name="filterTaskLink" id="filterTaskLink" value="1" /> Vinculada
			</label>

			<label class="radio inline">
			<input type="radio" name="filterTaskLink" id="filterTaskLink" value="0" /> Referenciada
			</label>

			<label class="radio inline">
			<input type="radio" name="filterTaskLink" checked /> Todas
			</label>

			<label>Status: </label>

			<label class="checkbox inline">
			  <input id="filterStatus1" value="1" type="checkbox">
			  <span class="label"><small>New</small></span>
			</label>

			<label class="checkbox inline">
			  <input id="filterStatus2" value="2" type="checkbox">
			  <span class="label label-inverse"><small>Rejected</small></span>
			</label>

			<label class="checkbox inline">
			  <input id="filterStatus3" value="3" type="checkbox">
			  <span class="label label-success"><small>Approved</small></span>
			</label>

			<label class="checkbox inline">
			  <input id="filterStatus4" value="4" type="checkbox">
			  <span class="label label-warning"><small>On going</small></span>
			</label>

			<label class="checkbox inline">
			  <input id="filterStatus5" value="5" type="checkbox">
			  <span class="label label-important"><small>Cancelled</small></span>
			</label>

			<label class="checkbox inline">
			  <input id="filterStatus6" value="6" type="checkbox">
			  <span class="label label-info"><small>Finished</small></span>
			</label>
		</fieldset>
	</form>

</div>

<div class="modal-footer">
	<button type="button" src="#" class="taskFilterButton btn btn-small btn-primary" href="#">Filtrar</button>
	<button type="button" src="#" class="taskListFilterCancel btn btn-small btn-danger" href="#">Cancelar</button>
	<button type="button" src="#" class="taskListFilterClean btn btn-small btn-warning" href="#">Limpar filtro</button>
</div>

<script src="<?=base_url()?>assets/js/task/filter.js"></script>