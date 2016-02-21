dondev2App.controller('mapController', 
	function(placesFactory,NgMap, $scope,$rootScope, $timeout, $routeParams, $location, $http){
	


  $timeout(function(){

    $rootScope.moveMapTo = {
      latitude:-12.382928338487396,
      longitude:-79.27734375,
      zoom:3
    };
  },1000);
  $rootScope.$watch('moveMapTo', function(d){

    if (d && $rootScope.map){
      $scope.center = "[" + d.latitude  + "," +  d.longitude +"]";
       window.map.setCenter({
        lat : d.latitude,
        lng : d.longitude
      });
      window.map.setZoom(d.zoom);
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

    

    $scope.showCurrent = function(i,p){
      $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;
    }
    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }
    
});