dondev2App.controller('locateListController',
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	$rootScope.main = false;
	$scope.service = $routeParams.servicio;
	$rootScope.navBar =$scope.service ;
	$scope.places = [];
	$scope.main = true;
	$rootScope.geo = true;
	$scope.loading = true;
	$scope.events = "distance";
	//parseo a obj para obtener el servicio si no piden todo
	$scope.service = ($scope.service != "all") ? angular.fromJson($scope.service) : $scope.service;
	//seteo a todos en false x las dudas
	$scope.checkbox = false;

	$rootScope.voteLimit = 5;

	$scope.voteLimit = 5;
	
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


	$scope.addComment = function () {
		$scope.voteLimit ++;
	}

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

	var onLocationError = function(e){
	  	$scope.$apply(function(){
			$location.path('/call/help');
		});
  	}
  	$scope.nextShowUp =function(item){
  		var urlCount = "api/v2/evaluacion/cantidad/" + item.placeId;
  		$http.get(urlCount)
  		.then(function(response) {
  			item.votes = response.data;
  		});

  		// //aparte
  		var urlRate = "api/v2/evaluacion/promedio/" + item.placeId;
  		$http.get(urlRate)
  		.then(function(response) {
  			item.rate = response.data[0];
  			item.faceList = [
		        { id: '1', image: '1', imageDefault: '1', imageBacon: '1active' },
		        { id: '2', image: '2', imageDefault: '2', imageBacon: '2active' },
		        { id: '3', image: '3', imageDefault: '3', imageBacon: '3active' },
		        { id: '4', image: '4', imageDefault: '4', imageBacon: '4active' },
		        { id: '5', image: '5', imageDefault: '5', imageBacon: '5active' }];


         var pos = -1;   
         for (var i = 0; i < item.faceList.length; i++) {
           item.faceList[i].image = item.faceList[i].imageDefault;
            if (item.faceList[i].id == item.rate ) pos = i;
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
  		});

		console.log("Entro en nextShowUp (locateListController)");
		$rootScope.places = $scope.places;
		$scope.cantidad = $scope.places.length;
	    $rootScope.currentMarker = item;
	    $rootScope.centerMarkers = [];
	      //tengo que mostrar arriba en el map si es dekstop.
	      $rootScope.centerMarkers.push($rootScope.currentMarker);

				//con esto centro el mapa en el place correspondiente
				$location.path('/localizar' + '/' + $routeParams.servicio + '/mapa');

	}
  	var onLocationFound = function(position){

  		$scope.$apply(function(){

	    	placesFactory.forLocation(position.coords, function(result){
				for (var i = result.length - 1; i >= 0; i--) {
				if (typeof result[i].distance === "string")
					result[i].distance = Number(result[i].distance);
					var tmp = result[i].distance.toFixed();
					result[i].distance = tmp * Number(100);
				}

	    	var jsonObj= {
	    		code: "all"
	    	};

	    	try{
	    	 	jsonObj = JSON.parse($routeParams.servicio);
					//me traigo el servicio
	    		console.log(jsonObj);
	    	}catch(e){
	    		jsonObj= {
	    			code: $routeParams.servicio
	    		}
	    	}

	var resultTemp = [];

		if(jsonObj.code ==="all"){
			resultTemp = result;
		}
		else {

			if (jsonObj.code == "condones"){ //codigo =  condon
		    	for (var i = 0; i < result.length ; i++) {
		    		if (result[i].condones == 1)
		    		resultTemp.push(result[i]);
		    	}
			}

	    	if (jsonObj.code == "vacunatorio"){ //codigo =  vacunacion
					for (var i = 0; i < result.length ; i++) {
		    		if (result[i].vacunatorio== 1)
		    		resultTemp.push(result[i]);
		    	}
			}

	    	if (jsonObj.code == "prueba"){ //codigo =  prueba
		    	for (var i = 0; i < result.length ; i++) {
		    		if (result[i].prueba== 1)
		    		resultTemp.push(result[i]);
		    	}
			}

	    	if (jsonObj.code == "infectologia"){ //codigo =  infectologia
		    	for (var i = 0; i < result.length ; i++) {
		    		if (result[i].infectologia== 1)
		    		resultTemp.push(result[i]);
		    	}
			}

			if (jsonObj.code == "mac"){ //codigo =  condon
		    	for (var i = 0; i < result.length ; i++) {
		    		if (result[i].mac == 1)
		    		resultTemp.push(result[i]);
		    	}
			}

			if (jsonObj.code == "ile"){ //codigo =  condon
		    	for (var i = 0; i < result.length ; i++) {
		    		if (result[i].ile == 1)
		    		resultTemp.push(result[i]);
		    	}
			}			
		}
		console.log("Termino de cargar places");
    	console.log(resultTemp);
            //$rootScope.places = $scope.places = $scope.closer = result;
		$rootScope.places = $scope.places = $scope.closer = resultTemp;
		$scope.cantidad = $scope.places.length;
		$rootScope.currentPos = position.coords;
		$scope.loading = false;
	        });
        });
    };
    navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
});
