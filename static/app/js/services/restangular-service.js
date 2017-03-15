myApp.factory('Rest', function(Restangular, $localStorage) {
    return Restangular.withConfig(function(RestangularConfigurer) {
        RestangularConfigurer.setBaseUrl('/~ayen/COEN178/Project/api');
        RestangularConfigurer.setRequestSuffix('/');
	});
});
