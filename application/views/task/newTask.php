	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Nova tarefa</h3>
	</div>

	<div class="modal-body">
    <div class="globalModalAlert" id="modalAlert"></div>
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

					<div class="span6">
			      <select  id="taskKind" name="taskKind" data-rel="chosen" class="input-block-level">
			        <option value="">Tipo da tarefa...</option>
			        <?php foreach($taskKinds as $taskKind) { ?>
			        <option value="<?=$taskKind->taskKindID?>"><?=$taskKind->taskKindName?></option>
			        <?php } ?>
			      </select>
					</div>

					<div class="span6">
					  <div id="deadLine" class="input-prepend date">
					    <span class="add-on">
					      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
					      </i>
					    </span>
					    <input data-format="dd/MM/yyyy hh:mm:ss" type="text" id="deadLineDate"></input>
					  </div>
				  </div>


				</div>

        <div class="row-fluid">
          <div class="span12">
            <div class="span6">
              <div class="btn-group pull-left" data-toggle="buttons-radio">
                <button class="btn btn-large" type="button" name="taskLink" value="0">
                  Referenciada
                </button>
                <button class="btn btn-large active" type="button" name="taskLink" value="1">
                  Vinculada
                </button>
              </div>
            </div>

            <div class="span6">
              <div class="btn-group pull-right" data-toggle="buttons-radio">
                <button class="btn btn-large active" id="taskSourceTask" type="button" name="taskSource" value="task">à Tarefa</button>
                <button class="btn btn-large" id="taskSourceProject" type="button" name="taskSource" value="project">ao Projeto</button>
              </div>
            </div>
          </div>
        </div>

        </br>
    
      	<div class="newTaskTaskSelect">
          <select id="newTaskFather" name="newTaskFather" data-rel="chosen" class="input-block-level">
            <option value="">Selecione a tarefa pai...</option>
            <?php foreach($tasks as $task) { ?>
            <option value="<?=$task->taskID?>" project="<?=$task->taskProject?>"><?=$task->taskID?> - <?=substr($task->taskTitle, 0, 60)?></option>
            <?php } ?>
          </select>       
        </div>

        <div class="newTaskProjectSelect hide">
          <select id="newTaskProject" name="newTaskProject" data-rel="chosen" class="input-block-level">
            <option value="">Selecione o projeto pai...</option>
            <?php foreach($taskProjects as $project) { ?>
            <option value="<?=$project->projectID?>"><?=$project->projectTitle?></option>
            <?php } ?>
          </select>
        </div>

			</div> <!-- span12 end -->
		</div> <!-- row-fluid end -->
	</div><!--modal-body row end -->

	<div class="modal-footer">
		<button type="submit" class="btn btn-primary" id="saveNewTask" data-loading-text="Salvando...">Criar</button>
		<a href="#" class="btn" data-dismiss="modal">Fechar</a>
    <a href="#" class="btn" id="test">Fechar</a>
	</div>

	<script src="<?=base_url()?>assets/js/task/newTask.js"></script>