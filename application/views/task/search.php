<div class="row-fluid">
	<h3>Tarefas 
		<?php if($this->session->userdata('userProject') > 0) {
			echo 'do projeto ' . $this->session->userdata('userProjectName');
		} else {
			echo "de todos os projetos";
		} ?>
	</h3>
</div>

<div class="row-fluid"> <!-- inicio filtro -->
	<div class="span3"> <!-- inicio seletor de filtro padrão -->
		<form>
			<select id="selectFilters" class="span12">
				<option value="0">Tudo...</option>
					<?php foreach($filters as $filter) { ?>
						<option value="<?=$filter->filterID?>" <?php if($filter->default) echo 'selected';?>>
							<?=$filter->filterTitle?>
						</option>
					<?php } ?>
			</select>
		</form>
	</div> <!-- fim seletor de filtro padrão -->
	<div class="span9"> <!-- inicio botões -->
		<a class="openSearchForm btn" href="#"><i class="icon-search"></i></a>
		<a class="refresh btn btn-info" href="#" rel="tooltip" title="Atualizar lista"><i class="icon-refresh icon-white"></i></a>
		<a class='saveCurrentSearch btn btn-success' rel="tooltip" title="Salvar filtro atual"><i class="icon-download-alt icon-white"></i></a>
		<a class='setSearchAsDefault btn btn-warning' rel="tooltip" title="Tornar filtro padrão"><i class="icon-star icon-white"></i></a>
	</div> <!-- fim botões -->
</div> <!-- fim do filtro -->

<div class="row-fluid"> <!-- inicio do indicador de total de tarefas retornadas -->
	<div class="span12">
		<p class="text-warning">Foram localizadas <b class="total"></b> tarefas</p>
	</div>
</div><!-- fim do indicador de total -->

<div class="row-fluid"> <!-- inicio da tabela -->
	<table class="table table-hover table-condensed tablesorter">
		<thead>
			<tr>
				<th class="header">Nº</th>
				<th class="header">Ação</th>
				<th class="header">Título</th>
				<th class="header">Responsável</th>
				<th class="header">Tipo</th>
				<th class="header"><abbr title="Tarefa Pai">TP</th>
				<th class="header">Projeto</th>
				<th class="header">Status</th>
				<th class="header">Vencimento</th>
			</tr>
		</thead>
		<tbody class="listBody"></tbody>
	</table>  
</div> <!-- fim da tabela -->

<div class="row-fluid">
	<div class="span12">
		<div class="row-fluid">
			<div class="span12">
				<p class="text-center text-warning">Mostrando <b class="loaded">10</b> de <b class="total"></b> tarefas</p>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12" id="paginationButtons">	
				<div class="span6">
					<a id="showMore" class="btn btn-success btn-large btn-block">Próximas 10</a>
				</div>
				<div class="span6">
					<a id="showAll" class="btn btn-info btn-large btn-block">Todas</a>
				</div>
			</div>
		</div>
	</div>
</div><!--/row-fluid-->

<div class="span4 hide" id="createFilterForm">
	<div class="input-prepend">
		<span class="add-on">Filtro</span>
		<input type="text" class="filterName span10" placeholder="Informe o nome do novo filtro" />
	</div>
</div>

<script type="text/javascript">
var searchPattern = {};

var filterData = { 
	'numRows' : 10,
	'filter' : 'first',
	'firstRow' : 0
};

var refresh = function () {
	filterData['firstRow'] = 0;
	filterData['numRows'] = 10;
	$(".listBody").empty();	
	getTasks(filterData); // função que popula a tabela de tarefas
}

