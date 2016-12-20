dondev2App.controller('cityMapController2', 
	function(placesFactory,NgMap, copyService,$scope,$rootScope, $routeParams, $location, $http){

var id = $routeParams.id;
var urlShow ="api/v1/panel/places/"+id; 

$scope.currentMarker = [];

$http({
        method : "GET",
        url : urlShow
    }).then(function mySucces(response) {
        $scope.currentMarker = response.data[0];
        $scope.moveMapTo = {
		latitude:parseFloat($scope.currentMarker.latitude),
		longitude:parseFloat($scope.currentMarker.longitude),
		zoom:14,
		center: true,
	};
		$scope.centerMarkers.push($scope.currentMarker);
    }, function myError(response) {
    	// console.log('error en peticion')
        // $scope.myWelcome = response.statusText;
    });


	// $scope.province = $routeParams.provincia.split('-')[1];
	// 	$scope.provinceId = $routeParams.provincia.split('-')[0];
	// 	$scope.city = $routeParams.ciudad.split('-')[1];
	// 	$scope.cityId = $routeParams.ciudad.split('-')[0];
	// 	$scope.country = $routeParams.pais.split('-')[1];
	// 	$scope.countryId = $routeParams.pais.split('-')[0];
		
	// 	$scope.service = copyService.getFor($routeParams.servicio);
	// 	$rootScope.navBar =$scope.service ;
	// 	var search = {
	// 		provincia:	$scope.provinceId,
	// 		partido:	$scope.cityId,
	// 		pais: $scope.countryId,
	// 		service: $routeParams.servicio.toLowerCase(),
			
	// 	};
	// 	search[$routeParams.servicio.toLowerCase()] = true;
		
	// $scope.showCurrent = function(i,p){
 //      $rootScope.navBar = p.establecimiento;
 //      $scope.currentMarker = p;
 //    }
 //    $scope.closeCurrent = function(){
 //      $scope.currentMarker = undefined;
 //    }

 //    if ($rootScope.places.length > 0 && $rootScope.currentMarker){
 //    	console.log($rootScope.currentMarker);
 //    	       $rootScope.centerMarkers = [];
 //      //tengo que mostrar arriba en el map si es dekstop.


 //    }else {
	// 	placesFactory.getAllFor(search, function(data){
	// 		$rootScope.places = $scope.places = data;
	// 		$rootScope.currentMarker = $scope.currentMarker = $scope.places[0];
	// 		console.log($rootScope.currentMarker);
	// 		$rootScope.moveMapTo = {
	// 			latitude:$rootScope.currentMarker.latitude,
	// 			longitude:$rootScope.currentMarker.longitude,
	// 			zoom:14,
	// 			center: true,
	// 		};
	// 		       $rootScope.centerMarkers = [];
	// 	      //tengo que mostrar arriba en el map si es dekstop.
	// 	      $rootScope.centerMarkers.push($rootScope.currentMarker);

			
	// 	})
	// }




});