myApp.controller('AddRentalPropertyCtrl', function($scope,$rootScope, $localStorage, Rest, Auth) {
	$scope.addRentalProperty = function(street, city, zipcode, rooms, rent) {
		function getRandomInt(min, max) {
			min = Math.ceil(min);
			max = Math.floor(max);
			return Math.floor(Math.random() * (max - min)) + min;
		}
		Rest.all('supervisor').getList().then(function(response) {
			var i = getRandomInt(0, response.length);
			var payload = {
				'owner': $rootScope.ownerId,
				'supervisor': response[i].EMPLOYEE_ID,
				'street': street,
				'city': city,
				'zipcode': zipcode,
				'rooms': rooms,
				'rent': rent
			}
			Rest.all('rental_property').post(payload).then(function(response) {
				$rootScope.$broadcast('ADD_RENTAL_PROPERTY', response);
				$scope.error = false;
				$('#addRentalModal').modal('hide');
				$('#addRentalForm')[0].reset();
			}, function(error) {
				console.log('error');
				$scope.error = true;
				console.log(error);
			})

		}, function(error) {
			console.log('error');
			console.log(error);
		});
	}
})
