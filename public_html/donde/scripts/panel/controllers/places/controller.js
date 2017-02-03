dondev2App.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})

.controller('panelplaceController', function($timeout,placesFactory,NgMap, $scope, $rootScope, $http, $location, $route, $routeParams) {
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


$scope.evaluationList=[];
$http.get('../../api/v2/evaluacion/panel/comentarios/'+ $scope.placeId )
 .success(function(response){
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

  $scope.voteYes = function (evaluation) {
      console.log('Entro a votar si')
      console.log(evaluation)
      // $http.post('../../api/v2/evaluacion/panel/' + evaluation.id + '/approve')
  }
  
  $scope.voteNo = function () {
    
    $http.post('../../api/v2/evaluacion/panel/' + evaluation.id + '/block')      
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

});
