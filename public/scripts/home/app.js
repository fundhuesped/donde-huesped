var dondev2App = angular.module('dondev2App', ['ngCookies', '720kb.socialshare', 'ngMap', 'ngRoute', 'ui.materialize', 'angucomplete', 'vcRecaptcha', 'ngTextTruncate', 'pascalprecht.translate'])

// Rutas de Angular
.config(['$routeProvider', function($routeProvider) {
  $routeProvider
  .when('/', {
    templateUrl: 'scripts/home/controllers/home/view.html',
    controller: 'homeController'
  }).when('/servicios/:servicio/', {
    templateUrl: 'scripts/home/controllers/location/view.html',
    controller: 'locationController'
  })
.when('/como-buscas/:servicio/', { //nueva Index
  templateUrl: 'scripts/home/controllers/location/viewTmp.html',
  controller: 'locationController'
})
.when('/como-buscas/:servicio/ubicacion', { //nueva vista Opcion 1 (sin uso)
  templateUrl: 'scripts/home/controllers/location/viewUbi.html',
  controller: 'locationController'
})
.when('/como-buscas/:servicio/geo', { //nueva vista Opcion 2
  templateUrl: 'scripts/home/controllers/location/viewGeo.html',
  controller: 'locationController'
})
.when('/como-buscas/:servicio/sug', { //nueva vista Opcion 3
  templateUrl: 'scripts/home/controllers/suggest-location/viewSug.html',
  controller: 'locationNewController'
})
.when('/lugar/nuevo', {
  templateUrl: 'scripts/places/controllers/map/view.html',
  controller: 'placesController'
})
.when('/localizar/:servicio/mapa', {
  templateUrl: 'scripts/home/controllers/city-map/view.html',
  controller: 'locateMapController'
})
.when('/localizar/:servicio/listado', {
  templateUrl: 'scripts/home/controllers/locate-list/view.html',
  controller: 'locateListController'
})
.when('/como-buscas/:servicio/name', { //nueva vista Opcion 4
  templateUrl: 'scripts/home/controllers/location/viewName.html',
  controller: 'locationController'
})
// List all the places
.when('/buscar/:servicio/:name/listado', {
  templateUrl: 'scripts/home/controllers/name-list/view.html',
  controller: 'nameListController'
})
//Locate places on the map by city
.when('/buscar/:servicio/:name/mapa', {
  templateUrl: 'scripts/home/controllers/city-map/view.html',
  controller: 'nameMapController'
})
// List all the places that belong to a party by service
.when('/:pais/:provincia/:partido/:servicio/listado', {
  templateUrl: 'scripts/home/controllers/party-list/view.html',
  controller: 'partyListController'
})
// List all the places that belong to a city by service
.when('/:pais/:provincia/:partido/:ciudad/:servicio/listado', {
  templateUrl: 'scripts/home/controllers/city-list/view.html',
  controller: 'cityListController'
})
//Locate places on the map by city
.when('/:pais/:provincia/:partido/:ciudad/:servicio/mapa', {
  templateUrl: 'scripts/home/controllers/city-map/view.html',
  controller: 'cityMapController'
})
//Locate places on the map by party
.when('/:pais/:provincia/:partido/:servicio/mapa', {
  templateUrl: 'scripts/home/controllers/city-map/view.html',
  controller: 'cityMapController'
})
.when('/acerca', {
  templateUrl: 'scripts/home/controllers/acerca/view.html',
  controller: 'acercaController'
})
.when('/detail/:id', {
  templateUrl: 'scripts/home/controllers/city-map/view2.html',
  controller: 'cityMapController2'
})
.when('/detail/:lang/:id', {
  templateUrl: 'scripts/home/controllers/city-map/view2.html',
  controller: 'cityMapController2'
})
.when('/califica/:id', {
  templateUrl: 'scripts/home/controllers/evaluation/view.html',
  controller: 'evaluationController'
})
.when('/voted/:id', {
  templateUrl: 'scripts/home/controllers/evaluation/completed.html',
  controller: 'evaluationController'
})

.otherwise({
  redirectTo: '/'
});

}])

// Translate
.config(['$translateProvider', function($translateProvider) {
  $translateProvider
  .translations('es', translations_es)
  .translations('br', translations_br)
  .translations('en', translations_en)
  .preferredLanguage('es');
}]);

// Efecto de recarga del mapa
dondev2App.run(function($rootScope, $timeout, $location) {
  $rootScope.$on("$routeChangeStart", function(event, next, current) {
    var url = $location.url();
    if (url.includes("como-buscas")) {
      $("#mainMap").hide();
      $timeout(function() {
        $("#mainMap").show();
      });
    }
  });
});

dondev2App.directive('filterList', function($timeout) {
  return {
    link: function(scope, element, attrs) {
      var li = Array.prototype.slice.call(element[0].children);
      function filterBy(value) {
        li.forEach(function(el) {
          el.className = el.textContent.toLowerCase().indexOf(value.toLowerCase()) !== -1 ? '' : 'ng-cloak ng-hide';
        });
      }
      scope.$watch(attrs.filterList, function(newVal, oldVal) {
        if (newVal !== oldVal) {
          filterBy(newVal);
        }
      });
    }
  };
});

// Para poder interoperar con Laravel Blade
dondev2App.config(function($interpolateProvider, $locationProvider) {
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');
})

angular.module('ngMap').run(function($rootScope) {
  $rootScope.$on('mapInitialized', function(evt, map) {
    $rootScope.map = map;
    window.map = $rootScope.map;
    $rootScope.$apply();
  });
  $rootScope.$on("$routeChangeStart", function(event, next, current) {
    if (!$rootScope.startedNav) {
      $rootScope.startedNav = true;
    } else {
      $rootScope.navigating = true;
    }
  });
});

dondev2App.filter('unique', function() {
  return function(input, key) {
    var unique = {};
    var uniqueList = [];
    for (var i = 0; i < input.length; i++) {
      if (typeof unique[input[i][key]] == "undefined") {
        unique[input[i][key]] = "";
        uniqueList.push(input[i]);
      }
    }
    return uniqueList;
  };
}).run(function($rootScope, $location, placesFactory) {
  placesFactory.load(function(data) {});
  $rootScope.$on('$locationChangeStart', function(event) {
    if ($location.hash().indexOf('anchor') > -1 || $location.hash().indexOf('acerca') > -1) {

      $anchorScroll();

      event.preventDefault();
    }
  });
  $rootScope.$on("$routeChangeStart", function(event, next, current) {
    //Cada vez que cambia la vista, se fuerza el cierre del menu.
    $("#sidenav-overlay").trigger("click");
  });
});

// Callback para la tecla enter: 'ng-enter=func()'
dondev2App.directive('ngEnter', function () {
  return function (scope, element, attrs) {
    element.bind("keydown keypress", function (event) {
      if (event.which === 13) {
        scope.$apply(function () {
          scope.$eval(attrs.ngEnter);
        });
        event.preventDefault();
      }
    });
  };
})

$(document).ready(function() {
  new WOW().init();
  $('.modal-trigger').leanModal();
  $(".button-collapse").sideNav();
});
