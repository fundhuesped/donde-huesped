dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
  })

  .controller('usersController', function($scope, $rootScope, $http, $interpolate) {

    console.log('usersController loaded');

    $scope.loadingPrev = true;
    $scope.loadingPost = true;
    $scope.countries = {};
    $scope.newUser = {
      roll: "",
      name: "",
      email: "",
      password: "",
      password_confirmation: ""
    };

    $http.get('../api/v1/countries/all')
      .success(function(response) {
        console.log(response);
        $scope.countries = response;
        $scope.loadingPrev = false;
        $scope.loadingPost = false;
      });
    $scope.list = [];
    $scope.selected = [];
    $scope.toggle = function(country, list) {
      console.log("toogle");
      var idx = list.indexOf(country.id);
      if (idx > -1) {
        list.splice(idx, 1);
      } else {
        list.push(country.id);
      }
      console.log("list");
      console.log(list);
    };

    $scope.exists = function(country, list) {
      console.log("exists");
      return list.indexOf(country.id) > -1;
    };

  });
