var schedulesApp = angular.module('schedulesApp', []);

schedulesApp.controller('customersController', ['$scope', '$http', function($scope,$http) {

		$http.get("http://localhost/synctv2.0/example.json")
			.success(function (response) {$scope.names = response;});
	}]
);
