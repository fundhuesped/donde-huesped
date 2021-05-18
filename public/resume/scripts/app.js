var dondeDataVizApp = angular
.module('dondeDataVizApp', [
  'ngCookies',
  '720kb.socialshare',
  'ngMap',
  'ngRoute',
  'ui.materialize',
  // 'angularMoment',
  // 'ui.odometer',
  // 'ngSanitize',
  'angucomplete', 
  'vcRecaptcha', 
  'ngTextTruncate', 
  'pascalprecht.translate'
  ])

// Rutas de Angular
.config(function ($routeProvider) {
  $routeProvider
  .when('/', {
    templateUrl: 'resume/views/home.html',
    controller: 'HomeCtrl',
    controllerAs: 'home'
  })
  .when('map/:id', {
    templateUrl: 'resume/views/map.html',
    controller: 'mapCtrl',
    controllerAs: 'map'
  })
  .when('/pais/:pais/provincia', {
    templateUrl: 'resume/views/country-list.html',
    controller: 'countryCtrl',
    controllerAs: 'cCtrl'
  })
  .when('/pais/:pais/provincia/:provincia/partido', {
    templateUrl: 'resume/views/province-list.html',
    controller: 'provinceCtrl',
    controllerAs: 'proCtrl'
  })
  .when('/pais/:pais/provincia/:provincia/partido/:partido/ciudad', {
    templateUrl: 'resume/views/party-list.html',
    controller: 'partyCtrl',
    controllerAs: 'pCtrl'
  })
  .when('/pais/:pais/provincia/:provincia/partido/:partido/ciudad/:ciudad/servicio', {
    templateUrl: 'resume/views/service-list.html',
    controller: 'serviceCtrl',
    controllerAs: 'serCtrl'
  })
  .when('/pais/:pais/provincia/:provincia/partido/:partido/ciudad/:ciudad/servicio/:code', {
    templateUrl: 'resume/views/places-list.html',
    controller: 'placeCtrl',
    controllerAs: 'psCtrl'
  })
  .otherwise({
    redirectTo: '/'
  });
})

// Para poder interoperar con Laravel Blade
.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})

// Translate
.config(['$translateProvider', function ($translateProvider) {
  $translateProvider
  .translations('es', translations_es)
  .translations('br', translations_br)
  .translations('en', translations_en)
  .preferredLanguage('es');
}]);

// dondeDataVizApp.run(function(amMoment) {
//   amMoment.changeLocale('es');
// });

$(document).ready(function() {
  new WOW().init();
  $('.modal-trigger').leanModal();
  $(".button-collapse").sideNav();
});
