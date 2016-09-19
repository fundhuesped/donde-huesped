dondev2App.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})

.controller('adminListController', function($scope, $rootScope, $http, $interpolate) {

  console.log('Admin list loaded');

  $scope.loadingPrev = true;
  $scope.loadingPost = true;

  $http.get('../api-admin')
    .success(function(response) {
      $scope.admins = response;
      $scope.loadingPrev = false;
    });

});
