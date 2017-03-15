myApp.directive('propertyOwnerTable', function() {
	return {
		scope: {
			ownerId: '@'
		},
		controller: ['$scope','$element' ,'$attrs', 'Rest', function EmployeeTableCtrl($scope, $element, $attrs,  Rest) {
			if(!$scope.ownerId) {
				Rest.all('property_owner').getList().then(function(response) {
					$scope.property_owners = response;
				}, function() {
					console.log("An error occurred.");
				});
			}
			else {
				$scope.ownerId = $scope.ownerId.replace(/\s/g,'')
				Rest.one('property_owner', $scope.ownerId).get().then(function(response) {
					$scope.property_owners = response;
				}, function() {
					console.log("An error occured.");
				})
			}

		}],
		templateUrl: 'static/partials/property-owner-table.html'
	};
})
