function getUsersTaskLog(taskUserIDs) {

	var total, data = [];
	// solicitando para aplicação task o log de tarefas dos usuários definidos em taskUserIDs
	$.post(base_url + "task/getUsersLog", {
		taskUserIDs: taskUserIDs
	}, function( e ) {
		total = e.length;

		var taskUsers = {},
			taskStatuses = {},
			userData = [],
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
		data = [headers],
		$.each( taskUsers , function(index, user) {
			// criando o array de cada usuário para incluir no array data
			userData = [];
			userData = [user.name, Number(user.totalTasks)];
				$.each( user.statuses , function(index, total) {
					userData.push(Number(total));
				});
			data.push(userData);
		});

	}, "json");

	chartData = [ data , total ];
	return chartData;
}

$(document).ready(function(){

	// definindo os usuários que terão o log exibido
	var taskUserIDs = [];

	// solicitando os dados dos usuarios
	getUsersTaskLog(taskUserIDs)
});