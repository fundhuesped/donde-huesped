'use strict';

/* Filters */
dondev2App.factory('copyService', function($http, $filter) {
    var allElements = [{
        label: 'Preservativos',
        icon: 'condones.png',
        title: 'condones_name',
        code: 'condones',
        newNotFoundResult: 'No tenemos registrados lugares de entrega gratuita de Preservativos',
        notFoundCities: 'noResults',
        content: 'condones_content',
        desc: 'condones_desc',
        short_desc: 'condones_short_desc',
        show_on_home: true,
    },{
        label: 'Test de VIH',
        icon: 'prueba.png',
        title: 'prueba_name',
        code: 'prueba',
        newNotFoundResult: 'No tenemos registrados Centros de Testeo de VIH',
        notFoundCities: 'noResults',
        content: 'prueba_content',
        desc: 'prueba_desc',
        short_desc: 'prueba_short_desc',
        show_on_home: true,
    },{
        label: 'Vacunatorios',
        icon: 'vacunatorio.png',
        title: 'vacunas_name',
        code: 'vacunatorio',
        newNotFoundResult: 'No tenemos registrados Vacunatorios',
        notFoundCities: 'noResults',
        content: 'vacunas_content',
        desc: 'vacunas_desc',
        short_desc: 'vacunas_short_desc',
        show_on_home: true,
    },{
        label: 'Centros de Infectología',
        icon: 'infectologia.png',
        title: 'infecto_name',
        code: 'infectologia',
        codeAlt :'cdi',
        newNotFoundResult: 'No tenemos registrados Centros de Infectología',
        notFoundCities: 'noResults',
        content: 'infecto_content',
        desc: 'infecto_desc',
        short_desc: 'infecto_short_desc',
        show_on_home: true,
    },{
        label: 'Servicios de Salud Sexual y Reproductiva',
        icon: 'ssr.png',
        title: 'ssr_name',
        code: 'ssr',
        codeAlt: 'sssr',
        newNotFoundResult: 'No tenemos registrados lugares que cuenten con servicios de Salud Sexual y Reproductiva',
        notFoundCities: 'noResults',
        content: 'ssr_content',
        desc: 'ssr_desc',
        short_desc: 'ssr_short_desc',
        show_on_home: true,
    },{
        label: 'Interrupción Legal del Embarazo',
        icon: 'ile.png',
        title: 'ile_name',
        code: 'ile',
        newNotFoundResult: 'No tenemos registrados lugares para obtener información sobre Interrupción Legal del Embarazo',
        notFoundCities: 'noResults',
        content: 'ile_content',
        desc: 'ile_desc',
        short_desc: 'ile_short_desc',
        show_on_home: true,
    },
    {
        label: 'Todos los servicios',
        icon: 'place-off.png',
        title: 'all_name',
        code: 'all',
        newNotFoundResult: 'No tenemos registrados lugares para obtener información sobre Todos los servicios de Donde',
        notFoundCities: 'noResults',
        content: 'all_content',
        desc: 'all_desc',
        short_desc: 'all_short_desc',
        show_on_home: false,
    },
    {
        label: 'Servicios amigables para LGBT',
        icon: 'lgbt.png',
        title: 'lgbt_name',
        code: 'friendly',
        newNotFoundResult: 'No tenemos registrados lugares para obtener información acerca de servicios amigables para LGBT',
        notFoundCities: 'noResults',
        content: 'lgbt_content',
        desc: 'lgbt_desc',
        short_desc: 'lgbt_short_desc',
        show_on_home: false,
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
