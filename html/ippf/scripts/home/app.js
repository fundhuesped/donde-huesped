


var dondev2App = angular.module('dondev2App',['720kb.socialshare','ngMap','ngRoute','ui.materialize','angucomplete','vcRecaptcha','ngTextTruncate','pascalprecht.translate']).

config(['$routeProvider', function($routeProvider) {
  $routeProvider
  .when('/', {
      templateUrl: 'scripts/home/controllers/home/view.html',
      controller: 'homeController'
    }).when('/servicios/:servicio/', {
      templateUrl: 'scripts/home/controllers/location/view.html',
      controller: 'locationController'
    })
    .when('/como-buscas/:servicio/', { //nueva Index
      templateUrl: 'scripts/home/controllers/location/viewTmp.html',
      controller: 'locationController'
    })
    .when('/como-buscas/:servicio/ubicacion', { //nueva vista Opcion 1 (sin uso)
      templateUrl: 'scripts/home/controllers/location/viewUbi.html',
      controller: 'locationController'
    })
    .when('/como-buscas/:servicio/geo', { //nueva vista Opcion 2
      templateUrl: 'scripts/home/controllers/location/viewGeo.html',
      controller: 'locationController'
    })
    .when('/como-buscas/:servicio/sug', { //nueva vista Opcion 3
      templateUrl: 'scripts/home/controllers/suggest-location/viewSug.html',
      controller: 'locationNewController'
    })
    .when('/lugar/nuevo', {
      templateUrl: 'scripts/places/controllers/map/view.html',
      controller: 'placesController'
    }).when('/localizar/:servicio/mapa', {
      templateUrl: 'scripts/home/controllers/city-map/view.html',
      controller: 'locateMapController'
    })
    .when('/localizar/:servicio/listado', {
      templateUrl: 'scripts/home/controllers/locate-list/view.html',
      controller: 'locateListController'
    })
    .when('/:pais/:provincia/:ciudad/:servicio/listado', {
      templateUrl: 'scripts/home/controllers/city-list/view.html',
      controller: 'cityListController'
    })
    .when('/:pais/:provincia/:ciudad/:servicio/mapa', {
      templateUrl: 'scripts/home/controllers/city-map/view.html',
      controller: 'cityMapController'
    })
    .when('/acerca', {
      templateUrl: 'scripts/home/controllers/acerca/view.html',
      controller: 'acercaController'
    })
    .when('/detail/:id', {
      templateUrl: 'scripts/home/controllers/city-map/view2.html',
      controller: 'cityMapController2'
    })
    .when('/califica/:id', {
      templateUrl: 'scripts/home/controllers/evaluation/view.html',
      controller: 'evaluationController'
    })
    .when('/voted/:id', {
      templateUrl: 'scripts/home/controllers/evaluation/completed.html',
      controller: 'evaluationController'
    })

    .otherwise({
        redirectTo: '/'
    });


}])

