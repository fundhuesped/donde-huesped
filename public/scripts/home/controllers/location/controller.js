dondev2App.controller('locationController',
  function($timeout, copyService, placesFactory, NgMap, $scope, $rootScope, $routeParams, $location, $http) {

    $rootScope.navBar = $routeParams.servicio;
    $scope.service = copyService.getFor($routeParams.servicio);
    $rootScope.serviceCode = $scope.service.code;
    $rootScope.serviceCode =  $routeParams.servicio.toLowerCase();
    $rootScope.returnTo = ""; //manipulate close buton.
    $scope.name = "";
    gtag('event','ver_servicio', {
      'event_category': $rootScope.serviceCode
    });
    

    $timeout(
      function() {
        $rootScope.moveMapTo = {
          latitude: -12.382928338487396,
          longitude: -79.27734375,
          zoom: 3
        };
      }, 500);
    $rootScope.places = [];
    $scope.searchOn = false;
    $rootScope.main = false;
    $scope.countries = [];

    placesFactory.getCountries(function(countries) {
      $scope.countries = countries;
    })

    $scope.getNow = function(value) {
      if(!$scope.isValidForm()) return;
      
      $location.path('buscar/' + $rootScope.serviceCode + '/' + $scope.name + '/listado');
      $scope.setReturn(value);
    }

    $scope.isValidForm = function(){
      var name = $scope.name;
      if(!name || name.length < 3) return false;
      else return true;
    }

    $scope.setReturn = function(value) {
      $rootScope.returnTo = value;
    }

  });
