dondev2App.controller('cityMapController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	$rootScope.main = false;

	$scope.province = $routeParams.provincia;
	$scope.city = $routeParams.ciudad;
	$scope.country = $routeParams.pais;
	$scope.service = $routeParams.servicio;
	$rootScope.navBar =$scope.service ;
	
	$scope.showCurrent = function(i,p){
      $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;
    }
    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }
	
	$rootScope.moveMapTo = {
			latitude:$rootScope.currentMarker.latitude,
			longitude:$rootScope.currentMarker.longitude,
			zoom:14,
			center: true,
		};


});