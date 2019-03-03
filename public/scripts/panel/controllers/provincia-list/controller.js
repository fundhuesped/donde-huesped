dondev2App.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})

.controller('provinciaListController', function($scope, $rootScope, $http, $interpolate, $translate) {

  $scope.loadingPrev = true;
  $scope.loadingPost = true;
  $scope.page = 1;
  $scope.pages = 1;
  $scope.per_page = 100;
  $scope.search = "";





  $scope.loadPage = function(){
    $scope.spinner = true;
    $http.get('../api/v1/panel/provincia/panel/' + $scope.per_page + '/'+ $scope.search +'?page=' + $scope.page )
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
    $http.post('../api/v1/panel/provincia/update/' + id, httpdata)
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
