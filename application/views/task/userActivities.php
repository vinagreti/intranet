<div class="row-fluid">
	<h2><?=$this->session->userdata('userName')?></h2>
</div>
<div class="row-fluid">
	<div id="chart_div" style="height: 300px;"></div>
</div>
<div class="row-fluid">
</br>
	<h2>Histórico de atividades</h2>
</div>
<div class="row-fluid">
	<table class="table table-hover table-condensed table-striped">
		<thead>
			<tr>
				<th><small>activityID </small></th>
				<th><small>activityStart</small></th>
				<th><small>activityEnd</small></th>
				<th><small>activityComment</small></th>
				<th><small>activityTask</small></th>
				<th><abbr title="Tarefa Pai"><small>activityDate</small></abbr></th>
				<th><small>activityUser</small></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($userLog as $activity){ ?>
			<tr>
				<td class="span1"><small><?=$activity->activityID?></small></td>
				<td class="span1"><small><?=date("d-m-y H:i" , strtotime($activity->activityStart))?></small></td>
				<td class="span1"><small><?=date("d-m-y H:i" , strtotime($activity->activityEnd))?></small></td>
				<td class="span5"><small><?=$activity->activityComment?></small></td>
				<td class="span1"><a href="<?=base_url()?>task/view/<?=$activity->activityTask?>" target="_blank"><small><?=$activity->activityTask?></small></a></td>
				<td class="span1"><small><?=date("d-m-y H:i" , strtotime($activity->activityDate))?></small></td>
				<td class="span1"><small><?=$activity->activityUser?></small></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>


<script type="text/javascript">

	function getUsersTaskLog(taskUserIDs) {
		// solicitando para aplicação task o log de tarefas dos usuários definidos em taskUserIDs
		$.post(base_url + "task/getUsersLog", {
			taskUserIDs: taskUserIDs
		}, function( e ) {
			total = e.length;

			var taskUsers = {},
				taskStatuses = {},
				userData = [],
				data = [],
				headers = ["Usuário", 'total'],
				status,
				statusName,
				user,
				name;

			$.each( e , function(index, userTask) {
				status = userTask.taskStatus;
				statusName = userTask.taskStatusName;
				if ( ! taskStatuses[status] ) {
					taskStatuses[status] = "0";
					headers.push(statusName);
				}
			});

			$.each( e , function(index, userTask) {
				user = userTask.taskResponsableUser;
				name = userTask.taskResponsableName;
				status = userTask.taskStatus;
				if ( ! taskUsers[user] ) {
					taskUsers[user] = [];
					taskUsers[user]['totalTasks'] = 1;
					taskUsers[user]['name'] = name;
					taskUsers[user]['statuses'] = jQuery.extend(true, {}, taskStatuses);
				} else {
					taskUsers[user]['totalTasks']++;
				}
				taskUsers[user]['statuses'][status]++;
			});

			// agrupando os arrays para serem interpretados pelo google chart
			data.push(headers);
			$.each( taskUsers , function(index, user) {
				// criando o array de cada usuário para incluir no array data
				userData = [];
				userData = [user.name, Number(user.totalTasks)];
					$.each( user.statuses , function(index, total) {
						userData.push(Number(total));
					});
				data.push(userData);
			});

			drawChart( data , total );
		}, "json");
	}

	$(document).ready(function(){

		// definindo os usuários que terão o log exibido
		var taskUserIDs = [<?=$activityUser?>];

		// solicitando os dados dos usuarios
		getUsersTaskLog(taskUserIDs)
	});
</script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  function drawChart( data , total ) {
    var data = google.visualization.arrayToDataTable(data);

    var options = {
      title: 'Execução de tarefas',
      vAxis: {title: 'Usuário',  titleTextStyle: {color: 'blue'}},
      hAxis: {title: "de um total de " + total + " tarefas",  titleTextStyle: {color: 'red'}}

    };

    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>