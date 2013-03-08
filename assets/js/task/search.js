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

var insertRow = function (task) {
	row = '<td class="center"><small>'+task.taskID+'</small></td>';
	row += '<td>'+ $(".actionSelect").clone().html() +'</td>';
	row += '<td class="center"><small><a href="task/view/taskID" target="_blank" rel="tooltip" title="'+task.taskTitle+'">'+task.taskTitle+'</a></small></td>';
	row += '<td class="center"><small>'+task.taskResponsableName.split(" ")[0]+'</small></td>';
	row += '<td class="center"><small>'+task.taskKindName+'</small></td>';
	row += '<td class="center"><small><a href="task/view/taskFather" target="_blank" rel="tooltip" title="link?"><span class="label"><small>'+task.taskFather+'</small></span></a></small></td>';
	row += '<td class="center"><small><a href="task/project/taskProject" target="_blank">'+task.taskProjectTitle+'</a></small></td>';
	row += '<td class="center "><span class="label taskLabel"><small>'+task.taskStatusName+'</small></span></td>';
	row += '<td class="center"><small>'+task.deadLineDate+'</small></td>';
	listRow = '<tr>'+row+'</tr>';
	$(".listBody").append(listRow);	
}

var getTasks = function ( e ){
	$('.loading').show();

	filter = { };
	filter['firstRow'] = $('.listBody tr').length;
	filter['numRows'] = e.numRows;
	if ( typeof e.filter == "number") filter['filterID'] = e.filter;
	else if ( typeof e.filter == "object") filter['searchPattern'] = e.filter;
	
	$.post(base_url+"task/search", filter, function( e ) {
		console.log(e);
		if( e ) {
			$(".total").text( e.total );
			$.each( e.tasks , function(index, task) {
				insertRow(task);
			});
		}
		reCountRows();
		$('.loading').hide();
	}, "json");
}

var reCountRows = function () {
	totalRows = $('.listBody tr').length;
	$(".loaded").text( totalRows );
	loaded = $(".loaded").text();
	total = $(".total").first().text();
	if ( loaded == total ) $("#paginationButtons").hide();
	else $("#paginationButtons").show();
	return totalRows;
}

var firstLoad = function () {
	data = { numRows : 10 }
	getTasks(data); // função que popula o select com os filtros padrão do usuário
}

$(document).ready(function(){

console.log($(".actionSelect").clone().html());
	firstLoad();
	
	$("#showMore").live("click", function(){
		data = { numRows : 10 }
		getTasks(data);
	});

	$("#showAll").live("click", function(){
		data = { numRows : 18446744073709551615 }
		getTasks(data);
	});

	$(".taskListFilterReset").live('click', function( e ){
		$(".filterID").val('');
		searchPattern = {};
		loadList(searchPattern);
	});

	$(".taskListFilterClean").live('click', function( e ){
		filterClean();
	});

	$(".taskFilterRefresh").live('click', function( e ){
		loadList(searchPattern);
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

		loadList(searchPattern);
	});


	$(".taskListFilter").live('click', function( e ){
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

	$(".taskListFilterSave").live('click', function( e ){

		e.preventDefault();

		if ( Object.keys(searchPattern).length == 0 ) alert("Nenhum filtro foi definido");
		else {
			if (typeof taskSaveFilter !== 'function') {
				$.ajax({
				  type: "POST",
				  url: base_url + "task/saveFilter/",
				  data: {
				  	form : true,
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

	$(".taskListFilterSetDefault").live('click', function( e ){
		filterID = $(".filterID").val();
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

	$(".filterID").live('change', function( e ){
		// Select de escolha do filtro
		// transforma o valor do select selecionado na variavel searchPattern[filterID] 
		// recarrega a listagem com o novo searchPattern
		if($(".filterID").val()) searchPattern = window['searchPattern'+$(".filterID").val()];
		else searchPattern = {};
		loadList(searchPattern);
	});
});