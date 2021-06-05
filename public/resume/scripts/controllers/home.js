angular.module('dondeDataVizApp').controller('HomeCtrl',
  function($timeout, NgMap, $anchorScroll, $scope, $rootScope, $routeParams, $location, $http, $translate, $cookies) {

    $rootScope.navigating = true;
    
    // Change language of this module
    var lang = $cookies.get('lang');
    if (lang === undefined || lang === null) {
      lang = 'es'; 
    }
    $translate.use(lang);

  });
