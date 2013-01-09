	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3>Nova tarefa</h3>
	</div>

	<div class="modal-body">

		<form class="form-vertical">

			<label for="newTaskTitle" class="control-label">Título *</label>
			<input type="text" class="input-block-level" placeholder="Título" id="newTaskTitle" name="newTaskTitle">

			<label for="taskKind" class="control-label">Tipo: *</label>
			<select  class="input-block-level" id="taskKind" name="taskKind" data-rel="chosen">
				<option></option>
				<?php foreach($taskKinds as $taskKind) { ?>
				<option value="<?=$taskKind->taskKindID?>"><?=$taskKind->taskKindName?></option>
				<?php } ?>

			</select>

			<label for="newTaskFather" class="control-label">Tarefa pai: *</label>
			<select  class="input-block-level" id="newTaskFather" name="newTaskFather" data-rel="chosen">
				<option value="<?=$taskID?>"><?=$taskTitle?></option>
				<?php foreach($tasks as $task) { ?>
				<option value="<?=$task->taskID?>"><?=$task->taskTitle?></option>
				<?php } ?>

			</select>

			<label for="taskResponsableUser" class="control-label">Responsável: *</label>
			<select  class="input-block-level" id="taskResponsableUser" name="taskResponsableUser" data-rel="chosen">
				<option></option>
				<?php foreach($taskResponsableUsers as $taskResponsableUser) { ?>
				<option value="<?=$taskResponsableUser->userID?>"><?=$taskResponsableUser->userName?></option>
				<?php } ?>

			</select>
		</form>

	</div>

	<div class="modal-footer">
	<a href="#" class="btn btn-primary" id="saveNewTask">Criar</a>
	<a href="#" class="btn" data-dismiss="modal">Fechar</a>
	</div>

