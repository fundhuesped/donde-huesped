dondev2App.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})

.controller('usersController', function($scope, $rootScope, $http, $interpolate) {

  console.log('usersController loaded');

  $scope.loadingPrev = true;
  $scope.loadingPost = true;
  $scope.newUser = {
    roll : "",
    name : "",
    email : "",
    password: "",
    password_confirmation : ""
  };

  $http.get('../api-admin')
    .success(function(response) {
      $scope.admins = response;
      $scope.loadingPrev = false;
    });

});
