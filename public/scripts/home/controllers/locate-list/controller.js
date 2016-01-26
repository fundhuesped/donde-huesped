dondev2App.controller('locateListController', 
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
          $rootScope.currentPos = position.coords;
        });
    };
    navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
});