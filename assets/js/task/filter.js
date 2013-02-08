$(document).ready(function(){
	if (typeof taskFilter !== 'function') {
		taskFilter = function taskFilter(){

			$(".taskListFilterCancel").live('click', function( e ){
				$("#filter").modal("hide");
			});
		};
		
		taskFilter();
	}

});