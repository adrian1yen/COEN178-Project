myApp.directive('supervisorTable', function() {
	return {
		controller: ['$scope', 'Rest', function EmployeeTableCtrl($scope, Rest) {
			Rest.all('supervisor').getList().then(function(response) {
				$scope.supervisors = response;
			}, function() {
				console.log("An error occurred.");
			});

		}],
		templateUrl: 'static/partials/supervisor-table.html'
	};
})
