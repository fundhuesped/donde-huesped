dondev2App.controller('locationNewController',
    function($timeout, copyService, placesFactory, NgMap, $scope, $rootScope, $routeParams, $location, $http) {
        $rootScope.navBar = $routeParams.servicio;
        $scope.service = copyService.getFor($routeParams.servicio);

        console.log($routeParams.servicio);
        var queryNavBar;

        $scope.getNow = function(postdata){
          switch($scope.navBar) {
            case "Vacunatorios":
                queryNavBar = "Vacunatorio";
                break;
            case "infectologia":
                queryNavBar = "infectologia";
                break;
          }

          var next = postdata.originalObject.idPais +"-" + postdata.originalObject.nombre_pais;
          next += "/" + postdata.originalObject.idProvincia +"-" + postdata.originalObject.nombre_provincia;
          next += "/" + postdata.originalObject.id +"-" + postdata.originalObject.nombre_partido;
          next += "/" + $scope.navBar;
          next += "/listado";

          $location.path(next);
        }
});
