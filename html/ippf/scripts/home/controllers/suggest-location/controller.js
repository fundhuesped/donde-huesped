dondev2App.controller('locationNewController',
  function($timeout, copyService, placesFactory, NgMap, $scope, $rootScope, $routeParams, $location, $http) {
    
    console.log('locationNewController')
    
    $rootScope.navBar = $routeParams.servicio;
    
    $scope.service = copyService.getFor($routeParams.servicio);

    var queryNavBar;

    $scope.getNow = function(postdata) {

      switch ($scope.navBar) {

        case "Vacunatorios":
        queryNavBar = "Vacunatorio";
        break;
        
        case "infectologia":
        queryNavBar = "infectologia";
        break;

      }


      // Go to places list by service
      if(postdata.originalObject.nombre_ciudad){

        var next = postdata.originalObject.idPais +"-" + postdata.originalObject.nombre_pais;
        next += "/" + postdata.originalObject.idProvincia +"-" + postdata.originalObject.nombre_provincia;
        next += "/" + postdata.originalObject.idPartido +"-" + postdata.originalObject.nombre_partido;
        next += "/" + postdata.originalObject.id +"-" + postdata.originalObject.nombre_ciudad;
        next += "/" + $scope.navBar;
        next += "/listado";

      }
      // Go to cities list by party 
      else{

        var next = postdata.originalObject.idPais +"-" + postdata.originalObject.nombre_pais;
        next += "/" + postdata.originalObject.idProvincia +"-" + postdata.originalObject.nombre_provincia;
        next += "/" + postdata.originalObject.id +"-" + postdata.originalObject.nombre_partido;
        next += "/" + $scope.navBar;
        next += "/ciudades";

      }
      
      $location.path(next);

    }

  });
