dondev2App.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})

.controller('cityListController', function($scope, $rootScope, $http, $interpolate, $translate) {

  $scope.loadingPrev = true;
  $scope.loadingPost = true;
  $scope.page = 1;
  $scope.pages = 1;
  $scope.per_page = 100;
  $scope.search = "";

  $scope.clearCiudades = function(){
    $scope.loadingCiudades = true;
    $http.get('../api/v1/panel/clear/ciudad/clearAllEmtpy')
       .success(function(response) {
      $scope.loadingCiudades = false;
      var text = "No se han encontrado ciudades habilitadas sin centros.";
      if (parseInt(response) > 0){
        text = "Se han removido " + response + " ciudades que no tenian centros.";''
      }
      Materialize.toast(text, 5000);
      $scope.loadPage();

    });
  }
  $scope.clearPartidos = function(){
    $scope.loadingPartido = true;
    $http.get('../api/v1/panel/clear/partido/clearAllEmtpy')
       .success(function(response) {
      $scope.loadingPartido = false;
      var text = "No se han encontrado partidos habilitados sin centros.";
      if (parseInt(response) > 0){
        text = "Se han removido " + response + " partidos que no tenian centros.";''
      }
      Materialize.toast(text, 5000);
      $scope.loadPage();

    });
  }
  $scope.clearPais = function(){
   
    $scope.loadingPaises = true;
    $http.get('../api/v1/panel/clear/pais/clearAllEmtpy')
       .success(function(response) {
      $scope.loadingPaises = false;
      var text = "No se han encontrado paises habilitados sin centros.";
      if (parseInt(response) > 0){
        text = "Se han removido " + response + " paises que no tenian centros.";''
      }
      Materialize.toast(text, 5000);
      $scope.loadPage();

    });
  }
  $scope.clearProvincias = function(){
    $scope.loadingProvincias = true;
    $http.get('../api/v1/panel/clear/provincia/clearAllEmtpy')
       .success(function(response) {

      $scope.loadingProvincias = false;
      var text = "No se han encontrado provincias habilitadas sin centros.";
      if (parseInt(response) > 0){
        text = "Se han removido " + response + " provincias que no tenian centros.";''
      }
      Materialize.toast(text, 5000);
      $scope.loadPage();

    });
  }
  
  $scope.loadPage = function(){
  
    $http.get('../api/v1/panel/ciudad/panel/' + $scope.per_page + '/'+ $scope.search +'?page=' + $scope.page )
       .success(function(response) {
      $scope.cities = response.data;
      $scope.cities.total = response.total;
      $scope.pages = response.last_page;
      for (var i = 0; i < $scope.cities.length; i++) {
        if (!$scope.cities[i].habilitado || $scope.cities[i].habilitado == "0") {
          $scope.cities[i].habilitado = false;
        } else {
          $scope.cities[i].habilitado = true;
        }
      }
      $scope.spinner = false;
      $scope.loadingPrev = false;
    });
  }

  $scope.loadPage();

  $scope.nextPage = function() {
      $scope.loadingPrev = true;
      $scope.loadingPost = true;
      $scope.spinner = true;
    if ($scope.page < $scope.pages) {
      $scope.page++;
      $scope.loadPage();

    }
  };

  $scope.previousPage = function() {
     $scope.loadingPrev = true;
     $scope.loadingPost = true;
     $scope.spinner = true;
    if ($scope.page > 1) {
      $scope.page--;
      $scope.loadPage();
    }
  };

  $scope.updateHidden = function(id, value, name) {
    var httpdata = {
      habilitado: !value[0][0]
    };
    $scope.spinner = true;
    $http.post('../api/v1/panel/ciudad/update/' + id, httpdata)
    .success(function(response) {

      var text = "Se ha habilitado " + name + " correctamente. Desde ahora es seleccionable en los combos.";
      if (!httpdata.habilitado) {
        var text = "Se ha ocultado " + name + " correctamente. Desde ahora no es seleccionable en los combos.";
      }
      Materialize.toast(text, 5000);
      $scope.spinner = false;
    });
    return;
  };


});
