dondev2App.controller('locationNewController', 
	function($timeout, copyService, placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	$rootScope.navBar = $routeParams.servicio;
	$scope.service = copyService.getFor($routeParams.servicio);

	$timeout(
		function() {
			$rootScope.moveMapTo = {
      latitude:-12.382928338487396,
      longitude:-79.27734375,
      zoom:3
    };
  },500);
	$rootScope.places = [];
	$scope.searchOn= false;
	$rootScope.main = false;
	$scope.countries = [];
	//TODO: Load from service
	$scope.countries.push({
		nombre: 'Argentina',
		geo:{
			latitude: -37.8514367,
			longitude: -67.2153843,
			zoom:4
		}
	});
	$scope.countries.push({
		nombre: 'Chile',
		geo:{
			latitude: -35.4544075,
			longitude: -74.6860874,
			zoom:4
		}
	});
	$scope.countries.push({
		nombre: 'Uruguay',
		geo:{
			latitude: -32.8846634,
			longitude:-56.2372968,
			zoom:6
		}
	});
	// $scope.countries.push({
	// 	nombre: 'Colombia',
	// 	geo:{
	// 		latitude: 3.8926541,
	// 		longitude:-73.325062,
	// 		zoom:5
	// 	}
	// });
	// $scope.countries.push({
	// 	nombre: 'Mexico',
	// 	geo:{
	// 		latitude: 21.9828103,
	// 		longitude:-106.4451805,
	// 		zoom:5
	// 	}
	// });

	





	$scope.loadCity = function(){
		$scope.showCity = true;
		placesFactory.getCitiesForProvince($scope.selectedProvince,function(data){
			$scope.cities = data;
			$rootScope.moveMapTo =$scope.selectedProvince.geo;
		})

	};
	$scope.showSearch = function(){
		$scope.searchOn= true;
		$rootScope.moveMapTo =$scope.selectedCity.geo;
	}

	$scope.showProvince = function(){
		
		$scope.provinceOn= true;
		$rootScope.moveMapTo =$scope.selectedCountry.geo;
		placesFactory.getProvincesForCountry($scope.selectedCountry.nombre,function(data){
			$scope.provinces = data;
		});
		
	}
});