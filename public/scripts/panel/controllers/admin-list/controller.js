dondev2App.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})
.controller('adminListController', function($scope, $rootScope, $http, $interpolate, $window) {

  $scope.loadAdmins = function() {
    $http.get('../api-admin')
    .success(function(response) {
      $scope.admins = response;
      $scope.loadingPrev = false;
    });
  }

  $scope.loadingPrev = true;
  $scope.loadAdmins();

  $scope.userCountries = function(userId) {
    $http.get('../api/v2/usercountries/' + userId)
    .success(function(response) {
      $window.localStorage.setItem('userCountries', response)
      $window.localStorage.setItem('idUser_countries', userId)
      $window.location.href = '../panel/user-countries';
    });
  }

  $scope.loadModalChangePassword = function(user) {
    $scope.user = user;
    $scope.data = {};
    $('#modal-changePassword').openModal();
  };

  $scope.loadModalDeleteUser = function(user) {
    $scope.user = user;
    $scope.data = {};
    $('#modal-deleteUser').openModal();
  };

  $scope.changePassword = function() {
    $scope.data.userId = $scope.user.id;
    $http.post('../panel/change-password', $scope.data)
    .then(
      function(response) {
        console.log(response);
        if (response.data.length === 0) {
          Materialize.toast('Contraseña cambiada correctamente!', 2500);
          $('#modal-changePassword').closeModal();
        }
        else{
          if(typeof response.data.userId !== "undefined") Materialize.toast(response.data.userId[0], 5000);
          if(typeof response.data.new_password !== "undefined") Materialize.toast(response.data.new_password[0], 5000);
        }
      },
      function(response) {
        Materialize.toast('Intente nuevamente mas tarde.', 5000);
      });
  }

  $scope.deleteUser = function() {
    $scope.data.userId = $scope.user.id;
    $http.post('../panel/delete-user', $scope.data)
    .then(
      function(response) {
        console.log(response);
        if (response.data.length === 0) {
          Materialize.toast('Usuario eliminado correctamente!', 2500);
          $('#modal-deleteUser').closeModal();
          $scope.loadingPrev = true;
          $scope.loadAdmins();
        }
        else if(response.data == "-1"){
          Materialize.toast('No puedes eliminarte a tí mismo!', 2500);
        }
        else{
          if(typeof response.data.userId !== "undefined") Materialize.toast(response.data.userId[0], 5000);
        }
      },
      function(response) {
        Materialize.toast('Intente nuevamente mas tarde.', 5000);
      });
  }

});