myApp.controller('RentalPropertyCtrl', function($scope, $state, $stateParams, $rootScope, $localStorage, Rest) {
	Rest.one('rental_property', $stateParams.rental_id).get().then(function(response) {
		$scope.rental_property = response[0];
		if($scope.rental_property.OWNER_ID == $rootScope.ownerId) {
			$scope.owner = true;
		} else {
			$scope.owner = false;
		}
	}, function(error) {
		console.log(error);
	});

	Rest.one('rental_lease', $stateParams.rental_id).get().then(function(response) {
		$scope.leases = response;
	})

	$scope.removeProperty = function() {
		Rest.one('rental_property', $stateParams.rental_id).remove().then(function() {
			console.log('deleted');
			$state.go('home');
		}, function(error) {
			console.log(error);
		})
	}

	$scope.addLease = function(renter_name, home_phone, work_phone, emergency_phone, emergency_name, start_date, end_date) {
		var payload = {
			'rental_id': $stateParams.rental_id,
			'renter_name': renter_name,
			'home_phone': home_phone,
			'work_phone': work_phone,
			'emergency_phone': emergency_phone,
			'emergency_name': emergency_name,
			'start_date': start_date,
			'end_date': end_date,
		}
		Rest.all('lease').post(payload).then(function(response) {
			console.log(response);
			$scope.error = false;
			$('#addLease').modal('hide');
			$('#addLeaseForm')[0].reset();
			$scope.rental_property.STATUS = 'leased';
			$scope.leases = response;
		}, function(error) {
			console.log(error);
			$scope.error = true;
		})
	}
	
	$scope.removeLease = function() {
		var lease_id = $scope.leases[0].LEASE_ID.replace(/\s/g,'')
		Rest.one('lease', lease_id).remove().then(function() {
			console.log('deleted');
			$scope.rental_property.STATUS = 'available';
			$scope.leases = [];
		}, function(error) {
			console.log(error);
		});
	}
})