$(document).ready(function(){
	
	getTasks(filterData); // popula a tabela pela primeira vez.

	$(".refresh").live('click', function( e ){ // atualiza a lista
		refresh();
	});

	$("table").tablesorter(); // faz a tabela ficar ordenável

	$("#showMore").live("click", function(){ // mostra as proximas 10 tarefas
		filterData['numRows'] = 10 ;
		filterData['firstRow'] = $('.listBody tr').length;
		getTasks(filterData);
	});

	$("#showAll").live("click", function(){ // mostra todas as ocorrencias de uma busca. Sem paginar de 10 em 10
		filterData['numRows'] = 18446744073709551615 ;
		filterData['firstRow'] = $('.listBody tr').length;
		getTasks(filterData);
	});

	$("#selectFilters").live('change', function( e ){
		if($("#selectFilters").val() != 0) {
			filterData['numRows'] = 10 ;
			filterData['firstRow'] = 0;
			filterData['filter'] = $("#selectFilters").val();
			$(".listBody").empty();
			getTasks(filterData);
		} else {
			filterData = { 
				'numRows' : 10,
				'filter' : 'all',
				'firstRow' : 0
			}
			$(".listBody").empty(); // remove o conteudo atual da tabela
			getTasks(filterData); // função que popula a tabela de tarefas
		}
	});

	$(".setSearchAsDefault").live('click', function( e ){
		filterID = $("#selectFilters").val();
		$.ajax({
		  type: "POST",
		  url: base_url + "task/filterSetDefault/",
		  data: {
		  	filterID : filterID
		  } 
		}).done(function( response ) {
			alert("O filtro atual agora é seu filtro padrão");
		});
	});

	$(".openSearchForm").live('click', function( e ){
		if (typeof listFile !== 'function') {
			listFile = function listFile(){
				$.post(base_url + "task/filter/", {
					form : true
				},function( response ) {
					$('#filter').html( response );
				});

				$("#filter").modal("show");
			};
			
			listFile();
		} else {
			$("#filter").modal("show");
		}
	});

	$(".taskListFilterClean").live('click', function( e ){
		filterClean();
	});

	$(".taskFilterButton").live('click', function( e ){

		var searchPatternTemp = {};

		if ( $("#filterTaskID").val() )	searchPatternTemp["taskID"] = $("#filterTaskID").val();
		if ( $("#filterFatherID").val() ) searchPatternTemp["taskFather"] = $("#filterFatherID").val();
		if ( $("#filterResponsableID").val() ) searchPatternTemp["taskResponsableUser"] = $("#filterResponsableID").val();
		if ( $("#filterTaskLink:checked").val() )	searchPatternTemp["taskLink"] = $("#filterTaskLink:checked").val();
		if ( $("#filterStatus1").is(':checked') ) searchPatternTemp["taskStatus1"] = true;
		if ( $("#filterStatus2").is(':checked') ) searchPatternTemp["taskStatus2"] = true;
		if ( $("#filterStatus3").is(':checked') ) searchPatternTemp["taskStatus3"] = true;
		if ( $("#filterStatus4").is(':checked') ) searchPatternTemp["taskStatus4"] = true;
		if ( $("#filterStatus5").is(':checked') ) searchPatternTemp["taskStatus5"] = true;
		if ( $("#filterStatus6").is(':checked') ) searchPatternTemp["taskStatus6"] = true;

		if ( Object.keys(searchPatternTemp).length > 0 ) {
			$(".filterID").val('');
			searchPattern = searchPatternTemp;
		}

		$("#filter").modal("hide");

		filterData = { 
			'numRows' : 10,
			'filter' : searchPattern,
			'firstRow' : 0
		}
		$(".listBody").empty(); // remove o conteudo atual da tabela
		getTasks(filterData); // função que popula a tabela de tarefas
	});

	$(".saveCurrentSearch").live('click', function( e ){

		e.preventDefault();

		if ( Object.keys(searchPattern).length == 0 ) alert("Nenhum novo filtro foi definido");
		else {
			if (typeof taskSaveFilter !== 'function') {
				$.ajax({
				  type: "POST",
				  url: base_url + "task/saveFilter/",
				  data: {
				  	form : true
				  } 
				}).done(function( response ) {
					$('#tzadiDialogs').html( response );
				});

				$('#tzadiDialogs').modal('show');

			} else {
				$('#tzadiDialogs').modal('show');
			}
		}
	});


	if (typeof searchJS !== 'function') {
		searchJS = function searchJS(){

			/*
			Função do botão APROVAR: approveButton
			Este botão:
			- muda o status de uma tarefa para Approved "taskStatus= 3"
			- muda a tarefa para a tabela Approved
			*/
			$(".approveButton").live('click', function( e ){
				e.preventDefault();
				taskID = $(this).attr('taskID');
				if(globalConfirmAction("Deseja realmente aprovar a tarefa "+ taskID + "?")){
					$.post(base_url + "task/update/" + taskID, {
						taskStatus : 3,
						taskID : taskID
					},function( e ) {
						if ( e ) {
							$.post(base_url + "task/saveActionComment", {
								comment : 'Successo!',
								commentTask : taskID,
								commentAction : 'Aprovada'
							});
							refresh();
						}
					});
				}
			});

			/*
			Função do botão REJEITAR: rejectButton
			Este botão:
			- Abre um formulário para inserir um comentário
			- muda o status de uma tarefa para REJECTED "taskStatus= 2"
			*/
			$(".rejectButton").live('click', function( e ){
				e.preventDefault();
				taskID = $(this).attr('taskID');
				if(globalConfirmAction("Deseja realmente rejeitar a tarefa "+ taskID + '?')){
					$.post(base_url + "task/rejectTask", {
						form : true,
						taskID : taskID
					}, function( e ) {
						$('#tzadiDialogs').html( e );
						$('#tzadiDialogs').modal('show');
					});
				}
			});



			/*
			Função do botão CANCELAR: cancelButton
			Este botão:
			- muda o status de uma tarefa para CANCELLED "taskStatus= 5"
			- muda a tarefa para a tabela Cancelled
			*/
			$(".cancelButton").live('click', function( e ){
				e.preventDefault();
				taskID = $(this).attr('taskID');
				if(globalConfirmAction("Deseja realmente cancelar a tarefa "+ taskID + '?')){
					$.post(base_url + "task/cancelTask", {
						form : true,
						taskID : taskID
					}, function( e ) {
						$('#tzadiDialogs').html( e );
						$('#tzadiDialogs').modal('show');
					});
				}
			});


			/*
			Função do botão INICIAR: startButton
			Este botão:
			- muda o status de uma tarefa para OnGOING "taskStatus= 4"
			- muda a tarefa para a tabela On Going
			*/
			$(".startButton").live('click', function( e ){
				e.preventDefault();
				taskID = $(this).attr('taskID');
				if(globalConfirmAction("Deseja realmente iniciar a tarefa "+ taskID + '?')){
					$.post(base_url + "task/update/" + taskID, {
						taskStatus : 4,
						taskID : taskID
					},function( e ) {
						if ( e ) {
							$.post(base_url + "task/saveActionComment", {
								comment : 'Successo!',
								commentTask : taskID,
								commentAction : 'Iniciada'
							});
							refresh();
						}
					});
				}
			});

			/*
			Função do botão REABRIR: reopenButton
			Este botão:
			- muda o status de uma tarefa para NEW "taskStatus= 1"
			- muda a tarefa para a tabela NEW
			*/
			$(".reopenButton").live('click', function( e ){
				e.preventDefault();
				taskID = $(this).attr('taskID');
				if(globalConfirmAction("Deseja realmente reabrir a tarefa "+ taskID + '?')){
					$.post(base_url + "task/reopenTask", {
						form : true,
						taskID : taskID
					}, function( e ) {
						$('#tzadiDialogs').html( e );
						$('#tzadiDialogs').modal('show');
					});
				}
			});

			/*
			Função do botão ACTIVITY: activityButton
			Este botão:
			- Abre o formulário para registro de atividades
			- insere um comentário na atividade selecionada
			*/
			$(".activityButton").live('click', function( e ){
				e.preventDefault();
				taskID = $(this).attr('taskID');
				if(globalConfirmAction("Deseja realmente reabrir a tarefa "+ taskID + '?')){
					$.post(base_url + "task/saveActivity", {
						form : true,
						taskID : taskID
					}, function( e ) {
						$('#tzadiDialogs').html( e );
						$('#tzadiDialogs').modal('show');
					});
				}
			});

			/*
			Função do botão FINALIZAR: finishButton
			Este botão:
			- muda o status de uma tarefa para FINISHED "taskStatus= 6"
			- muda a tarefa para a tabela FINISHED
			*/
			$(".finishButton").live('click', function( e ){
				e.preventDefault();
				taskID = $(this).attr('taskID');
				if(globalConfirmAction("Deseja realmente reabrir a tarefa "+ taskID + '?')){

					$.post(base_url + "task/update/" + taskID, {
						taskStatus : 6,
						taskID : taskID
					},function( e ) {
						if ( e ) {
							$.post(base_url + "task/finishTask", {
								form : true,
								taskID : taskID
							}, function( e ) {
								$('#tzadiDialogs').html( e );
								$('#tzadiDialogs').modal('show');
							});
						}
					});
				}
			});

			/*
			Função do botão COMENTAR: commentButton
			Este botão:
			- insere um comentário na tarefa selecionada
			*/
			$(".commentButton").live('click', function( e ){
				e.preventDefault();
				taskID = $(this).attr('taskID');
				$.post(base_url + "task/comment", {
					form : true,
					taskID : taskID
				}, function( e ) {
					$('#tzadiDialogs').html( e );
					$('#tzadiDialogs').modal('show');
				});
			});
		};

		searchJS();
	}
});

