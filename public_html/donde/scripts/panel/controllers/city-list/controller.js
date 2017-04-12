dondev2App.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})

.controller('cityListController', function($scope, $rootScope, $http, $interpolate) {

  console.log('City list loaded');

  $scope.loadingPrev = true;
  $scope.loadingPost = true;

  $http.get('../api/v1/panel/partido/panel')
    .success(function(response) {
      $scope.cities = response;

      for (var i = 0; i < $scope.cities.length; i++) {
        if (!$scope.cities[i].habilitado || $scope.cities[i].habilitado == "0") {
          $scope.cities[i].habilitado = false;
        } else {
          $scope.cities[i].habilitado = true;
        }
      }
      $scope.loadingPrev = false;
    });

  $scope.updateHidden = function(id, value,name) {
    var httpdata = {
      habilitado: !value[0][0]
    };
    $scope.spinner = true;
    $http.post('../api/v1/panel/partido/update/' + id, httpdata)
      .success(function(response) {
        console.log(response);
        var text = "Se ha habilitado " + name + " correctamente. Desde ahora es seleccionable en los combos.";
        if (!httpdata.habilitado){
          var text = "Se ha ocultado " + name + " correctamente. Desde ahora no es seleccionable en los combos.";
        }
        Materialize.toast(text, 5000);
        $scope.spinner= false;
      });
    return;
  };

  $scope.openCleardbModal = function(){
console.log("cleardb function");
     $('#cleardbModal').openModal();
  //   return;
  };

  $scope.closeCleardbModal = function(){
     $('#cleardbModal').closeModal();
  };

  $rootScope.cleardb = function(){
    console.log("cleardb function");
  $http.get('api/v1/panel/cleardb')
    .then(
      function(response) {
        /*if (response.data.length == 0) {
          Materialize.toast('La peticion de ' + $rootScope.current.establecimiento + ' ha sido rechazada.', 5000);
        } else {
          for (var propertyName in response.data) {
            Materialize.toast(response.data[propertyName], 10000);
          };
        }
*/
      },
      function(response) {
      //  Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);

      });
    // Materialize.toast($rootScope.current.establecimiento + " ha sido rechazada.",4000);
     $('#cleardbModal').closeModal();
  };

});
