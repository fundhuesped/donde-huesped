dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
  })

  .controller('tagsImportacionController', function(NgMap, placesFactory, $filter, $scope, $timeout, $rootScope, $http, $interpolate, $location, $route) {
      console.log("tagsImportacionController");

      $scope.tagsImportaciones;
      $scope.loading = true;
      
      $http.get('api/v1/places/tagsimportaciones')
        .success(function(response) {
          console.log(response);
          $scope.tagsImportaciones = response;
          $scope.loading = false;
        });

      $('#demoModal').closeModal();
      $scope.closeModal = function(place) {
      $('#demoModal').closeModal();
      $scope.current = {};
    };

  });
