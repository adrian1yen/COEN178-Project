myApp.factory('Auth', function($localStorage, $rootScope, Rest) {
	var service = {};
	service.login = login;
	service.logout = logout;

	return service;

	function login(username, password, callback) {
		var payload = {
			'username': username,
			'password': password
		}
		Rest.all('login').post(payload).then(function(response) {
			if(response[0]) {
				console.log('success');
				$localStorage.currentUser = response[0]['USERNAME'];
				$localStorage.currentUserId = response[0]['USER_ID'];
				$localStorage.ownerId = response[0]['OWNER_ID'];
				$rootScope.currentUser = $localStorage.currentUser;
				$rootScope.currentUserId = $localStorage.currentUserId;
				$rootScope.ownerId = $localStorage.ownerId;
				callback(true);
			} else {
				callback(false);
			}
		}, function(error) {
			console.log(error);
			callback(false);
		})
	}

	function logout() {
		delete $localStorage.currentUser;
		delete $localStorage.currentUserId;
		delete $localStorage.ownerId;
		delete $rootScope.currentUser;
		delete $rootScope.currentUserId;
		delete $rootScope.ownerId;
	}

});
