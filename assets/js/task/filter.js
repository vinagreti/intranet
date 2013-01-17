$(document).ready(function(){
	if (typeof taskFilter !== 'function') {
		taskFilter = function taskFilter(){

			$(".taskListFilterCancel").live('click', function( e ){
				$("#filter").modal("hide");
			});

			$(".filterID").live('change', function( e ){
				alert('falta implementar');
			});

			$(".taskListFilterSave").live('click', function( e ){

				$.post(base_url + "task/saveFilter/", {

				filterID : $("#filterID").val(),
				filterTaskID : $("#filterTaskID").val(),
				filterFrojectID : $(".filterFrojectID").val(),
				filterFatherID : $("#filterFatherID").val(),
				filterResponsableID : $(".filterResponsableID").val(),
				filterStatus1 : $("#filterStatus1").is(':checked'),
				filterStatus2 : $("#filterStatus2").is(':checked'),
				filterStatus3 : $("#filterStatus3").is(':checked'),
				filterStatus4 : $("#filterStatus4").is(':checked'),
				filterStatus5 : $("#filterStatus5").is(':checked'),
				filterStatus6 : $("#filterStatus6").is(':checked'),

				},function( response ) {
					$('#tzadiDialogs').append( response );
				});

			});

		};
		
		taskFilter();
	}

});