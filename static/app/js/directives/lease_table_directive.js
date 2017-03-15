myApp.directive('leaseTable', function() {
	return {
		scope: {
			ownerId: '@'
		},
		controller: ['$scope', 'Rest', function EmployeeTableCtrl($scope, Rest) {
			if(!$scope.ownerId) {
				Rest.all('lease').getList().then(function(response) {
					$scope.leases = response;
				}, function() {
					console.log("An error occurred.");
				});
			}
			else {
				$scope.ownerId = $scope.ownerId.replace(/\s/g,'')
				Rest.one('lease', $scope.ownerId).get().then(function(response) {
					$scope.leases = response;
				}, function() {
					console.log("An error occured.");
				})
			}
		}],
		templateUrl: 'static/partials/lease-table.html'
	};
})
