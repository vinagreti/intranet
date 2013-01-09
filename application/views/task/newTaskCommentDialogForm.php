<div class="modal-header">

	<button type="button" class="close" data-dismiss="modal">×</button>

	<h3>Novo comentário</h3>

</div>

<div class="modal-body">

	<div id="newTaskCommentTipsField"></div>

	<form class="form-vertical">
		<fieldset>

			<div class="control-group">
				<label for="newTaskComment" class="control-label">Comentario</label>
				<div class="controls">
					<textarea class="span12" id="newTaskComment" rows="7"></textarea>
				</div>
			</div>

			<input type="hidden" id="commentTaskID" value="<?=$taskID?>"></input>

		</fieldset>
	</form>

</div>

<div class="modal-footer">

	<a href="#" class="btn btn-primary" id="saveNewCommentTask">Criar</a>

	<a href="#" class="btn" data-dismiss="modal">Fechar</a>

</div>