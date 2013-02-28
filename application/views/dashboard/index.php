<div class="span10">
	<div class="row-fluid">
		<h2>Bem vindo ao dashboard!</h2>
	</div>
	<div class="row-fluid">
		<div id="chart_div" style="height: 300px;"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$.getJSON(base_url + "task/getUsersLog", function( e ) {
			total = e.length;

			taskUsers = {};
			taskStatuses = {};
			headers = ["Usuário", 'total'];

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

			data = [headers];
			$.each( taskUsers , function(index, user) {
				userData = [];
				userData = [user.name, Number(user.totalTasks)];
				console.log(user.statuses);
					$.each( user.statuses , function(index, total) {
						userData.push(Number(total));
					});
				data.push(userData);
			});

			console.log(data);
			
			drawChart( data , total );
		});
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