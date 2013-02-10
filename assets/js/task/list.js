function loadList(searchPattern){

	$(".taskList").empty();

	$(".taskList").append("</br></br></br></br></br>Carregando...</br></br></br></br></br></br>");

	$.post(base_url+"task/ajaxSearch", {
		taskResponsableUser : searchPattern["taskResponsableUser"],
		taskProject : searchPattern["taskProject"],
		taskID : searchPattern["taskID"],
		taskFather : searchPattern["taskFather"],
		taskLink : searchPattern["taskLink"],
		taskStatus1 : searchPattern["taskStatus1"],
		taskStatus2 : searchPattern["taskStatus2"],
		taskStatus3 : searchPattern["taskStatus3"],
		taskStatus4 : searchPattern["taskStatus4"],
		taskStatus5 : searchPattern["taskStatus5"],
		taskStatus6 : searchPattern["taskStatus6"],
	}, function( response ) {

		$(".taskList").empty();

		$(".taskList").append(response);

		//fillFormWothPattern();
	});
	
}

function fillFormWothPattern() {
	$("#filterTaskID").attr("value", '11');
	if(searchPattern["taskID"]) $("#filterTaskID").attr("value", searchPattern["taskID"]);
	if(searchPattern["taskFather"]) $("#taskFatherID").attr("value", searchPattern["taskFather"]);
	if(searchPattern["taskProject"]) $("#filterProjectID").attr("value", searchPattern["filterProjectID"]);
	if(searchPattern["taskResponsableUser"]) $("#filterResponsableID").attr("value", searchPattern["taskResponsableUser"]);
}

function filterReset(){
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

$(document).ready(function(){

	filterReset();

	loadList(searchPattern);

	$(".taskListFilterReset").live('click', function( e ){
		searchPattern = {};
		loadList(searchPattern);
	});

	$(".taskListFilterClean").live('click', function( e ){
		filterReset();
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

		if ( Object.keys(searchPatternTemp).length > 0 ) searchPattern = searchPatternTemp;

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
		loadList(window['searchPattern'+$(".filterID").val()]);
	});
});