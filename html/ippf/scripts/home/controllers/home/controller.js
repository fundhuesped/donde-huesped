dondev2App.controller('homeController',
	function($timeout,copyService, placesFactory,NgMap, $anchorScroll, $scope,$rootScope, $routeParams, $location, $http){


  // $(document).ready(function(){
  //   $('.tooltipped').tooltip({delay: 0});
  // });

	$timeout(
		function() {
			$rootScope.moveMapTo = {
      latitude:-12.382928338487396,
      longitude:-79.27734375,
      zoom:3
    };
  },500);
		$rootScope.places = [];
	$rootScope.navigating = false;
	$scope.currentMarker = undefined;

	$rootScope.main = true;
	$rootScope.navBar = ""



	$scope.collapsibleElements = copyService.getAll();
	//console.log($scope.collapsibleElements);
});
