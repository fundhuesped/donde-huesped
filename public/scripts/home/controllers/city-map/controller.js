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
			provincia_region: $routeParams.provincia,
			partido_comuna: $routeParams.ciudad,
			pais: $routeParams.pais,
			
		};
	search[$routeParams.servicio.toLowerCase()] = true;
		
	$scope.showCurrent = function(i,p){
      $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;
    }
    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }

    if ($rootScope.places.length > 0 && $rootScope.currentMarker){
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
	$rootScope.$watch('currentMarker',function(){
		 $scope.currentMarker = $rootScope.currentMarker;
	})



});