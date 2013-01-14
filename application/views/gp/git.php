<div class="span10">
	
	<h1>Boas práticas no trabalho com git</h1>
	
	<p>Para execução dos comandos deste guia, você deverá ter uma ssh-key com
	acesso ao repositório no qual está trabalhando.</p>
	<p>Este guia é para uso em ambientes linux.</p>
	<p>É importante refinar os commits o máximo possível e fazer apenas o que
	o commit propõe. Como exemplo, se fossemos colorir uma tabela e no meio da 
	atividade descobríssemos que existe um pequeno erro no código. Não devemos arrumar 
	este erro no commit de coloração da tabela, devemos criar uma tarefa separada 
	para tal correção, evitando o esquecimento, pois futuramente, se uma das 
	alterações (cor da tabela ou erro no código) provocar algum problema, vai 
	ser muito mais fácil identificar o commit que ocasionou a falha e 
	corrigir tal falha. Estou tendo este problema agora:</p>
	<p>Eu fiz uma alteração na edição de tarefas e depois dessa alteração fiz 
	outras duas. Porém, o finalizar a terceira modificação eu percebi que 
	o botão action havia parado de funcionar. Fui verificar log e fiz uns 
	testes e descobri o commit onde o erro começa a ocorrer, porém, este 
	commit está cheio de  modificações que fiz no código que não tem relação 
	com a atualização real que o commit propõe. Isto está fazendo eu voltar 
	os commits e separá-los para poder arrumar o bug sem perder histórico 
	de atividades.</p>

	<h3><i class="icon-briefcase"></i> Configurando a ssh-key</h3>
	<h4>Criando a chave para acesso ssh</h4>
	<p>Esqte guia mostra os passos para criar sua chave ssh: <a href="https://help.github.com/articles/generating-ssh-keys" target="_blank">Generating SSH Keys</a></p>

	<h4>Inserindo a chave em apenas um repositório</h4>
	<p>1 - Acesse a página do repositório: Ex.: https://github.com/tzadiinc/intranet</p>
	<p>2 - click em Settings</p>
	<p>3 - click em Deploy Keys</p>
	<p>4 - click em Add deploy key</p>
	<p>5 - Fornece um título de sua escolha e informe o conteúdo copiado do arquivo /home/user/.ssh/id_rsa.pub (ou outro nome que você setou na hora de criar a chave).</p>

	<h4>Inserindo a chave em todos os repositórios de uma conta</h4>
	<p>Para	liberar acesso à todos os repositórios de uma conta, você deve adicionar
	sua ssh-key na conta e não em um repositório. Por motivos de segurança, uma
	ssh-key só pode ser utilizada em uma configuração, por isso, para que a
	chave funciona a mesma não pode estar sendo utilizada em nenhum outro lugar
	no github.</p>
	<p>1 - Acesse a página da conta no github: Ex.: https://github.com/tzadiinc</p>
	<p>2 - click em Account Settings</p>
	<p>3 - click em SSH Keys</p>
	<p>4 - click em Add SSH key</p>
	<p>5 - Fornece um título de sua escolha e informe o conteúdo copiado do arquivo /home/user/.ssh/id_rsa.pub (ou outro nome que você setou na hora de criar a chave).</p>


	<h3><i class="icon-briefcase"></i> Baixando o repositório em sua máquina</h3>
	<p>$ git clone usuario@github.com:contanogit/repositorio.git</p>

	<h3><i class="icon-briefcase"></i> Fazendo merge sem log de commit</h3>
	<p>$ git merge staging --squash</p>
	<p>$ git add .</p>
	<p>$ git commit -m "version description"</p>
	<p>Este comando faz o merge, porém sem os commit. Por isso, depois de efetuar o merge, você deve adicionar e commitar as modificações antes de enviar para o github.</p>

	<h3><i class="icon-briefcase"></i> Excluir todas as modificações que não foram comitadas.</h3>
	<p>$ git reset --hard</p>

	<h3><i class="icon-briefcase"></i> Resetando o repositório para uma versão anterior e replicando no github</h3>
	<p>$ git reset --hard versionnumber</p>
	<p>$ git push --force</p>

</div>