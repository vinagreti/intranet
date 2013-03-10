$(document).ready(function(){ 
	
	var filterData = { 
		'numRows' : 10,
		'filter' : 'first',
		'firstRow' : 0
	};
	getTasks(filterData); // popula a tabela pela primeira vez.

	$(".refreshList").live('click', function( e ){ // atualiza a lista
		filterData['firstRow'] = 0;
		filterData['numRows'] = $('.listBody tr').length;
		$(".listBody").empty();	
		getTasks(filterData); // função que popula a tabela de tarefas
	});

	$(".showAllTasks").live('click', function( e ){ // mostra todas as tarefas do projeto
		filterData = { 
			'numRows' : 10,
			'filter' : 'all',
			'firstRow' : 0
		}
		$(".listBody").empty(); // remove o conteudo atual da tabela
		getTasks(filterData); // função que popula a tabela de tarefas
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
				$('#filter').empty();

				$.post(base_url + "task/filter/", {
					form : true
				},function( response ) {
					$('#filter').append( response );
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
		if ( $("#filterProjectID").val() ) searchPatternTemp["taskProject"] = $("#filterProjectID").val();
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

	$(".taskListFilterSave").live('click', function( e ){

		e.preventDefault();

		if ( Object.keys(searchPattern).length == 0 ) alert("Nenhum filtro foi definido");
		else {
			if (typeof taskSaveFilter !== 'function') {
				$.ajax({
				  type: "POST",
				  url: base_url + "task/saveFilter/",
				  data: {
				  	form : true
				  } 
				}).done(function( response ) {
					$('#tzadiDialogs').empty();
					$('#tzadiDialogs').append( response );
				});

				$('#tzadiDialogs').modal('show');

			} else {
				$('#tzadiDialogs').modal('show');
			}
		}
	});
	
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
	row += '<td rel="tooltip" title="Opções de interação com a tarefa">'+ $(".actionSelect").clone().html() +'</td>';
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
	$("#filterProjectID").attr("value", "");
	$("#filterResponsableID").attr("value", "");
	$("#filterLink").attr("checked", false);
	$("#filterStatus1").attr("checked", false);
	$("#filterStatus2").attr("checked", false);
	$("#filterStatus3").attr("checked", false);
	$("#filterStatus4").attr("checked", false);
	$("#filterStatus5").attr("checked", false);
	$("#filterStatus6").attr("checked", false);
}