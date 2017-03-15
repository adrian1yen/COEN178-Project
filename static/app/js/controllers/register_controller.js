myApp.controller('RegisterCtrl', function($scope, $state, Rest) {
	$scope.error = false;
	$scope.createUser = function(username, password, name, street, city, zipcode, phone_number) {
		var payload = {
			'name': name,
			'street': street,
			'city': city,
			'zipcode': zipcode,
			'phone_number': phone_number,
			'username': username,
			'password': password,
		}
		console.log(payload);
		Rest.all('user_profile').post(payload).then(function(response) {
			console.log('success');
			$state.go("home");
		}, function(error) {
			console.log("error");
			console.log(error);
			$scope.error = true;
		});
	}
});
