dondev2App.controller('cityMapController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	
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
	placesFactory.getAllFor(search, function(data){
		$scope.places = data;
		var map = NgMap.initMap('mainMap');
	})

});