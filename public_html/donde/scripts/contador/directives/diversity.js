'use strict';

angular.module('dondeDataVizApp')
.directive('diverisity', function() {
    return {
        restrict: 'E',
        replace: false,
        scope: {
          container: '=container',
          config: '=config',
          currentitem: '=currentitem',
          diversitychart:'=diversitychart'
        },
        controller: function($scope, $http, $timeout) {
        


        $scope.diversitychart = 
        c3.generate({
                bindto: '#diversityChart',
                    data: {
                        columns: [
                            ['diversity',0]
                        ],
                         names: {
                          diversity: 'Diversity %',
                        },
                        type: 'gauge',
                        // onclick: function (d, i) { console.log("onclick", d, i); },
                        // onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                        // onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                    },
                    gauge: {
                //        label: {
                //            format: function(value, ratio) {
                //                return value;
                //            },
                //            show: false // to turn off the min/max labels.
                //        },
                //    min: 0, // 0 is default, //can handle negative min e.g. vacuum / voltage / current flow / rate of change
                //    max: 100, // 100 is default
                //    units: ' %',
                //    width: 39 // for adjusting arc thickness
                    },
                    color: {
                        
                        pattern: ['#e0f2f1', '#80cbc4', '#26a69a', '#00897b','#004d40'], // the three color levels for the percentage values.
                        threshold: {
                //            unit: 'value', // percentage is default
                //            max: 200, // 100 is default
                            values: [0, 25, 50, 80, 100]
                        }
                    },
                    size: {
                        height: 180
                    }
                });


          $scope.$emit('diversityChartReady',$scope.diversitychart);
          
        }, 
        templateUrl: 'views/directives/diversity.html'
    };

});