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

		placesFactory.getPlacesByParty(search, function(data){

			$scope.establecimientos = data;
			$scope.cantidad = $scope.establecimientos.length;

			$scope.countryImageTag = $scope.country.toLowerCase();
			$scope.countryImageTag = $scope.countryImageTag.trim();
			$scope.countryImageTag = $scope.countryImageTag.replace(/ +/g, "");

			$scope.ileTag = "ile_" + $scope.countryImageTag;
			$scope.countryTextTag = "countryText_" + $scope.countryImageTag;
			console.log("$scope.countryImageTag " + $scope.countryImageTag);

			$scope.loading = false;

		});

		$scope.nextShowUp = function(item) {

			$scope.ciudad = item.nomnre_ciudad;

			console.log("item");
			console.log(item);
			var urlCount = "api/v2/evaluacion/cantidad/" + item.placeId;
			$http.get(urlCount)
			.then(function(response) {
				item.votes = response.data[0];
			});

      // //aparte
      var urlRate = "api/v2/evaluacion/promedio/" + item.placeId;
      $http.get(urlRate)
      .then(function(response) {
      	item.rate = response.data[0];
      	item.faceList = [{
      		id: '1',
      		image: '1',
      		imageDefault: '1',
      		imageBacon: '1active'
      	},
      	{
      		id: '2',
      		image: '2',
      		imageDefault: '2',
      		imageBacon: '2active'
      	},
      	{
      		id: '3',
      		image: '3',
      		imageDefault: '3',
      		imageBacon: '3active'
      	},
      	{
      		id: '4',
      		image: '4',
      		imageDefault: '4',
      		imageBacon: '4active'
      	},
      	{
      		id: '5',
      		image: '5',
      		imageDefault: '5',
      		imageBacon: '5active'
      	}
      	];


      	var pos = -1;
      	for (var i = 0; i < item.faceList.length; i++) {
      		item.faceList[i].image = item.faceList[i].imageDefault;
      		if (item.faceList[i].id == item.rate) pos = i;
      	}
          //si tiene votos cambio el color
          if (pos != -1)
          	item.faceList[pos].image = item.faceList[pos].imageBacon;
      });



      var urlComments = "api/v2/evaluacion/comentarios/" + item.placeId;
      item.comments = [];
      $http.get(urlComments)
      .then(function(response) {
      	item.comments = response.data;
      	item.comments.forEach(function(comment) {
      		comment.que_busca = comment.que_busca.split(',');
      	});
      });


      $rootScope.places = $scope.cantidad = $scope.establecimientos;
      $rootScope.currentMarker = item;
      $rootScope.centerMarkers = [];
      //tengo que mostrar arriba en el map si es dekstop.
      $rootScope.centerMarkers.push($rootScope.currentMarker);

      $location.path('/' + $scope.country + '/' +
      	$scope.province + '/' +
      	$scope.party + '/' +   
      	$scope.ciudad + '/' +
      	$routeParams.servicio + '/mapa');

  };

  $scope.$watchCollection('checkbox', function(newValue, oldValue) {
  	$scope.checkbox = newValue;
  	if ($scope.checkbox) {
  		var c = 0;
  		for (var i = $scope.establecimientos.length - 1; i >= 0; i--) {
  			if ($scope.establecimientos[i].es_rapido == 1) {
  				c++;
  			}
  		}
  		$scope.cantidad = c;
  	} else {
  		$scope.cantidad = $scope.places.length;
  	}

  });    	

  $scope.esFriendly = function() {
  	return function(item) {
  		if ($scope.onlyFriendly == 1) {

  			if (item.friendly_dc == 1 || item.friendly_ssr == 1 || item.friendly_ile == 1 || item.friendly_mac == 1 || item.friendly_prueba == 1 || item.friendly_condones == 1) {
  				return item;
  			}
  		} else {

  			return item;
  		}
  	}
  }

  $scope.tieneServicioFriendly = function(item) {
  	if (item.friendly_dc == 1 || item.friendly_ssr == 1 || item.friendly_ile == 1 || item.friendly_mac == 1 || item.friendly_prueba == 1 || item.friendly_condones == 1) {

  		return true;
  	} else {

  		return false;
  	}
  }

  $scope.esRapido = function() {
  	return function(item) {
  		if ($scope.checkbox == true) {
  			if (item.es_rapido == 1) {
  				return item;
  			}
  		}
  		if ($scope.checkbox == false) {
  			return item;
  		}
  	}
  };


});
