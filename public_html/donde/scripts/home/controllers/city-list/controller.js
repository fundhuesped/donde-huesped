dondev2App.controller('cityListController',
	function(placesFactory,copyService,NgMap, $scope,$rootScope, $routeParams, $location, $http){
		$rootScope.navBar = $routeParams.servicio;
		$scope.checkbox = false;
    $scope.loading = true;
		$rootScope.main = false;
		$rootScope.geo = false;
		$scope.province = $routeParams.provincia.split('-')[1];
		$scope.provinceId = $routeParams.provincia.split('-')[0];

		$scope.city = $routeParams.ciudad.split('-')[1];
		$scope.cityId = $routeParams.ciudad.split('-')[0];
		$scope.country = $routeParams.pais.split('-')[1];
		$scope.countryId = $routeParams.pais.split('-')[0];

		$scope.service = copyService.getFor($routeParams.servicio);
// console.log($scope);
		$rootScope.navBar =$scope.service ;
		var search = {
			provincia:	$scope.provinceId,
			partido:	$scope.cityId,
			pais: $scope.countryId,
			service: $routeParams.servicio.toLowerCase(),

		};
		search[$routeParams.servicio.toLowerCase()] = true;


	placesFactory.getAllFor(search, function(data){
		$rootScope.places = $scope.places = data;
		$scope.loading = false;
	})

	$scope.nextShowUp =function(item){
		$rootScope.places = $scope.places;
	    $rootScope.currentMarker = item;
	           $rootScope.centerMarkers = [];
      //tengo que mostrar arriba en el map si es dekstop.
      $rootScope.centerMarkers.push($rootScope.currentMarker);

		$location.path('/'+ $scope.country  +'/'
			+ $scope.province+ '/'
			+ $scope.city  + '/'
			+ $routeParams.servicio + '/mapa');

	};

	$scope.$watchCollection('checkbox', function(newValue, oldValue) {
	    console.log(newValue);
		$scope.checkbox = newValue;
	});

	 
	$scope.esRapido = function () {
	return function (item) {
	  if ( $scope.checkbox == true ) {
	  	console.log(item);
	  	if (item.es_rapido == 1){
	    	return item;
	  	}
	  }
	  if ( $scope.checkbox == false ) {
	  	return item;	
	  }
	}
	};

});
