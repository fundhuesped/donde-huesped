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
		        title: 'Centros de Infectología',
		        code:'infectologia',
		        label: 'Infectología',
		        content: 'Encuentra los centros de infectología más cercanos, sus horarios de atención e información de contacto. '
		    },{
		        icon: 'iconos-new_sssr-3.png',
		        title: 'Servicios de Salud Sexual y Reproductiva',
		        code:   'mac',
		        label: 'Servicios de Salud Sexual y Reproductiva',
		        content: 'Tienes derecho a recibir gratuitamente, con respeto y privacidad, información clara y el método anticonceptivo que elijas: Preservativos, pastillas e inyección anticonceptiva, anticoncepción de emergencia, implante subdérmico, DIU, ligadura de trompas y vasectomía.'
		    },{
		        icon: 'iconos-new_ile-3.png',
		        title: 'Interrupción Legal del Embarazo',
		        code:  'ile',
		        label: 'Interrupción Legal del Embarazo',
		        content: 'Tienes derecho a recibir información para decidir frente a un embarazo. En Argentina la interrupción del embarazo es legal cuando está en riesgo tu vida o tu salud (física, mental o social) o cuando el embarazo es producto de una violación.'
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
	