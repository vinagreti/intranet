	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Nova tarefa</h3>
	</div>

	<div class="modal-body">
		<div class="row-fluid">
			<div class="span12">

				<input type="text" placeholder="Título *" id="newTaskTitle" name="newTaskTitle" class="input-block-level" />
				<textarea rows="3" placeholder="Descrição *" id="newTaskDesc" name="newTaskDesc" class="input-block-level" ></textarea>

	      <div>
	        <select id="taskResponsableUser" name="taskResponsableUser" data-rel="chosen" class="input-block-level" >
	          <option value="<?=$this->session->userdata('userID')?>"> <?=$this->session->userdata('userName')?></option>
	          <?php foreach($taskResponsableUsers as $taskResponsableUser) { ?>
	            <?php if ($this->session->userdata('userID') != $taskResponsableUser->userID) { ?>
	              <option value="<?=$taskResponsableUser->userID?>"><?=$taskResponsableUser->userName?></option>
	            <?php } ?>
	          <?php } ?>
	        </select>
	      </div>

				<div class="row-fluid">
					<div class="span5">
			      <input type="text" id="deadLineDate" data-date-format="dd-mm-yyyy" class="input-small" />
			      <input type="text" id="deadLineTime" class="input-small" />
					</div>

					<div class="span7">
			      <select  id="taskKind" name="taskKind" data-rel="chosen" class="input-block-level">
			        <option>Tipo da tarefa...</option>
			        <?php foreach($taskKinds as $taskKind) { ?>
			        <option value="<?=$taskKind->taskKindID?>"><?=$taskKind->taskKindName?></option>
			        <?php } ?>
			      </select>
					</div>
				</div>

				<div>
		      <label class="radio inline">
		      <input type="radio" name="taskLink" id="taskLink1" value="1" checked /> Vinculada
		      </label>
		      <label class="radio inline">
		      <input type="radio" name="taskLink" id="taskLink2" value="2" /> Referenciada
		      </label>
				</div>

				<div>
		      <label class="radio inline">
		      ao <input type="radio" name="taskSource" class="taskSource" id="taskSource1" value="1"> Projeto
		      </label>
		      <label class="radio inline">
		      à <input type="radio" name="taskSource" class="taskSource" id="taskSource2" value="2"> Tarefa
		      </label>
		      <br></br>
				</div>

      	<div class="newTaskTaskSelect hide">
          <select id="newTaskFather" name="newTaskFather" data-rel="chosen" class="input-block-level">
            <option value="<?=$taskID?>"><?=$taskTitle?></option>
            <?php foreach($tasks as $task) { ?>
            <option value="<?=$task->taskID?>" projectID="<?=$task->taskProject?>"><?=$task->taskID?> - <?=substr($task->taskTitle, 0, 60)?></option>
            <?php } ?>

          </select>       
        </div>

        <div class="newTaskProjectSelect hide">
          <select id="newTaskProject" name="newTaskProject" data-rel="chosen" class="input-block-level">
            <option value="<?=$projectID?>"><?=$projectTitle?></option>
            <?php foreach($taskProjects as $project) { ?>
            <option value="<?=$project->projectID?>"><?=$project->projectTitle?></option>
            <?php } ?>
          </select>
        </div>

			</div> <!-- span12 end -->
		</div> <!-- row-fluid end -->
	</div><!--modal-body row end -->

	<div class="modal-footer">
		<a href="#" class="btn btn-primary" id="saveNewTask">Criar</a>
		<a href="#" class="btn" data-dismiss="modal">Fechar</a>
	</div>

	<script src="<?=base_url()?>assets/js/task/newTask.js"></script>