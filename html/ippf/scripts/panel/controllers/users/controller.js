dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
  })

  .controller('usersController', function($scope, $rootScope, $http, $interpolate) {

    console.log('usersController loaded');

    $scope.loadingPrev = true;
    $scope.loadingPost = true;
    $scope.countries = {};
    $scope.list = [];
    $scope.selected = [];
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
    $scope.toggle = function(country, list) {
      console.log("toogle");
      var idx = list.indexOf(country.id);
      if (idx > -1) {
        list.splice(idx, 1);
        $scope.list = list;
      } else {
        list.push(country.id);
        $scope.list = list;
      }
      console.log("list");
      console.log(list);
    };

    $scope.exists = function(country, list) {

      return list.indexOf(country.id) > -1;
    };

    $scope.saveUserCountries = function(){
      console.log("list ");
      console.log($scope.list);
      $http.post('../api/v2/usercountries', $scope.list)
   .then(
       function(response){
         console.log("success");
         console.log(response);
       },
       function(response){
         console.log("fail");
         console.log(response);
       }
    );
    }

  });
