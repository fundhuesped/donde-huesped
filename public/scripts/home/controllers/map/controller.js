dondev2App.controller('mapController', 
	function(placesFactory,NgMap, $scope,$rootScope, $timeout, $routeParams, $location, $http){
	

  $scope.center = "[-12.382928338487396,-79.27734375]";


  $rootScope.$watch('moveMapTo', function(d){
    if (d && $rootScope.map){
      $scope.center = "[" + d.latitude  + "," +  d.longitude +"]";
       window.map.setCenter({
        lat : d.latitude,
        lng : d.longitude
      });
       window.map.map.setZoom(d.zoom);
    }
  })
   
	$scope.service = $routeParams.servicio;
	$rootScope.navBar =$scope.service ;
	$rootScope.places = [];
	$scope.main = true;
  $rootScope.main = false;
	 var onLocationError = function(e){
        $scope.$apply(function(){
          $location.path('/call/help');
        });
    };

    // var onLocationFound = function(position){
    //   $scope.$apply(function(){
    //     	placesFactory.forLocation(position.coords, function(result){ 
    //           $rootScope.places = $scope.places = $scope.closer = result;
              
    //           // $scope.map = NgMap.initMap('mainMap');
    //           $scope.currentPos = position.coords;
    //         });
    //     });
    // };

    $scope.showCurrent = function(i,p){
      $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;
    }
    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }
    // navigator.geolocation.getCurrentPosition(onLocationFound, onLocationError);
});