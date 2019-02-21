'use strict';

/* Filters */
dondev2App.factory('copyService', function($http, $filter) {
  
    var allElements = [{
                label: 'Preservativos',
                icon: 'preservativos.png',
                title: 'condones_name',
                code: 'condones',
                newNotFoundResult: 'No tenemos registrados lugares de entrega gratuita de Preservativos',
                notFoundCities: 'noResults',
                content: 'Encuentra los lugares más cercanos para retirar preservativos gratis.',
                desc: 'condones_desc',
                short_desc: 'condones_short_desc'
            },{
                label: 'Test de VIH',
                icon: 'test.png',
                title: 'prueba_name',
                code: 'prueba',
                newNotFoundResult: 'No tenemos registrados Centros de Testeo de VIH',
                notFoundCities: 'noResults',
                content: 'Encuentra los lugares más cercanos que realizan la prueba de VIH de manera gratuita.',
                desc: 'prueba_desc',
                short_desc: 'prueba_short_desc'
             },{
                label: 'Vacunatorios',
                icon: 'vacunatorios.png',
                title: 'vacunas_name',
                code: 'vacunatorio',
                newNotFoundResult: 'No tenemos registrados Vacunatorios',
                notFoundCities: 'noResults',
                content: 'Encuentra los vacunatorios más cercanos, sus horarios de atención e información de contacto.',
                desc: 'vacunas_desc',
                short_desc: 'vacunas_short_desc'
            },{
                label: 'Centros de Infectología',
                icon: 'infectologia.png',
                title: 'infecto_name',
                code: 'infectologia',
                codeAlt :'cdi',
                newNotFoundResult: 'No tenemos registrados Centros de Infectología',
                notFoundCities: 'noResults',
                content: 'Encuentra los centros de infectología más cercanos, sus horarios de atención e información de contacto. ',
                desc: 'infecto_desc',
                short_desc: 'infecto_short_desc'
            },{
                label: 'Servicios de Salud Sexual y Reproductiva',
                icon: 'mac.png',
                title: 'ssr_name',
                code: 'ssr',
                codeAlt: 'sssr',
                newNotFoundResult: 'No tenemos registrados lugares que cuenten con servicios de salud sexual y reproductiva',
                notFoundCities: 'noResults',
                content: 'Tienes derecho a recibir gratuitamente, con respeto y privacidad, información clara y el método anticonceptivo que elijas: Preservativos, pastillas e inyección anticonceptiva, anticoncepción de emergencia, implante subdérmico, DIU, ligadura de trompas y vasectomía.',
                desc: 'ssr_desc',
                short_desc: 'ssr_short_desc'
            },{
                label: 'Interrupción Legal del Embarazo',
                icon: 'ile.png',
                title: 'ile_name',
                code: 'ile',
                newNotFoundResult: 'No tenemos registrados lugares para obtener información sobre Interrupción Legal del Embarazo',
                notFoundCities: 'noResults',
                content: 'Tienes derecho a recibir información para decidir frente a un embarazo. En Argentina la interrupción del embarazo es legal cuando está en riesgo tu vida o tu salud (física, mental o social) o cuando el embarazo es producto de una violación.',
                desc: 'ile_desc',
                short_desc: 'ile_short_desc'
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
