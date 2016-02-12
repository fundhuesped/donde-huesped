dondev2App.controller('homeController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	

	$rootScope.moveMapTo = {
		latitude:-9,
		longitude:-113,
		zoom:12
	};
	
	$rootScope.main = true;
	$rootScope.navBar = ""
    


			$scope.collapsibleElements = [{
		        icon: 'iconos-new_preservativos.png',
		        title: 'Preservativos',
		        code:'preservativos',
		        content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    },{
		        icon: 'iconos-new_analisis.png',
		        title: 'Test HIV',
		        code:'test',
		       content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    },{
		        icon: 'iconos-new_vacunacion.png',
		        code:'vacunacion',
		        title: 'Vacunacion Hepatitis',
		        content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    },{
		        icon: 'iconos-new_atencion.png',
		        title: 'Atencion Infecciosas',
		        code:'atencion',
		        content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    }
		];
});