myApp.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})

.controller('editConfirmationController', function($filter, $scope, $rootScope, $interpolate, $location, $route) {

  document.location.href = $location.path() + 'panel';


});