var insertRow = function (task) { // insere linha na tabela

	if (task.taskTitle.length > 100) taskTitle = task.taskTitle.substring(0,100)+"...";
	else taskTitle = task.taskTitle;

	// Define o label e o tooltip do link de tarefa pai.
	if(task.taskLink == 1) {
		label = 'label-important'; link = "Vinculada à tarefa "+task.taskFather;
	} else { 
		label = 'label-info'; link = "Referenciada à tarefa "+task.taskFather; 
	}

	if(task.taskFather == 0) { 
		if(task.taskLink == 1) { 
			link = "Vinculo direto com o projeto "+task.taskProjectTitle; 
		} else { 
			link = "Referência direta ao projeto "+task.taskProjectTitle; 
		}
	}

	row = '<td class="center" rel="tooltip" title="Número da tarefa"><small>'+task.taskID+'</small></td>';
	row += '<td rel="tooltip" title="Opções de interação com a tarefa">';
		row += '<span class="nav"><li class="dropdown">';
			row += '<button class="actionButton btn btn-info btn-mini" data-toggle="dropdown"><i class="icon-chevron-down"></i></button>';
			row += '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" tabindex="-1">';
			if(task.taskStatus == "1") row += '<li ><a class="approveButton" taskID="'+task.taskID+'" href="#profile"><i class="icon-thumbs-up"></i> Aprovar</a></li>';
			if(task.taskStatus == "1") row += '<li><a class="rejectButton" taskID="'+task.taskID+'" href="#profile"><i class="icon-thumbs-down"></i> Rejeitar</a></li>';
			if(task.taskStatus != "1" && task.taskStatus != "5"  && task.taskStatus != "2") row += '<li><a class="cancelButton" taskID="'+task.taskID+'" href="#profile"><i class="icon-remove"></i> Cancelar</a></li>';
			if(task.taskStatus != "5"  && task.taskStatus != "2"  && task.taskStatus != "4") row += '<li><a class="startButton" taskID="'+task.taskID+'" href="#profile"><i class="icon-play"></i> Iniciar</a></li>';
			if(task.taskStatus != "5"  && task.taskStatus != "2") row += '<li><a class="finishButton" taskID="'+task.taskID+'" href="#profile"><i class="icon-ok"></i> Finaizar</a></li>';
			if(task.taskStatus == "5" || task.taskStatus == "2") row += '<li><a class="reopenButton" taskID="'+task.taskID+'" href="#profile"><i class="icon-warning-sign"></i> Reabrir tarefa</a></li>';
			row += '<li><a class="commentButton" taskID="'+task.taskID+'" href="#profile"><i class="icon-comment"></i> Comentar</a></li>';
			if(task.taskStatus != "1") row += '<li><a class="activityButton" taskID="'+task.taskID+'" href="#profile"><i class="icon-time"></i> Registrar atividade</a></li>';
		row += '</ul></li></span>';
	row += '</td>';
	row += '<td class="center"><small><a href="task/view/'+task.taskID+'" target="_blank" rel="tooltip" title="'+task.taskTitle+'">'+ taskTitle +'</a></small></td>';
	row += '<td class="center" rel="tooltip" title="Responsável pela tarefa"><small>'+task.taskResponsableName.split(" ")[0]+'</small></td>';
	row += '<td class="center" rel="tooltip" title="Tipo de tarefa"><small>'+task.taskKindName+'</small></td>';
	row += '<td class="center"><small><a href="task/view/'+task.taskFather+'" target="_blank" rel="tooltip" title="'+link+'"><span class="label '+label+'"><small>'+task.taskFather+'</small></span></a></small></td>';
	row += '<td class="center" rel="tooltip" title="Projeto"><small><a href="task/project/'+task.taskProject+'" target="_blank">'+task.taskProjectTitle+'</a></small></td>';
	row += '<td class="center" rel="tooltip" title="Status da tarefa"><span class="label ' + task.taskLabel + '"><small>'+task.taskStatusName+'</small></span></td>';
	row += '<td class="center" rel="tooltip" title="Vencimento"><small>'+task.deadLineDate+'</small></td>';
	listRow = '<tr>'+row+'</tr>';
	$(".listBody").append(listRow);	
}

