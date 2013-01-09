	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3>Nova tarefa</h3>
	</div>

	<div class="modal-body">

		<form class="form-vertical">

			<label for="newTaskTitle" class="control-label">Título *</label>
			<input type="text" class="input-block-level" placeholder="Título" id="newTaskTitle" name="newTaskTitle">

			<label for="taskSource" class="control-label">Origem *</label>

			<label class="radio inline">
			<input type="radio" name="taskSource" class="taskSource" id="taskSource1" value="1"> Projeto
			</label>

			<label class="radio inline">
			<input type="radio" name="taskSource" class="taskSource" id="taskSource2" value="2"> Tarefa
			</label>

			<br></br>

			<div class="taskSelect hide">
				<select  class="input-block-level" id="newTaskFather" name="newTaskFather" data-rel="chosen">
					<option value="<?=$taskID?>"><?=$taskTitle?></option>
					<?php foreach($tasks as $task) { ?>
					<option value="<?=$task->taskID?>" projectID="<?=$task->taskProject?>"><?=$task->taskTitle?></option>
					<?php } ?>

				</select>				
			</div>

			<div class="projectSelect hide">
				<select  class="input-block-level" id="newTaskProject" name="newTaskProject" data-rel="chosen">
					<option value="<?=$projectID?>"><?=$projectTitle?></option>
					<?php foreach($taskProjects as $project) { ?>
					<option value="<?=$project->projectID?>"><?=$project->projectTitle?></option>
					<?php } ?>
				</select>
			</div>

			<div class="linkSelect hide">
				<label class="radio inline">
				<input type="radio" name="taskLink" id="taskLink1" value="1"> Vinculada
				</label>

				<label class="radio inline">
				<input type="radio" name="taskLink" id="taskLink2" value="2"> Referenciada
				</label>
				<br></br>
			</div>

			<label for="taskKind" class="control-label">Tipo: *</label>
			<select  class="input-block-level" id="taskKind" name="taskKind" data-rel="chosen">
				<option></option>
				<?php foreach($taskKinds as $taskKind) { ?>
				<option value="<?=$taskKind->taskKindID?>"><?=$taskKind->taskKindName?></option>
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

