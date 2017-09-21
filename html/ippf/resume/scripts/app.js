'use strict';
$.urlParam = function(url,name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
    if (results===null){
       return null;
    }
    else{
       return results[1] || 0;
    }
};
$(document).ready(function(){
      new WOW().init();
      smoothScroll.init();
});



/**
 * @ngdoc overview
 * @name houstonDiversityMap
 * @description
 * # houstonDiversityMap
 *
 * Main module of the application.
 */
angular
  .module('dondeDataVizApp', [
    'ngRoute',
    'ngMap',
    '720kb.socialshare',
    'angularMoment',
    'ui.odometer',
    'ngSanitize',
    'ui.materialize'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/home.html',
        controller: 'HomeCtrl',
        controllerAs: 'home'
      })
       .when('/map/:id', {
        templateUrl: 'views/map.html',
        controller: 'mapCtrl',
        controllerAs: 'map'
      })
      .otherwise({
        redirectTo: '/'
      });
  }).config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
  })

  .run(function(amMoment) {
    amMoment.changeLocale('es');
  })

