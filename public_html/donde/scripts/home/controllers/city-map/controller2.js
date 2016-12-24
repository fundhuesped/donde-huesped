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
		
		// $scope.service = copyService.getFor($routeParams.servicio);
		// $rootScope.navBar =$scope.service ;
		// var search = {
		// 	provincia:	$scope.provinceId,
		// 	partido:	$scope.cityId,
		// 	pais: $scope.countryId,
		// 	service: $routeParams.servicio.toLowerCase(),
			
		// };
		// search[$routeParams.servicio.toLowerCase()] = true;
		
	$scope.showCurrent = function(i,p){
      // $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;
    }

    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }

  //   if ($rootScope.places.length > 0 && $rootScope.currentMarker){
  //   	console.log('Entro en el IF')
  //   	// console.log($rootScope.currentMarker);
  //   	       $rootScope.centerMarkers = [];
  //     //tengo que mostrar arriba en el map si es dekstop.
  //     $rootScope.centerMarkers.push($rootScope.currentMarker);

  //   	$rootScope.moveMapTo = {
		// 	latitude:parseFloat($rootScope.currentMarker.latitude),
		// 	longitude:parseFloat($rootScope.currentMarker.longitude),
		// 	zoom:18,
		// 	center: true,
		// };
  //   }else {
		// placesFactory.getAllFor(search, function(data){
			console.log('Entro en el else')
			$rootScope.places = [response.data[0]];
			$rootScope.currentMarker = response.data[0];
			$scope.currentMarker = response.data[0];
			// console.log($rootScope.currentMarker);
			$rootScope.moveMapTo = {
				latitude:$rootScope.currentMarker.latitude,
				longitude:$rootScope.currentMarker.longitude,
				zoom:18,
				center: true,
			};
			  $rootScope.centerMarkers = [];
		      //tengo que mostrar arriba en el map si es dekstop.
		      $rootScope.centerMarkers.push($rootScope.currentMarker);

			
		// })
	// }













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