myApp.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})

.controller('cityListController', function($scope, $rootScope, $http, $interpolate) {

  console.log('City list loaded');

  $scope.loadingPrev = true;
  $scope.loadingPost = true;

  $http.get('../api-localidad/panel')
    .success(function(response) {
      $scope.cities = response;

      for (var i = 0; i < $scope.cities.length; i++) {
        if (!$scope.cities[i].hidden || $scope.cities[i].hidden == "0") {
          $scope.cities[i].hidden = false;
        } else {
          $scope.cities[i].hidden = true;
        }
      }
      $scope.loadingPrev = false;
    });

  $scope.updateHidden = function(id, value) {
    var httpdata = {
      hidden: !value[0][0]
    };
    $http.post('update/' + id, httpdata)
      .success(function(response) {
      });
    return;
  };
});
