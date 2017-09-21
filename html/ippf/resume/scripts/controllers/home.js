'use strict';

/**
 * @ngdoc function
 * @name houstonDiversityMap:controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the houstonDiversityMap
 */
angular.module('dondeDataVizApp').controller('HomeCtrl', 
  function (moment,NgMap, $interval, $scope,$timeout,$document,$http) {


      var server = 'https://ippf-staging.com.ar/';
      $scope.showDetail = function(i,p){
        $scope.currentMarker = p;
      }
     
     $scope.data = [];
   		var getStats = function(){
             var onPageFinished = function(){
              console.log($scope.data[0]);
             };
            var getNextPage = function(url){
             $http.get(url)
               .then(function(d){
                  $scope.data = $scope.data.concat(d.data.data);
                  if (d.data.next_page_url){
                    getNextPage(d.data.next_page_url);
                  }
                  else {
                    onPageFinished();
                  }
               }); 
            };

            getNextPage(server + 'api/v2/places/getall');

   		};
   		 
      getStats();

      
});


