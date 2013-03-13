<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3>Registro de atividade na tarefa <?=$taskID?></h3>
</div>
<div class="modal-body">
	<div class="globalModalAlert" id="modalAlert"></div>
	<div class="row-fluid">
		<div class="span12">
			<textarea rows="2" class="input-block-level" placeholder="Comentário" id="activityComment" name="activityComment"></textarea>
			<div class="row-fluid">
				<div class="span6">
				  <div id="activityStartInput" class="input-prepend">
				    <span class="add-on">
				      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
				      </i>
				    </span>
				    <input data-format="dd/MM/yyyy hh:mm:ss" type="text" id="activityStart"></input>
				  </div>
			  </div>
				<div class="span6">
				  <div id="activityEndInput" class="input-prepend">
				    <span class="add-on">
				      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
				      </i>
				    </span>
				    <input data-format="dd/MM/yyyy hh:mm:ss" type="text" id="activityEnd"></input>
				  </div>
			  </div>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
	<a href="#" class="btn btn-primary" id="saveActivity">Salvar</a>
	<a href="#" class="btn" data-dismiss="modal">Fechar</a>
</div>

<script type="text/javascript">

$('#activityStartInput').datetimepicker({
  language: 'pt-BR'
});

$('#activityEndInput').datetimepicker({
  language: 'pt-BR'
});

$(document).ready(function(){
	taskID = "<?=$taskID?>";
	if (typeof activityForm !== 'function') {
	  activityForm = function activityForm() {
	    $("#saveActivity").live("click", function() {
	      $("#saveActivity").button('loading');
	      var valid = true;
	      valid = valid && globalValidateLenght(1, 65535, $('#activityComment').val(), 'Favor comentar esta ação!');
	      valid = valid && globalValidateLenght(1, 65535, $('#activityStart').val(), 'Favor informar a data inicial!');
	      valid = valid && globalValidateLenght(1, 65535, $('#activityEnd').val(), 'Favor informar a data final!');
	      if ( valid ) {
					$.post(base_url + "task/saveActivity", {
						activityComment: $('#activityComment').val(),
						activityTask: taskID,
						activityStart: $('#activityStart').val(),
						activityEnd: $('#activityEnd').val()
					}, function( e ) {
						if ( e ) {
				    	comment = 'Data inicial: '+$('#activityStart').val();
				    	comment += '</br>Data final: '+$('#activityEnd').val();
				    	comment += '</br>'+$("#activityComment").val();
	            $.post(base_url + "task/saveActionComment", {
	              comment : comment,
	              commentTask : taskID,
	              commentAction : 'Atividade'
	            });
	            refresh();
	            $('#tzadiDialogs').modal('hide');
						}
					});
	      } else {
	        $("#saveActivity").button('reset');
	      }
	    })
	  }
	  activityForm();
	}
});
</script>