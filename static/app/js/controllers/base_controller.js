myApp.controller('BaseCtrl', function($scope, $localStorage, $rootScope, Auth) {
	$scope.logout = Auth.logout;
	if($localStorage.currentUser) {
		$rootScope.currentUser = $localStorage.currentUser;
		$rootScope.currentUserId = $localStorage.currentUserId;
		$rootScope.ownerId = $localStorage.ownerId;
	}

});
