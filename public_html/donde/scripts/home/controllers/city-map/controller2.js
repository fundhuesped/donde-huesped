dondev2App.controller('cityMapController2', 
	// function($rootScope, $routeParams,$scope, $http){
	function(placesFactory,NgMap, copyService, $scope,$rootScope, $routeParams, $location, $http){

// $rootScope.$watch('currentMarker',function(){
// 		 $scope.currentMarker = $rootScope.currentMarker;
// 	})

	
		var id = $routeParams.id;
		var urlShow ="api/v1/panel/places/"+id; 

		$http({
			method : "GET",
			url : urlShow
		}).then(function mySucces(response) {
			// $rootScope.centerMarkers = [];
			console.log(response[0])
	

    $rootScope.main = false;
	$rootScope.geo = false;
	$scope.province = response.data[0].nombre_provincia;
		$scope.provinceId = response.data[0].idProvincia;
		$scope.city = response.data[0].nombre_partido;
		$scope.cityId = response.data[0].idPartido;
		$scope.country = response.data[0].nombre_pais;
		$scope.countryId = response.data[0].idPais;
		
	$scope.showCurrent = function(i,p){
      $scope.currentMarker = p;
    }

    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }
		console.log('Entro en el else')
		$rootScope.places = [response.data[0]];
		$rootScope.currentMarker = response.data[0];
		$scope.currentMarker = response.data[0];
		// console.log($rootScope.currentMarker);
		$rootScope.moveMapTo = {
			latitude:parseFloat($rootScope.currentMarker.latitude),
			longitude:parseFloat($rootScope.currentMarker.longitude),
			zoom:18,
			center: true,
		};
		  $rootScope.centerMarkers = [];
	      //tengo que mostrar arriba en el map si es dekstop.
	      $rootScope.centerMarkers.push($rootScope.currentMarker);

			// $rootScope.currentMarker = response.data[0];
			// console.log($rootScope.currentMarker);
								
			// $rootScope.centerMarkers = [];
			
			// $rootScope.moveMapTo = {
			// 	latitude:parseFloat($rootScope.currentMarker.latitude),
			// 	longitude:parseFloat($rootScope.currentMarker.longitude),
			// 	zoom: 8,
			// 	center: true,
			// };

			// $rootScope.centerMarkers.push($rootScope.currentMarker);
	



















		}); //del get




	});