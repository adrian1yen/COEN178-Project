var myApp = angular.module('myApp', ['ui.router', 'ngStorage', 'restangular', 'angular-loading-bar']);

myApp.config(['$interpolateProvider',
			'$stateProvider',
			'$urlRouterProvider',
			'$locationProvider',
			'cfpLoadingBarProvider',
	function ($interpolateProvider,
			  $stateProvider,
			  $urlRouterProvider,
			  $locationProvider,
			  cfpLoadingBarProvider) {

		$locationProvider.html5Mode({
			enabled: true,
			requireBase: false
		});

		cfpLoadingBarProvider.includeSpinner = false;


		 //Routing
		$urlRouterProvider.otherwise('/home');
		$stateProvider
			.state('home', {
				url:'/home',
				templateUrl: 'static/partials/home.html',
				controller: 'HomeCtrl'
			})
			.state('information', {
				url:'/information',
				templateUrl: 'static/partials/information.html',
				controller: 'InformationCtrl'
			})
			.state('register', {
				url:'/register',
				templateUrl: 'static/partials/register.html',
				controller: 'RegisterCtrl'
			})
			.state('add_rental_property', {
				url:'/add_rental_property',
				templateUrl: 'static/partials/add-rental-property.html',
				controller: 'AddRentalPropertyCtrl'
			})
			.state('rental_property', {
				url:'/rental_property/:rental_id',
				templateUrl: 'static/partials/rental-property.html',
				controller: 'RentalPropertyCtrl'
			})
	}
]);
