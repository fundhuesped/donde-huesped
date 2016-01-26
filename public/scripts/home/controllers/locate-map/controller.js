dondev2App.controller('locateMapController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	
	$scope.service = $routeParams.servicio;
	$rootScope.navBar =$scope.service ;
	$scope.places = [];
	$scope.main = true;
  
	var onLocationError = function(e){
    	$timeout.cancel($rootScope.promiseHelp);
    	$location.path('/call/help');
  	}
  	var onLocationFound = function(position){
    	placesFactory.forLocation(position.coords, function(result){ 
          $scope.places = $scope.closer = result;
          
          var map = NgMap.initMap('mainMap');
          $scope.currentPos = position.coords;
        });
    };

    $scope.showCurrent = function(i,p){
      $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;
    }
    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }
    navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
});