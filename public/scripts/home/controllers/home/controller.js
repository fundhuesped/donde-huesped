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
		        icon: 'iconos-new_preservativos2.png',
		        title: 'Preservativos',
		        code:'preservativos',
		        content: 'El preservativo es el único método que te protege tanto de embarazos como del VIH y otras ETS.'
		    },{
		        icon: 'iconos-new_analisis2.png',
		        title: 'Test HIV',
		        code:'test',
		       content: 'El test ELISA es un análisis de sangre que detecta anticuerpos al VIH. Es simple, rápido, gratuito y confidencial'
		    },{
		        icon: 'iconos-new_vacunacion2.png',
		        code:'vacunacion',
		        title: 'Vacunacion Hepatitis',
		        content: 'Encontrá los vacunatorios más cercanos, sus horarios de atención e información de contacto.'
		    },{
		        icon: 'iconos-new_atencion2.png',
		        title: 'Atencion Infecciosas',
		        code:'atencion',
		        content: 'Encontrá los centros de infectología más cercanos, sus horarios de atención e información de contacto.'
		    }
		];
});