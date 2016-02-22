dondev2App.controller('cityMapController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	$rootScope.main = false;
	$rootScope.geo = false;
	$scope.province = $routeParams.provincia;
	$scope.city = $routeParams.ciudad;
	$scope.country = $routeParams.pais;
	$scope.service = $routeParams.servicio;
	$rootScope.navBar =$scope.service ;
	var search = {
			provincia: $routeParams.provincia,
			barrio_localidad: $routeParams.ciudad,
			// pais: $routeParams.pais,
			// servicio: $routeParams.servicio
		}
	
	$scope.showCurrent = function(i,p){
      $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;
    }
    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }

    if ((!$rootScope.places || $rootScope.places.length === 0) && $rootScope.currentMarker){
    	console.log($rootScope.currentMarker);
    	$rootScope.moveMapTo = {
			latitude:$rootScope.currentMarker.latitude,
			longitude:$rootScope.currentMarker.longitude,
			zoom:14,
			center: true,
		};
    }else {
		placesFactory.getAllFor(search, function(data){
			$rootScope.places = $scope.places = data;
			$rootScope.currentMarker = $scope.currentMarker = $scope.places[0];
			console.log($rootScope.currentMarker);
			$rootScope.moveMapTo = {
				latitude:$rootScope.currentMarker.latitude,
				longitude:$rootScope.currentMarker.longitude,
				zoom:14,
				center: true,
			};
			
		})
	}



});