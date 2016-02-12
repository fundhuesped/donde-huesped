dondev2App.controller('locationController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	$rootScope.navBar = $routeParams.servicio;
	$scope.service = $routeParams.servicio;
	
	$scope.searchOn= false;
	$rootScope.main = false;
	$scope.countries = [];
	//TODO: Load from service
	$scope.countries.push('Argentina');
		$scope.countries.push('Chile');
		$scope.countries.push('Uruguay');
		$scope.countries.push('Colombia');
		$scope.countries.push('Mexico');

	placesFactory.load(function(data){
		$scope.provinces = placesFactory.provinces;
	});




	$scope.loadCity = function(){
		$scope.showCity = true;
		placesFactory.getForProvince($scope.selectedProvince,function(data){
			$scope.cities = data;
		})
	};
	$scope.showSearch = function(){
		$scope.searchOn= true;
	}

	$scope.showProvince = function(){
		$scope.provinceOn= true;
	}
});