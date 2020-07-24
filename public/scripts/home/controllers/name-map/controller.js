dondev2App.controller('nameMapController',
  function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
    $rootScope.serviceCode =  $routeParams.servicio.toLowerCase();

    $rootScope.$watch('currentMarker', function() {
      $scope.currentMarker = $rootScope.currentMarker;
    })

    // Verificar que exista cargado un establecimiento
    checkCurrentMarker();
    function checkCurrentMarker(){
      if(!$rootScope.currentMarker || !$scope.currentMarker)
        window.history.back();
    }

    $rootScope.geo = true;
    $scope.service = $routeParams.servicio;
    $rootScope.navBar =$scope.service ;
    $scope.main = true;
    $rootScope.main = false;
    $scope.serviceCode =  $routeParams.servicio.toLowerCase();

    $scope.addComment = function () {
      $scope.voteLimit ++;
    }

    $scope.showCurrent = function(i,p){
      $rootScope.navBar = p.establecimiento;
      $rootScope.currentMarker = p;
      $rootScope.centerMarkers.push($rootScope.currentMarker);
    }

    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }
  });
