var dondev2App = angular.module('dondev2App',['ngRoute','ngMap','ui.materialize','pascalprecht.translate', 'angucomplete-alt']);

$(document).ready(function(){
  	new WOW().init();
});

dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})

.config(['$translateProvider', function ($translateProvider) {
       $translateProvider
         .translations('es', translations_es)
         .translations('br', translations_br)
         .translations('en', translations_en)
         .preferredLanguage(localStorage.getItem('lang'));

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
});

String.prototype.toProperCase = function(opt_lowerCaseTheRest) {
  return (opt_lowerCaseTheRest ? this.toLowerCase() : this)
    .replace(/(^|[\s\xA0])[^\s\xA0]/g, function(s){ return s.toUpperCase(); });
};