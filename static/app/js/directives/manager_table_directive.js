myApp.directive('managerTable', function() {
	return {
		controller: ['$scope', 'Rest', function EmployeeTableCtrl($scope, Rest) {
			Rest.all('manager').getList().then(function(response) {
				$scope.managers = response;
			}, function() {
				console.log("An error occurred.");
			});

		}],
		templateUrl: 'static/partials/manager-table.html'
	};
})
