dondev2App.controller('locateListController',
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	$rootScope.main = false;
	$scope.service = $routeParams.servicio;
	$rootScope.navBar =$scope.service ;
	$scope.places = [];
	$scope.main = true;
	$rootScope.geo = true;
	$scope.loading = true;
	$scope.cantidad = 0;

	//parseo a obj para obtener el servicio si no piden todo
	$scope.service = ($scope.service != "all") ? angular.fromJson($scope.service) : $scope.service;
	//seteo a todos en false x las dudas
	$scope.checkbox = false;

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

	$scope.noDots = function (item) {
		return function (item) {
			console.log(item)
			// console.log(item)
			// var tmp = item.distance.toString();
			// tmp.replace(',', '')
			// item.distance = parseInt(tmp);
			// console.log(typeof item.distance)
			// return [item]

		}
	};

	var onLocationError = function(e){
		  	$scope.$apply(function(){
    			$location.path('/call/help');
    		});
  	}
  	$scope.nextShowUp =function(item){
			console.log("Entro en nextShowUp");
			console.log(item);
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

				console.log("Entro al factory");
				console.log(result);
				console.log(typeof result[1].distance);
				
				for (var i = result.length - 1; i >= 0; i--) {
					console.log(result[i].distance);
					var tmp = result[i].distance.toFixed();
					result[i].distance = tmp;
					console.warn(result[1].distance);
					
				}
// function myFunction(item, index, arr) {
//     arr[index] = item * document.getElementById("multiplyWith").value;
//     demo.innerHTML = numbers;
// }
		
				

	    	var jsonObj= {
	    		code: "all"
	    	};

	    	try{
	    	 	jsonObj = JSON.parse($routeParams.servicio);
					console.log("Entro al try");
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
	    		console.log('entro en condon');
		    	for (var i = 0; i < result.length ; i++) {
		    		if (result[i].condones == 1)
		    		resultTemp.push(result[i]);
		    	}
			}

	    	if (jsonObj.code == "vacunatorio"){ //codigo =  vacunacion
		    	console.log('entro en vacunatorio');
					for (var i = 0; i < result.length ; i++) {
		    		if (result[i].vacunatorio== 1)
		    		resultTemp.push(result[i]);
		    	}
			}

	    	if (jsonObj.code == "prueba"){ //codigo =  prueba
		    console.log('entro en prueba');
		    	for (var i = 0; i < result.length ; i++) {
		    		if (result[i].prueba== 1)
		    		resultTemp.push(result[i]);
		    	}
			}

	    	if (jsonObj.code == "infectologia"){ //codigo =  infectologia
		    	console.log('entro en infectorlia');
		    	for (var i = 0; i < result.length ; i++) {
		    		if (result[i].infectologia== 1)
		    		resultTemp.push(result[i]);
		    	}
			}
		}
		console.log("Termino de cargar places");
    console.log(resultTemp);


            //$rootScope.places = $scope.places = $scope.closer = result;
	          $rootScope.places = $scope.places = $scope.closer = resultTemp;
// console.log("rootScope.places");
// console.log($rootScope.places);
//
// console.log("scope.places");
// console.log($scope.places);
//
// console.log("scope.closer");
// console.log($scope.closer);

						$scope.cantidad = $scope.places.length;
						// console.log("scope.cantidad");
						// console.log($scope.cantidad);

	          $rootScope.currentPos = position.coords;
						// console.log("position.coords");
						// console.log(position.coords);
						//
						// console.log("rootScope.currentPos");
						// console.log($rootScope.currentPos);

	          $scope.loading = false;
	        });
        });
    };
    navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
});