.config(['$translateProvider', function ($translateProvider) {

  var translation_es = {
    "condones_name": "Condones",
    "condones_content": "Encuentra los lugares más cercanos para retirar condones gratis.",
    "prueba_name": "Prueba VIH",
    "prueba_content": "Encuentra los lugares más cercanos para retirar condones gratis.",
    "mac_name": "Métodos Anticonceptivos",
    "mac_content": "Encuentra los lugares más cercanos para retirar condones gratis.",
    "ile_name": "Interrupción Legal del Embarazo",
    "ile_content": "Encuentra los lugares más cercanos para retirar condones gratis.",
    "dc_name": "Detección de Cancer",
    "dc_content": "Encuentra los lugares más cercanos para retirar condones gratis.",
    "ssr_name": "Salud Sexual y Reproductiva",
    "busqueda_geo_titulo": "Usa tu ubicación actual",
    "busqueda_geo_desc": "Necesita dispositivo con Geolocalización",
    "busqueda_geo_button" : "Buscar",
    "busqueda_auto_titulo": "Escribe tu ciudad.",
    "busqueda_auto_desc": "Ingresa tu ciudad",
    "busqueda_auto_button": "Siguiente",
    "busqueda_auto_acc": "Ubicación Actual (geolocalizada)",
    "cargando_cercanos": "Cargando lugares cercanos",
    "loading_label" : "Cargando",
    "resultado_cantidad_titulo>1": 'Hay [[cantidad]] lugares cerca',
    "resultado_cantidad_titulo=1": 'Hay 1 lugar cerca',
    "friendly_service_label": "Servicio amigable para adolecentes",
    "only_teenager_friendly": "Solo adolecente Friendly",
    "footer_text": 'Donde es una <b>plataforma colaborativa.</b> Si encontrarás un error en los datos o en el funcionamiento de la plataforma <a href="mailto:donde@huesped.org.ar"  target="_self">envianos un mensaje</a>',
    "sort_label_text": "Ordenar:",
    "sort_closest_option": "Más cercano",
    "sort_better_option": "Mejor puntuado",
    "all" : "Todos",
    "without_address": "Sin dirección",
    "place_distance_size" : "[[distance]] metros",
    "evaluation_singular" : "Evaluación",
    "evaluation_plural" : "Evaluaciones",
    "without_evaluations" : "No hay evaluaciones todavía",
    "places_not_found" :  "[[newNotFoundResult]] lugares cerca",
    "suggest_place" : "Sugiere un lugar",
    "seggest" : "Sugerir",
    "client_colaboration" : "Con tu colaboración podemos hacer que la búsqueda sea más certera.",
    "add": "Agregar",
    "searching_service" : " Buscando [[service]]",
    "search_service" : " Buscar [[service]]",
    "customize_search_service_label" :  "Personalize su busqueda de [[service]]",
    "search" : "Buscar",
    "select_country" : "(Elegir Pais)",
    "select_state" : "(Elegir Provincia)",
    "select_department" : "(Elegir Partido o Departamento)",
    "select_location" : "Elegir ubicación",
    "search_department_description" : "Escribe el nombre del Departamento o Partido",
    "not_found_result_label" : "No encontramos resultados...",
    "Mas info en" : "Más info en ",
    "about_usefull_information" : " Información útil",
    "about_href_label" : "Sobre #Dónde",
    "about_href_how_it_works" : "Cómo funciona #Dónde",
    "about_href_aboutfh" : "Sobre Fundación Huésped",
    "about_href_origin" : "Origen de los datos",
    "about_donde_description" : "#Dónde es una plataforma de código abierto que tiene como objetivos favorecer el acceso a servicios para el cuidado de la salud sexual y reproductiva y promover la participación ciudadana para mejorar la calidad de los mismos.",
    "about_donde_description_2" : "De forma rápida y sencilla podés encontrar lugares que brindan los siguientes servicios:",
    "about_donde_description_3" : "También podés acceder a una página con información clara sobre cada tema. #Dónde funciona desde cualquier dispositivo (celular, notebook, PC, tablet) con acceso a internet, no hace falta que descargues ningún programa ni aplicación. El uso es gratuito y anónimo.",
    "about_donde_description_4" : "#Dónde se realizó en varias etapas. La versión original fue desarrollada en 2013 por Fundación Huésped junto a los equipos de Gobierno Abierto y Gobierno Electrónico del Gobierno de la Ciudad de Buenos Aires. En 2015 se sumaron nuevas capas de información. Entre 2016 y 2017 se trabajó para ampliar la cantidad de servicios ofrecidos, incorporar la posibilidad de valorar la atención y mejorar las funcionalidades de administración de la plataforma. Estos desarrollos y el trabajo de validación y difusión junto a organizaciones se realizaron con el apoyo de:",
    "about_li_label_preservativos": "Entrega de preservativos",
    "about_li_label_prueba" : "Test de VIH",
    "about_li_label_ssr" : "Salud Sexual y Reproductiva",
    "about_li_label_dc" : "Detección de Cancer",
    "about_li_label_mac" : "Entrega de métodos anticonceptivos y asesoramiento en salud sexual y reproductiva",
    "about_li_label_ile" : "Información sobre aborto seguro y realización de interrupción legal del embarazo",
    "about_li_rhsc_label" : "a través del fondo Innovation Fund, obtenido en alianza con el ",
    "about_li_rhsc_label_2" : "Centro de Estudios de Estado y Sociedad (CEDES).",
    "about_li_ippf_hro_label" : "Federación Internacional de Planificación de la Familia/Región del Hemisferio Occidental (IPPF/RHO).",
    "about_li_ministerio_label" : "Ministerio de Desarrollo Social de la Nación",
    "about_href_colectivo_1" : "El Colectivo de Juventudes por los Derechos Sexuales y Reproductivos",
    "about_href_colectivo_1" : " constituye una alianza estratégica para esta iniciativa ya que en conjunto se trabajó en la validación de la plataforma y sus contenidos así como en la planificación e implementación de acciones de difusión.",
    "about_title_share_donde" : "Compartí #Dónde en redes sociales",
    "about_href_goto_git" : " Ir al GitHub del proyecto",
    "about_title_find_services" : "Buscar servicios:",
    "about_description_find_services" : "Ingresá a uno de los seis servicios de acuerdo a lo que estés buscando. Hay tres opciones para geolocalizar un lugar: activando tu GPS y buscando el lugar más cercano a tu ubicación, escribiendo el nombre de tu ciudad/provincia, o seleccionando de una lista.",
    "about_title_evaluate_services" : "Evaluar servicios:",
    "about_description_evaluate_services" : "Luego de realizar una búsqueda y seleccionar un servicio, cliqueá sobre el botón para calificar y accederás a una encuesta breve y sencilla. Esta información es muy importante para mejorar la calidad de la atención y el respeto de los derechos.",
    "about_title_add_info" : "Sumar información:",
    "about_descripcion1_add_info" : "Si querés sugerir la incorporación de un nuevo lugar podés acceder a un ",
    "about_description2_add_info" : "formulario",
    "about_description3_add_info" : "desde el botón ",
    "about_description4_add_info" : " en la esquina superior derecha.",
    "about_description5_add_info" : "Para sumar otro tipo de información envianos un mail a ",
    "about_title_about_fundacion" : "Sobre Fundación Huésped",
    "about_descripcion_about_fundacion1" : "Fundación Huésped es una organización argentina con alcance regional que, desde 1989, trabaja en áreas de salud pública con el objetivo de que el derecho a la salud y el control de enfermedades sean garantizados. A partir de un proceso de planificación estratégica en el que se amplió la visión institucional, trabajamos con foco en VIH/sida, Hepatitis virales, enfermedades prevenibles por vacunas y otras enfermedades transmisibles como dengue y zika, entre otras, así como en salud sexual y reproductiva.",
    "about_descripcion_about_fundacion2" : "Nuestro abordaje integral incluye el desarrollo de investigaciones y soluciones prácticas vinculadas a las políticas de salud pública en nuestro país y en la región. También realizamos acciones masivas de comunicación y prevención innovadoras y de alto impacto a través de una constante presencia en medios de comunicación y redes sociales.",
    "about_title_follow" : "Seguinos en redes sociales",
    "about_title_visit_page" : "Visitá nuestra página web",
    "about_description_dataorigin_1" : "Los sitios incluidos en #Dónde se obtuvieron gracias a la colaboración de diferentes organismos y a través de pedidos de información.</a> Como #Dónde es una plataforma colaborativa, los datos se amplían y mejoran con los aportes de cada usuari@.",
    "about_title_thanks_to" : "Agradecemos especialmente a:",
    "about_li_thank_to_1" : "Ministerio de Salud de la Nación, Dirección de Control de Enfermedades Inmunoprevenibles (DiCEI), Sistema Integrado de Información Sanitaria de Argentina (SISA), Programa Nacional de Salud Integral en la Adolescencia (PNSIA), Dirección Nacional de Sida.",
    "about_li_thank_to_2" : "Gobierno de la Ciudad de Buenos Aires, Ministerio de Modernización, Dirección de Calidad Institucional de la Subsecretaría de Gestión Estratégica y Calidad Institucional, Coordinación Sida y Salud Sexual y Reproductiva. ",
    "about_li_thank_to_3" : "Ministerio de Salud de la Provincia de Buenos Aires: Dirección de VIH, ITS y hepatitis virales, Dirección Provincial de Programas Sanitarios; Programa Provincial de Salud Sexual y Reproductiva, Subsecretaría de Atención de la Salud de las Personas.",
    "about_li_thank_to_4" : "Programas Provinciales de Salud Sexual y Procreación Responsable de Salta, Misiones y Santiago del Estero, Secretaría de Prevención y Promoción de la Salud de Córdoba, Sub Dirección de Políticas de Género e Interculturalidad en Salud de Santa Fe.",
    "about_li_thank_to_5" : "OMS en Argentina, ONUSIDA América Latina.",
    "about_li_thank_to_6" : "Alianza de organizaciones integrada por Amnistía Internacional Argentina, Grupo FUSA y Católicas por el Derecho a Decidir con apoyo de IPPF.",
    "about_li_thank_to_7" : "Colectivas de Socorristas en Red, Red de profesionales de la salud por el derecho a decidir, Colectivo de Salud Feminista - Comohacerseunaborto.com.",
    "next" : "Siguiente"

  };


  // add translation table
  $translateProvider
    .translations('es', translation_es)
    .preferredLanguage('es');
}]);


