myApp.controller('HomeCtrl', function($scope,$rootScope, $localStorage, Rest, Auth) {
	$scope.error = false;
	$scope.login = function(username, password) {
		Auth.login(username, password, function(result) {
			if(result) {
				$scope.error = false;
			} else {
				$scope.error = true;
			}
		});
	}
})
