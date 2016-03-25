dondev2App.controller('homeController', 
	function($timeout,placesFactory,NgMap, $anchorScroll, $scope,$rootScope, $routeParams, $location, $http){
	
	

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
    


			$scope.collapsibleElements = [{
		        icon: 'iconos-new_preservativos-3.png',
		        title: 'Condones',
		        code:'condones',
		        content: 'Encuentra los lugares más cercanos para retirar condones gratis.'
		    },{
		        icon: 'iconos-new_analisis-3.png',
		        title: 'Prueba VIH',
		        code:'prueba',
		       content: 'Encuentra los lugares más cercanos que realizan la prueba de VIH de manera gratuita.'
		    },{
		        icon: 'iconos-new_vacunacion-3.png',
		        code:'vacunatorio',
		        title: 'Vacunatorios',
		        content: 'Encuentra los vacunatorios más cercanos, sus horarios de atención e información de contacto.'  
		    },{
		        icon: 'iconos-new_atencion-3.png',
		        title: 'Centros De Infectología',
		        code:'infectologia',
		        content: 'Encuentra los centros de infectología más cercanos, sus horarios de atención e información de contacto. '
		    }
		];
});