'use strict';

/* Filters */
dondev2App.factory('copyService', function($http, $filter) {

	var allElements = [{
				label: 'Condones',
		        icon: 'condones.svg',
		        title: 'condones_name',
		        code: 'condones',
		        newNotFoundResult: 'noResults',
		        notFoundCities: 'noResults',
		        content: 'condones_content',
		        desc: 'condones_desc',
		        short_desc : 'condones_short_desc'
		    },{
		        icon: 'vih.svg',
		        title: 'prueba_name',
		        code: 'prueba',
		        newNotFoundResult: 'noResults',
		        label: 'Prueba',
		      // 	content: 'Encuentra los lugares más cercanos que realizan la prueba de VIH de manera gratuita.'
						content: 'prueba_content',
						desc: 'prueba_desc',
						short_desc : 'prueba_short_desc'
		     }/*,{
		        icon: 'iconos-new_vacunacion-3.png',
		        code: 'vacunatorio',
		        newNotFoundResult: 'No tenemos registrados Vacunatorios',
		        title: 'Vacunatorios',
		        label: 'Vacunatorios',
		        content: 'Encuentra los vacunatorios más cercanos, sus horarios de atención e información de contacto.'
		    },{
		        icon: 'iconos-new_atencion-3.png',
		        title: 'Centros de Infectología',
		        code: 'infectologia',
		        newNotFoundResult: 'No tenemos registrados Centros de Infectología',
		        label: 'Infectología',
		        content: 'Encuentra los centros de infectología más cercanos, sus horarios de atención e información de contacto. '
		    }*/,{
		        icon: 'mac.svg',
		        //title: 'Métodos Anticonceptivos',
						title: 'mac_name',
		        code: 'mac',
		        newNotFoundResult: 'noResults',
		        label: 'Métodos Anticonceptivos',
		      //  content: 'Tienes derecho a recibir gratuitamente, con respeto y privacidad, información clara y el método anticonceptivo que elijas: Preservativos, pastillas e inyección anticonceptiva, anticoncepción de emergencia, implante subdérmico, DIU, ligadura de trompas y vasectomía.'
					 	content: 'mac_content',
						desc: "mac_desc",
						short_desc : 'mac_short_desc'
		    },{
		        icon: 'ile.svg',
		        //title: 'Interrupción Legal del Embarazo',
						title: 'ile_name',
		        code: 'ile',
		        newNotFoundResult: 'noResults',
		        label: 'Interrupción Legal del Embarazo',
		        //content: 'Tienes derecho a recibir información para decidir frente a un embarazo. En Argentina la interrupción del embarazo es legal cuando está en riesgo tu vida o tu salud (física, mental o social) o cuando el embarazo es producto de una violación.'
						content: 'ile_content',
						desc: 'ile_desc',
						short_desc : 'ile_short_desc'
		    },{
		        icon: 'deteccion.svg',
		        //title: 'Detección de Cancer',
						title: 'dc_name',
		        code: 'dc',
		        newNotFoundResult: 'noResults',
		        label: 'Detección de Cancer',
		        //content: 'Tienes derecho a recibir información para decidir frente a un embarazo. En Argentina la interrupción del embarazo es legal cuando está en riesgo tu vida o tu salud (física, mental o social) o cuando el embarazo es producto de una violación.'
						content: 'dc_content',
						desc: 'dc_desc',
						short_desc : 'dc_short_desc'
		    },{
		        icon: 'salud.svg',
		        //title: 'Salud Sexual y Reproductiva',
						title: 'ssr_name',
		        code: 'ssr',
		        newNotFoundResult: 'noResults',
		        label: 'Salud Sexual y Reproductiva',
						content: 'ssr_content',
						desc: 'ssr_desc',
						short_desc : 'ssr_short_desc'
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
