dondev2App.controller('cityListController', 
	function(placesFactory,copyService,NgMap, $scope,$rootScope, $routeParams, $location, $http){
		
	
    	
		$rootScope.main = false;
		$rootScope.geo = false;
		$scope.province = $routeParams.provincia;
		$scope.city = $routeParams.ciudad;
		$scope.country = $routeParams.pais;
		$scope.service = copyService.getFor($routeParams.servicio);
		$rootScope.navBar =$scope.service ;
		var search = {
			provincia_region: $routeParams.provincia,
			partido_comuna: $routeParams.ciudad,
			pais: $routeParams.pais,
			
		};
		search[$routeParams.servicio.toLowerCase()] = true;
		
    
	placesFactory.getAllFor(search, function(data){
		$rootScope.places = $scope.places = data;
	})

	$scope.nextShowUp =function(item){
		$rootScope.places = $scope.places;
	    $rootScope.currentMarker = item;
		$location.path('/'+ $scope.country  +'/' 
			+ $scope.province+ '/' 
			+ $scope.city  + '/' 
			+ $routeParams.servicio + '/mapa');

	};
});