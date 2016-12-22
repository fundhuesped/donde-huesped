dondev2App.controller('cityMapController2', 
	function(placesFactory,NgMap,$scope,$rootScope, $routeParams, $location, $http){

		var id = $routeParams.id;
		var urlShow ="api/v1/panel/places/"+id; 

		$http({
			method : "GET",
			url : urlShow
		}).then(function mySucces(response) {
			// $rootScope.centerMarkers = [];
			$rootScope.currentMarker = response.data[0];
								
			$rootScope.moveMapTo = {
				latitude:parseFloat($rootScope.currentMarker.latitude),
				longitude:parseFloat($rootScope.currentMarker.longitude),
				zoom: 8,
				center: true,
			};
			$rootScope.centerMarkers = [];
			$rootScope.centerMarkers.push($rootScope.currentMarker);
		}); //del get




	});