dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})

.controller('panelplaceController', function($timeout,placesFactory,NgMap, $scope, $rootScope, $http, $location, $route, $routeParams, $window) {
  console.log('panelplaceController')

  $scope.spinerflag= false;

  angular.element(document).ready(function() {

      $scope.loading = true;
     $scope.onDragEnd = function(e) {
                    console.log("drag ended",e);
                    $rootScope.place.latitude = e.latLng.lat();
                    $rootScope.place.longitude = e.latLng.lng();
                    $rootScope.place.confidence = 1;
    };


  $http.get('../../api/v2/evaluacion/panel/notificacion/'+ $scope.placeId )
   .success(function(response){
      console.log('Cantidades')
      console.log(response);
      $scope.badge = response;
      $scope.id = $scope.placeId;
    });


    $http.get('../../api/v1/panel/places/' + $scope.placeId).success(function(response) {
    // $http.get('../../api/v1/places2/' + $scope.placeId).success(function(response) {
        $rootScope.place = response[0];
        response[0].es_rapido = (response[0].es_rapido == 1) ? true : false;
        response[0].mac = (response[0].mac == 1) ? true : false;
        response[0].ile = (response[0].ile == 1) ? true : false;
        response[0].condones = (response[0].condones == 1) ? true : false;
        response[0].prueba = (response[0].prueba == 1) ? true : false;
        response[0].vacunatorio = (response[0].vacunatorio == 1) ? true : false;
        response[0].infectologia = (response[0].infectologia == 1) ? true : false;
    //    response[0].es_gratuito = (response[0].es_gratuito == 1) ? true : false;
      //  response[0].comodo = (response[0].comodo == 1) ? true : false;
      //  response[0].informacion_vacunas = (response[0].informacion_vacunas == 1) ? true : false;

  //controlador exportar avaluaciones
  $rootScope.exportEvaluation = function (evaluationList) {
    var data = evaluationList;
    var req = {
    method: 'POST',
    url: '../../panel/importer/eval-export',
    headers: {
      'Content-Type': 'application/force-download'
    },
    data: {evaluationList},
    data2: data
    }

    $http(req).then(function(response){console.log(response)}, function(response){console.log(response)});

  }


$scope.evaluationList=[];
  $http.get('../../api/v2/evaluacion/panel/comentarios/'+ $scope.placeId )
  .success(function(response){
    for (var i = response.length - 1; i >= 0; i--) {
      response[i].info_ok = response[i].info_ok == 1 ? "Si" : "No";
      response[i].privacidad_ok = response[i].privacidad_ok == 1 ? "SI" : "No";
      response[i].comodo = response[i].comodo == 1 ? "SI" : "No";
      response[i].es_gratuito = response[i].es_gratuito == 1 ? "SI" : "No";
      response[i].informacion_vacunas = response[i].informacion_vacunas == 1 ? "SI" : "No";
    }
    $scope.evaluationList = response;
});



        if (typeof response[0] !== "undefined" && response[0] != 0) {
            if (typeof response[0].latitude !== "undefined" && response[0].latitude != 0) {
              var lat = response[0].latitude;
              var lon = response[0].longitude;


              var imageSize = Math.round($(window).width() / 2);

              var imageHeight = Math.round($(window).height() * 0.75);
              if ($(window).height() < 800) {
                imageHeight = Math.round($(window).height() / 3);
              }

              var formatedSize = imageSize + "x" + imageHeight;
              var googleMaps = "https://maps.googleapis.com/maps/api/staticmap?center=" + lat + "," + lon + "&zoom=14&size=" + formatedSize;
              googleMaps += "&markers=color:blue%7Clabel:C%7C" + lat + "," + lon;
              var streetView = "https://maps.googleapis.com/maps/api/streetview?size=" + formatedSize + "&location=" + lat + "," + lon + "&heading=100"
              $scope.googleMaps = googleMaps;
              $scope.streetView = streetView;
              $rootScope.place.position = [lat, lon];



              $scope.positions = [];
              $scope.positions.push($rootScope.place);
              $scope.center = [lat, lon];


              $scope.loading = false;
              console.log($scope.center);
              console.log($rootScope.place.position);

              $http.get('../../api/v1/countries/all')
                .success(function(countries){

                $scope.countries = countries;
                $scope.loadCity();
                $scope.showProvince();

              });
              var map = NgMap.initMap('mapEditor');

              map.panTo(new google.maps.LatLng(lat,lon));

            }
            else
            {
              var lat = 0;
              var lon = 0;


              var imageSize = Math.round($(window).width() / 2);

              var imageHeight = Math.round($(window).height() * 0.75);
              if ($(window).height() < 800) {
                imageHeight = Math.round($(window).height() / 3);
              }

              var formatedSize = imageSize + "x" + imageHeight;
              var googleMaps = "https://maps.googleapis.com/maps/api/staticmap?center=" + lat + "," + lon + "&zoom=14&size=" + formatedSize;
              googleMaps += "&markers=color:blue%7Clabel:C%7C" + lat + "," + lon;
              var streetView = "https://maps.googleapis.com/maps/api/streetview?size=" + formatedSize + "&location=" + lat + "," + lon + "&heading=100"
              $scope.googleMaps = googleMaps;
              $scope.streetView = streetView;
              $rootScope.place.position = [lat, lon];



              $scope.positions = [];
              $scope.positions.push($rootScope.place);
              $scope.center = [lat, lon];


              $scope.loading = false;
              console.log($scope.center);
              console.log($rootScope.place.position);

              $http.get('../../api/v1/countries/all')
                .success(function(countries){

                $scope.countries = countries;
                $scope.loadCity();
                $scope.showProvince();

              });
              var map = NgMap.initMap('mapEditor');

              map.panTo(new google.maps.LatLng(lat,lon));
            }
        }
      });
    });





  $scope.loadCity = function(){
    $scope.showCity = true;

   $http.get('../../api/v1/panel/provinces/'+
     $rootScope.place.idProvincia +'/cities')
     .success(function(cities){
                $scope.cities = cities;
                       $rootScope.cities = cities;
              });


  };


  $scope.showProvince = function(){

    $scope.provinceOn= true;
      $http.get('../../api/v1/countries/'+
        $rootScope.place.idPais + '/provinces')
      .success(function(provinces){
      $scope.provinces = provinces;
    });

  }

  function invalidForm() {

      return false;
  }


  $scope.formChange = function() {

      if (invalidForm()) {
          $scope.invalid = true;
      } else {
          $scope.invalid = false;
      }
  };

  $scope.clickyDis = function() {

    if (confirm("Desea realmente rechazar la peticion de la lugar " + $rootScope.place.establecimiento + "?")) {

            $scope.spinerflag= true;

    $http.post('../../api/v1/panel/places/' + $rootScope.place.placeId + '/block')
        .then(
          function(response) {
            if (response.data.length == 0) {
                 Materialize.toast('Hemos rechazado a   ' + $rootScope.place.establecimiento , 5000);
                // document.location.href = $location.path() + '../../panel';

            } else {
              for (var propertyName in response.data) {
                Materialize.toast(response.data[propertyName], 10000);
              };
            }

                  $scope.spinerflag= false;

          },
          function(response) {
            Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);
            $scope.spinerflag= false;
          });
    }
  };
  $scope.clickyApr = function() {

    if (confirm("Desea realmente aprobar la peticion de la lugar " + $rootScope.place.establecimiento + "?")) {

            $scope.spinerflag= true;

    $http.post('../../api/v1/panel/places/' + $rootScope.place.placeId + '/approve')
        .then(
          function(response) {
            if (response.data.length == 0) {
                 Materialize.toast('Hemos aprobado a   ' + $rootScope.place.establecimiento, 5000);
                 //document.location.href = $location.path() + '../../panel';

            } else {
              for (var propertyName in response.data) {
                Materialize.toast(response.data[propertyName], 10000);
              };
            }

                  $scope.spinerflag= false;

          },
          function(response) {
            Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);
            $scope.spinerflag= false;
          });
    }
  };

  $scope.reloadRoute = function() {
   $route.reload();
  }

  function updateEvaluationStatus() {
    $http.get('../../api/v2/evaluacion/panel/comentarios/'+ $scope.placeId )
    .success(function(response){
      for (var i = response.length - 1; i >= 0; i--) {
        response[i].info_ok = response[i].info_ok == 1 ? "Si" : "No";
        response[i].privacidad_ok = response[i].privacidad_ok == 1 ? "SI" : "No";
      }
      $scope.evaluationList = response;
    });

  }


  $scope.voteYes = function (evaluation) {
      $http.post('../../api/v2/evaluacion/panel/' + evaluation.id + '/approve')
      .then(
        function (response) {
            if (response.data.length == 0) {
              Materialize.toast('Hemos aprobado la calificación',3000);
              updateEvaluationStatus();
              console.log('Ya recargue')
              // $window.location.reload();
            }
            else {
              for (var propertyName in response.data) {
                Materialize.toast(response.data[propertyName], 5000);
              };
            }
        },//del then
        function (response) {
           Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);
        });
  }

  $scope.voteNo = function (evaluation) {
      $http.post('../../api/v2/evaluacion/panel/' + evaluation.id + '/block')
            .then(
        function (response) {
            if (response.data.length == 0) {
              Materialize.toast('Hemos desaprobado la calificación',3000);
              // $window.location.reload();
              updateEvaluationStatus();
              console.log('Ya recargue')
            }
            else {
              for (var propertyName in response.data) {
                Materialize.toast(response.data[propertyName], 5000);
              };
            }
        },//del then
        function (response) {
           Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);
        });
  }


  $rootScope.isChecked = function(d){
    if (d === 1 || d === true){
      return true;
    }
    else {
      return false;
    }
  }

  $scope.trackPartido = function(){
    console.log($scope.place.partido);
    $scope.place.nombre_partido = $scope.place.partido.nombre_partido;
    $scope.place.idPartido = $scope.place.partido.id;
  }


  $scope.clicky = function() {



      $scope.spinerflag= true;

      var httpdata = $rootScope.place;



      if (typeof $scope.otro_partido !== "undefined") {

          data["otro_partido"] = $rootScope.otro_partido;
          data["nombre_partido"] = $rootScope.otro_partido;

      }

      // if (httpdata.es_rapido === true || httpdata.es_rapido === 1)
      // httpdata.es_rapido = 1;
      // else if (httpdata.es_rapido === false || httpdata.es_rapido === 0)
      // httpdata.es_rapido = 0;
      //
      // if (httpdata.mac === true || httpdata.mac === 1)
      // httpdata.mac = 1;
      // else if (httpdata.mac === false || httpdata.mac === 0)
      // httpdata.es_rapido = 0;




      // console.log("aca te va el mac");
      // parseService(httpdata.mac);
      // console.log("aca te va el es_rapido");
      // parseService(httpdata.es_rapido);
      // console.log("aca te va el condones");
      // parseService(httpdata.condones);
      // console.log("aca te va el prueba");
      // parseService(httpdata.prueba);
      // console.log("aca te va el infectologia");
      // parseService(httpdata.infectologia);
      // console.log("aca te va el vacunatorio");
      // parseService(httpdata.vacunatorio);


      // if (httpdata.mac === true || httpdata.mac === 1 )
      //     httpdata.mac = 1;
      //     else
      //     httpdata.mac = 0;
      //
      // if (httpdata.condones === true)
      //     httpdata.condones = 1;
      //     else
      //     httpdata.condones = 0;
      //
      // if (httpdata.infectologia === true)
      //     httpdata.infectologia = 1;
      //     else
      //     httpdata.infectologia = 0;
      //
      // if (httpdata.prueba === true)
      //     httpdata.prueba = 1;
      //     else
      //     httpdata.prueba = 0;
      //
      // if (httpdata.vacunatorio === true)
      //     httpdata.vacunatorio = 1;
      //     else
      //     httpdata.vacunatorio = 0;



          // console.log(httpdata);

        $http.post('../../api/v1/panel/places/'
          + $rootScope.place.placeId + '/update', httpdata)
        .then(
          function(response) {
            if (response.data.length == 0) {

               Materialize.toast('Hemos guardado los datos de  ' + $rootScope.place.establecimiento , 5000);
                 //document.location.href = $location.path() + '../../panel';



            } else {
                for (var propertyName in response.data) {
                    Materialize.toast(response.data[propertyName], 10000);
                };
            }
            $scope.spinerflag= false;
        },
          function(response){
          Materialize.toast('Hemos cometido un error al procesar tu peticion, intenta nuevamente mas tarde.', 5000);
          $scope.spinerflag= false;
        });

  };


  $scope.selectedServiceList = ["prueba","condones","vacunatorios","cdi","sssr","ile"];
  $scope.checkboxService = [];
        $scope.services = [{"name":"Prueba VIH","shortname":"prueba"},{"name":"Condones","shortname":"condones"},{"name":"Vacunatorios","shortname":"vacunatorios"},{"name":"Centros de Infectología","shortname":"cdi"},{"name":"Servicios de Salud Sexual y Repoductiva","shortname":"sssr"},{"name":"Interrupción Legal del Embarazo","shortname":"ile"}];

          $scope.toggle = function (shortname, list) {
            var idx = $scope.selectedServiceList.indexOf(shortname);
            if (idx > -1) {
              $scope.selectedServiceList.splice(idx, 1);
            }
            else {
              $scope.selectedServiceList.push(shortname);
            }
          };

          $scope.exists = function (shortname, list) {
            return $scope.selectedServiceList.indexOf(shortname) > -1;
          };


          $scope.isIndeterminate = function() {
              return ($scope.selectedServiceList.length !== 0 &&
                  $scope.selectedServiceList.length !== $scope.services.length);
            };

            $scope.isChecked = function() {
              return $scope.selectedServiceList.length === $scope.services.length;
            };

            $scope.toggleAll = function() {
              if ($scope.selectedServiceList.length === $scope.services.length) {
                $scope.selectedServiceList = [];
              } else if ($scope.selectedServiceList.length === 0 || $scope.selectedServiceList.length > 0) {
                $scope.selectedServiceList = $scope.services.slice(0);
              }
            };

            $scope.serviceFilter = function(evaluation){
              /*var serviceName = $.grep($scope.services, function(serv){
                if (serv.shortname == evaluation.service) return serv.name;
              });*/
            //  console.log("serviceFilter - evualuation");
            //  console.log(evaluation);
              var a = $scope.selectedServiceList.indexOf(evaluation.service);
                console.log(a);
              return a > -1;
            };


