dondev2App.controller('homeController', 
	function(placesFactory, $scope,$rootScope, $routeParams, $location, $http){
	
      
	placesFactory.getAll(function(d){
		$scope.places = d;
	});	
			$scope.collapsibleElements = [{
		        icon: 'mdi-image-filter-drama',
		        title: 'First',
		        content: 'Lorem ipsum dolor sit amet.'
		    },{
		        icon: 'mdi-maps-place',
		        title: 'Second',
		        content: 'Lorem ipsum dolor sit amet.'
		    },{
		        icon: 'mdi-social-whatshot',
		        title: 'Third',
		        content: 'Lorem ipsum dolor sit amet.'
		    }
		];
});