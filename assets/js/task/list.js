var searchPattern = new Array();

function loadList(searchPattern){

	$(".taskList").empty();

	$(".taskList").append("</br></br></br></br></br>Carregando...</br></br></br></br></br></br>");

	$.post(base_url+"task/ajaxSearch", {
		taskResponsableUser : searchPattern["taskResponsableUser"],
		taskProject : searchPattern["taskProject"],
		taskID : searchPattern["taskID"],
		taskFather : searchPattern["taskFather"],
		taskStatus : searchPattern["taskStatus"],
		taskLink : searchPattern["taskLink"],
		searchPattern : searchPattern
	}, function( response ) {

		$(".taskList").empty();

		$(".taskList").append(response);

	});
	
}


function resetFilter(){
	$("#filterID").attr("value", "");
	$("#filterTaskID").attr("value", "");
	$("#filterFatherID").attr("value", "");
	$(".filterFrojectID").attr("value", "");
	$(".filterResponsableID").attr("value", "");
	$("#filterStatus1").attr("checked", false);
	$("#filterStatus2").attr("checked", false);
	$("#filterStatus3").attr("checked", false);
	$("#filterStatus4").attr("checked", false);
	$("#filterStatus5").attr("checked", false);
	$("#filterStatus6").attr("checked", false);
}

$(document).ready(function(){

	resetFilter();
	loadList(searchPattern);



	$(".taskListFilterReset").live('click', function( e ){
		searchPattern = [];
		resetFilter();
		$("#filter").modal("hide");
		loadList(searchPattern);
	});

	$(".taskListFilterClean").live('click', function( e ){
		resetFilter();
	});

	$(".taskFilterButton").live('click', function( e ){

		searchPattern["taskStatus"] = [];
		
		if ( $("#filterTaskID").val() )	searchPattern["taskID"] = $("#filterTaskID").val();
		if ( $("#filterFatherID").val() ) searchPattern["taskFather"] = $("#filterFatherID").val();
		if ( $(".filterFrojectID").val() ) searchPattern["taskProject"] = $(".filterFrojectID").val();
		if ( $(".filterResponsableID").val() ) searchPattern["taskResponsableUser"] = $(".filterResponsableID").val();
		if ( $("#taskLink").val() )	searchPattern["taskLink"] = $("#taskLink:checked").val();
		if ( $("#filterStatus1").is(':checked') ) searchPattern["taskStatus"].push(1);
		if ( $("#filterStatus2").is(':checked') ) searchPattern["taskStatus"].push(2);
		if ( $("#filterStatus3").is(':checked') ) searchPattern["taskStatus"].push(3);
		if ( $("#filterStatus4").is(':checked') ) searchPattern["taskStatus"].push(4);
		if ( $("#filterStatus5").is(':checked') ) searchPattern["taskStatus"].push(5);
		if ( $("#filterStatus6").is(':checked') ) searchPattern["taskStatus"].push(6);

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


});