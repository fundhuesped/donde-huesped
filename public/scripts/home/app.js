
var dondev2App = angular.module('dondev2App',['ngMap','ngRoute','ui.materialize']).

config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/', 
    {
      templateUrl: '/scripts/home/controllers/home/view.html', 
      controller: 'homeController'
    }).otherwise({
        redirectTo: '/'
      });

 
}]);

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
});

