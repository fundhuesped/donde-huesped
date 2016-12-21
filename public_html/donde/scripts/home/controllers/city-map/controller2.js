dondev2App.controller('cityMapController2', 
	function(placesFactory,NgMap, copyService,$scope,$rootScope, $routeParams, $location, $http){
		
	$rootScope.$watch('currentMarker',function(){
		 $scope.currentMarker = $rootScope.currentMarker;
	})

		var id = $routeParams.id;
		var urlShow ="api/v1/panel/places/"+id; 

		$http({
			method : "GET",
			url : urlShow
		}).then(function mySucces(response) {
			
			$rootScope.currentMarker = response.data[0];
			
			$rootScope.moveMapTo = {
				latitude:parseFloat($rootScope.currentMarker.latitude),
				longitude:parseFloat($rootScope.currentMarker.longitude),
				zoom:3,
				center: true,
			};

			$rootScope.centerMarkers.push($rootScope.currentMarker);


		});

		$scope.showCurrent = function(i,p){
      // $rootScope.navBar = p.establecimiento;
      $scope.currentMarker = p;
    }
    $scope.closeCurrent = function(){
      $scope.currentMarker = undefined;
    }

	});