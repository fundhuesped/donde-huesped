
var dondev2App = angular.module('dondev2App',['ngMap','ngRoute','ui.materialize']).

config(['$routeProvider', function($routeProvider) {
  $routeProvider
  .when('/', {
      templateUrl: '/scripts/home/controllers/home/view.html', 
      controller: 'homeController'
    }).when('/servicios/:servicio/', {
      templateUrl: '/scripts/home/controllers/location/view.html', 
      controller: 'locationController'
    })
    .when('/lugar/nuevo', {
      templateUrl: '/scripts/places/controllers/map/view.html', 
      controller: 'placesController'
    }).when('/localizar/:servicio/mapa', {
      templateUrl: '/scripts/home/controllers/locate-map/view.html',  
      controller: 'locateMapController'
    })
    .when('/localizar/:servicio/listado', {
      templateUrl: '/scripts/home/controllers/locate-list/view.html', 
      controller: 'locateListController'
    })
    .when('/:pais/:provincia/:ciudad/:servicio/listado', {
      templateUrl: '/scripts/home/controllers/city-list/view.html', 
      controller: 'cityListController'
    })
    .when('/:pais/:provincia/:ciudad/:servicio/mapa', {
      templateUrl: '/scripts/home/controllers/city-map/view.html', 
      controller: 'cityMapController'
    })
    
    .otherwise({
        redirectTo: '/'
    });

 
}]);


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
dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})

angular.module('ngMap').run(function($rootScope) {
  $rootScope.$on('mapInitialized', function(evt,map) {
    $rootScope.map = map;
    window.map = $rootScope.map;
    window.map.setCenter(new google.maps.LatLng(-12.382928338487396,-79.27734375));
    window.map.setZoom(3);
    $rootScope.$apply();
    
    
  });
});

dondev2App.filter('unique', function() {
    return function(input, key) {
        var unique = {};
        var uniqueList = [];
        for(var i = 0; i < input.length; i++){
            if(typeof unique[input[i][key]] == "undefined"){
                unique[input[i][key]] = "";
                uniqueList.push(input[i]);
            }
        }
        return uniqueList;
    };
}).run(function($rootScope, $location) {
    $rootScope.$on( "$routeChangeStart", function(event, next, current) {
        //Cada vez que cambia la vista, se fuerza el cierre del menu.
        $("#sidenav-overlay").trigger("click");
    });
  });



$(document).ready(function(){
    new WOW().init();
    $('.modal-trigger').leanModal();
    $(".button-collapse").sideNav();
});


function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}