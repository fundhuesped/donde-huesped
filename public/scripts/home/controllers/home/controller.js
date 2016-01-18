dondev2App.controller('homeController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	
	$scope.maps = false;
	$scope.countries = false;
	$scope.main = true;
      
  

    $scope.showCountries= function(){
    	$scope.main =false;
    	$scope.countries  =true;
    }

    $scope.showMap= function(){
    	$scope.countries =false;
    	$scope.main =false;
    	$scope.maps  =true;
    	 NgMap.initMap('mainMap');
    }
    
	placesFactory.getAll(function(d){
		$scope.places = d;
	});	

	$scope.paises = [];
	$scope.paises.push('Argentina');
	$scope.paises.push('Chile');
	$scope.paises.push('Uruguay');
	$scope.paises.push('Colombia');
	$scope.paises.push('Mexico');

			$scope.collapsibleElements = [{
		        icon: 'mdi-image-filter-drama',
		        title: 'Preservativos',
		        content: 'Lorem ipsum dolor sit amet.'
		    },{
		        icon: 'mdi-maps-place',
		        title: 'Test HIV',
		        content: 'Lorem ipsum dolor sit amet.'
		    },{
		        icon: 'mdi-social-whatshot',
		        title: 'Vacunacion Hepatitis',
		        content: 'Lorem ipsum dolor sit amet.'
		    },{
		        icon: 'mdi-social-whatshot',
		        title: 'Atencion Infecciosas',
		        content: 'Lorem ipsum dolor sit amet.'
		    }
		];
});