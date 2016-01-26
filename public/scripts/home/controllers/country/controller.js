dondev2App.controller('countryController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	$rootScope.navBar = $routeParams.servicio;
	$scope.service = $routeParams.servicio;
	$scope.activeCountry =  $routeParams.pais ;
	$scope.searchOn= false;
	$rootScope.main = false;

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
});