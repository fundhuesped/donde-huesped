'use strict';

/* Filters */
dondev2App.factory('copyService', function($http, $filter) {
  
    var allElements = [{
                label: 'Preservativos',
                icon: 'iconos-new_preservativos-3.png',
                title: 'Preservativos',
                code: 'condones',
                newNotFoundResult: 'No tenemos registrados lugares de entrega gratuita de Preservativos',
                notFoundCities: 'noResults',
                content: 'Encuentra los lugares más cercanos para retirar preservativos gratis.',
                desc: 'condones_desc',
                short_desc: 'condones_short_desc'
            },{
                label: 'Prueba',
                icon: 'iconos-new_analisis-3.png',
                title: 'Prueba VIH',
                code: 'prueba',
                newNotFoundResult: 'No tenemos registrados Centros de Testeo de VIH',
                notFoundCities: 'noResults',
                 content: 'Encuentra los lugares más cercanos que realizan la prueba de VIH de manera gratuita.',
                desc: 'condones_desc',
                short_desc: 'condones_short_desc'
             },{
                label: 'Vacunatorios',
                icon: 'iconos-new_vacunacion-3.png',
                title: 'Vacunatorios',
                code: 'vacunatorio',
                newNotFoundResult: 'No tenemos registrados Vacunatorios',
                notFoundCities: 'noResults',
                content: 'Encuentra los vacunatorios más cercanos, sus horarios de atención e información de contacto.',
                desc: 'condones_desc',
                short_desc: 'condones_short_desc'
            },{
                label: 'Centros de Infectología',
                icon: 'iconos-new_atencion-3.png',
                title: 'Centros de Infectología',
                code: 'infectologia',
                newNotFoundResult: 'No tenemos registrados Centros de Infectología',
                notFoundCities: 'noResults',
                content: 'Encuentra los centros de infectología más cercanos, sus horarios de atención e información de contacto. ',
                desc: 'condones_desc',
                short_desc: 'condones_short_desc'
            },{
                label: 'Servicios de Salud Sexual y Reproductiva',
                icon: 'iconos-new_ssr-3.png',
                title: 'Servicios de Salud Sexual y Reproductiva',
                code: 'mac',
                newNotFoundResult: 'No tenemos registrados lugares de entrega gratuita de métodos anticonceptivos',
                notFoundCities: 'noResults',
                content: 'Tienes derecho a recibir gratuitamente, con respeto y privacidad, información clara y el método anticonceptivo que elijas: Preservativos, pastillas e inyección anticonceptiva, anticoncepción de emergencia, implante subdérmico, DIU, ligadura de trompas y vasectomía.',
                desc: 'condones_desc',
                short_desc: 'condones_short_desc'
            },{
                label: 'Interrupción Legal del Embarazo',
                icon: 'iconos-new_ile-3.png',
                title: 'Interrupción Legal del Embarazo',
                code: 'ile',
                newNotFoundResult: 'No tenemos registrados lugares para obtener información sobre Interrupción Legal del Embarazo',
                notFoundCities: 'noResults',
                content: 'Tienes derecho a recibir información para decidir frente a un embarazo. En Argentina la interrupción del embarazo es legal cuando está en riesgo tu vida o tu salud (física, mental o social) o cuando el embarazo es producto de una violación.',
                desc: 'condones_desc',
                short_desc: 'condones_short_desc'
            } 

        ];

  var factory = {
    getAll: function() {
      return allElements;
    },
    getFor: function(code) {
      for (var i = 0; i < allElements.length; i++) {
        var e = allElements[i];
        if (e.code === code) {
          return e;
        }
      };
    }
  };

  return factory;
});
