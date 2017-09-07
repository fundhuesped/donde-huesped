dondev2App.controller('partyListController',
	function(placesFactory,copyService,NgMap, $scope,$rootScope, $routeParams, $location, $http){

		$scope.loading = true;

		$scope.service = copyService.getFor($routeParams.servicio);

		$scope.party = $routeParams.partido.split('-')[1];
		$scope.partyId = $routeParams.partido.split('-')[0];

		$scope.province = $routeParams.provincia.split('-')[1];
		$scope.provinceId = $routeParams.provincia.split('-')[0];

		$scope.country = $routeParams.pais.split('-')[1];
		$scope.countryId = $routeParams.pais.split('-')[0];

		var search = {
			
			id: 	    $scope.partyId,
			service: 	$routeParams.servicio.toLowerCase(),

		};

		search[$routeParams.servicio.toLowerCase()] = true;

		placesFactory.getCitiesByParty(search, function(data){

			$scope.ciudades = data;
			$scope.cantidad = $scope.ciudades.length;

			$scope.countryImageTag = $scope.country.toLowerCase();
			$scope.countryImageTag = $scope.countryImageTag.trim();
			$scope.countryImageTag = $scope.countryImageTag.replace(/ +/g, "");

			$scope.ileTag = "ile_" + $scope.countryImageTag;
			$scope.countryTextTag = "countryText_" + $scope.countryImageTag;
			console.log("$scope.countryImageTag " + $scope.countryImageTag);

     		$scope.loading = false;

    	});

});
