dondev2App.controller('serviceController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	

		$rootScope.navBar= $routeParams.servicio;
    	$scope.currentService = $routeParams.servicio;
		$scope.paises = [];
		$scope.paises.push('Argentina');
		$scope.paises.push('Chile');
		$scope.paises.push('Uruguay');
		$scope.paises.push('Colombia');
		$scope.paises.push('Mexico');

		
});