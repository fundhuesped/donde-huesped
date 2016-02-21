dondev2App.controller('cityListController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	$rootScope.main = false;

		$scope.province = $routeParams.provincia;
		$scope.city = $routeParams.ciudad;
		$scope.country = $routeParams.pais;
		$scope.service = $routeParams.servicio;
		$rootScope.navBar =$scope.service ;
		var search = {
			provincia: $routeParams.provincia,
			barrio_localidad: $routeParams.ciudad,
			// pais: $routeParams.pais,
			// servicio: $routeParams.servicio
		}
	placesFactory.getAllFor(search, function(data){
		$rootScope.places = $scope.places = data;
	})

});