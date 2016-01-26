dondev2App.controller('placeController', 
	function(placesFactory,NgMap, $scope,$rootScope, $routeParams, $location, $http){
	
	$scope.maps = false;
	$scope.countries = false;
	$scope.main = true;
    $scope.navBar = "";
    $scope.markers = [];
  

    $scope.showCountries= function(title){
    	$scope.main =false;
    	$scope.table  =false;
    	$scope.main =false;
    	$scope.table  =false;
    	$scope.countries  =true;
    	$scope.navBar= title;
    }

    $scope.showPostCountries = function(){
    	$scope.postCountries =true;
    	$scope.main =false;
    	$scope.table  =false;
    	$scope.countries  =false;
    }

    $scope.showMap= function(place){
    	$scope.postCountries =false;
    	$scope.countries =false;
    	$scope.main =false;
    	$scope.table  =false;
    	$scope.maps  =true;
    	var map = NgMap.initMap('mainMap');
    	var pos = [place.lat,place.lon];
	 	$scope.mapCenter = pos;
	 	place.pos = pos;
	 	$scope.currentMarker = place;
	 	$scope.markers.push(place);
	 	$scope.navBar= place.nombre;
    }
     $scope.showTable= function(country){
     	$scope.postCountries =false;
    	$scope.countries =false;
    	$scope.main =false;
    	$scope.maps  =false;
    	$scope.table  =true;
    	
    }
    
	placesFactory.getAll(function(d){
		$scope.places = d;
	});	



	$scope.places =[];


	// for (var i = 0; i < 10; i++) {
		$scope.places.push({
			nombre:"Hospital Zonal General de Agudos ”Julio de Vedia”",
			calle:"Tomás Cosentino",
			altura:1223,
			lat:-35.437675,
			lon:-60.8826171,
			localidad:"9 de Julio",
			provincia:"Buenos Aires",
			telefono:"(02317) 43-0004",
			email:"direccion-vedia@ms.gba.gov.ar"
		});
		$scope.places.push({
			nombre:"Hospital Zonal General De Agudos “Lucio Meléndez”",
			calle:"Tomás Cosentino",
			altura:1223,
			lat:-35.437675,
			lon:-60.8826171,
			localidad:"9 de Julio",
			provincia:"Buenos Aires",
			telefono:"(02317) 43-0004/0025/0525/0125",
			email:"direccion-vedia@ms.gba.gov.ar"
		});
		$scope.places.push({
			nombre:"Hospital Zonal General “Dr. Arturo Oñativia”",
			calle:"Tomás Cosentino",
			altura:1223,
			lat:-35.437675,
			lon:-60.8826171,
			localidad:"9 de Julio",
			provincia:"Buenos Aires",
			telefono:"(02317) 43-0004/0025/0525/0125",
			email:"direccion-vedia@ms.gba.gov.ar"
		});
		$scope.places.push({
			nombre:"Unidad Sanitaria N° 19 (Villa arguello)",
			calle:"124",
			altura:1223,
			lat:-35.437675,
			lon:-60.8826171,
			cruce: "e/62 y 63",
			localidad:"Berisso",
			provincia:"Buenos Aires",
			telefono:"(02317) 43-0004/0025/0525/0125",
			email:"direccion-vedia@ms.gba.gov.ar"
		});
		
	// }

	$scope.paises = [];
	$scope.paises.push('Argentina');
	$scope.paises.push('Chile');
	$scope.paises.push('Uruguay');
	$scope.paises.push('Colombia');
	$scope.paises.push('Mexico');

			$scope.collapsibleElements = [{
		        icon: 'mdi-image-filter-drama',
		        title: 'Preservativos',
		        content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    },{
		        icon: 'mdi-maps-place',
		        title: 'Test HIV',
		       content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    },{
		        icon: 'mdi-social-whatshot',
		        title: 'Vacunacion Hepatitis',
		        content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    },{
		        icon: 'mdi-social-whatshot',
		        title: 'Atencion Infecciosas',
		        content: 'Por ley, tenes derecho a recibir preservativos de forma gratuita sin preguntas ni exigencias'
		    }
		];
});