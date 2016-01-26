dondev2App.controller('locateListController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	
	$scope.service = $routeParams.servicio;
	$rootScope.navBar =$scope.service ;
	$scope.places = [];
	$scope.main = true;
	var onLocationError = function(e){
		  	$scope.$apply(function(){
    			$location.path('/call/help');
    		});
  	}
  	var onLocationFound = function(position){
  		$scope.$apply(function(){
	    	placesFactory.forLocation(position.coords, function(result){ 
	          $scope.places = $scope.closer = result;
	          $rootScope.currentPos = position.coords;
	        });
        });
    };
    navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
});