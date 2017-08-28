dondev2App.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})

.controller('adminListController', function($scope, $rootScope, $http, $interpolate, $window) {

  console.log('Admin list loaded');

  $scope.loadingPrev = true;
  $scope.loadingPost = true;

  $http.get('../api-admin')
    .success(function(response) {
      $scope.admins = response;
      $scope.loadingPrev = false;
    });

    $scope.userCountries = function(userId){
console.log("userCountries");
      $http.get('../api/v2/usercountries/'+ userId)
        .success(function(response) {
          console.log(response);
          console.log("response");
          console.log(response);
          $window.localStorage.setItem('userCountries',response)
          $window.localStorage.setItem('idUser_countries',userId)
          $window.location.href = '../panel/user-countries';
        });
    }

});
