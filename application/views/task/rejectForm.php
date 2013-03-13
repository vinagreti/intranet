<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h3>Rejeitar a tarefa <?=$taskID?></h3>
</div>

<div class="modal-body">

  <div class="globalModalAlert" id="modalAlert"></div>

  <form class="form-vertical">
    <label for="newComment" class="control-label">Comentário *</label>
    <textarea rows="5" class="input-block-level" placeholder="Comentário" id="newComment" name="newComment"></textarea>
  </form>

</div>

<div class="modal-footer">
  <a href="#" class="btn btn-primary" id="reject"  data-loading-text="Salvando...">Rejeitar</a>
  <a href="#" class="btn" data-dismiss="modal">Fechar</a>
</div>

<script type="text/javascript">
taskID = "<?=$taskID?>";
if (typeof rejectForm !== 'function') {
  rejectForm = function rejectForm() {
    $("#reject").live("click", function() {
      $("#reject").button('loading');
      var valid = true;
      valid = valid && globalValidateLenght(1, 65535, $('#newComment').val(), 'Favor comentar esta ação!');
      if ( valid ) {
        $.post(base_url + "task/update/" + taskID, {
          taskStatus : 2,
          taskID : taskID
        },function( e ) {
          if ( e ) {
            $.post(base_url + "task/saveActionComment", {
              comment : $("#newComment").val(),
              commentTask : taskID,
              commentAction : 'Rejeitada'
            });
            refresh();
            $('#tzadiDialogs').modal('hide');
          }
        });
      } else {
        $("#reject").button('reset');
      }
    })   
  }
  rejectForm();
}
</script>