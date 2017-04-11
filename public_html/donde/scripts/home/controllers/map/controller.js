dondev2App.controller('mapController',
	function(placesFactory,NgMap, $scope,$rootScope, $timeout, $routeParams, $location, $http){

$rootScope.centerMarkers = [];


  $timeout(function(){

    $rootScope.moveMapTo = {
      latitude:-12.382928338487396,
      longitude:-79.27734375,
      zoom:3
    };
  },3000);
  $rootScope.$watch('moveMapTo', function(d){
    if (d.center || (!$rootScope.places || $rootScope.places.length === 0)){
      if (d && $rootScope.map){
        $scope.center = "[" + d.latitude  + "," +  d.longitude +"]";
         window.map.setCenter({
          lat : d.latitude,
          lng : d.longitude
        });
        window.map.setZoom(d.zoom);
        }
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

      $rootScope.currentMarker  = $scope.currentMarker = p;
      window.map.setCenter({
          lat : $rootScope.currentMarker.latitude,
          lng : $rootScope.currentMarker.longitude,
        });
      window.map.panTo(new google.maps.LatLng($rootScope.currentMarker.latitude,$rootScope.currentMarker.longitude));
       $rootScope.centerMarkers = [];
      //tengo que mostrar arriba en el map si es dekstop.
      $rootScope.centerMarkers.push($rootScope.currentMarker);

      var path = $location.path();
      if (path.indexOf('listado') > -1){
        var newPath = path.replace('listado','mapa');
        $location.path(newPath);
      }
    }
    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }

});
