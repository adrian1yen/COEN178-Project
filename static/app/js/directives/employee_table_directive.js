myApp.directive('employeeTable', function() {
	return {
		controller: ['$scope', 'Rest', function EmployeeTableCtrl($scope, Rest) {
			Rest.all('employee').getList().then(function(response) {
				$scope.employees = response;
			}, function() {
				console.log("An error occurred.");
			});

		}],
		templateUrl: 'static/partials/employee-table.html'
	};
})
