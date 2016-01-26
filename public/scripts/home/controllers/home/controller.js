dondev2App.controller('homeController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	
	
	$rootScope.main = true;
	$rootScope.navBar = ""
    


			$scope.collapsibleElements = [{
		        icon: 'mdi-image-filter-drama',
		        title: 'Preservativos',
		        code:'preservativos',
		        content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    },{
		        icon: 'mdi-maps-place',
		        title: 'Test HIV',
		        code:'test',
		       content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    },{
		        icon: 'mdi-social-whatshot',
		        code:'vacunacion',
		        title: 'Vacunacion Hepatitis',
		        content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    },{
		        icon: 'mdi-social-whatshot',
		        title: 'Atencion Infecciosas',
		        code:'atencion',
		        content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    }
		];
});