	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Nova tarefa</h3>
	</div>

	<div class="modal-body">
		<div class="row-fluid">
			<div class="span6">

				<div class="row">
					<div class="span6">
						<input type="text" placeholder="Título *" id="newTaskTitle" name="newTaskTitle" class="span6" />
					</div>
				</div>

				<div class="row">
					<div class="span6">
						<textarea rows="3" placeholder="Descrição *" id="newTaskDesc" name="newTaskDesc" class="span6"></textarea>
					</div>
				</div>

			    <div class="row">
					<div class="span3">
						Previsão de conclusão
					</div>
					<div class="span3">
						Tipo:
					</div>
			    </div>

				<div class="row">
					<div class="span3">
						<input type="text" id="deadLineDate" data-date-format="dd-mm-yyyy" class="input-small" />
						<input type="text" id="deadLineTime" class="input-small" />
					</div>
					<div class="span3">
						<select  id="taskKind" name="taskKind" data-rel="chosen">
							<option></option>
							<?php foreach($taskKinds as $taskKind) { ?>
							<option value="<?=$taskKind->taskKindID?>"><?=$taskKind->taskKindName?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="span6">
						<label class="radio inline">
						<input type="radio" name="taskLink" id="taskLink1" value="1" checked /> Vinculada
						</label>

						<label class="radio inline">
						<input type="radio" name="taskLink" id="taskLink2" value="2" /> Referenciada
						</label>
					</div>
				
					<div class="span3">
						<label class="radio inline">
						ao <input type="radio" name="taskSource" class="taskSource" id="taskSource1" value="1"> Projeto
						</label>

						<label class="radio inline">
						à <input type="radio" name="taskSource" class="taskSource" id="taskSource2" value="2"> Tarefa
						</label>
					</div>

				</div>

				<div class="row">
					<div class="span6">
						<div class="newTaskTaskSelect hide">
							</br>
							<select class="span6"  id="newTaskFather" name="newTaskFather" data-rel="chosen">
								<option value="<?=$taskID?>"><?=$taskTitle?></option>
								<?php foreach($tasks as $task) { ?>
								<option value="<?=$task->taskID?>" projectID="<?=$task->taskProject?>"><?=$task->taskID?> - <?=substr($task->taskTitle, 0, 60)?></option>
								<?php } ?>

							</select>				
						</div>

						<div class="newTaskProjectSelect hide">
							</br>
							<select class="span6"  id="newTaskProject" name="newTaskProject" data-rel="chosen">
								<option value="<?=$projectID?>"><?=$projectTitle?></option>
								<?php foreach($taskProjects as $project) { ?>
								<option value="<?=$project->projectID?>"><?=$project->projectTitle?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>

				</br>

				<div class="row">
					<div class="span6">
						<label for="taskResponsableUser" class="control-label">Responsável: *</label>
						<select class="span6" id="taskResponsableUser" name="taskResponsableUser" data-rel="chosen">
							<option value="<?=$this->session->userdata('userID')?>"> <?=$this->session->userdata('userName')?></option>
							<?php foreach($taskResponsableUsers as $taskResponsableUser) { ?>
								<?php if ($this->session->userdata('userID') != $taskResponsableUser->userID) { ?>
									<option value="<?=$taskResponsableUser->userID?>"><?=$taskResponsableUser->userName?></option>
								<?php } ?>
							<?php } ?>

						</select>
					</div>
				</div>
			</div><!--span12 end -->
		</div><!--modal-body row end -->
	</div>

	<div class="modal-footer">
		<a href="#" class="btn btn-primary" id="saveNewTask">Criar</a>
		<a href="#" class="btn" data-dismiss="modal">Fechar</a>
	</div>

	<script src="<?=base_url()?>assets/js/task/newTask.js"></script>