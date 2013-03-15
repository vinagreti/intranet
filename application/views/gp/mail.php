<?php foreach($emails as $email){ ?>
<div class="alert alert-error">
  <p>Id: <?=$email->id?></p>
  <p>Data: <?=$email->date?></p>
  <p>De: <?=$email->from?></p>
  <p>Assunto: <?=$email->subject?></p>
  <p>Mensagem: <?=$email->message?></p>
</div>
<?php } ?>
