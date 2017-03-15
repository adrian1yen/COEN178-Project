myApp.directive('branchTable', function() {
	return {
		controller: ['$scope', 'Rest', function EmployeeTableCtrl($scope, Rest) {
			Rest.all('branch').getList().then(function(response) {
				$scope.branches = response;
			}, function() {
				console.log("An error occurred.");
			});

		}],
		templateUrl: 'static/partials/branch-table.html'
	};
})
