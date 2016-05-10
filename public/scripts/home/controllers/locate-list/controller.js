dondev2App.controller('locateListController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	$rootScope.main = false;
	$scope.service = $routeParams.servicio;
	$rootScope.navBar =$scope.service ;
	$scope.places = [];
	$scope.main = true;
	$rootScope.geo = true;
	$scope.loading = true;
	var onLocationError = function(e){
		  	$scope.$apply(function(){
    			$location.path('/call/help');
    		});
  	}
  	$scope.nextShowUp =function(item){
		$rootScope.places = $scope.places;

	    $rootScope.currentMarker = item;
	           $rootScope.centerMarkers = [];
	      //tengo que mostrar arriba en el map si es dekstop.
	      $rootScope.centerMarkers.push($rootScope.currentMarker);

		$location.path('/localizar' + '/' + $routeParams.servicio + '/mapa');

	}
  	var onLocationFound = function(position){

  		$scope.$apply(function(){

	    	placesFactory.forLocation(position.coords, function(result){ 
	    	//console.log(result[0].condones);

	    	var jsonObj = JSON.parse($routeParams.servicio);
	    	console.log(jsonObj);
	    	
	var resultTemp = [];
	    		    	

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
		console.log(resultTemp);
		
	    				    		   
                //$rootScope.places = $scope.places = $scope.closer = result;
	          $rootScope.places = $scope.places = $scope.closer = resultTemp;
	          $rootScope.currentPos = position.coords;
	          $scope.loading = false;
	        });
        });
    };
    navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
});