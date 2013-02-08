$(document).ready(function(){
	if (typeof taskSaveFilter !== 'function') {
		taskSaveFilter = function taskSaveFilter(){

			$(".saveFilter").live('click', function( e ){
				filterDefault = "";
				filterTitle = $(".filterTitle").val();
				if ( $("#filterDefault").is(':checked') ) filterDefault = true;

				$.ajax({
				  type: "POST",
				  url: base_url + "task/saveFilter/",
				  data: {
				  	searchPattern : searchPattern,
				  	filterTitle : filterTitle,
				  	filterDefault : filterDefault
				  } 
				}).done(function( response ) {
					$('#tzadiDialogs').modal('hide');
				});
			});

		};
		
		taskSaveFilter();
	}

});