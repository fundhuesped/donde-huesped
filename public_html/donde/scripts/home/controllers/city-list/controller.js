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
		$scope.cantidad = $scope.places.length;
		$scope.loading = false;
	})

	$scope.nextShowUp =function(item){
		$rootScope.places = $scope.cantidad = $scope.places;
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
		$scope.checkbox = newValue;
		if ($scope.checkbox) {
			var c =0;
			for (var i = $scope.places.length - 1; i >= 0; i--) {
				if ($scope.places[i].es_rapido == 1){
					c ++;
				}
			}
			$scope.cantidad = c;
		}
		else{
			$scope.cantidad = $scope.places.length;
		}

	});

$scope.onChange = function () {
	console.log($scope.cantidad);
}


	$scope.esRapido = function () {
	return function (item) {
	  if ( $scope.checkbox == true ) {
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
