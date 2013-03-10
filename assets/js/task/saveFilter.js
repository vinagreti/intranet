$(document).ready(function(){
	if (typeof taskSaveFilter !== 'function') {
		taskSaveFilter = function taskSaveFilter(){

			$(".saveFilter").live('click', function( e ){
				filterDefault = 0;
				filterTitle = $(".filterTitle").val();
				if ( $("#filterDefault").is(':checked') ) filterDefault = 1;

				$.ajax({
				  type: "POST",
				  url: base_url + "task/saveFilter/",
				  data: {
				  	searchPattern : searchPattern,
				  	filterTitle : filterTitle,
				  	filterDefault : filterDefault
				  } 
				}).done(function( id ) {
			    $('#selectFilters').append($('<option/>', { 
			        value: id,
			        text : filterTitle,
			        selected : true
			    }));
					$('#tzadiDialogs').modal('hide');
				});
			});

		};
		
		taskSaveFilter();
	}

});