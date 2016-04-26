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
		$location.path('/localizar' + '/' + $routeParams.servicio + '/mapa');

	}
  	var onLocationFound = function(position){

  		$scope.$apply(function(){

	    	placesFactory.forLocation(position.coords, function(result){ 

	          $rootScope.places = $scope.places = $scope.closer = result;
	          $rootScope.currentPos = position.coords;
	          $scope.loading = false;
	        });
        });
    };
    navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
});