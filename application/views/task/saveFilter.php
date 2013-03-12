<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>Salvar o filtro atual</h3>
</div>

<div class="modal-body">

<form class="form-vertical">
	<label for="filterTitle" class="control-label">Nome do novo filtro *</label>
	<input rows="5" class="filterTitle input-block-level" placeholder="Comentário" name="filterTitle" />

	<label class="checkbox inline">
	  <input id="filterDefault" value="true" type="checkbox">Default
	</label>
</form>

</div>

<div class="modal-footer">
<a href="#" class="btn btn-primary saveFilter">Salvar</a>
<a href="#" class="btn" data-dismiss="modal">Fechar</a>
</div>

<script type="text/javascript">
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
</script>