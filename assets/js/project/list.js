$(document).ready(function(){

	var createDemandByProjectButton = $(".newDemandByProjectButton");

	createDemandByProjectButton.click(function( e ){
		e.preventDefault();

		projectID = $(this).attr('projectID');
		projectTitle = $(this).attr('projectTitle');

		$('#tzadiDialogs').empty();

		$.post(base_url + "demand/createForm", {
			form : "demand/newDemandDialogForm",
			projectID : projectID,
			projectTitle : projectTitle
		},function( response ) {
			$('#tzadiDialogs').append( response );
		});

		$('#tzadiDialogs').modal('show');

	});

});