var getTasks = function ( filterData ){ // solicita dados ao servidor

	$('.loading').show();

	$.post(base_url+"task/search", filterData, function( e ) {
		if( e ) {
			$(".total").text( e.total );
			$.each( e.tasks , function(index, task) {
				insertRow(task);
			});
		}
		reCountRows();
		reSortTable();
		$('.loading').hide();
	}, "json");
}

var reCountRows = function () { // conta quantas tarefas existem na tabela e atualiza os indicadores superior e inferior
	totalRows = $('.listBody tr').length;
	$(".loaded").text( totalRows );
	loaded = $(".loaded").text();
	total = $(".total").first().text();
	if ( loaded == total ) $("#paginationButtons").hide();
	else $("#paginationButtons").show();
	return totalRows;
}

var reSortTable = function () { // reaplica a ordenação na tabela. Usado para adição com ajax
  var resort = true;
  $("table").trigger("update", [resort]);
}

var filterClean = function (){
	$("#filterTaskID").attr("value", "");
	$("#filterFatherID").attr("value", "");
	$("#filterResponsableID").attr("value", "");
	$("#filterLink").attr("checked", false);
	$("#filterStatus1").attr("checked", false);
	$("#filterStatus2").attr("checked", false);
	$("#filterStatus3").attr("checked", false);
	$("#filterStatus4").attr("checked", false);
	$("#filterStatus5").attr("checked", false);
	$("#filterStatus6").attr("checked", false);
}
</script>