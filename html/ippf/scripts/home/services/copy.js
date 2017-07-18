'use strict';

/* Filters */
dondev2App.factory('copyService', function($http, $filter) {



	var allElements = [{
				label: 'Condones',
		        icon: 'iconos-new_preservativos-3.png',
		        title: 'condones_name',
		        code: 'condones',
		        newNotFoundResult: 'No tenemos registrados lugares de entrega gratuita de Condones',
		        content: 'Encuentra los lugares más cercanos para retirar condones gratis.'
		    },{
		        icon: 'iconos-new_analisis-3.png',
		        title: 'prueba_name',
		        code: 'prueba',
		        newNotFoundResult: 'No tenemos registrados Centros de Testeo de VIH',
		        label: 'Prueba',
		       content: 'Encuentra los lugares más cercanos que realizan la prueba de VIH de manera gratuita.'
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
		        icon: 'iconos-new_sssr-3.png',
		        //title: 'Métodos Anticonceptivos',
						title: 'mac_name',
		        code: 'mac',
		        newNotFoundResult: 'No tenemos registrados lugares de entrega gratuita de métodos anticonceptivos',
		        label: 'Métodos Anticonceptivos',
		        content: 'Tienes derecho a recibir gratuitamente, con respeto y privacidad, información clara y el método anticonceptivo que elijas: Preservativos, pastillas e inyección anticonceptiva, anticoncepción de emergencia, implante subdérmico, DIU, ligadura de trompas y vasectomía.'
		    },{
		        icon: 'iconos-new_ile-3.png',
		        //title: 'Interrupción Legal del Embarazo',
						title: 'ile_name',
		        code: 'ile',
		        newNotFoundResult: 'No tenemos registrados lugares para obtener información sobre Interrupción Legal del Embarazo',
		        label: 'Interrupción Legal del Embarazo',
		        content: 'Tienes derecho a recibir información para decidir frente a un embarazo. En Argentina la interrupción del embarazo es legal cuando está en riesgo tu vida o tu salud (física, mental o social) o cuando el embarazo es producto de una violación.'
		    },{
		        icon: 'iconos-new_ile-3.png',
		        //title: 'Detección de Cancer',
						title: 'dc_name',
		        code: 'dc',
		        newNotFoundResult: 'No tenemos registrados lugares para obtener información sobre Interrupción Legal del Embarazo',
		        label: 'Detección de Cancer',
		        content: 'Tienes derecho a recibir información para decidir frente a un embarazo. En Argentina la interrupción del embarazo es legal cuando está en riesgo tu vida o tu salud (física, mental o social) o cuando el embarazo es producto de una violación.'
		    },{
		        icon: 'iconos-new_ile-3.png',
		        //title: 'Salud Sexual y Reproductiva',
						title: 'ssr_name',
		        code: 'ssr',
		        newNotFoundResult: 'No tenemos registrados lugares para obtener información sobre Interrupción Legal del Embarazo',
		        label: 'Salud Sexual y Reproductiva',
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
