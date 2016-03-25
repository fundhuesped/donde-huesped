'use strict';

/* Filters */
dondev2App.factory('copyService', function($http, $filter) {



	var allElements = [{
				label: 'Condones',
		        icon: 'iconos-new_preservativos-3.png',
		        title: 'Condones',
		        code:'condones',
		        content: 'Encuentra los lugares más cercanos para retirar condones gratis.'
		    },{
		        icon: 'iconos-new_analisis-3.png',
		        title: 'Prueba VIH',
		        code:'prueba',
		        label: 'Prueba',
		       content: 'Encuentra los lugares más cercanos que realizan la prueba de VIH de manera gratuita.'
		    },{
		        icon: 'iconos-new_vacunacion-3.png',
		        code:'vacunatorio',
		        title: 'Vacunatorios',
		        label: 'Vacunatorios',
		        content: 'Encuentra los vacunatorios más cercanos, sus horarios de atención e información de contacto.'  
		    },{
		        icon: 'iconos-new_atencion-3.png',
		        title: 'Centros De Infectología',
		        code:'infectologia',
		        label: 'Infectología',
		        content: 'Encuentra los centros de infectología más cercanos, sus horarios de atención e información de contacto. '
		    }
		];
	var factory = {
		getAll: function(){
			return allElements;
		},
		getFor: function(code){
			for (var i = 0; i < allElements.length; i++) {
				var e = allElements[i];
				if (e.code === code){
					return e;
				}
			};
		}	
	};
  	

	return factory;
});
	