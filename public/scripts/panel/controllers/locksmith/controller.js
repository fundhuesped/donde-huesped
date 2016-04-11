myApp.config(function($interpolateProvider, $locationProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})

.controller('panelplaceController', function($timeout,placesFactory,NgMap, $scope, $rootScope, $http, $location, $route, $routeParams) {

  $scope.spinerflag= false;

  angular.element(document).ready(function() {

      $scope.loading = true;
     $scope.onDragEnd = function(e) {
                    console.log("drag ended",e);
                    $scope.lock.latitude = e.latLng.lat();
                    $scope.lock.longitude = e.latLng.lng()
    };




    $http.get('../../api/panel/' + $scope.lockid).success(function(response) {
        $scope.lock = response[0];
        console.log(response[0]);

        if (!$scope.lock.abierta_24 || $scope.lock.abierta_24 == "0"){
          $scope.lock.abierta_24 = false;
        }else{
          $scope.lock.abierta_24 = true;
        }

        if (!$scope.lock.movil || $scope.lock.movil == "0"){
          $scope.lock.movil = false;
        }else {
            $scope.lock.movil = true;
        }


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
              $scope.lock.position = [lat, lon];

            

              $scope.positions = [];
              $scope.positions.push($scope.lock);
              $scope.center = [lat, lon];


              $scope.loading = false;
              console.log($scope.center);
              console.log($scope.lock.position);

              NgMap.initMap('mapEditor');


            }
        }
    });
});

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

    if (confirm("Desea realmente desaprobar la peticion de la lugar " + $scope.lock.razon_social + "?")) {

            $scope.spinerflag= true;

      $http.post('../../api/dep/' + $scope.lock.id)
        .then(
          function(response) {
            if (response.data.length == 0) {
              document.location.href = $location.path() + '../../dep';
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

  $scope.clicky = function() {

      $scope.spinerflag= true;

      var httpdata = {
          nombre: $scope.lock.nombre,
          razon_social: $scope.lock.razon_social,
          latitude : parseFloat($scope.lock.latitude),
          longitude: parseFloat($scope.lock.longitude),
          direccion: $scope.lock.direccion,
          movil: $scope.lock.movil,
          abierta_24: $scope.lock.abierta_24,
          direccion_particular: $scope.lock.direccion_particular,
          nombre_pais: $scope.lock.nombre_pais,
          nombre_provincia: $scope.lock.nombre_provincia,
          nombre_localidad: $scope.lock.nombre_localidad,
          piso: $scope.lock.piso,
          nro_local: $scope.lock.nro_local,
          cp: $scope.lock.cp,
          mail: $scope.lock.mail,
          tel: $scope.lock.tel,
          tel_24: $scope.lock.tel_24,
          cel: $scope.lock.cel,
          aprobado: 1,
          observacion: $scope.lock.observacion,
          web_url: $scope.lock.web_url,
          entre_calle: $scope.lock.entre_calle,
          idNextTel: $scope.lock.idNextTel
      }

      if (typeof $scope.otra_localidad !== "undefined") {

          data["nombre_localidad"] = $scope.otra_localidad;

      }

        $http.post('../../api/update/' + $scope.lock.id, httpdata)
        .then(
          function(response) {
            if (response.data.length == 0) {

                document.location.href = $location.path() + '../../edit-confirmation';

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
