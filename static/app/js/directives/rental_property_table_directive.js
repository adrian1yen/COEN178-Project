myApp.directive('rentalPropertyTable', function() {
	return {
		scope: {
			rOwnerId: '@',
			rentalId: '@'
		},
		controller: ['$scope', '$state','$localStorage', 'Rest', function ($scope, $state, $localStorage, Rest) {
			$scope.$on('ADD_RENTAL_PROPERTY', function(e, data){
				$scope.rental_properties.unshift(data[0]);
			});
			if(!$scope.rOwnerId) {
				Rest.all('rental_property').getList().then(function(response) {
					$scope.rental_properties = response;
				}, function() {
					console.log("An error occurred.");
				});
			}
			else if($scope.rentalId) {
				Rest.one('rental_property', $scope.rentalId).get().then(function(response) {
					$scope.rental_properties = response;
				}, function() {
					console.log("An error occured.");
				});
			}
			else {
				if($scope.rOwnerId == $localStorage.ownerId) {
					$scope.show = true;
				} else {
					$scope.show = false;
				}
				$scope.rOwnerId = $scope.rOwnerId.replace(/\s/g,'')
				Rest.one('owner_rental_property', $scope.rOwnerId).get().then(function(response) {
					$scope.rental_properties = response;
				}, function() {
					console.log("An error occured.");
				})
			}

			$scope.rentalProperty = function(id) {
				id = id.replace(/\s/g,'');
				$state.go('rental_property', {"rental_id": id});
			}

		}],
		templateUrl: 'static/partials/rental-property-table.html'
	};
})
