var myApp = angular.module('dondev2App',['vcRecaptcha','ngRoute','ngMap','ui.materialize']);

console.log('init app');

$(document).ready(function(){
    //Force para cerrar menu;
    $("#nav-mobile li a").on('click', function(){$("#sidenav-overlay").trigger("click"); });

});

myApp.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})

myApp.filter('unique', function() {
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
});