$scope.exportEvaluationsFilterByService = function(placeId){
 //$rootScope.loadingPost = true;

  var f = document.createElement("form");
  f.setAttribute('method',"post");
  f.setAttribute('action',"../../panel/importer/evaluationsExportFilterByService");
  f.style.display = 'none';
  var i1 = document.createElement("input"); //input element, text
  i1.setAttribute('type',"hidden");
  i1.setAttribute('name',"placeId");
  i1.setAttribute('value', placeId);

  var i2 = document.createElement("input"); //input element, text
  i2.setAttribute('type',"hidden");
  i2.setAttribute('name',"selectedServiceList");
  i2.setAttribute('value',$scope.selectedServiceList);

  var s = document.createElement("input"); //input element, Submit button
  s.setAttribute('type',"submit");
  s.setAttribute('value',"Submit");
  s.setAttribute('display',"hidden");

  f.appendChild(i1);
  f.appendChild(i2);
  f.appendChild(s);

  document.getElementsByTagName('body')[0].appendChild(f);
  f.submit();
  document.removeChild(f);
//  console.log("asd " + $scope.selectedServiceList );
  Materialize.toast($scope.selectedServiceList);
  //$rootScope.loadingPost = false;
};


$scope.showCondonIcon = function(service, icon){
  console.log("service : " + service);
  console.log("icon : " + icon);
  return service == icon;
};

});