dondev2App.run(function ($rootScope, $timeout, $location) {
  $rootScope.$on("$routeChangeStart", function (event, next, current) {
    var url = $location.url();
    if (url.includes("como-buscas")) {
      $("#mainMap").hide();
      $timeout(function () {
        $("#mainMap").show();
      });
    }
  });
});

dondev2App.directive('filterList', function($timeout) {
    return {
        link: function(scope, element, attrs) {

            var li = Array.prototype.slice.call(element[0].children);

            function filterBy(value) {
                li.forEach(function(el) {
                    el.className = el.textContent.toLowerCase().indexOf(value.toLowerCase()) !== -1 ? '' : 'ng-cloak ng-hide';
                });
            }

            scope.$watch(attrs.filterList, function(newVal, oldVal) {
                if (newVal !== oldVal) {
                    filterBy(newVal);
                }
            });
        }
    };
});
dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})


angular.module('ngMap').run(function($rootScope) {
  $rootScope.$on('mapInitialized', function(evt,map) {
    $rootScope.map = map;
    window.map = $rootScope.map;
    $rootScope.$apply();
  });
  $rootScope.$on( "$routeChangeStart", function(event, next, current) {
      if (!$rootScope.startedNav){
        $rootScope.startedNav =true;
      }
      else {
        $rootScope.navigating = true;
      }
  });
});

dondev2App.filter('unique', function() {
    return function(input, key) {
        var unique = {};
        var uniqueList = [];
        for(var i = 0; i < input.length; i++){
            if(typeof unique[input[i][key]] == "undefined"){
                unique[input[i][key]] = "";
                uniqueList.push(input[i]);
            }
        }
        return uniqueList;
    };
}).run(function($rootScope, $location,placesFactory) {
    placesFactory.load(function(data){});
 $rootScope.$on('$locationChangeStart', function(event) {
   if($location.hash().indexOf('anchor')> -1 || $location.hash().indexOf('acerca') > -1) {

          $anchorScroll();

       event.preventDefault();
    }
  });
    $rootScope.$on( "$routeChangeStart", function(event, next, current) {
        //Cada vez que cambia la vista, se fuerza el cierre del menu.
        $("#sidenav-overlay").trigger("click");



    });
  });



$(document).ready(function(){
    new WOW().init();
    $('.modal-trigger').leanModal();
    $(".button-collapse").sideNav();
});


function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1);
  var a =
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ;
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}

function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
